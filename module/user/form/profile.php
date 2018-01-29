<?php
    include '../../../connect/connect.php';
    $connect =  '../../../connect/connect.php';
    include '../../../function/user.php';
    $operator = $_GET["userid"];
    $u_id = $_GET["id"];
    $u_image = userInfo($u_id, 'u_image', $connect);
?>
<div class="row user">
    <div class="col-md-12">
        <div class="profile"><!-- profile -->
            <div class="info"><img class="user-img" src="module/user/photo/user.png">
                <h4><?= userInfo($u_id, 'u_codename', $connect) ?><?= userInfo($u_id, 'u_codenumber', $connect) ?></h4>
                <p><?= userInfo($u_id, 'u_fname', $connect) ?> <?= userInfo($u_id, 'u_lname', $connect) ?></p>
            </div>
            <div class="cover-image">
                <div class="panel-body">
                    <br>
                    <div class="pull-right">
                        <a href="?mod=user" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> back</a>
                    </div>
                    <br><br>
                    <p><strong>Kod : <i><?= userInfo($u_id, 'u_codename', $connect) ?><?= userInfo($u_id, 'u_codenumber', $connect) ?></i></strong></p>
                    <p><strong>Nama-nasab : <i><?= userInfo($u_id, 'u_fname', $connect) ?> <?= userInfo($u_id, 'u_lname', $connect) ?></i></strong></p>
                    <p><strong>ID Card : <i><?= userInfo($u_id, 'u_idcard', $connect) ?></i></strong></p>
                    <p><strong>Status : <i><?= userInfo($u_id, 'u_status', $connect) ?></i></strong></p>
                    <p><strong>Tel : <i><?= userInfo($u_id, 'u_telephone', $connect) ?></i></strong></p>
                </div>
            </div>
        </div><!-- /profile -->
    </div>
    
    <div class="col-md-3"><!-- content menu -->
        <div class="card p-0">
            <ul class="nav nav-tabs nav-stacked user-tabs">
                <li class="active"><a href="#payment-history" data-toggle="tab">Sejarah bayaran</a></li>
                <li><a href="#all-score" data-toggle="tab">Hasil studi</a></li>
                <li><a href="#mustawa-result" data-toggle="tab">Hasil mustawa</a></li>
                <li><a href="#dur-person" data-toggle="tab">Dur</a></li>
                <li><a href="#drop-person" data-toggle="tab">Drop</a></li>
            </ul>
        </div>
    </div><!-- /content menu -->
    
    <div class="col-md-9"><!-- content -->
        <div class="tab-content">
            <div class="tab-pane active" id="payment-history"><!-- payment-history -->
                <div class="card user-settings">
                    <h4 class="line-head">Sejarah bayaran</h4>
                    
                </div>
            </div><!-- /all-score -->
            
            <div class="tab-pane fade" id="all-score"><!-- all-score -->
                <div class="card user-settings">
                    <h4 class="line-head">Hasil studi</h4>
                    <?php personScore($st_id, $connect) ?>
                </div>
            </div><!-- /all-score -->
            
            <div class="tab-pane fade" id="mustawa-result"><!-- mustawa-result -->
                <div class="card user-settings">
                    <h4 class="line-head">Hasil mustawa</h4>
                    <?php mustawaResult($st_id, $connect) ?>
                </div>
            </div><!-- /mustawa-result -->
            
            <div class="tab-pane fade" id="dur-person"><!-- all-score -->
                <div class="card user-settings">
                    <h4 class="line-head">Dur</h4>
                    <?= durList($st_id, $connect) ?>
                </div>
            </div><!-- /all-score -->
            
            <div class="tab-pane fade" id="drop-person"><!-- all-score -->
                <div class="card user-settings">
                    <h4 class="line-head">Drop</h4>
                    
                </div>
            </div><!-- /all-score -->
            
        </div>
    </div><!-- /content -->
</div>
      


