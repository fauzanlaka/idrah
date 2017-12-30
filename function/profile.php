<?php
    function profile($u_id, $outputKey, $connect){
        include $connect;
        $sql = mysqli_query($con, "SELECT * FROM user WHERE u_id='$u_id'");
        $result = mysqli_fetch_array($sql);
        switch ($outputKey){
            case '1':
                return $u_fname = str_replace("\'", "&#39;", $result["u_fname"]);
                break;
            case '2':
                return $u_lastname = str_replace("\'", "&#39;", $result["u_lname"]);
                break;
            case '3':
                return $u_lastname = str_replace("\'", "&#39;", $result["u_status"]);
                break;
        }
    }
?>

