<?php
include './config/connection.php';

if (isset($_POST['patient_id'])) {
    $patientId = $_POST['patient_id'];

    try {
        $query = "DELETE FROM `patient_examen` WHERE `id` = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('i', $patientId);
        $stmt->execute();

        $message = 'Đã xóa bệnh nhân thành công.';
    } catch (PDOException $ex) {
        $message = 'Lỗi khi xóa bệnh nhân: ' . $ex->getMessage();
    }

    header("Location: list_patients.php?message=" . urlencode($message));
    exit;
} else {
    header("Location: list_patients.php");
    exit;
}
