<?php
session_start();
require_once('../db/dblogin.php');
$userLogin = new DBLogin();
$result = array('response'=>'failed');
header("Content-Type:application/json; charset=UTF-8");
    $user=$_POST['username'];
    $password = $_POST['pwd'];
 if(isset($user) && !empty($user) && isset($password) && !empty($password)){
        if ($userLogin->loginSignal($user,$password)==1){  // checks if the user exists
            $result['response']='success';
            $_SESSION['username'] = $user;
            $response = array_merge($userLogin->getUser($user,$password) , $result); // merges success resposne to user information
        }else{
            $response = array_merge(array('incorrect username/ password'), $result);
        }
 }else{
        $response = array_merge(array('username/password cannot be empty'), $result);
 }

 echo json_encode($response);

?>