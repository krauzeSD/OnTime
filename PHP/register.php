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
// Check for form submission:
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             // Connect to the db.
            $errors = array();       
            //We use arrays to store the particular's and the company's information.
            $particular = array();
            $company = array();
             // Check for a name
            if (empty($_POST['Name'])) {
                $errors[] = 'Enter the name.';
            } 
            else {
                $particular['Name'] = mysqli_real_escape_string($dbc, trim($_POST['Name']));
            }
            // Check for a surname
            if (empty($_POST['Surname'])) {
                $errors[] = 'Enter the surname.';
            } 
            else {
                $particular['Surname'] = mysqli_real_escape_string($dbc, trim($_POST['Surname']));
            }
            // Check for an email address
            if (empty($_POST['email'])) {
                $errors[] = 'Enter the email address.';
            } 
            else {
                $particular['email'] = mysqli_real_escape_string($dbc, trim($_POST['email']));
            }
            //Check the telephone.
            if (empty($_POST['telephone'])) {
                $errors[] = 'Enter the telephone number.';
            } 
            else {
                $particular['telephone'] = mysqli_real_escape_string($dbc, trim($_POST['telephone']));
            }
            //Check for a password
            if (!empty($_POST['password1'])) {
                //check if password1 = password2
                if ($_POST['password1'] != $_POST['password2']) {
                    $errors[] = 'Passwords did not match';
                } 
                else {
                    $particular['password'] = mysqli_real_escape_string($dbc, trim($_POST['password1']));
                }
            } 
            else {
                $errors[] = 'Enter the password.';
            }
            //Company mode 
            if (isset($_POST['companyID'])){
               //Check for a company name
                if (empty($_POST['companyID'])) {
                    $errors[] = 'Enter the company id.';
                } 
                else {
                    $company['ID'] = mysqli_real_escape_string($dbc, trim($_POST['companyID']));
                }
                if (empty($_POST['companyName'])) {
                    $errors[] = 'Enter the company name.';
                } 
                else {
                    $company['Name'] = mysqli_real_escape_string($dbc, trim($_POST['companyName']));
                }
                
               //Check for a company email	
                if (empty($_POST['companyEmail'])) {
                    $errors[] = 'Enter the company email.';
                }
                else {
                    $company['Email'] = mysqli_real_escape_string($dbc, trim($_POST['companyEmail']));
                }
                if (empty($_POST['sector'])){
                    $errors[] = 'Enter sector';
                }
                else{
                    $company['sector'] = mysqli_real_escape_string($dbc, trim($_POST['sector']));
                }
               //Check for a company telephone	
                if (empty($_POST['companyTelephone'])) {
                    $errors[] = 'Enter the telephone number of the company.';
                } 
                else {
                    $company['Telephone'] = mysqli_real_escape_string($dbc, trim($_POST['companyTelephone']));
                } 
            }
            
            
            
            
            if (empty($errors)) { // If everything's OK.
                if (isset($_POST['companyID'])){
                    $insertCompany = "
                    INSERT INTO business (BusinessID, BusinessName, Email, Sector, Telephone) 
                    VALUES (";
                    foreach ($company as $key=>$value){
                        $insertCompany = $insertCompany . "'" . $value . "'" . ",";
                    } 
                    $insertCompany = substr($insertCompany, 0, strlen($insertCompany) - 1);
                    $insertCompany = $insertCompany . ")";
                
               
                    $result = @mysqli_query($dbc, $insertCompany);
                }
                
                $insertParticular = "
                INSERT INTO individuals (Name, Surname, email, telephone, EncryptedPassword, BusinessID) 
                VALUES (";
                foreach ($particular as $key=>$value){
                    $insertParticular = $insertParticular . "'" . $value . "'" . ",";
                } 
               
                if (isset($_POST['companyID'])){
                    $insertParticular = $insertParticular . "'" . $company['ID'] . "'";
                }
                else {
                    $insertParticular = $insertParticular . "NULL";
                    
                }
                
                $insertParticular =  $insertParticular . ")";
               
                $result_par = @mysqli_query($dbc, $insertParticular);
                var_dump($result_par);
                if ($result_par){
                    echo '<h1>Thank you!</h1>';
                }
                
                mysqli_close($dbc); 
                   
            }
        }
    ?>
    <div class="registerForm">
        <div class="box">
           <span class="title">Individual's Data</span>
            <form id="register" action="register.php" method="post">
                <input class="input text" type="text" name="Name" placeholder="Name" value=<?php if (isset($_POST['Name'])){echo $_POST['Name'];} ?>>
                <input class="input text" type="text" name="Surname" placeholder="Surname" value=<?php if (isset($_POST['Surname'])){echo $_POST['Surname'];} ?>>
                <input class="input text" type="email" name="email" placeholder="Email" value=<?php if (isset($_POST['email'])){echo $_POST['email'];} ?>>
                <input class="input text" type="text" name="telephone" placeholder="Telephone" value=<?php if (isset($_POST['telephone'])){echo $_POST['telephone'];} ?>>
                <input class="input text" type="password" name="password1" placeholder="Password" value=<?php if (isset($_POST['password1'])){echo $_POST['password1'];} ?>>
                <input class="input text" type="password" name="password2" placeholder="Confirm Password" value=<?php if (isset($_POST['password2'])){echo $_POST['password2'];} ?>>
                <br>            
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
