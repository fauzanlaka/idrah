<?php
    header("content-type: text/plain");
    include '../../../connect/connect.php';
    include '../../../function/staff/staffInfo.php';
    include '../../../function/global.php';
    $connect = '../../../connect/connect.php';
    //รับค่า
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $tp_id = $_POST['tp_id'];
    
    
    
    function returnDates($fromDate, $toDate) {
        $fromdate = \DateTime::createFromFormat('Y-m-d', $fromDate);
        $todate = \DateTime::createFromFormat('Y-m-d', $toDate);
        return new \DatePeriod(
            $fromdate,
            new \DateInterval('P1D'),
            $todate->modify('+1 day')
        );
    }

?>
<div id="printableArea">
    <table border="1">
        <tr>
            <td><b>Nama-Nasab / Hari</b></td>
            <?php
                $i = 1;
                $datePeriod = returnDates($fromDate, $toDate);
                foreach($datePeriod as $date) {

                    $date->format('d-m-Y');
                    $daily = $date->format('d-m-Y');

                    //Our YYYY-MM-DD date string.
                    $date = $daily;

                    //Convert the date string into a unix timestamp.
                    $unixTimestamp = strtotime($date);

                    //Get the day of the week using PHP's date function.
                    $dayOfWeek = date("l", $unixTimestamp);

                    //Print out the day that our date fell on.

                    if($dayOfWeek=='Friday'){
                        $bgcolor = "orange";
                    }else{
                        $bgcolor = "";
                    }
            ?>
            <td height="190" align="center" valign="bottom" style="background-color: <?= $bgcolor ?>">
                <span class="textAlignVer">
                <?php 
                    echo $daily; 
                    echo " ".$dayOfWeek;
                ?>
                </span>
            </td>
            <?php
                }
            ?>
            <td height="190" align="center" valign="bottom" style="background-color: <?= $bgcolor ?>">
                <span class="textAlignVer">
                    Total putus (ขาดงาน)
                </span>
            </td>
            <td height="190" align="center" valign="bottom" style="background-color: <?= $bgcolor ?>">
                <span class="textAlignVer">
                    Total Minta cuti (ลางาน)
                </span>
            </td>
            <td height="190" align="center" valign="bottom" style="background-color: <?= $bgcolor ?>">
                <span class="textAlignVer">
                    Total Terlambat (มาสาย)
                </span>
            </td>
        </tr>
        <?php
            if($tp_id==0){
                $staff = mysqli_query($con, "SELECT * FROM teachers WHERE tp_id!='0'");
            }else{
                $staff = mysqli_query($con, "SELECT * FROM teachers WHERE tp_id='$tp_id'");
            }
            while ($result = mysqli_fetch_array($staff)){
                $t_id = $result['t_id'];
                $tp_id = staffInfo($t_id, 'tp_id', $connect);
                $tl_id = positionInfo($tp_id, 'tl_id', $connect);
        ?>
        <tr>
            <td><?= strtoupper(staffInfo($t_id, 't_fnameRumi', $connect)) ?> <?= strtoupper(staffInfo($t_id, 't_lnameRumi', $connect)) ?></td>
                <?php
                $totalAbsence = 0;
                $totalLeave = 0;
                $totalLate = 0;
                $datePeriod = returnDates($fromDate, $toDate);
                foreach($datePeriod as $date) {

                    $date->format('d-m-Y');
                    $daily = $date->format('d-m-Y');
                    $dailyCheck = $date->format('Y-m-d');

                    //Our YYYY-MM-DD date string.
                    $date = $daily;

                    //Convert the date string into a unix timestamp.
                    $unixTimestamp = strtotime($date);

                    //Get the day of the week using PHP's date function.
                    $dayOfWeek = date("l", $unixTimestamp);

                    //Print out the day that our date fell on.

                    if($dayOfWeek=='Friday'){
                        $bgcolor = "orange";
                    }else{
                        $bgcolor = "";
                    }
            ?>
            <td align="center">
                <?php 
                    //echo $daily; 
                    //echo " ".$dayOfWeek;
                    //เช็ควันหยุดของพนักงาน
                    $staffHoliday = mysqli_query($con, "SELECT * FROM holiday WHERE t_id='$t_id' AND h_holiday='$dayOfWeek'");
                    $staffHolidayNum = mysqli_num_rows($staffHoliday);
                    //เช็ควันลางาน
                    $staffLeave = mysqli_query($con, "SELECT * FROM staff_leave WHERE t_id='$t_id' AND sl_leave_date='$dailyCheck'");
                    $staffLeaveNum = mysqli_num_rows($staffLeave);
                    //ตรวจสอบว่าเข้างานหรือไม่
                    $staffCheck = mysqli_query($con, "SELECT * FROM daily_check WHERE t_id='$t_id' AND dc_come_check_date='$dailyCheck'");
                    $staffCheckNum = mysqli_num_rows($staffCheck);
                    $staffCome = mysqli_fetch_array($staffCheck);
                    $staffComeTime = $staffCome['dc_come_check'];
                    $tl = timelogInfo($tl_id, 'tl_time_late', $connect);
                    
                    //ตัวแปรเพื่อการเปรียบเทียบ
                    $tl_late = str_replace(':', '', $tl);
                    $comeStaff = str_replace(':', '', $staffComeTime);
                    
                    //ตรวจสอบวันหยุดโรงเรียน
                    $jisdaHoliday = mysqli_query($con, "SELECT * FROM jisda_holiday WHERE jh_holiday='$dailyCheck'");
                    $jisdaHolidayNum = mysqli_num_rows($jisdaHoliday);

                    if($staffHolidayNum>0){//ตรวจสอบวันหยุด
                        echo "";
                    }else{
                        if($staffCheckNum>0){//ตรวจสอบการเข้างาน
                            if($comeStaff>$tl_late){
                                echo "<font color='orange'>L</font>";
                                $totalLate = $totalLate + 1;
                            }else{
                                echo "";
                            }
                        }else{
                            if($staffLeaveNum>0){
                                echo "<font color='orange'>MC</font>";
                                $totalLeave = $totalLeave + 1;
                            }else{
                                if($jisdaHolidayNum>0 OR $dayOfWeek=='Friday'){
                                    echo "";
                                }else{
                                    echo "<font color='red'>0</font>";
                                    $totalAbsence = $totalAbsence + 1;
                                }
                            }
                        }
                    }
                ?>
            </td>
            <?php
                }
            ?>
            <td align="center">
                <font color="red"><?= $totalAbsence ?></font>
            </td>
            <td align="center">
                <font color="blue"><?= $totalLeave ?></font>
            </td>
            <td align="center">
                <font color="orange"><?= $totalLate ?></font>
            </td>
        </tr>
        <?php
            }
        ?>
    </table>
</div>
<br>

<button class="btn btn-success" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> PRINT</button>