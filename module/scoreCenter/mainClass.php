<?php
    include 'connect/connect.php';
    $connect =  'connect/connect.php';
    include 'function/student.php';
    include 'function/faculty.php';
    $operator = $_SESSION["u_id"];
    //กำหนดการเข้าถึง
    $u_status = $_SESSION['u_status'];
    if($u_status=='Admin' || $u_status=='Amir kuliah'){
?>
<div class="page-title">
    <div>
        <h1><i class="fa fa-file-code-o"></i> HASIL STUDI</h1>
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
            <h3 class="card-title"><i class="fa fa-file-code-o"></i> HASIL STUDI</h3>
            <form class="form-horizontal" name="classScheduleSearch" id="classScheduleSearch">
                <div class="form-group">
                    <div class="col-lg-3">
                        <select class="form-control" name="class" id="class">
                              <option>KELAS</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control" name="re_id" id="re_id">
                              <option>SEMESTER/TAHUN</option>
                              <?php
                                //get data from register data
                                $register = mysqli_query($con, "SELECT r.*,y.* FROM register r INNER JOIN year y ON r.y_id=y.y_id WHERE r.p_id='0' ORDER BY re_id DESC");
                                while($registerResult = mysqli_fetch_array($register)){
                                    $re_id = $registerResult['re_id'];
                                    $term = $registerResult['term_id'];
                                    $year = $registerResult['year'];
                                ?>
                                <option value="<?= $registerResult['re_id'] ?>"><?= $term ?> / <?= $year ?></option>
                              <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <select name="ft_id" id="ft_id" class="form-control" onchange="facultySelect('../connect/connect.php')">
                              <option>FAKULTI</option>
                              <?php
                              $faculty = mysqli_query($con, "SELECT * FROM fakultys");
                              while($ft_result = mysqli_fetch_array($faculty)){
                                $ft_id = $ft_result['ft_id'];
                                $ft_name = $ft_result['ft_name'];
                              ?>
                              <option value="<?= $ft_id ?>"><?= $ft_name ?></option>
                              <?php
                                }
                              ?>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <select name="dp_id" id="dp_id" class="form-control">
                                <option>Jurusan</option>
                        </select>
                    </div>
               </div>
            </form>
        </div>
        <div align="center">
            <button class="btn btn-success" onclick="classTimetableSearch_setting()"><span class="glyphicon glyphicon-search"></span> Cari</button>
        </div>
        <br>
        <div id="msg"></div>
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
