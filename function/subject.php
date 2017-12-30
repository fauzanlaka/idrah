<?php
    function subjectInfo($s_id, $output, $connect){
        include $connect;
        $sql = mysqli_query($con, "SELECT * FROM subject WHERE s_id='$s_id'");
        $result = mysqli_fetch_array($sql);
        switch ($output){
            case 's_code':
                return str_replace("\'", "&#39;", $result["s_code"]);
                break;
            case 's_rumiName':
                return str_replace("\'", "&#39;", $result["s_rumiName"]);
                break;
            case 's_arabName':
                return str_replace("\'", "&#39;", $result["s_arabName"]);
                break;
        }
    }
?>

