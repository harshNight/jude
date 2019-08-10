<?php
session_start();
spl_autoload_register(function($class){
    require_once('./db/'.$class.'.php');
});
// var_dump($_SERVER);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Management System</title>
    <link rel="stylesheet" href="./css/style.css">
    
</head>

<body>
  <div class="container">
  <div class="login-container">
        <h1>welcome</h1>

        <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST" class="login-form">
            <div class="response error">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username">
            </div>
            <div class="form-group">
                <label for="password">password&nbsp;</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            
            <button id="login" class="login-button">Log In</button>
            <span>Trouble loging in? contact Admin</span>
        </form>
    </div>
  </div>

    <script src="./js/jquery-3.4.1.min.js"></script>
    <script src="./js/login.js"></script>
</body>

</html>