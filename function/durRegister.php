<?php
        header("content-type: text/javascript");
        $connect = '../connect/connect.php';
    
        $size = count($_POST['ss_id']);
        $st_id = $_POST['st_id'];

        include 'global.php';

        $sumMoney = "";
        $check_sum = "";

        $i = 1;
        while ($i <= $size){
            //ผลรวมค่าลงทะเบียน
            $money = $_POST['money'][$i];
            $check_list = $_POST['check_list'][$i];
            if($check_list != ''){
                $sumMoney = $sumMoney + $money;
            }
            //ตรวจสอบวิชาที่เลือกลงทะเบียนว่ามีไหม
            $check_sum = $check_sum + $check_list;
            $i++;
        }
        //บันทึกการลงทะเบียนแก้ตาราง dulregister
        if($check_sum > 0){
            $dulCode = dulCode($connect);
            $form_data = array(
                'st_id' => $st_id,
                'academicYear' => academicInfo('year', $connect),
                'dulCode' => $dulCode,
                'dulDate' => date('Y-m-d'),
                'sumMoney' => $sumMoney
            );
            dbRowInsert('dulRegister', $form_data, $connect);
            //ดึงรหัส dr_id ล่าสุด
            $get_dr_id = lastRecord('dulRegister', "WHERE st_id='$st_id' AND dulCode='$dulCode'", $connect);
            $dr_id = $get_dr_id['dr_id'];
            
            //ลงทะเบียนวิชาที่จะแก้
            $i = 1;
            while ($i <= $size){
                $check_list = $_POST['check_list'][$i];
                $money = $_POST['money'][$i];
                $ss_id = $_POST['ss_id'][$i];
                if($check_list != ''){
                    $form_data = array(
                        'dr_id' => $dr_id,
                        'ss_id' => $ss_id,
                        'money' => $money
                    );
                    dbRowInsert('dulSubject', $form_data, $connect);
                }
                $i++;
                echo "swal(\"Daftar dur berhasil\", \"Klik OK untuk print kertas dur\", \"success\");";
                echo "formLoad('module/dur/durRegister.php', '$st_id', 'dur-history');";
            }
        }
        
?>

