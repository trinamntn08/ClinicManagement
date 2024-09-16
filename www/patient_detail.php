<?php
include './config/connection.php';
include './common_service/common_functions.php';

$patients = getPatients($con);

try 
{
    if (!isset($_GET['id']) || empty($_GET['id'])) {
      throw new Exception("No patient ID provided.");
    }
    $id = $_GET['id'];
    $query = "SELECT `id`, `patient_name`, `diachi`, 
              `cmnd`,`tuoi`, date_format(`visit_date`, '%d/%m/%Y') as `visit_date`,  
              `phone_number`, `gender`, `weight`, `patient_diagnostic_id`, 
              `chandoan`, `lamsang`, `gan`, `duongmat`, `ongmatchu`, `tuimat`, 
              `thantrai`, `thanphai`, `tuy`, `lach`, `bangquang`, `tuicung`, 
              `tucung`, `buongtrungtrai`, `buongtrungphai`, `ghinhankhac`, 
              `hinhanhsieuam`, `ketluan`
              FROM `patient_examen` 
              WHERE `id` = $id";

    $stmtPatient1 = $con->prepare($query);
    $stmtPatient1->execute();
    $result = $stmtPatient1->get_result();
    $row = $result->fetch_assoc();

    $gender = $row['gender'];
    $dob = $row['visit_date']; 
    $tuoi = $row['tuoi'];
} 
catch(PDOException $ex) 
{
    echo $ex->getMessage();
    echo $ex->getTraceAsString();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <?php include './config/site_css_links.php';?>
 <?php include './config/data_tables_css.php';?>
 <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
 <title>Update Patient Details - Clinic's Patient Management System in PHP</title>
 <style>
    .form-group {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    label {
        flex: 1 0 15%; /* Flex-grow: 1, Flex-shrink: 0, Flex-basis: 15% */
        text-align: left;
    }

    .form-control {
        flex: 1 0 75%; /* Flex-grow: 1, Flex-shrink: 0, Flex-basis: 75% */
    }

    .preview-image {
        max-width: 400px;
        margin-top: 10px;
        display: none;
    }
 </style>
</head>
<body class="hold-transition sidebar-mini dark-mode layout-fixed layout-navbar-fixed">
<div class="wrapper">
  <!-- Navbar -->
 <?php include './config/header.php';?>
 <?php include './config/sidebar.php';?>  
 
 <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bệnh nhân</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="card card-outline card-primary rounded-0 shadow">
        <div class="card-header">
          <h3 class="card-title">Chi tiết thăm khám</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>

        <div class="row justify-content-end">
          <div class="col-md-3">
            <button type="button" id="print_PatientExamen" class="btn btn-primary btn-sm btn-flat btn-block">In</button>
          </div>
        </div>

        <div class="card-body">
          <form method="post">
            <input type="hidden" name="hidden_id" value="<?php echo $row['id'];?>">
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Tên bệnh nhân</label>
                <input type="text" id="patient_name" name="patient_name" required="required"
                  class="form-control form-control-sm rounded-0" value="<?php echo $row['patient_name'];?>" />
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Địa chỉ</label> 
                <input type="text" id="diachi" name="diachi" required="required"
                class="form-control form-control-sm rounded-0" value="<?php echo $row['diachi'];?>" />
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>CMND</label>
                <input type="text" id="cmnd" name="cmnd" required="required"
                class="form-control form-control-sm rounded-0" value="<?php echo $row['cmnd'];?>" />
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Tuổi</label>
                <input type="text" id="tuoi" name="tuoi" required="required"
                class="form-control form-control-sm rounded-0" value="<?php echo $row['tuoi'];?>" />
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Số điện thoại</label>
                <input type="text" id="phone_number" name="phone_number" required="required"
                class="form-control form-control-sm rounded-0" value="<?php echo $row['phone_number'];?>" />
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Giới tính</label>
                  <select class="form-control form-control-sm rounded-0" id="gender" name="gender">
                  <?php echo getGender($gender);?>
                  </select>
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                  <label>Ngày khám</label>
                  <div class="form-group">
                    <div class="input-group date" id="visit_date" data-target-input="nearest">
                        <input type="text" class="form-control form-control-sm rounded-0 datetimepicker-input" 
                               data-target="#visit_date" name="visit_date" value="<?php echo $dob;?>" />
                        <div class="input-group-append" data-target="#visit_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                  </div>
              </div>

              <div class="container">
                <div class="form-group">
                  <label for="chandoan">1. Chẩn đoán:</label>
                  <input id="chandoan" required="required" name="chandoan" 
                  class="form-control form-control-sm rounded-0" value="<?php echo $row['chandoan'];?>" />
                </div>

                <div class="form-group">
                    <label for="lamsang">2. Lâm sàng:</label>
                    <input id="lamsang" required="required" name="lamsang" 
                    class="form-control form-control-sm rounded-0" value="<?php echo $row['lamsang'];?>" />
                </div>

                <div class="form-group">
                    <label for="gan">3. Gan:</label>
                    <input id="gan" required="required" name="gan" 
                    class="form-control form-control-sm rounded-0" value="<?php echo $row['gan'];?>" />
                </div>

                <div class="form-group">
                    <label for="duongmat">4. Đường mật:</label>
                    <input id="duongmat" required="required" name="duongmat" 
                    class="form-control form-control-sm rounded-0" value="<?php echo $row['duongmat'];?>" />
                </div>

                <div class="form-group">
                    <label for="ongmatchu">5. Ống mật chủ:</label>
                    <input id="ongmatchu" required="required" name="ongmatchu" 
                    class="form-control form-control-sm rounded-0" value="<?php echo $row['ongmatchu'];?>" />
                </div>

                <div class="form-group">
                    <label for="tuimat">6. Túi mật:</label>
                    <input id="tuimat" required="required" name="tuimat" 
                    class="form-control form-control-sm rounded-0" value="<?php echo $row['tuimat'];?>" />
                </div>

                <div class="form-group">
                    <label for="thantrai">7. Thận trái:</label>
                    <input id="thantrai" required="required" name="thantrai" 
                    class="form-control form-control-sm rounded-0" value="<?php echo $row['thantrai'];?>" />
                </div>

                <div class="form-group">
                    <label for="thanphai">8. Thận phải:</label>
                    <input id="thanphai" required="required" name="thanphai" 
                    class="form-control form-control-sm rounded-0" value="<?php echo $row['thanphai'];?>" />
                </div>

                <div class="form-group">
                    <label for="tuy">9. Tụy:</label>
                    <input id="tuy" required="required" name="tuy" 
                    class="form-control form-control-sm rounded-0" value="<?php echo $row['tuy'];?>" />
                </div>

                <div class="form-group">
                    <label for="lach">10. Lách:</label>
                    <input id="lach" required="required" name="lach" 
                    class="form-control form-control-sm rounded-0" value="<?php echo $row['lach'];?>" />
                </div>

                <div class="form-group">
                    <label for="bangquang">11. Bàng quang:</label>
                    <input id="bangquang" required="required" name="bangquang" 
                    class="form-control form-control-sm rounded-0" value="<?php echo $row['bangquang'];?>" />
                </div>

                <div class="form-group">
                    <label for="tuicung">12. Túi cùng:</label>
                    <input id="tuicung" required="required" name="tuicung" 
                    class="form-control form-control-sm rounded-0" value="<?php echo $row['tuicung'];?>" />
                </div>

                <div class="form-group">
                    <label for="tucung">13. Tử cung:</label>
                    <input id="tucung" required="required" name="tucung" 
                    class="form-control form-control-sm rounded-0" value="<?php echo $row['tucung'];?>" />
                </div>

                <div class="form-group">
                    <label for="buongtrungtrai">14. Buồng trứng trái:</label>
                    <input id="buongtrungtrai" required="required" name="buongtrungtrai" 
                    class="form-control form-control-sm rounded-0" value="<?php echo $row['buongtrungtrai'];?>" />
                </div>

                <div class="form-group">
                    <label for="buongtrungphai">15. Buồng trứng phải:</label>
                    <input id="buongtrungphai" required="required" name="buongtrungphai" 
                    class="form-control form-control-sm rounded-0" value="<?php echo $row['buongtrungphai'];?>" />
                </div>

                <div class="form-group">
                    <label for="ghinhankhac">16. Ghi nhận khác:</label>
                    <input id="ghinhankhac" required="required" name="ghinhankhac" 
                    class="form-control form-control-sm rounded-0" value="<?php echo $row['ghinhankhac'];?>" />
                </div>

                <div class="form-group">
                  <label for="hinhanhsieuam">17. Hình ảnh siêu âm:</label>
                  <br />
                      <?php if (!empty($row['hinhanhsieuam'])): ?>
                          <img src="anhsieuam/<?php echo $row['hinhanhsieuam']; ?>" alt="Hình ảnh siêu âm" style="max-width: 100%; max-height: 600px;">
                      <?php else: ?>
                        <p style="text-align: left; margin-top: 10px;">Không có</p>
                      <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="ketluan">18. KẾT LUẬN:</label>
                    <input id="ketluan" required="required" name="ketluan" 
                    class="form-control form-control-sm rounded-0" value="<?php echo $row['ketluan'];?>" />
                </div>
                <div class="form-group">
                    <label for="loikhuyen">Lời khuyên:</label>
                    <textarea id="loikhuyen" name="loikhuyen" 
                       class="form-control form-control-sm rounded-0" rows="3">Kiêng: rượu, bia, caffee.&#10;Hạn chế: Hành, tiêu, ớt tỏi, dầu mỡ, rau sống</textarea>
               </div>
               <div class="form-group">
                    <label for="loikhuyen">Ghi chú khác:</label>
                    <textarea id="ghichukhac" name="ghichukhac" 
                       class="form-control form-control-sm rounded-0" rows="3"></textarea>
               </div>
                <div class="form-group">
                    <label for="hentaikham">Hẹn tái khám:</label>
                    <input id="hentaikham" name="hentaikham" 
                          class="form-control form-control-sm rounded-0" value="Sau 1 tuần" />
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>

<?php 
 include './config/footer.php';
  $message = '';
  if(isset($_GET['message'])) {
    $message = $_GET['message'];
  }
?>  

<?php include './config/site_js_links.php'; ?>
<?php include './config/data_tables_js.php'; ?>


<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script>
  showMenuSelected("#mnu_patients", "#mi_patients");

  var message = '<?php echo $message;?>';

  if(message !== '') {
    showCustomMessage(message);
  }

  $(document).ready(function() {
    $('#visit_date').datetimepicker({
        format: 'DD/MM/YYYY', // Correct date format for display
    });

    $("#print_PatientExamen").click(function() {
      var patientId = "<?php echo $row['id'];?>";
      //var win = window.open("print_patients_examen.php?patientId=" + patientId + "&loikhuyen=" + loikhuyen + "&ghichukhac=" + ghichukhac + "&hentaikham=" + hentaikham);
      var win = window.open("print_patients_examen_doc.php?patientId="+ patientId );
      if(win) 
      {
        win.focus();
      } 
      else 
      {
        showCustomMessage('Please allow popups.');
      }
    });
  });
</script>
</body>
</html>
