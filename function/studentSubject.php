<?php
    include '../connect/connect.php';
    $s_id = $_POST['s_id'];
    $ft_id = $_POST['ft_id'];
    $dp_id = $_POST['dp_id'];
    $rs_term = $_POST['rs_term']; 
    $rs_year = $_POST['rs_year'];
    
    //echo $s_id;
    $sql = mysqli_query($con, "select s.*,ss.*,sr.* from students s
                        INNER JOIN studentsubject ss ON s.st_id=ss.st_id
                        INNER JOIN student_register sr ON sr.st_id=s.st_id
                        WHERE 
                        ss.ss_term='$rs_term' AND ss.ss_year='$rs_year' AND 
                        sr.term='$rs_term' AND sr.academic_year='$rs_year' AND 
                        ft_id='$ft_id' AND 
                        dp_id='$dp_id' AND 
                        s_id='$s_id' AND
                        student_id!=''
                        ");
    
    $subject = mysqli_query($con, "SELECT * FROM subject WHERE s_id='$s_id'");
    $subjectResult = mysqli_fetch_array($subject);
    $s_rumiName = ucwords(str_replace("\'", "&#39;", $subjectResult["s_rumiName"]));
    $s_arabName = ucwords(str_replace("\'", "&#39;", $subjectResult["s_arabName"]));
    $s_code = ucwords(str_replace("\'", "&#39;", $subjectResult["s_code"]));
    
    $response = <<<TB
            <h4 class="pull-left">{$s_code} : {$s_rumiName}</h4>
            <h4 class="pull-right"><div id="subText">{$s_arabName}</div></h4>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <td align="center"><b>BIL</b></td>
                        <td align="center"><b>NO.POKOK</b></td>
                        <td align="center">NAMA - NASAB</div></td>
                        <td align="center"><div id="subText"><b>نام - نسب</b></div></td>
                        <td align="center"><b>MARKAH</b></td>
                    </tr>
                </thead>
                <tbody>
TB;
    //echo $response;
    $i = 1;
    while($result = mysqli_fetch_array($sql)){
        $firstname_rumi = str_replace("\'", "&#39;", $result["firstname_rumi"]);
        $lastname_rumi = str_replace("\'", "&#39;", $result["lastname_rumi"]);
        $firstname_jawi = str_replace("\'", "&#39;", $result["firstname_jawi"]);
        $lastname_jawi = str_replace("\'", "&#39;", $result["lastname_jawi"]);
        $student_id = $result['student_id'];
        $ss_score = $result['ss_score'];
        $ss_id = $result['ss_id'];
        $tbody = <<<TBODY
                    <tr>
                        <td align="center">{$i}</td>
                        <td align="center">{$student_id}</td>
                        <td align="left">{$firstname_rumi} - {$lastname_rumi}</td>
                        <td align="right"><div id='subText'>{$firstname_jawi} - {$lastname_jawi}</div></td>
                        <td align="center" width="10%">
                            <input type="text" name="score" id="{$ss_id}" value="{$ss_score}" class="form-control" onkeyup="studentSubjectSave(this.value, $ss_id)">
                            <div id="alert{$ss_id}"></div>
                        </td>
                    </tr>
TBODY;
        $i++;
        $response .= $tbody;
    }
    echo $response;
?>

