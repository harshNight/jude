<?php
session_start();
require_once('../db/appointment.php');
$result = array('response'=>'failed');
header("Content-Type:application/json; charset=UTF-8");
$patientID=$_POST['p_id'];
$appt = new DBAppointment();
$response = $appt->get_appointment($patientID);
echo json_encode($response);
?>