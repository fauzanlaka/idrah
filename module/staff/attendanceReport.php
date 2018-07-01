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
                <h3 class="title">LAPORAN KERJA</h3>
                <div class="btn-group"><a class="btn btn-primary dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-cog"></i> Setting <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="?mod=holidayeSetting">Hari Cutis JISDA</a></li>
                        <li><a href="?mod=attendanceReport">Laporan Umum</a></li>
                        <li><a href="?mod=attendanceSnapReport">Laporan Snapping</a></li>
                    </ul>
                </div>
            </div>
            <form name="search" id="search">
                <div class="row mb-10">
                    <div class="col-md-3">
                        <label>Dari tanggal</label>
                        <input type="date" class="form-control" name="fromDate" id="fromDate" onchange="attendanceReport()">
                    </div>
                    <div class="col-md-3">
                        <label>Hingga tanggal</label>
                        <input type="date" class="form-control" name="toDate" id="toDate" onchange="attendanceReport()">
                    </div>
                    <div class="col-md-3">
                        <label>Staff</label>
                        <select class="form-control" name="tp_id" id="tp_id" onchange="attendanceReport()">
                            <option value="" disabled="" selected="" style="display: none;">Pilih</option>
                            <option value="0">Semua</option>
                            <?php
                                $staff = mysqli_query($con, "SELECT * FROM teacher_position");
                                while($result = mysqli_fetch_array($staff)){
                                    $tp_id = $result['tp_id'];
                            ?>
                            <option value="<?= $tp_id ?>"><?= positionInfo($tp_id, 'tp_name_rm', $connect) ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </form>
            <div id="result"></div>
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
