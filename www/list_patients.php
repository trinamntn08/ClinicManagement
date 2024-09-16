<?php
include './config/connection.php';
include './common_service/common_functions.php';

$message = '';
if (isset($_POST['save_Patient'])) {

    $patientName = trim($_POST['patient_name']);
    $patientName = ucwords(strtolower($patientName));
    $diachi = trim($_POST['diachi']);
    $diachi = ucwords(strtolower($diachi));
    $cmnd = trim($_POST['cmnd']);
    $tuoi = trim($_POST['tuoi']);

    $visit_date = trim($_POST['visit_date']);
    $dateArr = explode("/", $visit_date);
    $visit_date = $dateArr[2] . '-' . $dateArr[0] . '-' . $dateArr[1];

    $phoneNumber = trim($_POST['phone_number']);
    $gender = $_POST['gender'];
    $chandoan = $_POST['chandoan'];
    $lamsang = $_POST['lamsang'];
    $gan = $_POST['gan'];
    $duongmat = $_POST['duongmat'];
    $ongmatchu = $_POST['ongmatchu'];
    $tuimat = $_POST['tuimat'];
    $thantrai = $_POST['thantrai'];
    $thanphai = $_POST['thanphai'];
    $tuy = $_POST['tuy'];
    $lach = $_POST['lach'];
    $bangquang = $_POST['bangquang'];
    $tuicung = $_POST['tuicung'];
    $tucung = $_POST['tucung'];
    $buongtrungtrai = $_POST['buongtrungtrai'];
    $buongtrungphai = $_POST['buongtrungphai'];
    $ghinhankhac = $_POST['ghinhankhac'];
    $ketluan = $_POST['ketluan'];

    // Handle image upload
    $hinhanhsieuam = '';
    if (isset($_FILES["hinhanhsieuam"]) && $_FILES["hinhanhsieuam"]["error"] == 0) {
        $baseName = basename($_FILES["hinhanhsieuam"]["name"]);
        $targetFile = time() . $baseName;
        $uploadDir = 'anhsieuam/';

        if (move_uploaded_file($_FILES["hinhanhsieuam"]["tmp_name"], $uploadDir . $targetFile)) {
            $hinhanhsieuam = $targetFile;
        } else {
            $message = 'A problem occurred during image uploading.';
            header("Location: congratulation.php?goto_page=list_patients.php&message=$message");
            exit;
        }
    }

    try {
        $con->begin_transaction();

        $query = "INSERT INTO `patient_examen`(`patient_name`, 
        `diachi`, `cmnd`, `tuoi`, `visit_date`, `phone_number`, `gender`,
        `chandoan`, `lamsang`, `gan`, `duongmat`, `ongmatchu`,
        `tuimat`, `thantrai`, `thanphai`, `tuy`, `lach`,
        `bangquang`, `tuicung`, `tucung`, `buongtrungtrai`, `buongtrungphai`,
        `ghinhankhac`, `hinhanhsieuam`, `ketluan`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        $stmtPatient = $con->prepare($query);
        $stmtPatient->bind_param('ssssssssssssssssssssssss', 
            $patientName, $diachi, $cmnd, $tuoi, $visit_date, $phoneNumber, $gender,
            $chandoan, $lamsang, $gan, $duongmat, $ongmatchu, $tuimat, $thantrai,
            $thanphai, $tuy, $lach, $bangquang, $tuicung, $tucung, $buongtrungtrai,
            $buongtrungphai, $ghinhankhac, $hinhanhsieuam, $ketluan
        );
        $stmtPatient->execute();
        $con->commit();

        $message = 'Đã thêm bệnh nhân vào danh sách';
    } 
    catch (PDOException $ex) 
    {
        $con->rollback();
        echo $ex->getMessage();
        echo $ex->getTraceAsString();
        exit;
    }

    header("Location: congratulation.php?goto_page=list_patients.php&message=$message");
    exit;
}

