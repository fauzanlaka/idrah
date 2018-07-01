 <?php
    header("content-type: text/plain");
    include '../../../connect/connect.php';
    include '../../../function/faculty.php';
    include '../../../function/user.php';
    include '../../../function/staff/staffInfo.php';
    $connect = "../../../connect/connect.php";
    $q = $_POST['q'];
    $operator = $_POST['operator'];
    $sql = mysqli_query($con, "SELECT * FROM teachers WHERE t_fnameRumi LIKE '%$q%' OR t_lnameRumi LIKE '%$q%' ORDER BY t_id DESC LIMIT 0,10");
?>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>KOD</th>
            <th>NAMA - NASAB</th>
            <th>PHONE</th>
            <th>AKSI</th>
        </tr>
    </thead>
    <tbody>
<?php
    while($result=  mysqli_fetch_array($sql)){
        $t_id = $result['t_id'];
?>
        <tr>
            <td><?= staffInfo($t_id, 't_code', $connect) ?></td>
            <td><?= staffInfo($t_id, 't_fnameRumi', $connect) ?> <?= staffInfo($t_id, 't_lnameRumi', $connect) ?></td>
            <td><?= staffInfo($t_id, 't_telephone', $connect) ?></td>
            <td>
                <a href="#" onclick="formLoad('module/staff/form/profile.php', '<?= $t_id ?>', '<?= $operator ?>')"><button class="btn btn-success btn-sm"><i class="fa fa-folder-open-o"></i> lihat</button></a>
                <a href="#" onclick="formLoad('module/staff/form/attendancePersonReport.php', '<?= $t_id ?>', '<?= $operator ?>')"><button class="btn btn-success btn-sm"><i class="fa fa-folder-open-o"></i> Kehadiran</button></a>
            </td>
        </tr>        
<?php        
    }
?>

