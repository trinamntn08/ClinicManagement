<?php 
function getGender($gender = 'Nam') 
{
    $arr = array("Nam", "Nữ", "Khác");
    $data = '';

    foreach ($arr as $value) {
        if ($gender == $value) {
            $data .= '<option selected="selected" value="'.$value.'">'.$value.'</option>';
        } else {
            $data .= '<option value="'.$value.'">'.$value.'</option>';
        }
    }

    return $data;
}

function getMedicines($con, $medicineId = 0) 
{
    $query = "SELECT `id`, `medicine_name` FROM `medicines` ORDER BY `medicine_name` ASC;";
    $stmt = $con->prepare($query);

    try {
        $stmt->execute();
    } catch (PDOException $ex) {
        die('Execute failed: ' . $ex->getMessage());
    }

    $data = '<option value="">Select Medicine</option>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $selected = $medicineId == $row['id'] ? 'selected="selected"' : '';
        $data .= '<option ' . $selected . ' value="' . $row['id'] . '">' . $row['medicine_name'] . '</option>';
    }

    return $data;
}

function getPatients($con) 
{
    $query = "SELECT `id`, `patient_name`, `phone_number` FROM `patients` ORDER BY `patient_name` ASC;";
    $stmt = $con->prepare($query);

    try {
        $stmt->execute();
    } catch (PDOException $ex) {
        die('Execute failed: ' . $ex->getMessage());
    }

    $data = '<option value="">Select Patient</option>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data .= '<option value="' . $row['id'] . '">' . $row['patient_name'] . ' (' . $row['phone_number'] . ')</option>';
    }

    return $data;
}

function getPatientHistory($con) 
{
    $query = "SELECT `patient_name`, `id`, `diachi`, `cmnd`, 
              DATE_FORMAT(`visit_date`, '%d %b %Y') as `visit_date`, 
              `phone_number`, `gender`, `tuoi`  
              FROM `patient_examen` ORDER BY `patient_name` ASC;";
    $stmt = $con->prepare($query);

    try {
        $stmt->execute();
    } catch (PDOException $ex) {
        die('Execute failed: ' . $ex->getMessage());
    }

    $data = '<option value="">Select Patient</option>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $diachi = isset($row['diachi']) ? $row['diachi'] : ''; 
        $cmnd = isset($row['cmnd']) ? $row['cmnd'] : ''; 
        $phone_number = isset($row['phone_number']) ? $row['phone_number'] : ''; 
        $gender = isset($row['gender']) ? $row['gender'] : ''; 
        $tuoi = isset($row['tuoi']) ? $row['tuoi'] : ''; 
        $data .= '<option value="' . $row['patient_name'] . '" 
                  data-diachi="' . $diachi . '" 
                  data-cmnd="' . $cmnd . '" 
                  data-phone_number="' . $phone_number . '" 
                  data-gender="' . $gender . '" 
                  data-tuoi="' . $tuoi .'">' . $row['patient_name'] . '</option>';
    }

    return $data;
}

function getPatientVisits($con) 
{
    $query = "SELECT `id`, `patient_name`, `phone_number` 
              FROM `patients` ORDER BY `patient_name` ASC;";
    $stmt = $con->prepare($query);

    try {
        $stmt->execute();
    } catch (PDOException $ex) {
        die('Execute failed: ' . $ex->getMessage());
    }

    $data = '<option value="">Select Patient</option>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data .= '<option value="' . $row['id'] . '">' . $row['patient_name'] . ' (' . $row['phone_number'] . ')</option>';
    }

    return $data;
}

function getDateTextBox($label, $dateId) 
{
    $d = '<div class="col-lg-3 col-md-3 col-sm-4 col-xs-10">
                <div class="form-group">
                  <label>'.$label.'</label>
                  <div class="input-group rounded-0 date" 
                  id="" 
                  data-target-input="nearest">
                  <input type="text" class="form-control form-control-sm rounded-0 datetimepicker-input" data-toggle="datetimepicker" 
                  data-target="#'.$dateId.'" name="'.$dateId.'" id="'.$dateId.'" required="required" autocomplete="off"/>
                  <div class="input-group-append rounded-0" 
                  data-target="#'.$dateId.'" 
                  data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>';

    return $d;
}

