
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Management System</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <div class="card-wrapper">
        <div class="header">
            <ul class="navbar">
                <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Create Account</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Case Files</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Track</a></li>
                <li class="nav-item"><a href="#" class="nav-link">History</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Message</a></li>
            </ul>
        </div>
        <div class="form-wrapper">
            <!-- <section class="alert alert-danger">
                <div>
                    patient record not found
                </div>
                <span class="alert-close">Close</span>
            </section> -->
           
            <form action="profile.html" class="search-form" id="id_search_form">
                <div class="input-group">
                    <label for="" class="search_label">patient ID:</label>
                    <input type="text" name="patient_id" id="patient_id" class="form-control" required
                        patter="[A-Za-z0-9 ]{6-10}">
                </div>
                <div class="input-group">
                    <input type="submit" value="Check ID" name="check_patientId" class="btn-check-profile"
                        id="btn-check-profile">
                </div>
                <span id="full-search-link">make detailed search</span>

             
            </form>
            <form action="" class="full-search-form hide">
                <div class="input-group">
                    <label for="">patient name: </label>
                    <input type="text" name="patient_id" class="form-control">
                </div>
                <div class="input-group">
                    <label for="">Telephone:&emsp;</label>
                    <input type="text" name="patient_id" class="form-control">
                </div>
                <div class="input-group">
                    <input type="submit" value="Search" name="check_patient_details" class="btn_create-account">
                </div>
                <span id="id-search-link">make detailed search</span>
            </form>

        </div>

    </div>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="./js/card_main.js"></script>
</body>

</html>