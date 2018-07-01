<?php
    header("content-type: text/javascript");
    include '../../../function/global.php';
    include '../../../connect/connect.php';
    $connect = '../../../connect/connect.php';
    $h_holiday = $_POST['h_holiday'];
    $t_id = $_POST['t_id'];
    $form_data = array(
        't_id' => $t_id,
        'h_holiday' => $h_holiday
    );
    dbRowInsert('holiday', $form_data, $connect);
    $response = "";
    $response .= "<table class=\'table table-bordered\'><tr>";
    $response .= "<td><b>Hari Cuti</b></td><td><b>Delete</b></td>";
    $response .= "</tr>";
    $sql = mysqli_query($con, "SELECT * FROM holiday WHERE t_id='$t_id'");
    while($result = mysqli_fetch_array($sql)){
        $h_id = $result['h_id'];
        $response .= "<tr>";
        $response .= "<td>".$result['h_holiday']."</td>";
        $response .= "<td><a class=\'btn btn-danger btn-sm\' onclick=\"deleteStaffHoliday(\'$h_id\', \'$t_id\')\">DELETE</a></td>";
        $response .= "</tr>";
    }
    $response .= "</table>";
    echo "document.getElementById('holidayList').innerHTML = '$response';";
    echo "document.getElementById('holidayProcess').innerHTML = 'SAVE';";
?>

