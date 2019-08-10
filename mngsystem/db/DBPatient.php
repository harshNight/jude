<?php

require_once(__DIR__.DIRECTORY_SEPARATOR.'DBConnect.php');
 require_once(__DIR__.DIRECTORY_SEPARATOR.'sanitize.php');

class DBPatient{
    private $conn;
    private $found = false;
    private $patient_ID;
 
  private function check_user($phone): Bool 
  {
      try{
          $sql = "SELECT `patient_ID` from `tbl_patient_biodata` WHERE `phone`= :phone;";
          $stmt = $this->conn->prepare($sql);
          $stmt->bindParam(':phone', $phone,PDO::PARAM_STR);
          $stmt->execute();
          if($stmt->rowCount()==1){
              $this->found = true;
          }
      }catch(Throwable $ex){
          die('uanble to check phone number '.$ex->getMessage());
      }finally{
          return $this->found;
      }
  }

  private function insert_Patient_Biodata($user_input, $kin_id){
    try{
        $c_type;
        $c_category;
        switch($user_input['card_type']){
            case 1: 
                $c_type = 'SNE';
            break;
            case 2:
             $c_type = 'ATN';
             break;
            case 3:
             $c_type = 'ADM';
             break;
            default:
            $c_type = 'SNE';
        }
        switch($user_input['card_category']){
            case 1: 
                $c_category = 'IND';
            break;
            case 2:
             $c_category = 'FAM';
             break;
            default:
            $c_category = 'IND';
        }

          $patientID = $c_type.'-'.$c_category.'-'.rand(100,900);
          if(!empty($user_input['company_name']) ){
                $sql = "INSERT INTO
                     `tbl_patient_biodata`
                    ( `surname`, `othernames`, `phone`, `address`, `sex`, `marital_status`,
                     `DOB`, `LGA`, `state`, `nationality`, `occupation`, `religion`, `kin_ID`, `card_type`,
                      `card_category`, `date_created`,`family_card_id`, `patient_ID`)
                      VALUES(:surname, :othernames, :phone, :addr, :sex, :marital_status,
                     :DOB, :LGA, :lga_state, :nationality, :occupation, :religion, :kin_ID, :card_type,
                      :card_category, NOW(), :family_card_id, :patient_ID)";
          }else{
                $sql = "INSERT INTO
                    `tbl_patient_biodata`
                ( `surname`, `othernames`, `phone`, `address`, `sex`, `marital_status`,
                    `DOB`, `LGA`, `state`, `nationality`, `occupation`, `religion`, `kin_ID`, `card_type`,
                    `card_category`, `date_created`, `patient_ID`)
                    VALUES(:surname, :othernames, :phone, :addr, :sex, :marital_status,
                    :DOB, :LGA, :lga_state, :nationality, :occupation, :religion, :kin_ID, :card_type,
                    :card_category, NOW(), :patient_ID)";
          }
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':surname',$user_input['patient_surname'], PDO::PARAM_STR);
            $stmt->bindParam(':othernames',$user_input['patient_othername'], PDO::PARAM_STR);
            $stmt->bindParam(':phone',$user_input['patient_phone'], PDO::PARAM_INT);
            $stmt->bindParam(':addr',$user_input['patient_addr'], PDO::PARAM_STR);
            $stmt->bindParam(':sex',$user_input['gender'], PDO::PARAM_STR);
            $stmt->bindParam(':marital_status',$user_input['marital_status'], PDO::PARAM_STR);
            $stmt->bindParam(':DOB', $user_input['patient_age'], PDO::PARAM_STR);
            $stmt->bindParam(':LGA',$user_input['patient_lga'], PDO::PARAM_STR);
            $stmt->bindParam(':lga_state',$user_input['patient_state'], PDO::PARAM_STR);
            $stmt->bindParam(':nationality',$user_input['patient_nationality'], PDO::PARAM_STR);
            $stmt->bindParam(':occupation',$user_input['patient_occupation'], PDO::PARAM_STR);
            $stmt->bindParam(':religion',$user_input['patient_religion'], PDO::PARAM_STR);
            $stmt->bindParam(':kin_ID',$kin_id, PDO::PARAM_INT);
            $stmt->bindParam(':card_type',$user_input['card_type'], PDO::PARAM_STR);
            $stmt->bindParam(':card_category',$user_input['card_category'], PDO::PARAM_STR);
            if(!empty($user_input['company_name'])){
                $stmt->bindParam(':family_card_id',$user_input['company_name'], PDO::PARAM_STR);
            }
            $stmt->bindParam(':patient_ID',$patientID, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt;
      }catch(Throwable $ex){
          
          die('insersion error '. $ex->getMessage());
   }
}
 
