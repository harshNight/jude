<?php
 session_start();
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
        <header class="header">
             <a href="../login.php">HOme</a>
        </header>
        <div class="form-general">
            <form action="<?php $_SERVER['SCRIPT_NAME'];?>" id="card-form" class="card-form hide" method="POST">
                <h1 class="bio-heading">Patient Biodate</h1>
                <div class="input-group">
                    <div class="form-group">
                        <label for="">Surname:</label>
                        <input type="text" name="patient_surname"  id="patient_surname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Othernames</label>
                        <input type="text" name="patient_othername" id="patient_othername"   class="form-control">
                    </div>
                </div>

                <div class="input-group">
                    <div class="form-group">
                        <label for="">Address:&thinsp;</label>
                        <input type="text" name="patient_addr" id="patient_addr" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Telephone</label>
                        <input type="tel" name="patient_phone" class="form-control" id="patient_phone">
                    </div>
                </div>

                <div class="input-group">
                    <div class="form-group">
                        <label for="">Date of Birth</label>
                        <input type="date" name="patient_age" id="patient_age" class="date-control">
                    </div>
                    <div class="form-group">
                        <label for="">Status:</label>
                        <select name="marital_status" id="marital_status" class="select-control">
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="divorced">Divorced</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Gender</label>
                        <select name="gender" id="gender" class="select-control">
                            <option value="male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>

                <div class="input-group">

                    <div class="form-group">
                        <label for="">Religion</label>
                        <input type="text" name="patient_religion" id="patient_religion" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Occupation</label>
                        <input type="text" name="patient_occupation" id="patient_occupation" class="form-control">
                    </div>
                </div>
                <div class="input-group">
                    <div class="form-group">
                        <label for="">State</label>
                        <input type="text" name="patient_state"id="patient_state" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">LGA</label>
                        <input type="text" name="patent_lga" id="patient_lga" class="form-control">
                    </div>
                </div>
                <div class="input-group">
                    <div class="form-group">
                        <label for="">Nationality</label>
                        <input type="text" name="patent_nationality" id="patient_nationality" class="form-control">
                    </div>
                    <div class="form-group" id="card_select">
                        <label for="">Type of card</label>
                        <select name="card_type" id="card_type" class="type-select">
                            <option value=""></option>
                            <option value="1">Single</option>
                            <option value="2">Antenatal</option>
                            <option value="3">Admission</option>
                        </select>
                    </div>
                </div>

                <div class="input-group">
                    
                    <div class="form-group" id="card_select">
                        <label for="">Category</label>
                        <select name="card_category" id="card_category" class="type-select">
                            <option value=""></option>
                            <option value="1">Individual</option>
                            <option value="2">Family/Company</option>
                        </select>
                    </div>
                    <div class="form-group" id="card_select">
                        <label for="">Company Name</label>
                        <select name="company_name" id="company_name" class="type-select">
                        </select>
                    </div>
                </div>

                <div class="kin">
                    <h3 class="kin-heading">Next of Kin</h3>
                    <div class="input-group">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="Text" name="next_of_kin" id="next_of_kin" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Telephone</label>
                            <input type="tel" name="kin_phone" id="kin_phone" class="form-control">
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="Text" name="kin_addr" id="kin_addr" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">relationship</label>
                            <input type="text" name="relation_with_kin" id="relation_with_kin" class="form-control">
                        </div>
                    </div>
                </div>


                <div class="input-group">
                    <input type="submit" value="Create Account" name="create_account" class="btn_create-account">
                </div>


            </form>
        </div>

    </div>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="./js/newpatient.js"></script>
</body>

</html>