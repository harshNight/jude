<?php
 require_once(__DIR__.DIRECTORY_SEPARATOR.'DBConnect.php');
 require_once(__DIR__.DIRECTORY_SEPARATOR.'sanitize.php');
 
 final class DBDiagnosis{
    private $conn;

    public function check_completed_appointment($apptID){
        try {     
            $sql = "SELECT * FROM `tbl_cases` WHERE `appointment_id` =:appt AND `service` != 2;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':appt',$apptID, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (\Throwable $th) {
            die('unable to work'.$th->getMessage());
        }
     }

     private function appointment_query($apptID){  
            $sql = "SELECT * FROM `tbl_cases` WHERE `appointment_id` =:appt ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':appt',$apptID, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt; 
     }

     public function check_lab_status($apptID){  
        $sql = "SELECT `lab_status` FROM `tbl_cases` WHERE `appointment_id` =:appt ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':appt',$apptID, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount(); 
 }

     public function check_appointment_id($apptID){
        try {     
            return $this->appointment_query($apptID)->rowCount();
        } catch (\Throwable $th) {
            die('unable to work'.$th->getMessage());
        }
     }

     public function get_appointment_details($apptID){
        try {     
            return $this->appointment_query($apptID)->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            die('unable to work'.$th->getMessage());
        }
     }

     public function delete_appointment($apptID){
        try { 
            $sql = "DELETE FROM `tbl_cases` WHERE `appointment_id` =:appt AND `service` !=2";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':appt',$apptID, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt();
        } catch (\Throwable $th) {
            die('unable to work'.$th->getMessage());
        }
     }
     public function update_symptoms($apptID, $symptoms){
         $this->conn->beginTransaction();
        try {     
            $sql = "UPDATE `tbl_cases` SET `symptoms` = :symptoms WHERE `appointment_id` =:appt ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':appt',$apptID, PDO::PARAM_STR);
            $stmt->bindParam(':symptoms', $symptoms, PDO::PARAM_STR);
            $stmt->execute();
            $this->conn->commit();
            return $stmt->rowCount();
        } catch (\Throwable $th) {
            $this->conn->rollBack();
            die('unable to work'.$th->getMessage());
        }
     }

     public function update_diagnosis($apptID, $symptoms){
        $this->conn->beginTransaction();
       try {     
           $sql = "UPDATE `tbl_cases` SET `diagnosis` = :symptoms, `service` = 1, `lab_status` = 1 WHERE `appointment_id` =:appt ";
           $stmt = $this->conn->prepare($sql);
           $stmt->bindParam(':appt',$apptID, PDO::PARAM_STR);
           $stmt->bindParam(':symptoms', $symptoms, PDO::PARAM_STR);
           $stmt->execute();
           $this->conn->commit();
           return $stmt->rowCount();
       } catch (\Throwable $th) {
           $this->conn->rollBack();
           die('unable to work'.$th->getMessage());
       }
    }
    public function update_prescription($apptID, $symptoms){
        $this->conn->beginTransaction();
       try {     
           $sql = "UPDATE `tbl_cases` SET `prescription` = :symptoms, `service` = 2 WHERE `appointment_id` =:appt ";
           $stmt = $this->conn->prepare($sql);
           $stmt->bindParam(':appt',$apptID, PDO::PARAM_STR);
           $stmt->bindParam(':symptoms', $symptoms, PDO::PARAM_STR);
           $stmt->execute();
           $this->conn->commit();
           return $stmt->rowCount();
       } catch (\Throwable $th) {
           $this->conn->rollBack();
           die('unable to work'.$th->getMessage());
       }
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