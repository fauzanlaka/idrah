<?php
    include 'connect/connect.php';
    $connect =  'connect/connect.php';
    include 'function/staff/staffInfo.php';
    $operator = $_SESSION["u_id"];
    //กำหนดการเข้าถึง
    $u_status = $_SESSION['u_status'];
    $operator = $_SESSION["u_id"];
    if($u_status=='Admin'){
?>
<div class="page-title">
    <div>
        <h1><i class="fa fa-id-card-o"></i> STAFF JISDA</h1>
        <p>sistem manajemen JISDA</p>
    </div>
    <div>
        <ul class="breadcrumb">
            <li><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title-w-btn">
                <h3 class="title">HARI CUTI</h3>
                <div class="btn-group"><a class="btn btn-primary dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-cog"></i> Setting <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="?mod=holidayeSetting">Hari cuti JISDA</a></li>
                        <li><a href="?mod=attendanceReport">Laporan kerja</a></li>
                    </ul>
                </div>
            </div>
            <form name="holiday" id="holiday">
                <div class="row mb-10">
                    <div class="col-md-3">
                        <label>Dari tanggal</label>
                        <input type="date" class="form-control" name="fromDate" id="fromDate">
                    </div>
                    <div class="col-md-3">
                        <label>Hingga tanggal</label>
                        <input type="date" class="form-control" name="toDate" id="toDate">
                    </div>
                    <div class="col-md-3">
                        <label>Hari cuti</label>
                        <input type="text" class="form-control" name="jh_holiday_name" id="jh_holiday_name">
                    </div>
                    <div class="col-md-3">
                        <label><font color='white'>Hari cuti</font></label><br>
                        <a class="btn btn-success" onclick="holidayAdd()" id="process">SAVE</a>
                    </div>
                </div>
            </form>
            <div id="result">
                <table class="table table-bordered">
                    <tr>
                        <td><b>Hari cuti</b></td>
                        <td><b>Hari & Tanggal</b></td>
                        <td><b>Edit</b></td>
                    </tr>
                    <?php
                            $pagic = "?mod=holidayeSetting";
                            $sql = "SELECT COUNT(jh_id) FROM jisda_holiday";
                            $query = mysqli_query($con, $sql);
                            $row = mysqli_fetch_row($query);
                            // Here we have the total row count
                            $rows = $row[0];
                            // This is the number of results we want displayed per page
                            $page_rows = 10;
                            // This tells us the page number of our last page
                            $last = ceil($rows/$page_rows);
                            // This makes sure $last cannot be less than 1
                            if($last < 1){
                                $last = 1;
                            }
                            // Establish the $pagenum variable
                            $pagenum = 1;
                            // Get pagenum from URL vars if it is present, else it is = 1
                            if(isset($_GET['pn'])){
                                $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
                            }
                            // This makes sure the page number isn't below 1, or more than our $last page
                            if ($pagenum < 1) { 
                                $pagenum = 1; 
                            } else if ($pagenum > $last) { 
                                $pagenum = $last; 
                            }
                            // This sets the range of rows to query for the chosen $pagenum
                            $limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
                            // This is your query again, it is for grabbing just one page worth of rows by applying $limit
                            $sql = "SELECT * FROM jisda_holiday GROUP BY jh_holiday_name ORDER BY jh_holiday DESC $limit";
                            $query = mysqli_query($con, $sql);
                            // This shows the user what page they are on, and the total number of pages
                            $textline1 = "จำนวน(<b>$rows</b>)";
                            $textline2 = "laman <b>$pagenum</b> dari <b>$last</b>";
                            // Establish the $paginationCtrls variable
                            $paginationCtrls = '';
                            // If there is more than 1 page worth of results
                            if($last != 1){
                                /* First we check if we are on page one. If we are then we don't need a link to 
                                the previous page or the first page so we do nothing. If we aren't then we
                                generate links to the first page, and to the previous page. */
                                if ($pagenum > 1) {
                                    $previous = $pagenum - 1;

                                    $paginationCtrls .= '<a href="'.$pagic.'&&pn='.$previous.'"><<</a> &nbsp; &nbsp; ';
                                    // Render clickable number links that should appear on the left of the target page number
                                    for($i = $pagenum-4; $i < $pagenum; $i++){
                                        if($i > 0){
                                            $paginationCtrls .= '<a href="'.$pagic.'&&pn='.$i.'">'.$i.'</a> &nbsp; ';
                                        }
                                    }
                                }
                                // Render the target page number, but without it being a link
                                $paginationCtrls .= ''.$pagenum.' &nbsp; ';
                                // Render clickable number links that should appear on the right of the target page number
                                for($i = $pagenum+1; $i <= $last; $i++){
                                    $paginationCtrls .= '<a href="'.$pagic.'&&pn='.$i.'">'.$i.'</a> &nbsp; ';
                                    if($i >= $pagenum+4){
                                        break;
                                    }
                                }
                                // This does the same as above, only checking if we are on the last page, and then generating the "Next"
                                if ($pagenum != $last) {
                                    $next = $pagenum + 1;
                                    $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$pagic.'&&pn='.$next.'">>></a> ';
                                    }
                            }
                            $list = '';
                            while($result = mysqli_fetch_array($query)){
                                $jh_id = $result['jh_id'];
                                $jh_holiday_name = $result['jh_holiday_name'];
                                $jhName = jisdaHolidayInfo($jh_id, 'jh_holiday_name', $connect);
                    ?> 
                    <tr>
                        <td><?= jisdaHolidayInfo($jh_id, 'jh_holiday_name', $connect) ?></td>
                        <td>
                            <?php
                                //แสดงช่วงวันหยุด
                                $fdMn = mysqli_query($con, "SELECT MIN(jh_holiday) AS jh_holiday FROM jisda_holiday WHERE jh_holiday_name='$jhName'");
                                $fdMin = mysqli_fetch_array($fdMn);
                                $min = $fdMin['jh_holiday'];
                                $minDate = new DateTime($min);
                                $fdMx = mysqli_query($con, "SELECT MAX(jh_holiday) AS jh_holiday FROM jisda_holiday WHERE jh_holiday_name='$jhName'");
                                $fdMax = mysqli_fetch_array($fdMx);
                                $max = $fdMax['jh_holiday'];
                                $maxDate = new DateTime($max);
                                echo $minDate->format('d-m-Y')." "." <b>Hingga</b> "." ".$maxDate->format('d-m-Y') ;
                            ?>
                        </td>
                        <td><a class="btn btn-danger btn-sm" onclick="deleteHoliday('<?= $jh_holiday_name ?>')" id="deleteProcess">DELETE</a></td>
                    </tr> 
                            <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
    }else{
?>
<div class="col-lg-12">
    <div class="alert alert-danger">
        ขออภัย ท่านไม่สามารถเข้าถถึงข้อมูลส่วนนี้ได้
    </div>
</div>
<?php
    }
?>
