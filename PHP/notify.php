<?php
    session_start();
    require_once('mysqli_connect.php');
    //Gets a list of requested appointments.
    $query_requests = "SELECT BusinessName FROM appointments WHERE BusinessName ='" . $_SESSION['BusinessName'] . "' AND Accepted=0";
    $result_requests = @mysqli_query($dbc, $query_requests);
    //Returns the number of requested appointments a company has.
    echo mysqli_num_rows($result_requests);
?>