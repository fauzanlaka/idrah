<?php
    header("content-type: text/javascript");
    include '../../../function/global.php';
    include '../../../connect/connect.php';
    $connect = '../../../connect/connect.php';
    
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $t_id = $_POST['t_id'];
    
    //เวลาบันทึกข้อมูล
    $key_add_date = date("h:i:sa");
    
    function returnDates($fromDate, $toDate) {
        $fromdate = \DateTime::createFromFormat('Y-m-d', $fromDate);
        $todate = \DateTime::createFromFormat('Y-m-d', $toDate);
        return new \DatePeriod(
            $fromdate,
            new \DateInterval('P1D'),
            $todate->modify('+1 day')
        );
    }
    
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
    
    $datePeriod = returnDates($fromDate, $toDate);
        foreach($datePeriod as $date) {
            $date->format('d-m-Y');
            $daily = $date->format('Y-m-d');
        
            $form_data = array(
                't_id' => $t_id,
                'sl_leave_title' => addslashes($_POST['sl_leave_title']),
                'sl_leave_date' => $daily,
                'key_add_date' => $key_add_date,
            );
            dbRowInsert('staff_leave', $form_data, $connect);
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
    echo "document.getElementById('leaveProcess').innerHTML = 'SAVE';";
?>

