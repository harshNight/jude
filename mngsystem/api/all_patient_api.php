<?php
require_once('../db/DBPatient.php');
header('Content-Type:application/json; CHARSET=UTF-8');
$cases = new DBPatient();
if(isset($_GET['appointment_form'])){
  echo json_encode($cases->get_daily_cases() );
}

?>