<?php
    //sleep(2);
    include '../../../connect/connect.php';
    $t_id = $_POST['t_id'];
    
    
    $sql = mysqli_query($con, "SELECT * FROM teachers WHERE t_id='$t_id'");
    $result = mysqli_fetch_array($sql);
    $pes_profile_image_value = $result['t_photo'];
    
    //รูปถ่าย
    if($_FILES['t_photo']['tmp_name']==""){
        $stf_photoName = $pes_profile_image_value;
    }else{
        $tmp_stf_photo = $_FILES['t_photo']['tmp_name'];
        $stf_photo = $_FILES['t_photo']['name'];
        $stf_photoName = time()."$t_id"."$stf_photo";
    }

    //ทำการอัพโหลดไฟล์
    //1.อัพโหลดไฟล์ รูปถ่าย
    move_uploaded_file($tmp_stf_photo, "../photo/".$stf_photoName);
    //move_uploaded_file($tmp_stf_photo, "attendance/staffPhoto/".$stf_photoName);
    //$tmp_stf_photo->move('../../../../attendance/staffPhoto/', $stf_photoName);
    
    //อัพเดทฐานข้อมูล
    $insert = mysqli_query($con, "UPDATE teachers
                           SET t_photo='$stf_photoName'
                           WHERE t_id='$t_id'");
    
    //ดึงข้อมูลภาพอีกครั้ง
    $sql = mysqli_query($con, "SELECT * FROM teachers WHERE t_id='$t_id'");
    $result = mysqli_fetch_array($sql);
    $pes_profile_image_value = $result['t_photo'];
     
?>
//แสดงข้อความที่เพจ profileImage.php 
<script>
    top.document.getElementById('profileImage').reset();
    top.document.getElementById('process').innerHTML = '<i class=\"fa fa-fw fa-lg fa-check-circle\"></i> UPLOAD';
    top.$('html, body').animate({scrollTop:0}, 'slow');
    top.document.getElementById('imageShow').innerHTML = "<img src=\'module/staff/photo/<?= $pes_profile_image_value ?>\' width=\'160px\' height=\'180px\'>";
    top.document.getElementById('imageShow2').innerHTML = "<img src=\'module/staff/photo/<?= $pes_profile_image_value ?>\' >";
</script>

