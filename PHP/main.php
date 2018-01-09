<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<?php
session_start();
if (isset($_SESSION["individual"])){
    echo "You are: " . $_SESSION["individual"] . " " . "You are a individual";   
    echo '<body style="background-color:red">';
}
else{
    echo "You are: " . $_SESSION["company"] . " " . "You are a company";
    echo '<body style="background-color:blue">';
   
}


?>
    
</body>