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
            if($key == 'company_phone'){
               $user_input[$key] = sanitize::checkamount($value);
            }else{
               $user_input[$key] = sanitize::checkname($value);
            }
            
        }
    }
    if( $user->company_phone($user_input['company_phone']) !=0){
        array_push($result,'Phone number Already Exists');
        $response = $result;
    }else{
        $response = $user->create_company($user_input);
        if($response){
            $result['response'] = true;
            array_push($result,$response);
            $response = $result;
        }else{
            array_push($result,$response);
            $response = $result;
        }
    }
    

    echo json_encode($response);
?>