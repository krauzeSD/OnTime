<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="ontime.css">
   <link href="https://fonts.googleapis.com/css?family=Comfortaa|Mukta+Mahee|Quattrocento+Sans|Quicksand|Ropa+Sans|Rubik|Work+Sans|Yanone+Kaffeesatz" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Register to OnTime</title>
    <script src="utilities.js"></script>
</head>
<body>
    <?php
        include('header.php');
    ?>
    <div class="registerForm">
        <div class="box">
           <span class="title">Individual's Data</span>
            <form action="register.php">
               <input class="inputText" type="text" name="Name" placeholder="Name">
               <input class="inputText" type="text" name="Surname" placeholder="Surname">
                <input class="inputText" type="email" name="email" placeholder="Email">
                <input class="inputText" type="text" name="telephone" placeholder="Telephone">
                <input class="inputText" type="password" name="password1" placeholder="Password">
                <input class="inputText" type="password" name="password2" placeholder="Confirm Password">
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
                <input class='inputText' type='text' name='telephone' placeholder='Company Telephone'>
                
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