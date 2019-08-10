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
    <ul class="navbar">
                <li class="nav-item">New File
                    <ul class="sub-file">
                        <li class="sub-nav-item"><a href="p_acct.php" class="nav-link">Personal File</a></li>
                        <li class="sub-nav-item"><a href="coporate.php" class="nav-link">Family/Coporate</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="createcase.php" class="nav-link">New Appointment</a></li>
                <li class="nav-item"><a href="#" class="nav-link">History</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Message</a></li>
            </ul>
    </header>

    <div class="wrapper">
        <div class="form-wrapper">
            <h4 class="error-tag">incorrect Patient ID</h4>
            <form action="" id="patient-search-form">
                <div class="input-group">
                    <label for="patientID">Patient ID:</label>
                    <input type="text" name="patientID" id="patientID" class="patientID" required>
                </div>
                <button id="patient_btn">Search</button>
                <h5 class="span-info"> cannot find patient ID</h5>
            </form>
            <form action="" id="patient-fullsearch-form">
                <div class="input-group">
                    <label for="patientName">Fullname:&ensp;</label>
                    <input type="text" name="patientName" id="patientName" class="patientName" required>
                </div>
                
            <div class="input-group">
                    <label for="Telephone">Telephone:</label>
                    <input type="text" name="patientPhone" id="patientPhn" class="patientName" required>
            </div>
            <button id="patient_btn">Search</button>
            <h5 class="span-info"> use patient ID</h5>
            </form>
        </div>
    </div>
     </div>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="./js/card_search.js"></script>
</body>

</html>