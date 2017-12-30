<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>NIM</th>
            <th>NAMA - NASAB</th>
            <th>AKSI</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include '../../../function/student.php';
            include '../../../connect/connect.php';
            $connect = '../../../connect/connect.php';
            $operator = $_POST['operator'];
            $q = addslashes($_POST['q']);
            $sql = mysqli_query($con, "SELECT st_id,student_id,firstname_rumi,lastname_rumi,firstname_jawi,lastname_jawi,cityzen_id FROM students WHERE student_id LIKE '%$q%' OR firstname_rumi LIKE '%$q%' ORDER BY student_id DESC LIMIT 0,10");
            while($result = mysqli_fetch_array($sql)){
                $st_id = $result['st_id'];
        ?>
        <tr>
            <td><?= studentInfo($st_id, 'student_id', $connect) ?></td>
            <td><?= studentInfo($st_id, 'firstname_rumi', $connect) ?> <?= studentInfo($st_id, 'lastname_rumi', $connect) ?></td>
            <td><a href="#" onclick="formLoad('module/dur/durRegister.php', '<?= $st_id ?>', '<?= 'dur-register' ?>')"><button class="btn btn-success btn-sm"><i class="fa fa-folder-open-o"></i> lihat</button></a></td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>

