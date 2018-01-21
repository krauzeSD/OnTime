<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../IMG/ontime_logo.png">
    <link rel="stylesheet" href="../CSS/ontime.css">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Mukta+Mahee|Quattrocento+Sans|Quicksand|Ropa+Sans|Rubik|Work+Sans|Yanone+Kaffeesatz" rel="stylesheet">
    <title>OnTime</title>
    <script src="../JS/utilities.js"></script>
    <script src="../JS/flag.js"></script>
    <link rel="stylesheet" href="../fullcalendar-3.8.0/fullcalendar.min.css">
    <link href="../fullcalendar-3.8.0/fullcalendar.print.min.css" rel="stylesheet" media="print">
    <script src="../fullcalendar-3.8.0/lib/moment.min.js"></script>
    <script src="../fullcalendar-3.8.0/lib/jquery.min.js"></script>
    <script src="../fullcalendar-3.8.0/fullcalendar.js"></script>
    <script src="../fullcalendar-3.8.0/locale-all.js"></script>
</head>
<body>
    <div id="header" <?php if (isset($_SESSION['IndividualEmail'])){echo "style='background-color:" . $_SESSION['MainColor'] . "'";}?>>
        <a href="<?php            
            //If a user is logged in, it will redirect to the main page. Otherwise it will redirect to the entry page.
            if (isset($_SESSION['IndividualEmail'])){
                echo "main.php";
            }
            else {
                echo "index.php";         
            }
        ?>"><img id="logo" src="../IMG/ontime_logo.png" alt="logo"></a>
        <?php 
            //We show the motto when no user is logged in and, otherwise, the search bar.
            if (!isset($_SESSION['IndividualEmail'])){
                echo "<span id='motto'>Appointments in no time</span>";
            }
            else {
                echo "
                <form method='post' action='company_search.php' style='margin:auto 0 auto auto'>
                    <input id='search_bar' class='input' type='text' name='pattern'>       
                </form>
                <img class='search_icon' src='../IMG/search_icon.png'>";
                echo "<a id='logout' href='logout.php'>Logout</a>";
            }
       ?>
    </div>
</body>
