<?php
    include 'connect/connect.php';
    $connect =  'connect/connect.php';
    include 'function/student.php';
    include 'function/faculty.php';
    $operator = $_SESSION["u_id"];
    //กำหนดการเข้าถึง
    $u_status = $_SESSION['u_status'];
    if($u_status=='Admin' || $u_status=='Amir kuliah'){
?>
<div class="page-title">
    <div>
        <h1><i class="fa fa-dot-circle-o"></i> SISTEM DUR</h1>
        <p>sistem manajemen JISDA</p>
    </div>
    <div>
        <ul class="breadcrumb">
            <li><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title"><i class="fa fa-dot-circle-o"></i> SISTEM DUR</h3>
            <form class="form-horizontal" name="search" id="search">
                <input type="text" class="form-control" name="q" id="q" placeholder="Cari" onkeyup="student_search('module/dur/action/search.php', 'search')" onkeypress="return student_search_enter('module/scoreCenter/action/search.php', 'search')">
                <input type="hidden" name="operator" id="operator" value="<?= $operator ?>">
            </form>
            <br>
            <div id="list">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>NAMA - NASAB</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $pagic = "?mod=dur";
                            $sql = "SELECT COUNT(st_id) FROM students";
                            $query = mysqli_query($con, $sql);
                            $row = mysqli_fetch_row($query);
                            // Here we have the total row count
                            $rows = $row[0];
                            // This is the number of results we want displayed per page
                            $page_rows = 10;
                            // This tells us the page number of our last page
                            $last = ceil($rows/$page_rows);
                            // This makes sure $last cannot be less than 1
                            if($last < 1){
                                $last = 1;
                            }
                            // Establish the $pagenum variable
                            $pagenum = 1;
                            // Get pagenum from URL vars if it is present, else it is = 1
                            if(isset($_GET['pn'])){
                                $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
                            }
                            // This makes sure the page number isn't below 1, or more than our $last page
                            if ($pagenum < 1) { 
                                $pagenum = 1; 
                            } else if ($pagenum > $last) { 
                                $pagenum = $last; 
                            }
                            // This sets the range of rows to query for the chosen $pagenum
                            $limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
                            // This is your query again, it is for grabbing just one page worth of rows by applying $limit
                            $sql = "SELECT st_id FROM students WHERE student_id!='' ORDER BY student_id DESC $limit";
                            $query = mysqli_query($con, $sql);
                            // This shows the user what page they are on, and the total number of pages
                            $textline1 = "จำนวน(<b>$rows</b>)";
                            $textline2 = "laman <b>$pagenum</b> dari <b>$last</b>";
                            // Establish the $paginationCtrls variable
                            $paginationCtrls = '';
                            // If there is more than 1 page worth of results
                            if($last != 1){
                                /* First we check if we are on page one. If we are then we don't need a link to 
                                the previous page or the first page so we do nothing. If we aren't then we
                                generate links to the first page, and to the previous page. */
                                if ($pagenum > 1) {
                                    $previous = $pagenum - 1;

                                    $paginationCtrls .= '<a href="'.$pagic.'&&pn='.$previous.'"><<</a> &nbsp; &nbsp; ';
                                    // Render clickable number links that should appear on the left of the target page number
                                    for($i = $pagenum-4; $i < $pagenum; $i++){
                                        if($i > 0){
                                            $paginationCtrls .= '<a href="'.$pagic.'&&pn='.$i.'">'.$i.'</a> &nbsp; ';
                                        }
                                    }
                                }
                                // Render the target page number, but without it being a link
                                $paginationCtrls .= ''.$pagenum.' &nbsp; ';
                                // Render clickable number links that should appear on the right of the target page number
                                for($i = $pagenum+1; $i <= $last; $i++){
                                    $paginationCtrls .= '<a href="'.$pagic.'&&pn='.$i.'">'.$i.'</a> &nbsp; ';
                                    if($i >= $pagenum+4){
                                        break;
                                    }
                                }
                                // This does the same as above, only checking if we are on the last page, and then generating the "Next"
                                if ($pagenum != $last) {
                                    $next = $pagenum + 1;
                                    $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$pagic.'&&pn='.$next.'">>></a> ';
                                    }
                            }
                            $list = '';
                            while($result = mysqli_fetch_array($query)){
                                $st_id = $result['st_id'];
                        ?>
                        <tr>
                            <td><?= studentInfo($st_id, 'student_id', $connect) ?></td>
                            <td><?= studentInfo($st_id, 'firstname_rumi', $connect) ?> <?= studentInfo($st_id, 'lastname_rumi', $connect) ?></td>
                            <td><a href="#" onclick="formLoad('module/dur/durRegister.php', '<?= $st_id ?>', '<?= 'dur-register' ?>')"><button class="btn btn-success btn-sm"><i class="fa fa-folder-open-o"></i> lihat</button></a></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="pull-left">
                <?php echo $paginationCtrls; ?>
            </div>
            <div class="pull-right">
                <?php echo $textline2 ?>
            </div>
            <br>
        </div>
    </div>
</div>
<?php
    }else{
?>
<div class="col-lg-12">
    <div class="alert alert-danger">
        ขออภัย ท่านไม่สามารถเข้าถถึงข้อมูลส่วนนี้ได้
    </div>
</div>
<?php
    }
?>
