<?php

    function staffInfo($t_id, $output, $connect){
        include $connect;
        $sql = mysqli_query($con, "SELECT * FROM teachers WHERE t_id='$t_id'");
        $result = mysqli_fetch_array($sql);
        switch ($output){
            case "t_code":
                return str_replace("\'", "&#39;", $result["t_code"]);
                break;
            case "t_fnameRumi":
                return str_replace("\'", "&#39;", $result["t_fnameRumi"]);
                break;
            case "t_lnameRumi":
                return str_replace("\'", "&#39;", $result["t_lnameRumi"]);
                break;
            case "t_telephone":
                return str_replace("\'", "&#39;", $result["t_telephone"]);
                break;
            case "tp_id":
                    return str_replace("\'", "&#39;", $result["tp_id"]);
                break;
            case "t_code":
                    return str_replace("\'", "&#39;", $result["t_code"]);
                break;
            case "t_telephome":
                    return str_replace("\'", "&#39;", $result["t_telephome"]);
                break;
            case "t_photo":
                    return str_replace("\'", "&#39;", $result["t_photo"]);
                break;
            case "t_idscan":
                return str_replace("\'", "&#39;", $result["t_idscan"]);
                break;
        }
    }
    
    function jisdaHolidayInfo($jh_id, $output, $connect){
        include $connect;
        $sql = mysqli_query($con, "SELECT * FROM jisda_holiday WHERE jh_id='$jh_id'");
        $result = mysqli_fetch_array($sql);
        switch ($output){
            case 'jh_holiday_name':
                return str_replace("\'", "&#39;", $result["jh_holiday_name"]);
                break;
            case 'jh_holiday':
                return str_replace("\'", "&#39;", $result["jh_holiday"]);
                break;
        }
    }
    
    function positionInfo($tp_id, $output, $connect){
        include $connect;
        $sql = mysqli_query($con, "SELECT * FROM teacher_position WHERE tp_id='$tp_id'");
        $result = mysqli_fetch_array($sql);
        switch ($output){
            case 'tl_id':
                return str_replace("\'", "&#39;", $result["tl_id"]);
                break;
            case 'tp_name_rm':
                return str_replace("\'", "&#39;", $result["tp_name_rm"]);
                break;
        }
    }
?>