// Fetch patients data
try 
{
    $query = "SELECT `id`, `patient_name`, `diachi`, 
    `cmnd`, date_format(`visit_date`,  '%d/%m/%Y') as `visit_date`, 
    `phone_number`, `gender` 
    FROM `patient_examen` ORDER BY `patient_name` ASC;";

    $stmtPatient1 = $con->prepare($query);
    $stmtPatient1->execute();
    $result = $stmtPatient1->get_result();
} 
catch (PDOException $ex) 
{
    echo $ex->getMessage();
    echo $ex->getTraceAsString();
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './config/site_css_links.php'; ?>
    <?php include './config/data_tables_css.php'; ?>

    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <style>
        .dt-button-separator 
        {
            margin: 0 10px;
            font-weight: bold;
            color: #FFF; /* Adjust color as needed */
        }
        .dataTables_wrapper .top {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 10px;
            width: 100%;
        }

        .dataTables_wrapper .middle {
    display: flex;
    justify-content: flex-start;
    margin-bottom: 10px;
    width: 100%;
}

        .dataTables_wrapper .dt-buttons 
        {
            display: flex;
            gap: 20px;
        }

        .dataTables_wrapper .dt-buttons .dt-button:first-child 
        {
            margin-right: auto;
        }
        .dataTables_wrapper .dataTables_filter label input {
            flex-grow: 1;
            margin-left: 10px;
            width: 70%; /* Set desired width */
            height: 2em; /* Adjust height as needed */
            font-size: 1.1em; /* Adjust font size as needed */
            padding: .375rem .75rem; /* Adjust padding as needed */
            border: 1px solid #ced4da;
            border-radius: .25rem;
        }

    </style>
    <title>Patients - Clinic's Patient Management System in PHP</title>
</head>
<body class="hold-transition sidebar-mini dark-mode layout-fixed layout-navbar-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <?php include './config/header.php'; ?>
    <?php include './config/sidebar.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Bệnh nhân</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card card-outline card-primary rounded-0 shadow">
                <div class="card-header">
                    <h3 class="card-title">Danh sách bệnh nhân</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row table-responsive">
                        <table id="all_patients"
                               class="table table-striped dataTable table-bordered dtr-inline"
                               role="grid" aria-describedby="all_patients_info">

                            <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Tên bệnh nhân</th>
                                <th>Địa chỉ</th>
                                <th>Ngày khám</th>
                                <th>Số điện thoại</th>
                                <th>Giới tính</th>
                                <th>CMND</th>
                                <th>Chi tiết</th>
                                <th>Xóa</th> 
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $count = 0;
                            while ($row = $result->fetch_assoc()) {
                                $count++;
                                ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo htmlspecialchars($row['patient_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['diachi']); ?></td>
                                    <td><?php echo htmlspecialchars($row['visit_date']); ?></td>
                                    <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                                    <td><?php echo htmlspecialchars($row['gender']); ?></td>
                                    <td><?php echo htmlspecialchars($row['cmnd']); ?></td>
                                    <td>
                                        <a href="patient_detail.php?id=<?php echo $row['id']; ?>"
                                           class="btn btn-primary btn-sm btn-flat">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form method="post" action="delete_patient.php" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bệnh nhân này?');">
                                            <input type="hidden" name="patient_id" value="<?php echo $row['id']; ?>" />
                                            <button type="submit" class="btn btn-danger btn-sm btn-flat">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </section>
    </div>
    <!-- /.content-wrapper -->
    <?php
    include './config/footer.php';

    $message = '';
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
    }
    ?>
    <!-- /.control-sidebar -->
<?php include './config/site_js_links.php'; ?>
<?php include './config/data_tables_js.php'; ?>


<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script>
    showMenuSelected("#mnu_patients", "#mi_list_patients");

    var message = '<?php echo $message;?>';

    if(message !== '') {
    showCustomMessage(message);
    }
    $('#visit_date').datetimepicker({
        format: 'L'
    });

    $(document).ready(function() 
    {
        // Function to remove accents
        function removeAccents(str) {
            return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        }

        // Custom search function
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var searchValue = $('#all_patients_filter input').val().toLowerCase();
                var dataStr = data.join(' ').toLowerCase();
                return removeAccents(dataStr).includes(removeAccents(searchValue));
            }
        );

        // Initialize DataTable
        var table = $("#all_patients").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "dom": '<"top"f><"middle"B>rt<"bottom"lip><"clear">',
            "language": {
                "search": "Tìm theo tên bệnh nhân:",
                "lengthMenu": "Hiển thị _MENU_ mục",
                "zeroRecords": "Không tìm thấy dữ liệu",
                "info": "Hiển thị _START_ đến _END_ trên tổng số _TOTAL_ mục",
                "infoEmpty": "Hiển thị 0 đến 0 của 0 mục",
                "infoFiltered": "(lọc từ _MAX_ mục)",
                "paginate": {
                    "first": "Đầu tiên",
                    "last": "Cuối cùng",
                    "next": "Tiếp",
                    "previous": "Trước"
                },
                "buttons": {
                    "colvis": "Chọn cột hiển thị",
                    "excel": "Tải xuống file Excel",
                    "pdf": "Tải xuống file PDF",
                    "print": "In"
                }
            },
            "buttons": [
                'colvis',
                'excel',
                'pdf',
                {
                    extend: 'print',
                    text: 'In',
                    exportOptions: {
                        columns: ':not(:last-child):not(:nth-last-child(2))'  // Exclude the last two columns
                    },
                    customize: function (win) {
                        $(win.document.body)
                            .css('font-size', '10pt')
                            .prepend(
                                '<h3 style="text-align:center;">Danh sách bệnh nhân</h3>'
                            );

                        $(win.document.body).find('table')
                            .addClass('display')
                            .css('font-size', 'inherit');
                    }
                }
            ]
        }).buttons().container().appendTo('#all_patients_wrapper .col-md-6:eq(0)');

    // Redraw table when the search input changes
    $('#all_patients_filter input').on('input', function() 
    {
        table.draw();
    });
});
</script>

<script>
function previewImage() {
  var preview = document.getElementById('preview');
  var file    = document.getElementById('hinhanhsieuam').files[0];
  var reader  = new FileReader();

  reader.onloadend = function () {
    preview.src = reader.result;
    preview.style.display = 'block';
  }

  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = '';
    preview.style.display = 'none';
  }
}
</script>


</body>
</html>