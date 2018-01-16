<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../IMG/ontime_logo.png">
    <link rel="stylesheet" href="../CSS/ontime.css">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Mukta+Mahee|Quattrocento+Sans|Quicksand|Ropa+Sans|Rubik|Work+Sans|Yanone+Kaffeesatz" rel="stylesheet">
    <title>OnTime</title>
    <script src="../JS/utilities.js"></script>
</head>
<body>
    <div id="header">
        <a href="<?php            
            if (isset($_SESSION['IndividualEmail'])){
                echo "main.php";
            }
            else {
                echo "index.php";         
            }
        ?>"><img id="logo" src="../IMG/ontime_logo.png" alt="logo"></a>
        <?php 
            if (!isset($_SESSION['IndividualEmail'])){
                echo "<span id='motto'>Appointments in no time</span>";
            }
            else {
                echo "
                <form style='margin:auto 0 auto auto'>
                    <input id='search_bar' class='input' type='text' name='search_bar'>       
                </form>
                <img class='search_icon' src='../IMG/search_icon.png'>";
                echo "<a id='logout' href='logout.php'>Logout</a>";
            }
       ?>
    </div>
</body>
