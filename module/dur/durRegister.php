<?php
    include '../../connect/connect.php';
    $connect =  '../../connect/connect.php';
    include '../../function/student.php';
    include '../../function/faculty.php';
    include '../../function/subject.php';
    include '../../function/user.php';
    $tab_id = $_GET["userid"];
    $st_id = $_GET['id'];
    
    //แปลง tab_id เพื่อเลือก tab
    if($tab_id == 'dur-register'){
        $tab1 = 'active';
        $tab2 = '';
        $tab_pane1 = 'active';
        $tab_pane2 = 'fade';
    }else{
        $tab1 = '';
        $tab2 = 'active';
        $tab_pane1 = 'fade';
        $tab_pane2 = 'active';
    }
?>
<div class="row user">
    <div class="col-md-12">
        <div class="profile"><!-- profile -->
            <div class="info"><img class="user-img" src="http://system.jisda.org/content/student/capture/images/<?= studentInfo($st_id, 'image', $connect) ?>.jpg">
                <h4><?= studentInfo($st_id, 'firstname_rumi', $connect) ?> <?= studentInfo($st_id, 'lastname_rumi', $connect) ?></h4>
                <p><?= studentInfo($st_id, 'student_id', $connect) ?></p>
            </div>
            <div class="cover-image">
                <div class="panel-body">
                    <br>
                    <div class="pull-right">
                        <a href="?mod=dur" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> back</a>
                    </div>
                    <br><br>
                    <p><strong>Nama-nasab : <i><?= studentInfo($st_id, 'firstname_rumi', $connect) ?> <?= studentInfo($st_id, 'lastname_rumi', $connect) ?></i></strong></p>
                    <p><strong>Fakultas : <i><?= facultyInfo(studentInfo($st_id, 'fakulty', $connect), 'ft_name', $connect) ?></i></strong></p>
                    <p><strong>Jurusan : <i><?= departmentInfo(studentInfo($st_id, 'department', $connect), 'dp_name', $connect) ?></i></strong></p>
                    <p><strong>Tel : <i><?= studentInfo($st_id, 'telephone', $connect) ?></i></strong></p>
                </div>
            </div>
        </div><!-- /profile -->
    </div>
    
    <div class="col-md-3"><!-- content menu -->
        <div class="card p-0">
            <ul class="nav nav-tabs nav-stacked user-tabs">
                <li class="<?= $tab1 ?>"><a href="#dur-register" data-toggle="tab">Daftar dur</a></li>
                <li class="<?= $tab2 ?>"><a href="#dur-history" data-toggle="tab">Sejarah dur</a></li>
            </ul>
        </div>
    </div><!-- /content menu -->
    
    <div class="col-md-9"><!-- content -->
        <div class="tab-content">
            <div class="tab-pane <?= $tab_pane1 ?>" id="dur-register"><!-- mustawa-result -->
                <div class="card user-settings">
                    <h4 class="line-head">Daftar dur</h4>
                    <?= durList($st_id, $connect) ?>
                    <div id="registerAlert"></div>
                </div>
            </div><!-- /mustawa-result --><!-- /all-score -->
            
            <div class="tab-pane <?= $tab_pane2 ?>" id="dur-history"><!-- mustawa-result -->
                <div class="card user-settings">
                    <h4 class="line-head">Sejarah dur</h4>
                    <?= durHistory($st_id, 'Kewangan', $connect) ?>
                </div>
            </div><!-- /mustawa-result -->
        </div>
    </div><!-- /content -->
</div>
      
