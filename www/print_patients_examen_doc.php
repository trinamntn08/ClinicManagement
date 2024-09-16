<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include './config/connection.php';

try {
    if (!isset($_GET['patientId']) || empty($_GET['patientId'])) {
        throw new Exception("No patient ID provided.");
    }
    $patientId = intval($_GET['patientId']);

    // Set the character set to UTF-8 for the database connection
    $con->set_charset('utf8');

    $query = "SELECT `id`, `patient_name`, `diachi`, `cmnd`, `tuoi`, 
              date_format(`visit_date`, '%d/%m/%Y') as `visit_date`,  
              `phone_number`, `gender`, `weight`, `patient_diagnostic_id`, 
              `chandoan`, `lamsang`, `gan`, `duongmat`, `ongmatchu`, `tuimat`, 
              `thantrai`, `thanphai`, `tuy`, `lach`, `bangquang`, `tuicung`, 
              `tucung`, `buongtrungtrai`, `buongtrungphai`, `ghinhankhac`, 
              `hinhanhsieuam`, `ketluan`
              FROM `patient_examen` 
              WHERE `id` = ?";

    $stmtPatient1 = $con->prepare($query);
    $stmtPatient1->bind_param('i', $patientId);
    $stmtPatient1->execute();
    $result = $stmtPatient1->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        throw new Exception("No data found for the provided patient ID.");
    }

    // Function to handle text output without conversion
    function clean_utf8_text($text) {
        // Assuming the database content is in UTF-8 and should remain in UTF-8
        return $text; // No conversion, using UTF-8 directly
    }

    // Mapping database fields to placeholders
    $placeholders = [
        "hoten" => clean_utf8_text($row['patient_name']),
        "tuoi" => clean_utf8_text($row['tuoi']),
        "diachi" => clean_utf8_text($row['diachi']),
        "chandoan" => clean_utf8_text($row['chandoan']),
        "lamsang" => clean_utf8_text($row['lamsang']),
        "gan" => clean_utf8_text($row['gan']),
        "duongmat" => clean_utf8_text($row['duongmat']),
        "ongmat" => clean_utf8_text($row['ongmatchu']),
        "tuimat" => clean_utf8_text($row['tuimat']),
        "thantrai" => clean_utf8_text($row['thantrai']),
        "thanphai" => clean_utf8_text($row['thanphai']),
        "tuy" => clean_utf8_text($row['tuy']),
        "lach" => clean_utf8_text($row['lach']),
        "bangquang" => clean_utf8_text($row['bangquang']),
        "tuicung" => clean_utf8_text($row['tuicung']),
        "cungdo" => clean_utf8_text($row['tucung']),
        "buongtrungtrai" => clean_utf8_text($row['buongtrungtrai']),
        "buongtrungphai" => clean_utf8_text($row['buongtrungphai']),
        "ghinhankhac" => clean_utf8_text($row['ghinhankhac']),
        "hinhanhsieuam" => clean_utf8_text($row['hinhanhsieuam']),
        "ketluan" => clean_utf8_text($row['ketluan']),
    ];

    // Initialize COM for Word
    $word = new COM("word.application") or die("Could not initialize MS Word object.");
    $word->Visible = true;

    $templatePath = realpath('./database/patient_examen.doc');
    if (!$templatePath) {
        throw new Exception('Template file not found.');
    }

    $document = $word->Documents->Open($templatePath);

    foreach ($placeholders as $placeholder => $replacement) {
        $word->Selection->Find->ClearFormatting();
        $word->Selection->Find->Replacement->ClearFormatting();
        $word->Selection->Find->Text = $placeholder;
        $word->Selection->Find->Replacement->Text = $replacement;
        $word->Selection->Find->Forward = true;
        $word->Selection->Find->Wrap = 1; // wdFindContinue
        $word->Selection->Find->Format = false;
        $word->Selection->Find->MatchCase = false;
        $word->Selection->Find->MatchWholeWord = false;
        $found = $word->Selection->Find->Execute();

        if ($found) {
            // Use replacement text
            $word->Selection->Text = $replacement;
            echo "Placeholder '$placeholder' replaced with '$replacement'.<br>";
        } else {
            echo "Placeholder '$placeholder' not found in the document.<br>";
        }
    }

} catch (Exception $ex) {
    echo "Error: " . $ex->getMessage();
    exit;
}
?>
