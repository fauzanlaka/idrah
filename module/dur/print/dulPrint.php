<?php
    include '../../../connect/connect.php';
    $dr_id = $_GET['dr_id'];
    $st_id = $_GET['st_id'];
    //Get dul register data from dulRegister
    $dulRegister = mysqli_query($con, "SELECT * FROM dulRegister WHERE dr_id='$dr_id'");
    $rowDulRegister = mysqli_fetch_array($dulRegister);
    $dr_date = $rowDulRegister['dulDate'];
    $sumMoney = $rowDulRegister['sumMoney'];
    $dulCode = $rowDulRegister['dulCode'];
    $academicYear = $rowDulRegister['academicYear'];
    
    //Get student data
    $student = mysqli_query($con, "SELECT * FROM students WHERE st_id='$st_id'");
    $rowStudent = mysqli_fetch_array($student);
    $student_id = $rowStudent['student_id'];
    $frname = $rowStudent['firstname_rumi'];
    $lrname = $rowStudent['lastname_rumi'];
    $faname = $rowStudent['firstname_jawi'];
    $laname = $rowStudent['lastname_jawi'];
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <title>JISDA | Kertas dur</title>
    
    <style>
        body {
            height: 842px;
            width: 650px;
            /* to centre page on screen*/
            margin-left: auto;
            margin-right: auto;
        }
        table{
            border-collapse: collapse;
        }
        @font-face {
            font-family: "jawi";
            src: url(../../../font/font/jawi.ttf);
        }

        #main{
            font:25px "jawi";
            font-weight: bold;
        }
        #subText{
            font: 20px "jawi";
        }
        #thai{
            font: 12px "jawi";
        }

    </style>
    
    <script language="javascript" type="text/javascript">
        function printDiv(printableArea) {
            var printContents = document.getElementById(printableArea).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>

    </head>
    <div id="printableArea">
                <table width="100%">
                    <tr>
                        <td colspan="4" align="center">
                            <img src="LOGO JISDA.png"width="69" height="77">
                        </td>
                    </tr>
                    <tr align="center">
                        <td align="center" colspan="4">
                            <div id="main"> جامعة الشيخ داود الفطاني اﻹسلامية - جالا </div>
                        </td>
                    </tr>
                    <tr align="center">
                        <td align="center" colspan="4">
                            <div id="main">(كرتس دور)</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>KOD DAFTAR</b>
                        </td>
                        <td>
                            <font color="grey"><?= "D".substr($academicYear, 2).sprintf("%04d",$dulCode) ?></font>
                        </td>
                        <td align="right">
                            <font color="grey"><?= "D".substr($academicYear, 2).sprintf("%04d",$dulCode) ?></font>
                        </td>
                        <td align="right">
                            <div id="subText"><b>
                                    كوددفتر</b>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            <b>NO.POKOK </b>
                        </td>
                        <td align="left">
                            <font color="grey"><?= $student_id ?></font>
                        </td>
                        <td align="right">
                            <font color="grey"><?= $student_id ?></font> 
                        </td>
                        <td align="right">
                            <div id="subText"><b>
                                    نمبرفوكؤ </b>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>NAMA-NASAB</b>
                        </td>
                        <td align="left">
                            <font color="grey"><?= $frname ?> - <?= $lrname ?></font>
                        </td>
                        <td align="right">
                            <font color="grey"><div id="subText"><?= $faname ?> - <?= $laname ?></div></font>
                        </td>
                        <td align="right">
                            <div id="subText"><b>
                                    نام - نسب </b>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>TARIKH DAFTAR</b>
                        </td>
                        <td align="left"> 
                            <font color="grey">
                                <?php
                                $date=date_create("$dr_date");
                                date_add($date,date_interval_create_from_date_string("0 days"));
                                echo date_format($date,"d-m-Y");
                                ?>
                            </font>
                        </td>
                        <td align="right">
                            <font color="grey"><?= $dr_date ?></font>
                        </td>
                        <td align="right">
                            <div id="subText"><b>
                                    تاريخ دفتر  </b>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>AKHIR</b>
                        </td>
                        <td align="left"> 
                            <font color="grey"><?php
                                $date=date_create("$dr_date");
                                date_add($date,date_interval_create_from_date_string("60 days"));
                                echo date_format($date,"d-m-Y");
                                ?>
                            </font>
                        </td>
                        <td align="right">
                            <font color="grey"><?php
                                $date=date_create("$dr_date");
                                date_add($date,date_interval_create_from_date_string("60 days"));
                                echo date_format($date,"Y-m-d");
                                ?>
                            </font>
                        </td>
                        <td align="right">
                            <div id="subText"><b>
                                    اخير  </b>
                            </div>
                        </td>
                    </tr>
                </table>
        <br>
        <table border="1px" width="100%" class="table table-bordered">
                      <tr bgcolor="">
                        <td align="center"><div id="subText"><b>تندا تاڠن</b></div></td>
                        <td align="center"><div id="subText"><b>مركه</b></div></td>
                        <td align="center"><div id="subText"><b>جمله دويت</b></div></td>
                        <td align="center"><div id="subText"><b>فنشرح</b></div></td>
                        <td align="center"><div id="subText"><b>مادة</b></div></td>
                        <td align="center"><div id="subText"><b>كود</b></div></td>
                        <td align="center" <div id="subText"><b>بيل</b></div></td>
                      </tr>
                    <tbody>
                        <?php
                            $dulSubject = mysqli_query($con, "SELECT * FROM dulSubject WHERE dr_id='$dr_id'");
                            $i = 1;
                            while($rowDulSubject = mysqli_fetch_array($dulSubject)){
                                $ss_id = $rowDulSubject['ss_id'];
                                $money = $rowDulSubject['money'];
                                
                            //Get s_id from studentSubject table
                            $studentSubject = mysqli_query($con, "SELECT * FROM studentsubject WHERE ss_id='$ss_id'");
                            $rowStudentSubject = mysqli_fetch_array($studentSubject);
                            $s_id = $rowStudentSubject['s_id'];
                            $t_id = $rowStudentSubject['t_id'];

                            //Get subject data from subject table
                            $subject = mysqli_query($con, "SELECT * FROM subject WHERE s_id='$s_id'");
                            $rowSubject = mysqli_fetch_array($subject);
                            $s_code = $rowSubject['s_code'];
                            $s_aname = $rowSubject['s_arabName'];
                            $s_rname = $rowSubject['s_rumiName'];
                            
                            //Get teacher data from teachers table
                            $teacher = mysqli_query($con, "SELECT * FROM teachers WHERE t_id='$t_id'");
                            $rowTeacher = mysqli_fetch_array($teacher);
                            $t_fname = $rowTeacher['t_fnameRumi'];
                            $t_lname = $rowTeacher['t_lnameRumi'];
                        ?>
                        <tr>
                          
                          <td align="center">
                              
                          </td>
                          
                          <td align="center">
                              
                          </td>
                          
                          <td align="center">
                              <font size="2px">
                                <?= $money ?>
                              </font>
                          </td>
                          
                          <td align="center">
                              <font size="2px">
                                  <?= $t_fname ?> - <?= $t_lname ?>
                              </font>
                          </td>
                          
                          <td align="center">
                              <font size="2px">
                                <div id="subText"><?= $s_aname ?></div> <?= $s_rname ?>
                              </font>
                          </td>
                          
                          <td align="center">
                            <font size="2px">
                              <?= $s_code ?>    
                            </font>
                          </td>
                          
                          <td align="center">
                            <font size="2px">
                              <?= $i ?>    
                            </font>
                          </td>
                          
                        </tr>
                        <?php
                            ++$i;
                            }
                        ?>
                        <tr>
                            <td colspan="7" align="right"><div id="subText"><b>
                                    <?= $sumMoney ?> &nbsp;&nbsp;&nbsp;&nbsp;    جمله دويت سموا</b></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <div align="center">
                <button type="button" class="btn btn-success" onclick="printDiv('printableArea')">Print <span class="glyphicon glyphicon-print"></span></button>
            </div>
            <br>
    </body>
</html>
