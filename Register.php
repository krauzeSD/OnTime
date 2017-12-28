<?php 

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require ('mysqli_connect.php'); // Connect to the db.
        
        $errors = array(); 
            
    // Check for a name
    if (empty($_POST['Name'])) {
        $errors[] = 'Enter the name.';
    } else {
        $nameP = mysqli_real_escape_string($dbc, trim($_POST['Name']));
    }
    
    // Check for a surname
    if (empty($_POST['Surname'])) {
        $errors[] = 'Enter the surname.';
    } else {
        $surnameP = mysqli_real_escape_string($dbc, trim($_POST['Surname']));
    }
    
    // Check for an email address
    if (empty($_POST['email'])) {
        $errors[] = 'Enter the email address.';
    } else {
        $emailP = mysqli_real_escape_string($dbc, trim($_POST['email']));
    }

    //Check the telephone.
     if (empty($_POST['telephone'])) {
        $errors[] = 'Enter the telephone number.';
    } else {
        $telephoneP = mysqli_real_escape_string($dbc, trim($_POST['telephone']));
    }
    
    //Check for a password
    if (!empty($_POST['password1'])) {
    	//check if password1 = password2
        if ($_POST['password1'] != $_POST['password2']) {
            $errors[] = 'Your password did not match the confirmed password.';
        } else {
            $passwordP = mysqli_real_escape_string($dbc, trim($_POST['password1']));
        }
    } else {
        $errors[] = 'Enter the password.';
    }
    

    //Company mode

    /* 
	if ($_GET['mode']=='company'){

	//Check for a company name
    if (empty($_POST['companyName'])) {
        $errors[] = 'Enter the company name.';
    } else {
        $companyP = mysqli_real_escape_string($dbc, trim($_POST['companyName']));
    }

	//Check for a company email	
    if (empty($_POST['companyEmail'])) {
        $errors[] = 'Enter the company email.';
    } else {
        $emailCP = mysqli_real_escape_string($dbc, trim($_POST['companyEmail']));
    }

	//Check for a company telephone	
    if (empty($_POST['companyTelephone'])) {
        $errors[] = 'Enter the telephone number of the company.';
    } else {
        $telephoneCP = mysqli_real_escape_string($dbc, trim($_POST['companyTelephone']));
    } }
    */
    


    if (empty($errors)) { // If everything's OK.
    //Company mode
     
    	/*
    	if ($_GET['mode']=='company'){
        $insert = "INSERT INTO individuals (Name, Surname, email, telephone, EncryptedPassword) VALUES ('$nameP', '$surnameP', '$emailP', '@telephoneP', '$passwordP'"; 
        $insert = "INSERT INTO business (BusinessName, Email, telephone, Sector) VALUES ('$companyP', '$emailCP', '$telephoneCP', '$passwordP'"; 
        $done = @mysqli_query ($dbc, $q); // Run the query.
        if ($done) { // If it ran OK.
        
            // Print a message:
            echo '<h1>Thank you!</h1>   
        
        } 
        else{
        */
        // Register the user in the database...
        	//insert the data in mysql
        $insert = "INSERT INTO individuals (Email, Name, Surname, Telephone, EncryptedPassword) VALUES ('$emailP', '$nameP', '$surnameP', '$telephoneP', '$passwordP')"; 

        $done = @mysqli_query ($dbc, $insert); // Run the query.
        if ($done) { // If it ran OK.
        
            // Print a message:
            echo '<h1>Thank you!</h1>';  
        }
        else { // If it did not run OK.
            
            // Public message:
            echo '<h1>System Error</h1>
            <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
            
            // Debugging message:
            echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $insert . '</p>';
                        
        } 
        
        mysqli_close($dbc); // Close the database connection.

        // Include the footer and quit the script:

    

}
    
    mysqli_close($dbc); 
    // Close the database connection.
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="ontime.css">
    <?php include('header.php')?>
   <link href="https://fonts.googleapis.com/css?family=Comfortaa|Mukta+Mahee|Quattrocento+Sans|Quicksand|Ropa+Sans|Rubik|Work+Sans|Yanone+Kaffeesatz" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Register to OnTime</title>
    <script src="utilities.js"></script>
</head>
<body>
   
    <div class="registerForm">
        <div class="box">
           <span class="title">Individuals Data</span>
            <form id="register" action="register.php?mode=<?php echo $_GET['mode'] ?>" method="post">
                <input class="inputText" type="text" name="Name" placeholder="Name" value=<?php if (isset($_POST['Name'])){echo $_POST['Name'];} ?>>
                <input class="inputText" type="text" name="Surname" placeholder="Surname" value=<?php if (isset($_POST['Surname'])){echo $_POST['Surname'];} ?>>
                <input class="inputText" type="email" name="email" placeholder="Email" value=<?php if (isset($_POST['email'])){echo $_POST['email'];} ?>>
                <input class="inputText" type="text" name="telephone" placeholder="Telephone" value=<?php if (isset($_POST['telephone'])){echo $_POST['telephone'];} ?>>
                <input class="inputText" type="password" name="password1" placeholder="Password" value=<?php if (isset($_POST['password1'])){echo $_POST['password1'];} ?>>
                <input class="inputText" type="password" name="password2" placeholder="Confirm Password" value=<?php if (isset($_POST['password2'])){echo $_POST['password2'];} ?>>
                <br>            
    <?php
            if ($_GET['mode']=='company'){
                echo "
                </div>
                <div class='box'>
                   <span class='title'>Company's Data</span>
                    <form action='register.php'>
                       <input class='inputText' type='text' name='companyName' placeholder='Company Name'>
                        <input class='inputText' type='email' name='companyEmail' placeholder='Company Email'>
                        <input class='inputText' type='text' name='companyTelephone' placeholder='Company Telephone'>

                        <br>

                        <select class='inputText'>
                            <option>SECTORES</option>
                        </select>
                        <br>
                ";
            }
        
    
    echo "
    <input id='registerButton' class='button' type='submit' name='submit' value='Register'>   
    </div>"
    
    ?>
    <script src="registerCheck.js"></script>
    <?php include('footer.html')?>
</body>
</html>
