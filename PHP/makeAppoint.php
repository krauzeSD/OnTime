<?php
    session_start();
    require_once('mysqli_connect.php');
    require_once('functions.php');
    include('header.php');
    //We get all data to make the appointment.
    $email = $_SESSION['IndividualEmail'];
    $company_name = $_POST['companyName'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    //Insert of the appointment.
    $query = insert(
        $dbc, 
        'appointments', 
        ['Email', 'BusinessName', 'start', 'end', 'Location'], 
        ['Email'=>$email, 'BusinessName'=>$company_name, 'start'=>$start, 'end'=>$end, 'Location'=>1]);
    //Check the result of the query.
    if ($query){
        echo "Your request has been sent.";
    }
    else {
        echo "There has been an error.";
    }
?>
