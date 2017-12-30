<?php
    function scoreResult($st_id, $s_id, $term, $year, $connect){
        include $connect;
        $sql = mysqli_query($con, "SELECT * FROM studentsubject WHERE s_id='$s_id' AND st_id='$st_id' AND ss_term='$term' AND ss_year='$year'");
        $result = mysqli_fetch_array($sql);
        return $result['ss_score'];
    }
?>

