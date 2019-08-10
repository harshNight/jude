<?php
// session_start();
require_once('../db/DBPatient.php');
$user = new DBPatient();


$result = array('response'=>'failed');
header("Content-Type:application/json; charset=UTF-8");
$user_input = array();    
    foreach ($_POST as $key => $value) { // forces empty string to become null
        if(empty($value) ){
           $user_input[$key] = null;
        }else{
            if($key == 'kin_phone' || $key == 'patient_phone' ){
               $user_input[$key] = sanitize::checkamount($value);
            }else{
               $user_input[$key] = sanitize::checkname($value);
            }
            
        }
    }

    function check_for_null($ar){ // makes sure the field is not null
        if(is_null($ar) ){
             return true;
        }
    }

 if(check_for_null($user_input['patient_phone'])){
     // if the user_phone number is null in this check
     array_push($result,'phone number cannot be null');
     $response = $result;
 }else{
              // sends the entire field to the database
       $response = $user->create_new_patient($user_input); //expects an array
     //  $response = array_push($result,$response);
    // $response = check_for_null($user_input['patient_phone']); //$user_input['patient_phone'];
  }

 echo json_encode($response);

?>