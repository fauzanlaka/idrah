<!DOCTYPE html>
<html>
    <head>
        <title>HASIL STUDI</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
         <!-- tvm style -->
        <link href="../../../css/jisda.css" rel="stylesheet"> 
        <style>
            body {
                height: 100%;
                width: 100%;
                /*to centre page on screen*/
                margin-left: auto;
                margin-right: auto;
            }
            table {
                    border-collapse: collapse;
                }
                @font-face {
                    font-family: "jawi";
                    src: url(../../../font/jawi.ttf);
                }

                #main{
                    font:35px "jawi";
                }
                #subText{
                    font: 20px "jawi";
                }
                #text{
                    font: 16px "jawi";
                    color: #000000;
                }
        </style>
    </head>
    <body>
        
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
        ?>
      
        <div align="center">
            <p>Tahun pengajian : <?= $rs_term ?>/<?= $rs_year ?></p>
            <p>Kelas : <?= $class ?></p>
            <p><?= facultyInfo($ft_id, 'ft_name', $connect) ?></p>
            <p><?= departmentInfo($dp_id, 'dp_name', $connect) ?></p>
        </div>
        
        <table border="1" class="fixed">
            <col width="10px" />
            <col width="20px" />
            <col width="180px" />
            <thead>
                <tr style="background-color:#c8cfd4">
                    <td align="center" rowspan="3"><div id="text">BIL</div></td>
                    <td align="center" rowspan="3"><div id="text">NIM</div></td>
                    <td align="center" rowspan="3"><div id="text">NAMA-NASAB</div></td>
                    <?php
                        while($registerSubject_rs = mysqli_fetch_array($registerSubject)){
                            $s_id = $registerSubject_rs['s_id'];
                    ?>
                    <td><div class="vertical"><div id="text">
                            <?= subjectInfo($s_id, 's_code', $connect) ?> <br>
                            <?= subjectInfo($s_id, 's_rumiName', $connect) ?>
                    </div></div></td>
                    <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 1;
                    while($student_rs = mysqli_fetch_array($student)){
                        $st_id = $student_rs['st_id'];
                ?>
                <tr>
                    <td align="center"><div id="text"><?= $i ?></div></td>
                    <td align="center"><div id="text"><?= studentInfo($st_id, 'student_id', $connect) ?></div></td>
                    <td align="left"><div id="text"><?= strtolower(studentInfo($st_id, 'firstname_rumi', $connect)) ?> <?= strtolower(studentInfo($st_id, 'lastname_rumi', $connect)) ?></div></td>
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