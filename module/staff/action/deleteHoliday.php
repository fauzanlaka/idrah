<?php
    header("content-type: text/javascript");
    $connect = "../../../connect/connect.php";
    include "../../../connect/connect.php";
    include '../../../function/global.php';
    include '../../../function/staff/staffInfo.php';
    $jh_holiday_name = addslashes($_POST['jh_holiday_name']);
    //echo "alert('$jh_id');";
    $sql = mysqli_query($con, "DELETE FROM jisda_holiday WHERE jh_holiday_name='$jh_holiday_name'");
    
    $response = "";
    $response .= "<table class=\'table table-bordered\'>";
    $response .= "<tr>";
    $response .= "<td><b>Hari cuti</b></td>";
    $response .= "<td><b>Hari & Tanggal</b></td>";
    $response .= "<td><b>Delete</b></td>";
    $response .= "<tr></tr>";
    $sql = mysqli_query($con, "SELECT * FROM jisda_holiday GROUP BY jh_holiday_name ORDER BY jh_holiday DESC");
    while($result = mysqli_fetch_array($sql)){
        $jh_id = $result['jh_id'];
        $jh_holiday_name = $result['jh_holiday_name'];
        $jhName = jisdaHolidayInfo($jh_id, 'jh_holiday_name', $connect);
    
    $response .= "<tr>";
    $response .= "<td>".jisdaHolidayInfo($jh_id, 'jh_holiday_name', $connect)."</td>";
    $response .= "<td>";
                    //แสดงช่วงวันหยุด
                    $fdMn = mysqli_query($con, "SELECT MIN(jh_holiday) AS jh_holiday FROM jisda_holiday WHERE jh_holiday_name='$jhName'");
                    $fdMin = mysqli_fetch_array($fdMn);
                    $min = $fdMin['jh_holiday'];
                    $minDate = new DateTime($min);
                    $fdMx = mysqli_query($con, "SELECT MAX(jh_holiday) AS jh_holiday FROM jisda_holiday WHERE jh_holiday_name='$jhName'");
                    $fdMax = mysqli_fetch_array($fdMx);
                    $max = $fdMax['jh_holiday'];
                    $maxDate = new DateTime($max);
     $response .= $minDate->format('d-m-Y')." "." <b>Hingga</b> "." ".$maxDate->format('d-m-Y');
     $response .= "</td>";
     $response .= "<td><a class=\"btn btn-danger btn-sm\" onclick=\"deleteHoliday(\'$jh_holiday_name\')\" id=\"deleteProcess\">DELETE</a></td>";
     $response .= "</tr>";
    }
     $response .= "</table>";
    
    echo "document.getElementById('result').innerHTML = '$response';";
?>

