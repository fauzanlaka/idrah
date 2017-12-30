<?php
    header("content-type: text/javascript");
    session_start();
    unset($_SESSION["u_id"]);
    echo "location = 'login.php';";
?>