<?php

require_once(__DIR__.DIRECTORY_SEPARATOR.'DBConnect.php');
require_once(__DIR__.DIRECTORY_SEPARATOR.'sanitize.php');

class DBPatient_search{
    private $conn;

    private function patient_id($ID){
        $sql = "SELECT  `surname`, `othernames`, `phone`, `address`, `sex`, `marital_status`, 
                `DOB`, `LGA`, `state`, `nationality`, `occupation`, `religion`, `kin_ID`, `card_type`,
                 `card_category`, `date_created`, `family_card_id`, `patient_ID`
                  FROM `tbl_patient_biodata` WHERE `patient_ID` = :patient_ID;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':patient_ID',$ID,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }
    public function check_patient_id($ID){
        try {
            return $this->patient_id($ID)->rowCount();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function get_patient_info($ID){
        try {
            return $this->patient_id($ID)->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    private function patient_info($fullname,$phone){
        $sql = "SELECT  `surname`, `othernames`, `phone`, `address`, `sex`, `marital_status`, 
                `DOB`, `LGA`, `state`, `nationality`, `occupation`, `religion`, `kin_ID`, `card_type`,
                 `card_category`, `date_created`, `family_card_id`, `patient_ID`
                  FROM `tbl_patient_biodata` 
                  WHERE  `phone` = :phone
                  OR `surname` LIKE CONCAT('%',:fullname,'%');";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':phone',$phone,PDO::PARAM_INT);
        $stmt->bindParam(':fullname',$fullname,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }
    public function check_patient_info($fullname,$phone){
        try {
            return $this->patient_info($fullname,$phone)->rowCount();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function get_search_patient_info($fullname,$phone){
        try {
            return $this->patient_info($fullname,$phone);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
/*
 CHANGE TO GET PATIENT INFO WITH THE APPOINTMENT ID
 JUST ADD THE SELECT STATEMENT TO THE WHERE CLAUSE

 */
   private function appointment_id($appointment_ID){
        $sql = "SELECT  `surname`, `othernames`, `phone`, `address`, `sex`, `marital_status`, 
                `DOB`, `LGA`, `state`, `nationality`, `occupation`, `religion`, `kin_ID`, `card_type`,
                 `card_category`, `date_created`, `family_card_id`, `patient_ID`
                  FROM `tbl_patient_biodata` 
                  WHERE `patient_ID` = (SELECT `patient_id` FROM `tbl_cases` WHERE `appointment_id` =:appointment_ID);"; 
                 // AND `service` = 0 ORDER BY `case_id` ASC LIMIT 1; ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':appointment_ID',$appointment_ID,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }
    public function check_appointment_id($ID){
        try {
            return $this->appointment_id($ID)->rowCount();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function get_appointment_info($ID){
        try {
            return $this->appointment_id($ID)->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
         

    function __construct(){
        try{
            if(!isset($conn)){
                $this->conn = DBConnect::db_connect();
            }
        }catch(Throwable $ex){
            die('error '.$ex->getMessage());
        }   
    }
}

    ?>