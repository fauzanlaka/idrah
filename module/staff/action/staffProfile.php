<?php
    header("content-type: text/javascript");
    include '../../../connect/connect.php';
    include '../../../function/global.php';
    $connect = '../../../connect/connect.php';
    $t_id = $_POST['t_id'];
    $form_data = array(
        'tp_id' => $_POST['tp_id'],
        't_idscan' => $_POST['t_idscan']
    );
    dbRowUpdate('teachers', $form_data, "WHERE t_id='$t_id'");
    echo "swal(\"Daftar dur berhasil\", \"Klik OK untuk print kertas dur\", \"success\");";
    echo "document.getElementById('profileProcess').innerHTML = 'SAVE';";
?>
