<?php
    function userInfo($u_id, $output, $connect){
        include $connect;
        $sql = mysqli_query($con, "SELECT * FROM user WHERE u_id='$u_id'");
        $result = mysqli_fetch_array($sql);
        switch ($output){
            case 'u_status':
                return $result['u_status'];
                break;
            case 'ft_id':
                return $result['ft_id'];
                break;
        }
    }
?>

