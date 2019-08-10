<?php
 require_once(__DIR__.DIRECTORY_SEPARATOR.'DBConnect.php');
 require_once(__DIR__.DIRECTORY_SEPARATOR.'sanitize.php');
 
 final class DBAppointment{
    private $conn;

    private function appt_number(){  // generates the query number of a patient
            $sql = "SELECT IFNULL(COUNT(`case_id`),0) as appt_number FROM `tbl_cases` WHERE `date_created` = CURDATE();";
             $stmt = $this->conn->query($sql);
            return $stmt->fetch()['appt_number']+1;
        
    }
    private function create_appointment($patientID){  // creates new appointment
            $appt = $this->appt_number();
            $sql = "INSERT INTO tbl_cases(`patient_id`, `appointment_id`,`date_created`)
                    VALUES(:patientID, CONCAT('PT-', (SELECT TIME_TO_SEC(NOW()) ), '-' ,:appt ), NOW());";
             $stmt = $this->conn->prepare($sql);
             $stmt->bindParam(':patientID',$patientID, PDO::PARAM_STR);
             $stmt->bindParam(':appt',$appt, PDO::PARAM_INT);
             $stmt->execute();     
    }

    private function appointment($appt){ // retrieves appintment data
        $sql = "SELECT * FROM `tbl_cases` WHERE `case_id` =:appt ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':appt',$appt, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }
     public function get_appointment($patientID){
        $this->conn->beginTransaction();
        try {
            $this->create_appointment($patientID);
            $stmt = $this->appointment($this->conn->lastInsertId()); 
            $this->conn->commit();
            return $stmt->fetch(PDO::FETCH_ASSOC);
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