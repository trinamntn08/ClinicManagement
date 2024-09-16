<?php
require_once('pdflib/TCPDF/tcpdf.php');
include './config/connection.php';

// Create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Bác sĩ Đợi');
$pdf->SetTitle('Phòng khám bác sĩ Đợi');

// Set margins
$pdf->SetMargins(15, 10, 15);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(10);
$pdf->SetAutoPageBreak(TRUE, 10);

// Add a page
$pdf->AddPage();

// Set font to DejaVu, which supports Vietnamese characters
$pdf->SetFont('dejavusans', '', 12);

// Title
$pdf->SetFont('dejavusans', 'B', 16);
$pdf->Cell(0, 10, "Phòng khám bác sĩ Đợi", 0, 1, 'C');
$pdf->Ln(10);

try {
    $id = $_GET['patientId'];
    // Ensure that variables are correctly retrieved and defined
    $loikhuyen = isset($_GET['loikhuyen']) ? urldecode($_GET['loikhuyen']) : '';
    $hentaikham = isset($_GET['hentaikham']) ? urldecode($_GET['hentaikham']) : '';    
    $ghichukhac = isset($_GET['ghichukhac']) ? urldecode($_GET['ghichukhac']) : '';

    $query = "SELECT `id`, `patient_name`, `diachi`, `tuoi`,
    `cmnd`, date_format(`visit_date`, '%d/%m/%Y') as `visit_date`, `phone_number`, `gender`, `chandoan`, `lamsang`, `gan`,
    `duongmat`, `ongmatchu`, `tuimat`, `thantrai`, `thanphai`, `tuy`, `lach`,
    `bangquang`, `tuicung`, `tucung`, `buongtrungtrai`, `buongtrungphai`, `ghinhankhac`, `hinhanhsieuam`,
    `ketluan`
    FROM `patient_examen` WHERE `id` = ?";
    
    $stmtPatient1 = $con->prepare($query);
    $stmtPatient1->bind_param('i', $id);
    $stmtPatient1->execute();
    $result = $stmtPatient1->get_result();

    if ($row = $result->fetch_assoc()) {
        // Patient Details
        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(22, 10, "Họ và tên:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['patient_name'], 0, 0, 'L');

        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(22, 10, "Tuổi:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(30, 10, $row['tuoi'], 0, 0, 'L');
        
        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(22, 10, "Giới tính:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(30, 10, $row['gender'], 0, 1, 'L');

        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(22, 10, "Địa chỉ:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['diachi'], 0, 1, 'L');

        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(22, 10, "SĐT:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['phone_number'], 0, 0, 'L');

        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(27, 10, "Ngày khám:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['visit_date'], 0, 1, 'L');

        $pdf->Ln(5);

        // Medical Examination Details
        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(32, 10, "1. Chẩn đoán:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['chandoan'], 0, 1, 'L');

        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(32, 10, "2. Lâm sàng:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['lamsang'], 0, 1, 'L');

        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(25, 10, "3. Gan:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['gan'], 0, 1, 'L');

        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(32, 10, "4. Đường mật:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['duongmat'], 0, 1, 'L');

        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(35, 10, "5. Ống mật chủ:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['ongmatchu'], 0, 1, 'L');

        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(32, 10, "6. Túi mật:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['tuimat'], 0, 1, 'L');

        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(32, 10, "7. Thận trái:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['thantrai'], 0, 1, 'L');

        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(32, 10, "8. Thận phải:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['thanphai'], 0, 1, 'L');

        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(25, 10, "9. Tụy:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['tuy'], 0, 1, 'L');

        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(25, 10, "10. Lách:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['lach'], 0, 1, 'L');

        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(35, 10, "11. Bàng quang:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['bangquang'], 0, 1, 'L');

        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(35, 10, "12. Túi cùng:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['tuicung'], 0, 1, 'L');

        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(45, 10, "13. Buồng trứng trái:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['buongtrungtrai'], 0, 1, 'L');

        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(45, 10, "14. Buồng trứng phải:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['buongtrungphai'], 0, 1, 'L');

        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(40, 10, "15. Ghi nhận khác:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['ghinhankhac'], 0, 1, 'L');

        // Print the ultrasound image
        if (!empty($row['hinhanhsieuam'])) {
            $imagePath = "anhsieuam/" . $row['hinhanhsieuam'];
            $pdf->SetFont('dejavusans', 'B', 10);
            $pdf->Cell(25, 10, "16. Hình ảnh siêu âm:", 0, 1, 'L');

            $imageWidth = 120;
            $imageHeight = 120;

            if (file_exists($imagePath)) {
                $currentY = $pdf->GetY();
                $imageX = ($pdf->GetPageWidth() - $imageWidth) / 2;
                $pdf->Image($imagePath, $imageX, $currentY + 5, $imageWidth, $imageHeight);
                $pdf->SetY($currentY + $imageHeight + 10);
            } else {
                $pdf->SetFont('dejavusans', '', 10);
                $pdf->Cell(60, 10, "Không tìm thấy ảnh siêu âm", 0, 1, 'L');
            }
			$pdf->Ln(5);
        }
		else
		{
			$pdf->SetFont('dejavusans', 'B', 10);
			$pdf->Cell(45, 10, "16. Hình ảnh siêu âm:", 0, 0, 'L');
			$pdf->SetFont('dejavusans', '', 10);
			$pdf->Cell(60, 10, "Không có", 0, 1, 'L');
		}
        // Conclusion
        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(32, 10, "17. KẾT LUẬN:", 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(60, 10, $row['ketluan'], 0, 1, 'L');

        // Get the current date components
        $day = date('d'); // Day with leading zero
        $month = date('m'); // Month with leading zero
        $year = date('Y'); // Full year

        // Format the date string
        $dateString = "Ngày $day tháng $month năm $year";
		// Footer
        $pdf->Ln(20);
        $pdf->SetFont('dejavusans', '', 10);
        $pdf->Cell(0, 10,  $dateString, 0, 1, 'R');
        $pdf->Ln(10);
        $pdf->Cell(0, 10, "BÁC SĨ SIÊU ÂM", 0, 1, 'R');

		$pdf->Ln(35);

		$pdf->SetFont('dejavusans', 'B', 10);
		$pdf->Cell(32, 10, "Lời khuyên:", 0, 0, 'L');
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->MultiCell(0, 10, $loikhuyen, 0, 'L');

		$pdf->SetFont('dejavusans', 'B', 10);
		$pdf->Cell(32, 10, "Ghi chú khác:", 0, 0, 'L');
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->MultiCell(0, 10, $ghichukhac, 0, 'L');

		$pdf->SetFont('dejavusans', 'B', 10);
		$pdf->Cell(45, 10, "Hẹn tái khám:", 0, 0, 'L');
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->Cell(60, 10, $hentaikham, 0, 1, 'L');
    } else {
        throw new Exception('No data found for the provided patient ID.');
    }

    $pdf->Output('print_patient_visits.pdf', 'I');

} catch (Exception $ex) {
    echo $ex->getMessage();
    exit;
}
