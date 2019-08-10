<?php
    require_once('../db/DBPatient_search.php');
    header('Content-Type:application/json; CHARSET=UTF-8');
    $patient = new DBPatient_search();
$result = array('result'=>false);
if(isset($_POST['form']) && $_POST['form']=='ID_search'){
    $ID = sanitize::checkname(trim($_POST['patient_ID']) );
    if ($patient->check_patient_id($ID)==1) {
        $result['result']= true;
        $response = array_merge([$patient->get_patient_info($ID)['patient_ID']],$result);
    }else{
        $response = $result;
    }
}

if(isset($_POST['form']) && $_POST['form']=='profile_search'){
    $ID = sanitize::checkname(trim($_POST['patient_ID']) );
    if ($patient->check_patient_id($ID)==1) {
        $result['result']= true;
        $response = array_merge([$patient->get_patient_info($ID)],$result);
    }else{
        $response = $result;
    }
}

if(isset($_POST['form']) && $_POST['form']=='fullname_search'){
    $phone = sanitize::checkamount($_POST['patient_tel']);
    $fullname = sanitize::checkname($_POST['patient_name']);
    if ($patient->check_patient_info($fullname,$phone)==1) {
        $result['result']= true;
        $response = array_merge([$patient->get_search_patient_info($fullname,$phone)->fetch()['patient_ID']],$result);
     }else{
        $response = $result;
     }
}
    
echo json_encode($response);
?>