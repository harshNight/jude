<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:../login.php');
}
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
    </div class="container">
    <header class="header">

    </header>

    <div class="wrapper">
        <div class="form-wrapper">
            <h4 class="error-tag">incorrect Patient ID</h4>
            <form action="" id="create-company-form">
                <h1 class="kin-heading">Coporate Info</h1>
                <div class="input-group">
                    <label for="company_name">Name:&emsp;</label>
                    <input type="text" name="company_name" id="company_name" class="company-control" required>
                </div>
                <div class="input-group">
                    <label for="company_addr">Address:</label>
                    <input type="text" name="company_addr" id="company_addr" class="company-control" required>
                </div>
                <div class="input-group">
                    <label for="company_phone">Phone: &ensp;</label>
                    <input type="text" name="company_phone" id="company_phone" class="company-control" required>
                </div>
                <button id="company_btn" class="btn_create-account">Register</button>
            </form>
        </div>
    </div>
    </div>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="./js/create_company.js"></script>
</body>

</html>