<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/ontime.css">
    <?php include('header.php')?>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Mukta+Mahee|Quattrocento+Sans|Quicksand|Ropa+Sans|Rubik|Work+Sans|Yanone+Kaffeesatz" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Register to OnTime</title>
    <script src="../JS/utilities.js"></script>
</head>
<body>
   <?php 
    require_once('mysqli_connect.php');
    require_once('functions.php');
    // Check for form submission:
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $errors = array();       
        $particular = array();
        $company = array();
        
        //Check for a name
        check_field($dbc, $particular, $errors, 'Name');
        //Check for a surname
        check_field($dbc, $particular, $errors, 'Surname');
        //Check for an email address
        check_field($dbc, $particular, $errors, 'Email');
        //Check the telephone.
        check_field($dbc, $particular, $errors, 'Telephone');
        //Check for a password
        check_field($dbc, $particular, $errors, 'Password1', true, 'Password2');
            
        //Company mode 
        if (isset($_POST['companyName'])){
            //Check the company ID
            check_field($dbc, $company, $errors, 'companyID');
            //Check the company name
            check_field($dbc, $company, $errors, 'companyName');
            //Check the company email
            check_field($dbc, $company, $errors, 'companyEmail');
            //Check the company telephone
            check_field($dbc, $company, $errors, 'companyTelephone');
            //Check the company sector
            check_field($dbc, $company, $errors, 'sector');
        }
        
        if (empty($errors)) { // If everything's OK.
            if (isset($_POST['companyID'])){
                $particular['businessName'] = $_POST['companyName'];
                //We insert each set of information in its respective table.
                $business_check = insert($dbc, 'business', ['BusinessID', 'BusinessName', 'Email', 'Telephone', 'Sector'], $company);
                $particular_check = insert($dbc, 'individuals', ['Name', 'Surname', 'Email', 'Telephone', 'EncryptedPassword', 'BusinessName'], $particular);
                }
                else {
                    $particular['businessName'] = NULL;
                    $particular_check = insert($dbc, 'individuals', ['Name', 'Surname', 'Email', 'Telephone', 'EncryptedPassword', 'BusinessName'], $particular);
                }
                //We set the default values for this user's settings.
                $settings_check = insert($dbc, 'settings', ['UserEmail'], ['UserEmail'=>$particular['Email']]);
                //Check for only an individual or an individual representing a company.
                if(isset($_POST['companyName'])){
                    if ($business_check && $particular_check){
                        echo "<h1>Thank you, " . $particular['Name'] . " " . $particular['Surname'] . "</h1>";
                        echo "<h3>Your company name is " . $company['companyName'] . "</h3>";
                        echo "<h3>We have sent a confirmation email to " . $particular['Email'] . "</h3>";
                    }
                    else{
                        echo "There has been an error";
                    }
                }
                else{
                    if ($particular_check){
                        //Mail functionality deactiveted due to the hosting provider.
						//mail($particular['Email'],"Register","Wellcome to OnTime" . " " . $particular['Name']);
                        echo "<h1>Thank you, " . $particular['Name'] . " " . $particular['Surname'] . "</h1>";
                        echo "<h3>We have sent a confirmation email to " . $particular['Email'] . "</h3>";
                    }
                    else{
                        echo "There has been an error";
                    }
                }
                mysqli_close($dbc); 
                exit();
            }
            else {
                foreach($errors as $report){
                    echo "- " . $report . "<br>";
                }
            }
        }
    ?>
    <div class="registerForm">
        <div class="box">
           <span class="title">Individual's Data</span>
            <form action="register.php" method="post">
                <input class="input text" type="text" name="Name" placeholder="Name" value=<?php if (isset($_POST['Name'])){echo $_POST['Name'];} ?>>
                <input class="input text" type="text" name="Surname" placeholder="Surname" value=<?php if (isset($_POST['Surname'])){echo $_POST['Surname'];} ?>>
                <span id="email_alert"></span>
                <input class="input text" type="email" name="Email" placeholder="Email" value=<?php if (isset($_POST['Email'])){echo $_POST['Email'];} ?>>
                <input class="input text" type="text" name="Telephone" placeholder="Telephone" value=<?php if (isset($_POST['Telephone'])){echo $_POST['Telephone'];} ?>>
                <input class="input text" type="password" name="Password1" placeholder="Password" value=<?php if (isset($_POST['Password1'])){echo $_POST['Password1'];} ?>>
                <input class="input text" type="password" name="Password2" placeholder="Confirm Password" value=<?php if (isset($_POST['Password2'])){echo $_POST['Password2'];} ?>>
                <br>            
    <script>
        function check_user_exist(parameterEmail){
            var email_alert = GetByID('email_alert');
            var register_button = GetByID('registerButton');
            if (parameterEmail){
                email_alert.innerHTML = "Email already in use.";
                register_button.disabled = true;
            }
            else {
                email_alert.innerHTML = "";
                register_button.disabled = false;
            }
        }
        var email = document.getElementsByName('Email')[0];
        email.onchange = function(){
            //Makes an asyncronous query to check if email is already in use.
            AJAX_select('POST', 'check_email.php', 'email', this.value, check_user_exist);
        }    
    </script>        
    <?php
        //Creates the company form
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            if ($_GET['mode'] == 'company'){
                echo "
                </div>
                <div class='box'>
                   <span class='title'>Company's Data</span>
                    <form action='register.php'>
                       <input class='input text' type='text' name='companyName' placeholder='Company Name'>
                    <input class='input text' type='text' name='companyID' placeholder='Company ID'>
                        <input class='input text' type='email' name='companyEmail' placeholder='Company Email'>
                        <input class='input text' type='text' name='companyTelephone' placeholder='Company Telephone'>
                        <p>Sectors 
                        <select name='sector' class='input option'>";
                $q = "SELECT Name FROM sectors";     
                $r = @mysqli_query ($dbc, $q); // Run the query.
                while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
                {
                    echo "<option>" . $row['Name'] . "</option>";
                }           
                echo "</select></p>";
            }
        }
        echo "
        <input id='registerButton' class='button' type='button' value='Register'>   
        </div>
        "
    ?>
    <script src="../JS/registerCheck.js"></script>
    <?php include('footer.php'); ?>
</body>
</html>
