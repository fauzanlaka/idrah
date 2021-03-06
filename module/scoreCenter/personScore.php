<?php
    include '../../connect/connect.php';
    $connect =  '../../connect/connect.php';
    include '../../function/student.php';
    include '../../function/faculty.php';
    include '../../function/subject.php';
    $operator = $_GET["userid"];
    $st_id = $_GET['id'];
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
                        <a href="?mod=scoreCenter" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> back</a>
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
                <li class="active"><a href="#all-score" data-toggle="tab">Hasil studi</a></li>
                <li><a href="#mustawa-result" data-toggle="tab">Hasil mustawa</a></li>
                <li><a href="#dur-result" data-toggle="tab">Hasil dur</a></li>
            </ul>
        </div>
    </div><!-- /content menu -->
    
    <div class="col-md-9"><!-- content -->
        <div class="tab-content">
            <div class="tab-pane active" id="all-score"><!-- mustawa-result -->
                <div class="card user-settings">
                    <h4 class="line-head">Hasil studi</h4>
                    <?php personScore($st_id, $connect) ?>
                </div>
            </div><!-- /mustawa-result --><!-- /all-score -->
            
            <div class="tab-pane fade" id="mustawa-result"><!-- mustawa-result -->
                <div class="card user-settings">
                    <h4 class="line-head">Hasil mustawa</h4>
                    <?php mustawaResult($st_id, $connect) ?>
                </div>
            </div><!-- /mustawa-result -->
            
            <div class="tab-pane fade" id="dur-result"><!-- dur-result -->
                <div class="card user-settings">
                    <h4 class="line-head">Hasil dur</h4>
                    <?php durHistory($st_id, 'Amir kuliah', $connect) ?>
                </div>
            </div><!-- /dur-result -->
        </div>
    </div><!-- /content -->
</div>
      
