<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <div id="header">
        <img id="logo" src="ontime_logo.png" alt="logo">
        <?php 
            if (!isset($_SESSION)){
                echo "<span id='motto'>Appointments in no time</span>";
            }
        ?>
    </div>
</body>