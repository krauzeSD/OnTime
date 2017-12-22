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
           <span class="title">Individual's Data</span>
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
    <input id='registerButton' class='button' type='button' value='Register'>   
    </div>
    "
    ?>
    <script src="registerCheck.js"></script>
    <?php include('footer.html')?>
</body>
</html>