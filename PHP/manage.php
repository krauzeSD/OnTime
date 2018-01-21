<?php
session_start();
require_once('mysqli_connect.php');
include('header.php');
//Get all requested appointments of a company.
$query = "SELECT Email, start, end, Location FROM appointments WHERE BusinessName='" . $_SESSION['BusinessName'] . "' AND Accepted=0";
$result = @mysqli_query($dbc, $query);
if (mysqli_num_rows($result) > 0) {
    echo "<div id='requests_container'>";
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        //For each request we create a box with an onclick event of an AJAX_select [More information in utilities.js].
        echo "
        <div style='display:flex; flex-direction:column; margin: 2vh auto 0vw auto' class='company_box'>
            <h3>" . $row['Email'] . " " . $row['start'] . "</h3>
            <button style='margin-left:auto' onclick=AJAX_select('POST','handle_request.php','data',['" . $row['Email'] . "','" . $row['start'] . "','accept'],reload_requests)>Accept</button>
            <button style='margin-left:auto' onclick=AJAX_select('POST','handle_request.php','data',['" . $row['Email'] . "','" . $row['start'] . "','decline'],reload_requests)>Decline</button>
        </div>";
    }
    echo "</div>";
}
?>

