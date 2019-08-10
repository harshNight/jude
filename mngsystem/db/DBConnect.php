<?php

final Class DBConnect{
    // private $username;
    // private $password;
    // private $db_name;

    private static function connect(){
        try{
          $conn = new PDO('mysql:host=localhost;dbname=jude','root','');
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $conn->setAttribute(PDO::ATTR_AUTOCOMMIT,FALSE);
          return $conn;
        }catch(\Throwable $ex){
             die($ex->getMessage());
            // return FALSE;
        }finally{
          //  var_dump($conn);
        }
    }
    public static function db_connect(){
      return self::connect();
    }
}
?>

