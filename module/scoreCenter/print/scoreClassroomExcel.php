<?php
    include '../../../connect/connect.php';
    include '../../../function/student.php';
            include '../../../function/subject.php';
            include '../../../function/score.php';
            include '../../../function/faculty.php';
            $connect = '../../../connect/connect.php';
            
            $class = $_GET['class'];
            $ft_id = $_GET['ft_id'];
            $dp_id = $_GET['dp_id'];
            $rs_term = $_GET['rs_term']; 
            $rs_year = $_GET['rs_year'];
            
            //query mahasiswa
            $student = mysqli_query($con, "SELECT rs.ft_id,rs.dp_id,rs.rs_class,rs.rs_term,rs.rs_academic_year,
                                    ss.ss_term,ss.ss_year,ss.ss_score,
                                    s.st_id,s.student_id,s.firstname_rumi,s.lastname_rumi,s.ft_id,s.dp_id,
                                    sr.*,
                                    re.*, 
                                    y.*
                                    FROM registerSubject rs
                                    INNER JOIN studentsubject ss ON ss.s_id=rs.s_id
                                    INNER JOIN students s ON s.st_id=ss.st_id
                                    INNER JOIN student_register sr ON sr.st_id=s.st_id
                                    INNER JOIN register re ON re.re_id=sr.re_id
                                    INNER JOIN year y ON y.y_id=re.y_id
                                    WHERE 
                                    rs.ft_id='$ft_id' AND rs.dp_id='$dp_id' AND rs.rs_class='$class' AND rs.rs_term='$rs_term' AND rs.rs_academic_year='$rs_year'
                                    AND ss.ss_term='$rs_term' AND ss.ss_year='$rs_year'
                                    AND s.ft_id='$ft_id' AND s.dp_id='$dp_id' AND s.student_id!=''
                                    AND y.year='$rs_year' AND re.term_id='$rs_term'
                                    GROUP BY ss.st_id
                                    ORDER BY s.student_id
                                    ");
            
            //query mata kuliah
            $registerSubject = mysqli_query($con, "SELECT re.*,s.*,t.* FROM registerSubject re 
                                           INNER JOIN subject s ON re.s_id=s.s_id
                                           INNER JOIN teachers t ON re.t_id=t.t_id
                                           WHERE re.rs_class='$class'
                                           AND re.rs_term='$rs_term'
                                           AND re.rs_academic_year='$rs_year'
                                           AND re.ft_id='$ft_id'
                                           AND re.dp_id='$dp_id'
                                           ORDER BY rs_session
                                           ");
            
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment; filename="HASIL STUDI.xls"');#ชื่อไฟล์
    header('Cache-Control: max-age=0');
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"

xmlns:x="urn:schemas-microsoft-com:office:excel"

xmlns="http://www.w3.org/TR/REC-html40">

<HTML dir="rtl" lang="ar">
    <head>

        <meta http-equiv="Content-type" content="text/html;charset=utf-8" />
        
    </head>
      
    <body>
        <div align="center">
            <?= $rs_term ?>/<?= $rs_year ?>
            كلس : <?= $class ?> 
            <?= facultyInfo($ft_id, 'ft_arab_name', $connect) ?>
            <?= departmentInfo($dp_id, 'dp_arab_name', $connect) ?>
        </div>

        <table x:str border="1" width="100%">
            
            <tr style="background-color:#c8cfd4;">
                <td align="center"><div id="text">بيل</div></td>
                <td align="center"><div id="text">#</div></td>
                <td align="center"><div id="text">نام - نسب</div></td>
                <?php
                    while($registerSubject_rs = mysqli_fetch_array($registerSubject)){
                    $s_id = $registerSubject_rs['s_id'];
                ?>
                <td>
                    <?= subjectInfo($s_id, 's_code', $connect)." ".subjectInfo($s_id, 's_rumiName', $connect)." ".subjectInfo($s_id, 's_arabName', $connect) ?> <br>
                </td>
                <?php
                    }
                ?>
                </tr>
                   <?php
                    $i = 1;
                    while($student_rs = mysqli_fetch_array($student)){
                        $st_id = $student_rs['st_id'];
                ?>
                <tr>
                    <td align="center"><div id="text"><?= $i ?></div></td>
                    <td align="center"><div id="text"><?= studentInfo($st_id, 'student_id', $connect) ?></div></td>
                    <td align="right"><div id="text"><?= strtolower(studentInfo($st_id, 'firstname_jawi', $connect)) ?> <?= strtolower(studentInfo($st_id, 'lastname_jawi', $connect)) ?></div></td>
                    <?php
                        //query mata kuliah
                        $registerSubject = mysqli_query($con, "SELECT re.*,s.*,t.* FROM registerSubject re 
                                                       INNER JOIN subject s ON re.s_id=s.s_id
                                                       INNER JOIN teachers t ON re.t_id=t.t_id
                                                       WHERE re.rs_class='$class'
                                                       AND re.rs_term='$rs_term'
                                                       AND re.rs_academic_year='$rs_year'
                                                       AND re.ft_id='$ft_id'
                                                       AND re.dp_id='$dp_id'
                                                       ORDER BY rs_session
                                                       ");
                        while($registerSubject_rs = mysqli_fetch_array($registerSubject)){
                            $re_s_id = $registerSubject_rs['s_id'];
                    ?>
                    <td align="center"><div id="text"><?= studentGrade(scoreResult($st_id, $re_s_id, $rs_term, $rs_year, $connect)) ?></div></td>
                    <?php
                        }
                    ?>
                </tr>
                <?php
                $i++;
                    }
                ?> 
            </tbody>
        </table>
          
    </body>

</html>