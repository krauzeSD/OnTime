<?php
    session_start();
    require_once('mysqli_connect.php');
    //Create an array based on the POST data.
    $appointment = explode(",", $_POST['data']);
    //Select the accepted (type bit) field of that appointment
    $query = "SELECT Accepted FROM appointments WHERE Email='" . $appointment[0] . "' AND start='" . $appointment[1] . "' AND BusinessName='" . $_SESSION['BusinessName'] . "'";
    $result = @mysqli_query($dbc, $query);
    if (mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if ($row['Accepted'] == 0){
            //If the company accepted the appointment we make an update.
            if ($appointment[2] == 'accept'){
                //We set the Accepted bit to 1
                $query = "UPDATE appointments SET Accepted=1 WHERE Email='" . $appointment[0] . "' AND start='" . $appointment[1] . "' AND BusinessName='" . $_SESSION['BusinessName'] . "'";
                $result = @mysqli_query($dbc, $query);
                //We send an email to notify users (Currently deactivated due to the hosting provider having a limit).
                if ($result){
                    //mail($appointment[0], "Your request has been accepted", "Your appointment with " . $_SESSION['BusinessName'] . " has been accepted.\nStart: " . $appointment[1]);
                    echo true;
                }
                else {
                    echo false;
                }
            }
            else {
                //If the company declined we erase the appointment from the table.
                $query = "DELETE FROM appointments WHERE Email='" . $appointment[0] . "' AND start='" . $appointment[1] . "' AND BusinessName='" . $_SESSION['BusinessName'] . "'";
                $result = @mysqli_query($dbc, $query);
                if ($result){
                    //mail($appointment[0], "Your request has been declined", "Your appointment with " . $_SESSION['BusinessName'] . " has been declined.");
                    echo true;
                }
                else {
                    echo false;
                }
            }
        }
    }


?>