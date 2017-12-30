<?php
    function facultyInfo($ft_id, $output, $connect){
        include $connect;
        $sql = mysqli_query($con, "SELECT * FROM fakultys WHERE ft_id='$ft_id'");
        $result = mysqli_fetch_array($sql);
        switch ($output){
            case 'ft_name':
                return str_replace("\'", "&#39;", $result["ft_name"]);
                break;
            case 'ft_arab_name':
                return str_replace("\'", "&#39;", $result["ft_arab_name"]);
                break;
        }
    }
    function departmentInfo($dp_id, $output, $connect){
        include $connect;
        $sql = mysqli_query($con, "SELECT * FROM departments WHERE dp_id='$dp_id'");
        $result = mysqli_fetch_array($sql);
        switch ($output){
            case 'dp_name':
                return str_replace("\'", "&#39;", $result["dp_name"]);
                break;
            case 'dp_short_name':
                return str_replace("\'", "&#39;", $result["dp_short_name"]);
                break;
            case 'dp_arab_name':
                return str_replace("\'", "&#39;", $result["dp_arab_name"]);
                break;
        }
    }
?>

