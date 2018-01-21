<?php
session_start();
//We unset the SESSION
$_SESSION = array();
session_destroy();
//We destoy the PHPSESSID cookie.
if (isset($_COOKIE[session_name()])){
    setcookie(session_name(), "", time() - 3600);
}
header('Location: index.php');
?>