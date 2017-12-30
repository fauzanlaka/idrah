<?php
    function studentInfo($st_id, $output, $connect){
        include $connect;
        switch ($output){
            case 'student_id':
                $sql = mysqli_query($con, "SELECT st_id,student_id FROM students where st_id='$st_id'");
                $result = mysqli_fetch_array($sql);
                return str_replace("\'", "&#39;", $result["student_id"]);
                break;
            case 'firstname_rumi':
                $sql = mysqli_query($con, "SELECT st_id,firstname_rumi FROM students where st_id='$st_id'");
                $result = mysqli_fetch_array($sql);
                return str_replace("\'", "&#39;", $result["firstname_rumi"]);
                break;
            case 'lastname_rumi':
                $sql = mysqli_query($con, "SELECT st_id,lastname_rumi FROM students where st_id='$st_id'");
                $result = mysqli_fetch_array($sql);
                return str_replace("\'", "&#39;", $result["lastname_rumi"]);
                break;
            case 'firstname_jawi':
                $sql = mysqli_query($con, "SELECT st_id,firstname_jawi FROM students where st_id='$st_id'");
                $result = mysqli_fetch_array($sql);
                return str_replace("\'", "&#39;", $result["firstname_jawi"]);
                break;
            case 'lastname_jawi':
                $sql = mysqli_query($con, "SELECT st_id,lastname_jawi FROM students where st_id='$st_id'");
                $result = mysqli_fetch_array($sql);
                return str_replace("\'", "&#39;", $result["lastname_jawi"]);
                break;
            case 'telephone':
                $sql = mysqli_query($con, "SELECT st_id,telephone FROM students where st_id='$st_id'");
                $result = mysqli_fetch_array($sql);
                return str_replace("\'", "&#39;", $result["telephone"]);
                break;
            case 'fakulty':
                $sql = mysqli_query($con, "SELECT st_id,ft_id FROM students where st_id='$st_id'");
                $result = mysqli_fetch_array($sql);
                return str_replace("\'", "&#39;", $result["ft_id"]);
                break;
            case 'department':
                $sql = mysqli_query($con, "SELECT st_id,dp_id FROM students where st_id='$st_id'");
                $result = mysqli_fetch_array($sql);
                return str_replace("\'", "&#39;", $result["dp_id"]);
                break;
            case 'image':
                $sql = mysqli_query($con, "SELECT st_id,images FROM image where st_id='$st_id'");
                $result = mysqli_fetch_array($sql);
                return str_replace("\'", "&#39;", $result["images"]);
                break;
            case 'image':
                $sql = mysqli_query($con, "SELECT st_id,telephone FROM students where st_id='$st_id'");
                $result = mysqli_fetch_array($sql);
                return str_replace("\'", "&#39;", $result["telephone"]);
                break;
        }
    }
    function personScore($st_id, $connect){
        include $connect;
        $student_register = mysqli_query($con, "SELECT * FROM student_register WHERE st_id='$st_id'");
        while($sr_rs = mysqli_fetch_array($student_register)){
            $term = $sr_rs['term'];
            $year = $sr_rs['academic_year'];
            
            echo "<strong>";
            echo $term;
            echo "/";
            echo $year;
            echo "</strong>";
            echo "<table class=\"table table-striped\">";
            echo "<thead>
                    <tr>
                        <th>MATA KULIAH</th>
                        <th>PENSYARAH</th>
                        <th>MARKAH</th>
                        <th>GRADE</th>
                    </tr>
                   </thead>";
            echo "<tbody>";
            
            $subject = mysqli_query($con, "SELECT ss.*,s.*,t.* FROM studentsubject ss
                                           INNER JOIN subject s ON ss.s_id=s.s_id
                                           INNER JOIN teachers t ON ss.t_id=t.t_id
                                           WHERE ss.ss_term='$term' AND ss.ss_year='$year' and ss.st_id='$st_id'");
            while($rowSubject = mysqli_fetch_array($subject)){
                $code = $rowSubject['s_code'];
                $subjectName = $rowSubject['s_rumiName'];
                $t_fname = $rowSubject['t_fnameRumi'];
                $t_lname = $rowSubject['t_lnameRumi'];
                $score = $rowSubject['ss_score'];
                
                //MATA KULIAH
                echo "<tr>";
                echo "<td>";
                echo "<font color='orange'><b>"; echo $code; echo "</b></font>"; echo " - "; echo $subjectName;
                echo "</td>";
                //PENSYARAH
                echo "<td>";
                echo $t_fname; echo " - "; echo $t_lname;
                echo "</td>";
                //MARKAH
                echo "<td>";
                echo $score;
                echo "</td>";
                //GRADE
                echo "<td>";
                echo studentGrade($score);
                echo "</td>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "<hr>";
        }
    }
    function studentGrade($score){
        if ($score == ''){
            $score1 = "I";
        }elseif ($score <= 49){
            $score1 = "F";
            return $score1;
        }elseif ($score <= 54) {
            $score1 = "D";
            return $score1;
        }elseif ($score <= 59) {
            $score1 = "D+";
            return $score1;
        }elseif ($score <= 64) {
            $score1 = "C";
            return $score1;
        }elseif ($score <= 69) {
            $score1 = "C+";
            return $score1;
        }elseif ($score <= 74) {
            $score1 = "B";
            return $score1;
        }elseif ($score <= 79) {
            $score1 = "B+";  
            return $score1;
                        }elseif ($score <= 84) {
                                $score1 = "A";
                                return $score1;
                        }elseif ($score <= 89) {
                                $score1 = "A+";
                                return $score1;
                        }  else {
                            $score1 = "A+";
                            return $score1;
                        }
    }
    function mustawaResult($st_id, $connect){
        include $connect;
        $sql = mysqli_query($con, "SELECT * FROM mustawa_register WHERE st_id='$st_id'");
        echo "<table class=\"table table-striped\">";
            echo "<thead>
                    <tr>
                        <th>MUSTAWA</th>
                        <th>TAHUN</th>
                        <th>GRUP</th>
                        <th>NATIJAH</th>
                    </tr>
                   </thead>";
            echo "<tbody>";
        while($result = mysqli_fetch_array($sql)){
            $mustawadata_id = str_replace("\'", "&#39;", $result["mustawadata_id"]);
            $group = str_replace("\'", "&#39;", $result["learningGroup"]);
            $learningStatus = str_replace("\'", "&#39;", $result["learningStatus"]);
            //data mustawa
            $m_data = mysqli_query($con, "SELECT * FROM mustawadata WHERE mustawaData_id='$mustawadata_id'");
            $m_rs = mysqli_fetch_array($m_data);
            $level = $m_rs['level'];
            $year = $m_rs['year'];
            echo "<tr>";
                //mustawa lewel
                echo "<td>";
                echo $level;
                echo "</td>";
                //tahun
                echo "<td>";
                echo $year;
                echo "</td>";
                
                //grup
                echo "<td>";
                echo $group;
                echo "</td>";
                
                //natijah
                echo "<td>";
                mustawaGrade($learningStatus);
                echo "</td>";
                
            echo "</tr>";
        }
        echo '</table>';
    }
    function mustawaGrade($status){
        if($status==0){
           
        }else if($status=='1'){
            echo "<font color='green'><b>LULUS</b></font>";
        }else{
            echo "<font color='red'><b>TIDAK LULUS</b></font>";
        }    
    }
    function durList($st_id, $connect){
        include $connect;
        $sql = mysqli_query($con, "SELECT s.*,ss.*,t.* FROM studentsubject ss
                                   INNER JOIN subject s ON ss.s_id=s.s_id
                                   INNER JOIN teachers t ON ss.t_id=t.t_id
                                   WHERE ss.st_id='$st_id' and ss.ss_score < 50 and ss.ss_score!=''
                                   ORDER BY ss.ss_year,ss.ss_term
                            ");
        echo "<form name='durRegister'>";
        echo "<table class=\"table table-striped\">"; 
            echo "<thead>
                    <tr>
                        <th>#</th>
                        <th>MADAH</th>
                        <th>PENSYARAH</th>
                        <th>SEM/TAHUN</th>
                        <th>HARGA</th>
                        <th>NATIJAH</th>
                    </tr>
                   </thead>";
            echo "<tbody>";
            $i = 1;
            while($result = mysqli_fetch_array($sql)){
                $s_id = $result['s_id'];
                $ss_id = $result['ss_id'];
                $t_fname = $result['t_fnameRumi'];
                $t_lname = $result['t_lnameRumi'];
                $score = $result['ss_score'];
                $term = $result['ss_term'];
                $year = $result['ss_year'];
                echo "<tr>";
                
                    echo "<td>";
                        echo "<input type=\"checkbox\" value=\"1\" name=\"check_list[$i]\">";
                    echo "</td>";
                    
                    echo "<td>";
                        echo "<font color='orange'>"; echo subjectInfo($s_id, 's_code', $connect); echo "</font>"; echo " "; echo subjectInfo($s_id, 's_rumiName', $connect);
                    echo "</td>";

                    echo "<td>";
                        echo ucfirst($t_fname); echo " "; echo ucfirst($t_lname);
                    echo "</td>";
                    
                    echo "<td>";
                        echo $term; echo "/"; echo $year;
                    echo "</td>";
                    
                    echo "<td width='10%'>";
                        echo "<input type=\"number\" name=\"money[$i]\" class=\"form-control input-sm\" value=\"50\">";
                    echo "</td>";
                    
                    echo "<td>";
                        echo $score;
                    echo "</td>";
                    
                    echo "<input type='hidden' name='ss_id[$i]' value='$ss_id'>";
                    
                echo "</tr>";
                $i++;
            }
            echo "</tbody>";
        echo "</table>";
        
        echo "<input type='hidden' name='st_id' value='$st_id'>";
        
        echo "</form>";
        
    echo "<a class=\"btn btn-success\" onclick=\"dur_register('function/durRegister.php', 'durRegister')\">SAVE</a>";
    }
    function durHistory($st_id, $status, $connect){
        include $connect;
        include 'global.php';
        $sql = mysqli_query($con, "SELECT * FROM dulRegister WHERE st_id='$st_id' ORDER BY dr_id DESC");
            echo "<table class=\"table table-striped\">"; 
            echo "<thead>
                    <tr>
                        <th>KOD DAFTAR</th>
                        <th>TARIKH DAFTAR</th>
                        <th>JUMLAH DUIT</th>
                        <th>MARKAH</th>
                        <th>HAPUS</th>
                    </tr>
                   </thead>";
            echo "<tbody>";
            while($result = mysqli_fetch_array($sql)){
                $dr_id = $result['dr_id'];
                $st_id = $result['st_id'];
                $dulCode = $result['dulCode'];
                echo "<tr id='$dr_id'>";
                
                    echo "<td>";
                        echo "D".substr($result['academicYear'],2).sprintf("%04d",$result['dulCode']); echo " "."<a href=\"module/dur/print/dulPrint.php?dr_id=$dr_id&st_id=$st_id\" target=\"_blank\"><i class=\"fa fa-print\" aria-hidden=\"true\"></i></a>";
                    echo "</td>";
                    
                    echo "<td>";
                        echo $result['dulDate'];
                    echo "</td>";
                    
                    echo "<td>";
                        echo $result['sumMoney'];
                    echo "</td>";
                    
                    echo "<td>";
                        
                        echo "<button type=\"button\" class=\"btn btn-success btn-sm\" data-toggle=\"modal\" data-target=\"#myModal$dr_id\">
                                  <i class=\"fa fa-edit\"></i> MARKAH
                              </button>
                             ";
                        echo "
                                <div class=\"modal fade\" id=\"myModal$dr_id\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel$dr_id\">
                                  <div class=\"modal-dialog\" role=\"document\">
                                    <div class=\"modal-content\">
                                      <div class=\"modal-header\">
                                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                        <h4 class=\"modal-title\" id=\"myModalLabel\">Pengisian markah</h4>
                                      </div>
                                      <div class=\"modal-body\">
                                            <table class='table table-striped'>
                                                <thead>
                                                    <tr>
                                                        <th>MADAH</th>
                                                        <th>PENSYARAH</th>
                                                        <th>MARKAH</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                             ";
                                        $subject = mysqli_query($con, "SELECT ds.*,ss.* FROM dulSubject ds INNER JOIN studentsubject ss ON ds.ss_id=ss.ss_id WHERE ds.dr_id='$dr_id' AND ss.st_id='$st_id'");
                                        while($subjectRs = mysqli_fetch_array($subject)){
                                            $s_id = $subjectRs['s_id'];
                                            $t_id = $subjectRs['t_id'];
                                            $ss_score = $subjectRs['ss_score'];
                                            $ss_id = $subjectRs['ss_id'];
                                            
                                            $s_code = subjectInfo($s_id, 's_code', $connect);
                                            $s_name = subjectInfo($s_id, 's_rumiName', $connect);
                                            $tname = teacherInfo($t_id, 'name', $connect);
                                            $lname = teacherInfo($t_id, 'lname', $connect);
                                            
                                            echo "<tr>";
                                                echo "<td><font color='orange'><b>$s_code</b></font> $s_name</td>";
                                                echo "<td>$tname $lname</td>";
                                                echo "<td>
                                                        <input type='text' class='form-control' name='score' id='$ss_id' value='$ss_score' onkeyup='studentSubjectSave(this.value, $ss_id)'>
                                                      </td>";
                                                echo "<td><div id='alert$ss_id'></div></td>";
                                            echo "</tr>";
                                        } 
                      echo "
                                                </tbody>
                                            </table>
                                      </div>
                                      <div class=\"modal-footer\">
                                        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                             ";
                             
                    echo "</td>";
                    
                    echo "<td>";
                        if($status=='Admin' || $status=='Kewangan' || $status=='Pengurus data'){
                            echo "<a class=\"btn btn-danger btn-sm\" onclick=\"dul_delete('function/dul/dulDelete.php', '$dr_id', '$st_id')\" href=\"#\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i> hapus</a>";
                        }else{
                            
                        }
                    echo "</td>";
                    
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
    }
?>
