<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="ontime_logo.png">
</head>
<body>
    <div id="header">
        <a href="index.php"><img id="logo" src="ontime_logo.png" alt="logo"></a>
        <?php 
            if (!isset($_SESSION)){
                echo "<span id='motto'>Appointments in no time</span>";
            }
        ?>
    </div>
</body>