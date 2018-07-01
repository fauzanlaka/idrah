<?php
    header("content-type: text/javascript");
    include '../../../connect/connect.php';
    include '../../../function/staff/staffInfo.php';
    $connect = '../../../connect/connect.php';
    
    $id = $_POST['id'];
    $t_id = $_POST['t_id'];
    
    $sql = mysqli_query($con, "DELETE FROM staff_leave WHERE key_add_date='$id' AND t_id='$t_id'");
    
    function getMaxDate($id, $connect){
        include $connect;
        $sql = mysqli_query($con, "SELECT MAX(sl_leave_date) AS sl_leave_date FROM staff_leave WHERE key_add_date='$id'");
        $result = mysqli_fetch_array($sql);
        $date = $result['sl_leave_date'];
        return date("d-m-Y", strtotime($date));
    }
    
    function getMinDate($id, $connect){
        include $connect;
        $sql = mysqli_query($con, "SELECT MIN(sl_leave_date) AS sl_leave_date FROM staff_leave WHERE key_add_date='$id'");
        $result = mysqli_fetch_array($sql);
        $date = $result['sl_leave_date'];
        $date = $result['sl_leave_date'];
        return date("d-m-Y", strtotime($date));
    }
    
    $response = "";
    $response = "<br>";
    $response .= "<table class=\'table\'>";
    $response .= "<tr><td>Hal</td><td>Tarikh</td><td>DELETE</td></tr>";
    
    $leave = mysqli_query($con, "SELECT * FROM staff_leave WHERE t_id='$t_id' GROUP BY key_add_date");
    while($leaveResult = mysqli_fetch_array($leave)){
        $title = str_replace("\'", "&#39;", $leaveResult["sl_leave_title"]);
        $date = $leaveResult['sl_leave_date'];
        $key_add_date = $leaveResult['key_add_date'];
        $response .= "<tr>";
        $response .= "<td>$title</td>";
        $response .= "<td>".getMinDate($key_add_date, $connect)." <<<b>Hingga</b>>> ".getMaxDate($key_add_date, $connect)."</td>";
        $response .= "<td><a class=\"btn btn-danger\" onclick=\"deleteLeave(\'$key_add_date\', \'$t_id\')\">DELETE</a></td>";
        $response .= "</tr>";
    }
    $response .= "</table>";
    echo "document.getElementById('leaveList').innerHTML = '$response';";

?>

