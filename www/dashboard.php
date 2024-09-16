<?php 
include './config/connection.php';

$date = date('Y-m-d');
$year = date('Y'); 
$month = date('m');

$queryToday = "SELECT count(*) as `today` 
               FROM `patient_examen` 
               WHERE `visit_date` = ?";

$queryWeek = "SELECT count(*) as `week` 
              FROM `patient_examen` 
              WHERE YEARWEEK(`visit_date`, 1) = YEARWEEK(?, 1)";

$queryYear = "SELECT count(*) as `year` 
              FROM `patient_examen` 
              WHERE YEAR(`visit_date`) = YEAR(?)";

$queryMonth = "SELECT count(*) as `month` 
               FROM `patient_examen` 
               WHERE YEAR(`visit_date`) = ? 
               AND MONTH(`visit_date`) = ?";

$todaysCount = 0;
$currentWeekCount = 0;
$currentMonthCount = 0;
$currentYearCount = 0;

try {
    // Today's count
    $stmtToday = $con->prepare($queryToday);
    if ($stmtToday) {
        $stmtToday->bind_param("s", $date);
        $stmtToday->execute();
        $stmtToday->bind_result($todaysCount);
        $stmtToday->fetch();
        $stmtToday->close();
    } else {
        throw new Exception("Query Preparation Failed: " . $con->error);
    }

    // This week's count
    $stmtWeek = $con->prepare($queryWeek);
    if ($stmtWeek) {
        $stmtWeek->bind_param("s", $date);
        $stmtWeek->execute();
        $stmtWeek->bind_result($currentWeekCount);
        $stmtWeek->fetch();
        $stmtWeek->close();
    } else {
        throw new Exception("Query Preparation Failed: " . $con->error);
    }

    // This year's count
    $stmtYear = $con->prepare($queryYear);
    if ($stmtYear) {
        $stmtYear->bind_param("s", $date);
        $stmtYear->execute();
        $stmtYear->bind_result($currentYearCount);
        $stmtYear->fetch();
        $stmtYear->close();
    } else {
        throw new Exception("Query Preparation Failed: " . $con->error);
    }

    // This month's count
    $stmtMonth = $con->prepare($queryMonth);
    if ($stmtMonth) {
        $stmtMonth->bind_param("ss", $year, $month);
        $stmtMonth->execute();
        $stmtMonth->bind_result($currentMonthCount);
        $stmtMonth->fetch();
        $stmtMonth->close();
    } else {
        throw new Exception("Query Preparation Failed: " . $con->error);
    }

} catch (Exception $ex) {
    echo "Error: " . $ex->getMessage();
    echo "<br>Trace: " . $ex->getTraceAsString();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <?php include './config/site_css_links.php';?>
 <title>Tổng quan - Phòng khám bác sĩ Đợi</title>
<style>
  .dark-mode .bg-fuchsia, .dark-mode .bg-maroon {
    color: #fff!important;
}
</style>
</head>
<body class="hold-transition sidebar-mini dark-mode layout-fixed layout-navbar-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->

<?php 

include './config/header.php';
include './config/sidebar.php';
?>  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Số lượng bệnh nhân </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $todaysCount;?></h3>

                <p>Hôm nay</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar-day"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-purple">
              <div class="inner">
                <h3><?php echo $currentWeekCount;?></h3>

                <p>Trong tuần</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar-week"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-fuchsia text-reset">
              <div class="inner">
                <h3><?php echo $currentMonthCount;?></h3>

                <p>Trong tháng</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-maroon text-reset">
              <div class="inner">
                <h3><?php echo $currentYearCount;?></h3>

                <p>Trong năm</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-injured"></i>
              </div>
             
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include './config/footer.php';?>  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include './config/site_js_links.php';?>
<script>
  $(function(){
    showMenuSelected("#mnu_dashboard", "");
  })
</script>

</body>
</html>