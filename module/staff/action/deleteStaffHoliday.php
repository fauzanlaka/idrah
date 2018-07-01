<?php
    header("content-type: text/javascript");
    $connect = "../../../connect/connect.php";
    include "../../../connect/connect.php";
    include '../../../function/global.php';
    include '../../../function/staff/staffInfo.php';
    $h_id = $_POST['h_id'];
    $t_id = $_POST['t_id'];
    //echo "alert('$jh_id');";
    $sql = mysqli_query($con, "DELETE FROM holiday WHERE h_id='$h_id'");
    
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
?>

