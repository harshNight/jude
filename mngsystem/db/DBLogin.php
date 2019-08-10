<?php
 require_once(__DIR__.DIRECTORY_SEPARATOR.'DBConnect.php');
 require_once(__DIR__.DIRECTORY_SEPARATOR.'sanitize.php');
 final class DBLogin{
    private $conn;

    private function _getUser($username, $password){
        $username = sanitize::checkname($username);
        $password = sanitize::checkpwd($password);
        $sql= "SELECT * FROM `login_table` WHERE `username`=:username AND `password`=:password";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username',$username,PDO::PARAM_STR);
        $stmt->bindParam(':password',$password,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }
    public function getUser($username, $password){
        return $this->_getUser($username, $password)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function loginSignal($username, $password){
        return $this->_getUser($username, $password)->rowCount();
    }

    function __construct(){
        try{
            if(!isset($this->conn)){
                $this->conn = DBConnect::db_connect();
            }
        }catch(Throwable $ex){
            die("unable to get data". $ex->getMessage());
        }
        
        
    }
 }

?>