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
    function check_field($db_connect, &$escape_array, &$errors_array, $field, $is_password = false, $pass2 = ""){
        $check = 0;
        if ($is_password){
            if (!empty($_POST[$field])) {
                //check if password1 = password2
                if ($_POST[$field] != $_POST[$pass2]) {
                    $errors_array[] = 'Passwords did not match';
                } 
                else {
                    $check++;
                }
            }
        }
        else {
            if (!empty($_POST[$field])){
                $check++;
            }
        }
        
        if ($check == 1){
            $escape_array[$field] = mysqli_real_escape_string($db_connect, trim($_POST[$field]));
            
        }
        else {
            $errors_array[] = 'Enter the ' . $field . '.';
        }
    }
    function deleteLastChar($string){
                $result = substr($string, 0, strlen($string) - 1);
                return $result;
            }
    function insert(&$db_connect, $table, $fields, $values){
                //FIELDS
                $insert_string = "INSERT INTO " . $table . " (";
                foreach($fields as $item){
                    $insert_string = $insert_string . $item . ","; 
                }
                $insert_string = deleteLastChar($insert_string);
                $insert_string = $insert_string . ")"; 
                
                //VALUES
                $insert_string = $insert_string . "VALUES (";
                foreach($values as $key=>$value){
                    if ($key == 'Password1'){
                        $insert_string = $insert_string . "SHA1('" . $value . "'),";
                    }
                    else if (is_null($value)){
                        $insert_string = $insert_string . "NULL,";
                    }
                    else {
                        $insert_string = $insert_string . "'" . $value . "',";
                    }
                }
                $insert_string = deleteLastChar($insert_string);
                $insert_string = $insert_string . ")"; 
          
                $result = @mysqli_query($db_connect, $insert_string);
        
                return $result;
            }
    // Check for form submission:
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             // Connect to the db.
            $errors = array();       
            $particular = array();
            $company = array();
             // Check for a name
            check_field($dbc, $particular, $errors, 'Name');
            // Check for a surname
            check_field($dbc, $particular, $errors, 'Surname');
            // Check for an email address
            check_field($dbc, $particular, $errors, 'Email');
            //Check the telephone.
            check_field($dbc, $particular, $errors, 'Telephone');
            //Check for a password
            check_field($dbc, $particular, $errors, 'Password1', true, 'Password2');
            
            //Company mode 
            if (isset($_POST['companyID'])){
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
                    $particular['businessID'] = $_POST['companyID'];
                    $business_check = insert($dbc, 'business', ['BusinessID', 'BusinessName', 'Email', 'Telephone', 'Sector'], $company);
                    $particular_check = insert($dbc, 'individuals', ['Name', 'Surname', 'Email', 'Telephone', 'EncryptedPassword', 'BusinessID'], $particular);
                }
                else {
                    $particular['businessID'] = NULL;
                   
                    $particular_check = insert($dbc, 'individuals', ['Name', 'Surname', 'Email', 'Telephone', 'EncryptedPassword', 'BusinessID'], $particular);
                    
                }
                if(isset($_POST['companyID'])){
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
        var email = document.getElementsByName('Email')[0];
        console.log(email.value);
        email.onchange = function(){
            var data = "email=" + email.value;
            var xml_http = new XMLHttpRequest();
            xml_http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    
                    if(this.responseText){
                        
                        document.getElementById('email_alert').innerHTML = "Email already in use.";
                        document.getElementById('registerButton').disabled = true;
                    }
                    else {
                        document.getElementById('email_alert').innerHTML = "";
                        document.getElementById('registerButton').disabled = false;
                    }
                }
            };
            xml_http.open("POST", "check_email.php", true); 
            xml_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");   
            
            xml_http.send(data);
        }
        
    </script>        
    <?php
                
                
                
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
                $q = "SELECT Name FROM Sectors";     
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
    <?php include('footer.php')?>
                
                
                
                
         
</body>
</html>
