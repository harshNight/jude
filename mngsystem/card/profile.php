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
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a> </li>
                <li class="nav-item"><a href="createcase.php" class="nav-link">New Appointment</a></li>
                <li class="nav-item"><a href="#" class="nav-link">History</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Message</a></li>
            </ul>
    </header>

    <div class="profile-wrapper">
    <div class="appointment-wrapper">
            <div class="appointment-section">
                <button class="btn-create" id="create_case">Create new Appointment</button>
            </div>
            <div class="appointment-response" id="appointment-response">
                <table id="htable"> </table>
                <!-- data comes from profile.js -->
            </div>          
        </div>
        
        <div class="profile-wrapper" >
            <h3 class="table-head">Patient ID: <span id="span_patientID"> <?php echo $_GET['id']; ?> </h3>
            <table class="profile-table" >
                <tbody> 
                    <tr>
                    <td>Firstname:</td> <td id="firstname"></td> 
                    </tr>
                    <tr>
                        <td>Othernames:</td> <td id="othernames"></td>
                    </tr>
                    <tr>
                        <td>Patient Phone:</td> <td id="p_phone"></td>
                    </tr>
                    <tr>
                        <td>Address:</td> <td id='p_addr'></td>
                    </tr>
                    <tr>
                        <td>Origin:</td> <td id='p_origin'></td>
                    </tr>
                    <tr>
                        <td>Gender:</td> <td id="p_gender"></td>
                    </tr>
                    <tr>
                        <td>Marital Status:</td> <td id="p_m_status"></td>
                    </tr>
                    <tr>
                    <td>Date of Birth:</td> <td id="p_birth"></td>
                    </tr>
                    <tr>
                         <td>Occupation:</td> <td id="p_occupation"></td>
                    </tr>
                    <tr>
                    <td>Religion:</td> <td id="p_religion"></td>
                    </tr>
                    <tr>
                        <td>Card type:</td> <td id="c_cardtype"></td>
                    </tr>
                    <tr>
                    <td>Category:</td> <td id="c_category"></td>
                    </tr>
                    <tr>
                         <td>Date Created:</td> <td id="d_created"></td>
                    </tr>
                </tbody>
            </table>
        </div>
       
     </div>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="./js/profile.js"></script>
</body>

</html>