 private function insert_kin($user_input){
     $sql = "INSERT INTO `tbl_kin`(`kin_name`, `kin_phone`, `kin_address`, `kin_relationship`)
           VALUES (:kin_name,:kin_phone,:kin_address,:kin_relationship)";
     $stmt = $this->conn->prepare($sql);
     $stmt->bindParam(':kin_name',$user_input['next_of_kin'], PDO::PARAM_STR);
     $stmt->bindParam(':kin_phone',$user_input['kin_phone'], PDO::PARAM_INT);
     $stmt->bindParam(':kin_address',$user_input['kin_addr'], PDO::PARAM_STR);
     $stmt->bindParam(':kin_relationship',$user_input['relation_with_kin'], PDO::PARAM_STR);
     $stmt->execute();
     return $this->conn->lastInsertId();    
 }

 public function create_new_patient($user_input){
    if($this->check_user($user_input['patient_phone'])){
        return 'PHONE NUMBER ALREADY EXISTS';
    }  

     try {
        $this->conn->beginTransaction();
        $kin_id = $this->insert_kin($user_input);  // INSERTS THE KIN DETIALS AND GETS THE LAST ID TO BE USED IN BIODATA TABLE
        $result = $this->insert_Patient_Biodata($user_input, $kin_id);
        $this->conn->commit();
        return $result->rowCount();
     } catch (\Throwable $th) {
        $this->conn->rollBack();
        return $th->getMessage();
     }         
   
 }

 private function check_company_ID($company_ID){
        $sql = "SELECT `company_ID`, `company_name`, `company_address`, `company_phone`, `date_created` FROM `tbl_company_card`
        WHERE `company_ID` = :company_ID; ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':company_ID', $company_ID, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
 }
 private function company_id($company_ID){
    try {
     return $this->check_company_ID($company_ID)->rowCount();
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
 }


 private function check_company_Phone($company_phone){
    $sql = "SELECT `company_ID`, `company_name`, `company_address`, `company_phone`, `date_created` FROM `tbl_company_card`
    WHERE `company_phone` = :company_phone; ";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':company_phone', $company_phone, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt;
} 
 public function company_phone($company_phone){
    try {
     return $this->check_company_Phone($company_phone)->rowCount();
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
 }
 public function get_companies(){
    try {
        $sql = "SELECT `company_ID`, `company_name`, `company_address`, `company_phone`, `date_created` FROM `tbl_company_card`; ";
        $stmt = $this->conn->query($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
 }
 
 private function insert_company($user_input, $company_ID){
    try {
            $this->conn->beginTransaction();
            $sql = 'INSERT INTO `tbl_company_card`( `company_ID`, `company_name`,`company_address`, `company_phone`, `date_created`) 
                VALUES (:company_ID,:company_name,:company_address,:company_phone,NOW())';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':company_ID', $company_ID, PDO::PARAM_STR);
            $stmt->bindParam(':company_name', $user_input['company_name'], PDO::PARAM_STR);
            $stmt->bindParam(':company_address', $user_input['company_addr'], PDO::PARAM_STR);
            $stmt->bindParam(':company_phone', $user_input['company_phone'], PDO::PARAM_STR);
            $stmt->execute();
            $this->conn->commit();
            return $stmt;      
        } catch (\Throwable $th) {
        $this->conn->rollBack();
        return $th->getMessage();
        }
 }

 public function create_company($user_input){
    try {
            $company_ID = 'COM-'.rand(1000,9999);
            while($this->company_id($company_ID)!=0){
                $company_ID = 'COM-'.rand(1000,9999);
            }
            if($this->insert_company($user_input, $company_ID)->rowCount()==0){
                return false;
            }else{
                return $company_ID;
            }
        } catch (\Throwable $th) {
            $this->conn->rollBack();
            return $th->getMessage();
            }
     
 }

 public function get_daily_cases(){
    try {
            $sql = "SELECT CONCAT(`tbl_patient_biodata`.`surname`,' ', `tbl_patient_biodata`.`othernames`) 
                AS fullname, `tbl_patient_biodata`.`patient_ID`, `tbl_cases`.`appointment_id` 
                    FROM `tbl_patient_biodata`
                RIGHT JOIN `tbl_cases` 
                    ON `tbl_patient_biodata`.`patient_ID` = `tbl_cases`.`patient_ID`
                  
                    WHERE `tbl_cases`.`service` != 2";

                    //  WHERE `tbl_cases`.`date_created` = CURDATE() ;
            $stmt = $this->conn->prepare($sql);
             $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
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