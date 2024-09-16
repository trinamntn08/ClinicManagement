<?php
session_start();

$_SESSION['user_id'] = 1;  // Set a default user ID
$_SESSION['display_name'] = 'Guest';  // Set a default display name
$_SESSION['user_name'] = 'guest';  // Set a default user name
$_SESSION['profile_picture'] = 'default.jpg';  // Set a default profile picture
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Clinic's Patient Management System in PHP</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <style>
  	
  	.login-box {
    	width: 430px;
	}
  
#system-logo {
    width: 5em !important;
    height: 5em !important;
    object-fit: cover;
    object-position: center center;
}
  </style>
</head>
<body class="hold-transition login-page dark-mode">
<div class="login-box">
  <div class="login-logo mb-4">
    <img src="dist/img/logo.jpg" class="img-thumbnail p-0 border rounded-circle" id="system-logo">
    <div class="text-center h2 mb-0">Phòng khám bác sĩ Đợi</div>
  </div>
</div>

<script>
  // Redirect to the main page (dashboard.php)
  window.location.href = "dashboard.php";
</script>

<!-- jQuery -->

</body>
</html>
