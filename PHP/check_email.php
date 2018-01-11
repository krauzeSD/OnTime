<?php
    require_once('mysqli_connect.php');
    $email_value = $_POST['email'];
    $query = "SELECT email FROM individuals WHERE email=" . "'" . $email_value . "'";
    $result = @mysqli_query($dbc, $query);
    if (mysqli_num_rows($result) == 1){
        echo true;
    }

?>