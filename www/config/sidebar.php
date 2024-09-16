<?php 
if(!(isset($_SESSION['user_id']))) {
  header("location:index.php");
  exit;
}
?>
<aside class="main-sidebar sidebar-dark-primary bg-black elevation-4">
    <a href="./" class="brand-link logo-switch bg-black">
      <h4 class="brand-image-xl logo-xs mb-0 text-center"><b>CMS</b></h4>
      <h4 class="brand-image-xl logo-xl mb-0 text-center">BS Đợi's <b>Clinic</b></h4>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
           
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item" id="mnu_dashboard">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tổng quan
              </p>
            </a>
          </li>

          <li class="nav-item">
              <a href="add_patient.php" class="nav-link" 
                id="mi_add_patient">
                <i class="nav-icon fas fa-user-injured"></i>
                <p>Thêm bệnh nhân mới</p>
              </a>
          </li>

          <li class="nav-item">
              <a href="list_patients.php" class="nav-link" 
                id="mi_list_patients">
                <i class="nav-icon fas fa-user-injured"></i>
                <p>Danh sách bệnh nhân</p>
              </a>
          </li>
 <!--
          <li class="nav-item">
              <a href="patient_histories.php" class="nav-link" 
                id="mi_patient_histories">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lịch sử thăm khám</p>
              </a>
          </li>
          -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>