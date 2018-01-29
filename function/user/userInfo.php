<?php
    function userInfo($u_id, $output, $connect){
        include $connect;
        $sql = mysqli_query($con, "SELECT * FROM user");
        $result = mysqli_fetch_array($sql);
        switch ($output){
            
        }
    }
?>

