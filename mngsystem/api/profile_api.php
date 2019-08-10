<?php
require_once('../db/DBPatient_search.php');
header('Content-Type:application/json; CHARSET=UTF-8');
$appointment = new DBPatient_search();
$result = false;
  if(isset($_POST['form'])){
    $response = $appointment->check_appointment_id($_POST['appointment_ID']);
    if($response = 1){
      $result = true;
     $response = array_merge(array($appointment->get_appointment_info($_POST['appointment_ID']) ), array('result'=>$result) );
     echo json_encode($response);
    }else{
        echo array(array('response'=>'APPINTMENT ID DOES NOT EXIST') );
    }
    
  }
?>