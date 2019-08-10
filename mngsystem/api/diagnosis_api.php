<?php
session_start();
require_once('../db/DBDiagnosis.php');
$result = array('response'=>'failed');
$response = '';
header("Content-Type:application/json; charset=UTF-8");
$appt = new DBDiagnosis();
if(isset($_POST['form']) && $_POST['form']=='security' ){
    
    $patientID=$_POST['appointment_id'];
    if($appt->check_completed_appointment($patientID)!=0){
        $response = $appt->get_appointment_details($patientID);
    }else{
        $response = false;
    }
    
    echo json_encode($response);
}

if(isset($_POST['sender']) && !empty(trim($_POST['sender']) ) ){
    $appointmentID=$_POST['appointment_id'];
    $symptoms =$_POST['symptoms'];
    $sender = $_POST['sender'];
    if($sender =='btn_symptom'){
        $response = $appt->update_symptoms( $appointmentID, $symptoms);
    }
    if($sender =='btn_diagnosis'){
        $response = $appt->update_diagnosis( $appointmentID, $symptoms);
    }
    if($sender =='btn_prescription'){
        //$appt->check_lab_status($apptID)
        $response = $appt->update_prescription( $appointmentID, $symptoms);
    }
    echo json_encode($response);

   
}

if(isset($_POST['form']) && $_POST['form']=='terminate' ){
    
    $patientID=$_POST['appointment_id'];
    if($appt->check_appointment_id($patientID)!=0){
        $response = $appt->delete_appointment($patientID);
    }else{
        $response = false;
    }
    
    echo json_encode($response);
}

?>