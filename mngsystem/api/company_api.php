<?php
require_once('../db/DBPatient.php');
$user = new DBPatient();


$result = array('response'=>'failed');
$response = array();
header("Content-Type:application/json; charset=UTF-8");

foreach ($user->get_companies() as $key => $value) {
    array_push($response, $value['company_ID'].' '.$value['company_name']);
    $result['response']=true;
 }
 $response = array_merge(array($response),array($result) );
     
 echo json_encode($response);
?>