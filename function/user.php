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
            case 'u_codename':
                return str_replace("\'", "&#39;", $result["u_codename"]);
                break;
            case 'u_codenumber':
                return str_replace("\'", "&#39;", $result["u_codenumber"]);
                break;
            case 'u_fname':
                return str_replace("\'", "&#39;", $result["u_fname"]);
                break;
            case 'u_lname':
                return str_replace("\'", "&#39;", $result["u_lname"]);
                break;
            case 'u_telephone':
                return str_replace("\'", "&#39;", $result["u_telephone"]);
                break;
        }
    }
?>

