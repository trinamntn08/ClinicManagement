<?php 
session_start();


$host = "127.0.0.1";  // Use this IP for localhost in PHP Desktop
$user = "root";
$password = "";
$db = "pms_db";
try {
  $con = new mysqli($host, $user, $password, $db);
  if ($con->connect_error) {
      die("Connection failed: " . $con->connect_error);
  }
} catch(mysqli_sql_exception $e) {
  echo "Connection failed: " . $e->getMessage();
  exit;
}



//24 minutes default idle time
// if(isset($_SESSION['ABC'])) {
// 	unset($_SESSION['ABC']);
// }

