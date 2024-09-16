<?php
include './config/connection.php';

// Ensure that the key exists in the $_GET array
$gotoPage = isset($_GET['goto_page']) ? $_GET['goto_page'] : 'list_patients.php';
$message = isset($_GET['message']) ? $_GET['message'] : '';

// Redirect with the message
header("Location: $gotoPage?message=" . urlencode($message));
exit;
