<?php
include './config/connection.php';
include './common_service/common_functions.php';

$message = '';
if (isset($_POST['action'])) 
{
    $action = $_POST['action'];
    $patientName = trim($_POST['patient_name']);
    if (empty($patientName)) 
    {
        echo "<script>alert('Cần điền tên bệnh nhân'); window.history.back();</script>";
        exit;
    }

    // Set other fields to NULL if they are empty
    $diachi = isset($_POST['diachi']) ? $_POST['diachi'] : NULL;
    $cmnd = isset($_POST['cmnd']) ? $_POST['cmnd'] : NULL;
    $tuoi = isset($_POST['tuoi']) ? $_POST['tuoi'] : NULL;

    $visit_date = !empty(trim($_POST['visit_date'])) ? trim($_POST['visit_date']) : NULL;
    if ($visit_date) 
    {
        $dateArr = explode("/", $visit_date);
        if (count($dateArr) == 3) {
            $visit_date = $dateArr[2] . '-' . $dateArr[1] . '-' . $dateArr[0];
        } else 
        {
            $visit_date = NULL;
        }
    }

    $phoneNumber = isset($_POST['phone_number']) ? $_POST['phone_number'] : NULL;
    $gender = isset($_POST['gender']) ? $_POST['gender'] : NULL;
    $chandoan = isset($_POST['chandoan']) ? $_POST['chandoan'] : NULL;
    $lamsang = isset($_POST['lamsang']) ? $_POST['lamsang'] : NULL;
    $gan = isset($_POST['gan']) ? $_POST['gan'] : NULL;
    $duongmat = isset($_POST['duongmat']) ? $_POST['duongmat'] : NULL;
    $ongmatchu = isset($_POST['ongmatchu']) ? $_POST['ongmatchu'] : NULL;
    $tuimat = isset($_POST['tuimat']) ? $_POST['tuimat'] : NULL;
    $thantrai = isset($_POST['thantrai']) ? $_POST['thantrai'] : NULL;
    $thanphai = isset($_POST['thanphai']) ? $_POST['thanphai'] : NULL;
    $tuy = isset($_POST['tuy']) ? $_POST['tuy'] : NULL;
    $lach = isset($_POST['lach']) ? $_POST['lach'] : NULL;
    $bangquang = isset($_POST['bangquang']) ? $_POST['bangquang'] : NULL;
    $tuicung = isset($_POST['tuicung']) ? $_POST['tuicung'] : NULL;
    $tucung = isset($_POST['tucung']) ? $_POST['tucung'] : NULL;
    $buongtrungtrai = isset($_POST['buongtrungtrai']) ? $_POST['buongtrungtrai'] : NULL;
    $buongtrungphai = isset($_POST['buongtrungphai']) ? $_POST['buongtrungphai'] : NULL;
    $ghinhankhac = isset($_POST['ghinhankhac']) ? $_POST['ghinhankhac'] : NULL;
    $ketluan = isset($_POST['ketluan']) ? $_POST['ketluan'] : NULL;
    $loikhuyen = isset($_POST['loikhuyen']) ? $_POST['loikhuyen'] : NULL;
    $ghichukhac = isset($_POST['ghichukhac']) ? $_POST['ghichukhac'] : NULL;
    $hentaikham = isset($_POST['hentaikham']) ? $_POST['hentaikham'] : NULL;

    // Store image data into a local folder
    $hinhanhsieuam = NULL; // Initialize as NULL

    if (isset($_FILES["hinhanhsieuam"]) && $_FILES["hinhanhsieuam"]["error"] == 0) 
    {
        $baseName = basename($_FILES["hinhanhsieuam"]["name"]);
        $targetFile = time() . '_' . $baseName;
        $status = move_uploaded_file($_FILES["hinhanhsieuam"]["tmp_name"], 'anhsieuam/' . $targetFile);
        if ($status) 
        {
            $hinhanhsieuam = $targetFile;
        }
    }

    try {
        $con->begin_transaction();

        // If hinhanhsieuam is uploaded, include it in the query
        if ($hinhanhsieuam) 
        {
            $query = "INSERT INTO `patient_examen`(`patient_name`, `diachi`, `cmnd`, `tuoi`, `visit_date`, `phone_number`, `gender`,
                `chandoan`, `lamsang`, `gan`, `duongmat`, `ongmatchu`, `tuimat`, `thantrai`, `thanphai`, `tuy`, `lach`,
                `bangquang`, `tuicung`, `tucung`, `buongtrungtrai`, `buongtrungphai`, `ghinhankhac`, `hinhanhsieuam`, `ketluan`,
                `loikhuyen`, `ghichukhac`, `hentaikham`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?)";
        } 
        else 
        {
            $query = "INSERT INTO `patient_examen`(`patient_name`, `diachi`, `cmnd`, `tuoi`, `visit_date`, `phone_number`, `gender`,
                `chandoan`, `lamsang`, `gan`, `duongmat`, `ongmatchu`, `tuimat`, `thantrai`, `thanphai`, `tuy`, `lach`,
                `bangquang`, `tuicung`, `tucung`, `buongtrungtrai`, `buongtrungphai`, `ghinhankhac`, `ketluan`,
                `loikhuyen`, `ghichukhac`, `hentaikham`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
        }

        $stmtPatient = $con->prepare($query);

        // Check if the preparation of the statement was successful
        if ($stmtPatient === false) {
            die('Prepare failed: ' . $con->error);
        }

        if ($hinhanhsieuam) 
        {
            $stmtPatient->bind_param(
                "ssssssssssssssssssssssssssss",
                $patientName,
                $diachi,
                $cmnd,
                $tuoi,
                $visit_date,
                $phoneNumber,
                $gender,
                $chandoan,
                $lamsang,
                $gan,
                $duongmat,
                $ongmatchu,
                $tuimat,
                $thantrai,
                $thanphai,
                $tuy,
                $lach,
                $bangquang,
                $tuicung,
                $tucung,
                $buongtrungtrai,
                $buongtrungphai,
                $ghinhankhac,
                $hinhanhsieuam,
                $ketluan,
                $loikhuyen,
                $ghichukhac,
                $hentaikham
            );
        } else {
            $stmtPatient->bind_param(
                "sssssssssssssssssssssssssss",
                $patientName,
                $diachi,
                $cmnd,
                $tuoi,
                $visit_date,
                $phoneNumber,
                $gender,
                $chandoan,
                $lamsang,
                $gan,
                $duongmat,
                $ongmatchu,
                $tuimat,
                $thantrai,
                $thanphai,
                $tuy,
                $lach,
                $bangquang,
                $tuicung,
                $tucung,
                $buongtrungtrai,
                $buongtrungphai,
                $ghinhankhac,
                $ketluan,
                $loikhuyen,
                $ghichukhac,
                $hentaikham
            );
        }

        // Execute the query
        $stmtPatient->execute();
        $patientId = $con->insert_id; // Use $con->insert_id to get the correct ID

        // Check if the insert was successful
        if (!$patientId) {
            throw new Exception('Could not retrieve patient ID.');
        }
        // Commit the transaction
        $con->commit();
        // Redirect directly to the patient_detail.php page with the patientId and message
        header("Location: patient_detail.php?id=" . $patientId );
        exit;

    } catch (Exception $ex) {
        $con->rollback();
        echo "Failed: " . $ex->getMessage();
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <?php include './config/site_css_links.php';?>

 <?php include './config/data_tables_css.php';?>

  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <title>Patients - Clinic's Patient Management System in PHP</title>
  <style>
        .container {
            width: 100%;
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        label {
            flex: 1 0 10%; /* Flex-grow: 1, Flex-shrink: 0, Flex-basis: 10% */
            text-align: left;
        }

        .form-control {
            flex: 1 0 80%; /* Flex-grow: 1, Flex-shrink: 0, Flex-basis: 80% */
            width: 100%;
        }

        .preview-image {
            max-width: 400px;
            margin-top: 10px;
            display: none;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini dark-mode layout-fixed layout-navbar-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
<?php include './config/header.php';
include './config/sidebar.php';?>  
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
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
     <div class="card card-outline card-primary rounded-0 shadow">
        <div class="card-header">
          <h3 class="card-title">Thêm bệnh nhân mới</h3>
          
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>

        <div class="card-body">
          <form method="post" enctype="multipart/form-data">
            <div class="row">

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Tên bệnh nhân *</label>
                <input type="text" id="patient_name" name="patient_name" list="patientList" required="required"
                  class="form-control form-control-sm rounded-0"/>
                  <datalist id="patientList">
                    <?php echo $list_patients; ?>
                  </datalist>
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Địa chỉ</label> 
                <input type="text" id="diachi" name="diachi" 
                class="form-control form-control-sm rounded-0"/>
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>CMND</label>
                <input type="text" id="cmnd" name="cmnd" 
                class="form-control form-control-sm rounded-0"/>
              </div>
              
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Tuổi</label>
                <input type="text" id="tuoi" name="tuoi" 
                class="form-control form-control-sm rounded-0"/>
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Số điện thoại</label>
                <input type="text" id="phone_number" name="phone_number"
                class="form-control form-control-sm rounded-0"/>
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
              <label>Giới tính </label>
                <select class="form-control form-control-sm rounded-0" id="gender" 
                name="gender">
                  <?php echo getGender();?>
                </select>
              </div>
              <div class="clearfix">&nbsp;</div>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                  <div class="form-group">
                      <label>Ngày khám</label>
                      <div class="input-group date" id="visit_date_picker" data-target-input="nearest">
                          <input type="text" id="visit_date" class="form-control form-control-sm rounded-0 datetimepicker-input" data-target="#visit_date_picker" name="visit_date" data-toggle="datetimepicker" autocomplete="on" />
                          <div class="input-group-append" data-target="#visit_date_picker" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- FILL THE EXAMEN'S FORM FROM HERE -->
              <div class="container">
                <div class="form-group">
                  <label for="chandoan">1. Chẩn đoán:</label>
                  <input id="chandoan" name="chandoan" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="lamsang">2. Lâm sàng:</label>
                    <input id="lamsang" name="lamsang" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="gan">3. Gan:</label>
                    <input id="gan" name="gan" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="duongmat">4. Đường mật:</label>
                    <input id="duongmat" name="duongmat" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="ongmatchu">5. Ống mật chủ:</label>
                    <input id="ongmatchu" name="ongmatchu" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="tuimat">6. Túi mật:</label>
                    <input id="tuimat" name="tuimat" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="thantrai">7. Thận trái:</label>
                    <input id="thantrai" name="thantrai" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="thanphai">8. Thận phải:</label>
                    <input id="thanphai" name="thanphai" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="tuy">9. Tụy:</label>
                    <input id="tuy" name="tuy" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="lach">10. Lách:</label>
                    <input id="lach" name="lach" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="bangquang">11. Bàng quang:</label>
                    <input id="bangquang" name="bangquang" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="tuicung">12. Túi cùng:</label>
                    <input id="tuicung" name="tuicung" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="tucung">13. Tử cung:</label>
                    <input id="tucung" name="tucung" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="buongtrungtrai">14. Buồng trứng trái:</label>
                    <input id="buongtrungtrai" name="buongtrungtrai" class="form-control form-control-sm rounded-0" />
                </div>

                <div class="form-group">
                    <label for="buongtrungphai">15. Buồng trứng phải:</label>
                    <input id="buongtrungphai" name="buongtrungphai" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="ghinhankhac">16. Ghi nhận khác:</label>
                    <input id="ghinhankhac" name="ghinhankhac" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="hinhanhsieuam">17. Hình ảnh siêu âm:</label>
                    <input id="hinhanhsieuam" type="file" name="hinhanhsieuam" accept="image/*" class="form-control" onchange="previewImage();" />
                    <br />
                    <img id="preview" src="#" alt="Preview Image" class="preview-image" />
                </div>

                <div class="form-group">
                    <label for="ketluan">18. KẾT LUẬN:</label>
                    <input id="ketluan" name="ketluan" class="form-control" />
                </div>
                <br />
                <div class="row justify-content-center">
                  <div class="col-6 text-center">
                      <button type="submit" id="save_Patient" name="action" value="save" class="btn btn-primary btn-lg" style="padding: 10px 30px; font-size: 20px;">Lưu</button>
                  </div>
                </div>
              </div>
          </form>
        </div>
      </div>
    </section>
<?php 
 include './config/footer.php';

  $message = '';
  if(isset($_GET['message'])) {
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
function previewImage() 
{
  var preview = document.getElementById('preview');
  var file    = document.getElementById('hinhanhsieuam').files[0];
  var reader  = new FileReader();

  reader.onloadend = function () 
  {
    preview.src = reader.result;
    preview.style.display = 'block';
  }

  if (file) 
  {
    reader.readAsDataURL(file);
  } 
  else 
  {
    preview.src = '';
    preview.style.display = 'none';
  }
}
</script>

<script>
  showMenuSelected("#mnu_patients", "#mi_add_patient");

  var message = '<?php echo $message;?>';

  if(message !== '') {
  showCustomMessage(message);
  }

  $(document).ready(function() 
  {
      $('#visit_date_picker').datetimepicker({
          format: 'L'
      });

      var today = new Date();
      var formattedDate = ("0" + today.getDate()).slice(-2) + "/" + ("0" + (today.getMonth() + 1)).slice(-2) + "/" + today.getFullYear();
      $('#visit_date').val(formattedDate);

  });
</script>
</body>
</html>
