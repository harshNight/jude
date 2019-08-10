<?php
final class sanitize{
   static public function checkemail($email)
   {
      if(filter_var(htmlentities($email),FILTER_VALIDATE_EMAIL)){
        return true;
      }else{
        return false;
      }
   }
   static public function checkname($name)
   {
       return filter_var(htmlentities($name),FILTER_SANITIZE_STRING);
    }
    static public function checkpwd($password)
   {
      return filter_var(htmlentities($password),FILTER_SANITIZE_STRING);
    }

    static public function checkamount($amount)
    {
       return filter_var(htmlentities($amount),FILTER_SANITIZE_NUMBER_INT);
     }

     static public function confirmamount($amount)
     {
        return filter_var(htmlentities($amount),FILTER_VALIDATE_INT);
      }

      static public function sanitize_url_parameter($url){
        if(isset($url) && !empty($url) && !is_null($url) && is_numeric($url) && filter_var($url, FILTER_VALIDATE_URL)){
            return true;
        }else{
             return false;   // current page in pagination
        }
      }
      static public function sanitize_quicksearch($url){
        if(isset($url) && !empty($url) && !is_null($url)){
          return true;
        }else{
             return false;   // current page in pagination
        }
      }
}
?>
