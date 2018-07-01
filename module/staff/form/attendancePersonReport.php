<?php
    include '../../../connect/connect.php';
    $connect =  '../../../connect/connect.php';
    include '../../../function/staff/staffInfo.php';
    include '../../../function/user.php';
    $operator = $_GET["userid"];
    $t_id = $_GET["id"];
    
    $tp_id = staffInfo($t_id, 'tp_id', $connect);
    $t_photo = staffInfo($t_id, 't_photo', $connect);
    if($t_photo==""){
        $staffPhoto = "module/user/photo/user.png";
    }else{
        $staffPhoto = "module/staff/photo/$t_photo";
    }
    
?>
<div class="row user">
    <div class="col-md-12">
        <div class="profile"><!-- profile -->
            <div class="info" id="imageShow2"><img class="user-img" src="<?= $staffPhoto ?>">
            </div>
            <div class="cover-image">
                <div class="panel-body">
                    <br>
                    <div class="pull-right">
                        <a href="?mod=staff" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> back</a>
                    </div>
                    <br><br>
                    <p><strong>Kod : <?= staffInfo($t_id, 't_code', $connect) ?><i></i></strong></p>
                    <p><strong>Nama-nasab : <?= staffInfo($t_id, 't_fnameRumi', $connect) ?> <?= staffInfo($t_id, 't_lnameRumi', $connect) ?><i></i></strong></p>
                    <p><strong>Tel : <?= staffInfo($t_id, 't_telephone', $connect) ?><i></i></strong></p>
                </div>
            </div>
        </div><!-- /profile -->
    </div>
    
    <div class="col-md-3"><!-- content menu -->
        <div class="card p-0">
            <ul class="nav nav-tabs nav-stacked user-tabs">
                <li class="active"><a href="#staff-attendance" data-toggle="tab">Sejarah kehadiran</a></li>
                <li><a href="#staff-snapping" data-toggle="tab">Snapping</a></li>
                
            </ul>
        </div>
    </div><!-- /content menu -->
    
    <div class="col-md-9"><!-- content -->
        <div class="tab-content">
            <div class="tab-pane active" id="staff-attendance"><!-- payment-history -->
                <div class="card user-settings">
                    <h4 class="line-head">Sejarah kehadiran</h4>
                    <table class="table">
                        <tr>
                            <td><b>Tarikh</b></td>
                            <td><b>Masa Scan Masuk</b></td>
                            <td><b>Masa Scan Keluar</b></td>
                        </tr>
                        <?php
                            $daily = mysqli_query($con, "SELECT * FROM daily_check WHERE t_id='$t_id' ORDER BY dc_come_check_date DESC LIMIT 0,31");
                            while($dailyRes = mysqli_fetch_array($daily)){
                                $come_time = $dailyRes['dc_come_check'];
                                $back_time = $dailyRes['dc_back_check'];
                                $date = $dailyRes['dc_come_check_date'];
                        ?>
                        <tr>
                            <td><?= $date ?></td>
                            <td><?= $come_time ?></td>
                            <td><?= $back_time ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
            </div><!-- /all-score -->
            
            <div class="tab-pane fade" id="staff-snapping"><!-- payment-history -->
                <div class="card user-settings">
                    <h4 class="line-head">Snapping</h4>
                    
                    <table class="table">
                        <tr>
                            <td><b>Tarikh</b></td>
                            <td><b>Masa Scan Masuk</b></td>
                            <td><b>Masa Scan Keluar</b></td>
                            <td><b>Capture</b></td>
                        </tr>
                        <?php
                            $daily = mysqli_query($con, "SELECT * FROM daily_check WHERE t_id='$t_id' ORDER BY dc_come_check_date DESC LIMIT 0,31");
                            while($dailyRes = mysqli_fetch_array($daily)){
                                $come_time = $dailyRes['dc_come_check'];
                                $back_time = $dailyRes['dc_back_check'];
                                $date = $dailyRes['dc_come_check_date'];
                                $photo = $dailyRes['dc_photo_capture'];
                        ?>
                        <tr>
                            <td><?= $date ?></td>
                            <td><?= $come_time ?></td>
                            <td><?= $back_time ?></td>
                            <td><img src="http://attendance.jisda.org/photoCheck/<?= $photo ?>" width="150px" height="160px"></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
            </div><!-- /all-score -->
            
        </div>
    </div><!-- /content -->
</div>
      


