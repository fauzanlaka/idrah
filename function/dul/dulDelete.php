<?php
    header("content-type: text/javascript");
    include "../../function/global.php";
    $connect = "../../connect/connect.php";
    $dr_id = $_POST['dr_id'];
    $st_id = $_POST['st_id'];
    dbRowDelete("dulRegister", "dr_id='$dr_id'" ,$connect);
    dbRowDelete("dulSubject", "dr_id='$dr_id'", $connect);
    echo "swal(\"Delete berhasil\", \"Klik OK\", \"success\");";
    echo "formLoad('module/dur/durRegister.php', '$st_id', 'dur-history');";
?>

