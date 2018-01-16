<?php
    require_once('mysqli_connect.php');
    $pattern = $_POST['pattern'];

    $query = "SELECT BusinessName, Sector FROM business WHERE BusinessName LIKE '%$pattern%'";
    $result = @mysqli_query($dbc, $query);

    if (mysqli_num_rows($result) > 0){
        $response = array();
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $response[] = [$row['BusinessName'], $row['Sector']];
        }
        foreach($response as $value){
            echo $value[0] . "_" . $value[1] . ",";
        }
        
        
    }
    
    

?>