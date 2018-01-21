<?php
session_start();
require_once('mysqli_connect.php');
if (isset($_GET['BusinessName'])){
    $query_condition = "BusinessName='" . $_GET['BusinessName'] . "'";    
}
else if (isset($_SESSION['BusinessName'])){
    $query_condition = "BusinessName='" . $_SESSION['BusinessName'] . "'";
}
else {
    $query_condition = "Email='" . $_SESSION['IndividualEmail'] . "'";
}

//Gets all accepted appointments 
$query = "SELECT Email, BusinessName, start, end FROM appointments WHERE Accepted=1 AND " . $query_condition;
$result = @mysqli_query($dbc, $query);
$events = array();

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    if (isset($_GET['BusinessName'])){
            $title = 'Unavailable';
    }
    else if (isset($_SESSION['BusinessName'])){
        $title = $row['Email'];
    } 
    else {
        $title = $row['BusinessName'];
    }
    
    $events[] = array('title' => $title, 'start' => $row['start'], 'end' => $row['end']);
}

echo json_encode($events);
exit();
?>