<?php
    include '../connect/connect.php';
    header("content-type: text/javascript");
    //sleep(1);
    $ss_id = $_POST['ss_id'];
    $ss_score = $_POST['score'];
    $alertId = $_POST['alertId'];
  
    $updateScore = mysqli_query($con, "UPDATE studentsubject SET ss_score='$ss_score' WHERE ss_id='$ss_id'");
    if($ss_score != ""){
        echo "document.getElementById('$alertId').innerHTML = '<span class=\'glyphicon glyphicon-ok\'></span> <font color=\'green\'>saved</font>';";
    }else{
        echo "document.getElementById('$alertId').innerHTML = '';";
    }
?>


