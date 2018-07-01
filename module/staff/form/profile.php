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
                <li class="active"><a href="#staff-profile" data-toggle="tab">Profil</a></li>
                <li><a href="#staff-holiday" data-toggle="tab">Hari cuti</a></li>
                <li><a href="#staff-leave" data-toggle="tab">Minta cuti</a></li>
                <li><a href="#staff-photo" data-toggle="tab">Upload gambar</a></li>
                
            </ul>
        </div>
    </div><!-- /content menu -->
    
    <div class="col-md-9"><!-- content -->
        <div class="tab-content">
            <div class="tab-pane active" id="staff-profile"><!-- payment-history -->
                <div class="card user-settings">
                    <h4 class="line-head">Profil</h4>
                    <form name="profileForm" id="profileForm">
                        <div class="row mb-10">
                            <div class="col-md-3">
                                <label>Position</label>
                                <select class="form-control" name="tp_id" id="tp_id" onchange="attendanceReport()">
                                    <?php $satff_tp_id = staffInfo($t_id, 'tp_id', $connect)  ?>
                                    <option value="" disabled="" selected="" style="display: none;">Pilih</option>
                                    <?php
                                        $staff = mysqli_query($con, "SELECT * FROM teacher_position");
                                        while($result = mysqli_fetch_array($staff)){
                                            $tp_id = $result['tp_id'];
                                    ?>
                                    <option value="<?= $tp_id ?>" <?php if($satff_tp_id==$tp_id){echo "selected='selected'";} ?>><?= positionInfo($tp_id, 'tp_name_rm', $connect) ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>   
                            <div class="col-md-3">
                                <label>ID_Scanner</label>
                                <input type="text" class="form-control" name="t_idscan" id="t_idscan" value="<?= staffInfo($t_id, 't_idscan', $connect) ?>" onkeypress="return press_Enter()">
                            </div>
                        </div>
                        <input type="hidden" name="t_id" id="t_id" value="<?= $t_id ?>">
                    </form>
                    <a class="btn btn-success" id="profileProcess" onclick="staffProfile()">SAVE</a>
                </div>
            </div><!-- /all-score -->
            
            <div class="tab-pane fade" id="staff-holiday"><!-- all-score -->
                <div class="card user-settings">
                    <h4 class="line-head">Hari cuti</h4>
                    <form name="holidayForm" id="holidayForm">
                        <div class="row mb-10">
                            <div class="col-md-3">
                                <select class="form-control" name="h_holiday" id="h_holiday">
                                    <option value="Monday">Isnin</option>
                                    <option value="Tuesday">Selasa</option>
                                    <option value="Wednesday">Rabu</option>
                                    <option value="Thursday">Khamis</option>
                                    <option value="Friday">Jumat</option>
                                    <option value="Saturday">Sabtu</option>
                                    <option value="Sunday">Ahad</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-success" onclick="staffHoliday()" id="holidayProcess">SAVE</a>
                            </div>
                        </div>
                        <input type="hidden" name="t_id" id="t_id" value="<?= $t_id ?>">
                        <div id="holidayList">
                            <table class='table table-bordered'>
                                <tr>
                                    <td><b>Hari Cuti</b></td>
                                    <td><b>Delete</b></td>
                                </tr>
                                <?php
                                    $sql = mysqli_query($con, "SELECT * FROM holiday WHERE t_id='$t_id'");
                                    while($result = mysqli_fetch_array($sql)){
                                    $h_id = $result['h_id'];
                                ?>
                                <tr>
                                    <td><?= $result['h_holiday'] ?></td>
                                    <td><a class='btn btn-danger btn-sm' onclick="deleteStaffHoliday('<?= $h_id ?>', '<?= $t_id ?>')">DELETE</a></td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </table>
                        </div>
                    </form>
                </div>
            </div><!-- /all-score -->
            
            <div class="tab-pane fade" id="staff-leave"><!-- mustawa-result -->
                <div class="card user-settings">
                    <h4 class="line-head">Minta cuti</h4>
                    <form name="leaveForm" id="leaveForm">
                        <div class="row mb-10">
                            <div class="col-md-6">
                                <label>Hal</label>
                                <input type="text" class="form-control" name="sl_leave_title" id="sl_leave_title">
                            </div>
                        </div>
                        <div class="row mb-10">
                            <div class="col-md-3">
                                <label>Dari tanggal</label>
                                <input type="date" class="form-control" name="fromDate" id="fromDate">
                            </div>
                            <div class="col-md-3">
                                <label>Hingga tanggal</label>
                                <input type="date" class="form-control" name="toDate" id="toDate">
                            </div>
                        </div>
                        <input type="hidden" name="t_id" id="t_id" value="<?= $t_id ?>">
                    </form>
                    <button class="btn btn-success" onclick="staffLeave()" id="leaveProcess">SAVE</button>
                    <div id="leaveList">
                        <table class="table">
                            <tr>
                                <td>Hal</td>
                                <td>Tarikh</td>
                                <td>DELETE</td>
                            </tr>
                            <?php
                            $leave = mysqli_query($con, "SELECT * FROM staff_leave WHERE t_id='$t_id' GROUP BY key_add_date");
                            while($leaveResult = mysqli_fetch_array($leave)){
                                $title = str_replace("\'", "&#39;", $leaveResult["sl_leave_title"]);
                                $date = $leaveResult['sl_leave_date'];
                                $key_add_date = $leaveResult['key_add_date'];
                            ?>
                                <tr>
                                    <td>$title</td>
                                    <td><?= getMinDate($key_add_date, $connect) ?> <b>Hingga</b> <?= getMaxDate($key_add_date, $connect) ?></td>
                                    <td><a class="btn btn-danger" onclick="deleteLeave('<?= $key_add_date ?>', '<?= $t_id ?>')">DELETE</a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div><!-- /mustawa-result -->
            
            <div class="tab-pane fade" id="staff-photo"><!-- all-score -->
                <div class="card user-settings">
                    <h4 class="line-head">Upload gambar <a href="../idarah2/module/staff/capture/index.php?t_id=<?= $t_id ?>" target="_blank"><i class="fa fa-camera"></i></a> </h4>
                    <form class="form-horizontal" name="profileImage" id="profileImage" method="post" target="ifrm" enctype="multipart/form-data" action="module/staff/action/profileImage.php">
                        <div class="row mb-10">
                            <div class="col-md-6">
                                <label>Pilih gambar</label>
                                <input type="file" class="form-control" name="t_photo" id="t_photo" required="">
                            </div>
                        </div>
                        <input type="hidden" name="t_id" id="t_id" value="<?= $t_id ?>">
                        <button class="btn btn-primary" type="submit" onclick="if(document.getElementById('t_photo').value==''){}else{document.getElementById('process').innerHTML = 'Uploading....'}">   
                            <div id="process"><i class="fa fa-fw fa-lg fa-check-circle"></i> UPLOAD</div>
                        </button> 
                    </form>
                    <br>
                    <div id="imageShow"></div>
                    <iframe name="ifrm" style="display:none;"></iframe>
                </div>
            </div><!-- /all-score -->
            
        </div>
    </div><!-- /content -->
</div>
      


