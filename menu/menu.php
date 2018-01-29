<ul class="sidebar-menu">
<?php
    if($u_status=='Admin'){
?>
    
    <li class="treeview"><a href="?mod=index"><i class="fa fa-info-circle"></i><span>DASHBOARD</span></a></li>
    <!-- user -->
    <li class="treeview"><a href="?mod=user"><i class="fa fa-user-circle-o"></i><span>PENGUNA</span></a></li>
    <!-- info mahasiswa -->
    <li class="treeview"><a href="?mod=student"><i class="fa fa-group"></i><span>MAHASISWA</span></a></li>
    <!-- hasil studi -->
    <li class="treeview"><a href="#"><i class="fa fa-file-code-o"></i><span>HASIL STUDI</span><i class="fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li><a href="?mod=scoreRecord"><i class="fa fa-circle-o"></i> Pengisian hasil</a></li>
            <li><a href="?mod=scoreCenter"><i class="fa fa-circle-o"></i> Hasil peribadi</a></li>
            <li><a href="?mod=scoreCenterClass"><i class="fa fa-circle-o"></i>Hasil perkelas</a></li>
        </ul>
    </li>
    <!-- dur -->
    <li class="treeview"><a href="?mod=dur"><i class="fa fa-dot-circle-o"></i><span>SISTEM DUR</span></a></li>
<?php
    }else if($u_status=='Kewangan'){
?>
    <li class="treeview"><a href="#"><i class="fa fa-info-circle"></i><span>INFORMASI</span></a></li>
    <!-- info mahasiswa -->
    <li class="treeview"><a href="?mod=student"><i class="fa fa-group"></i><span>MAHASISWA</span></a></li>
    <!-- dur -->
    <li class="treeview"><a href="?mod=dur"><i class="fa fa-dot-circle-o"></i><span>SISTEM DUR</span></a></li>
<?php
    }else if($u_status=='Amir kuliah'){
?>
    <li class="treeview"><a href="#"><i class="fa fa-info-circle"></i><span>INFORMASI</span></a></li>
    <!-- hasil studi -->
    <li class="treeview"><a href="#"><i class="fa fa-file-code-o"></i><span>HASIL STUDI</span><i class="fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li><a href="?mod=scoreRecord"><i class="fa fa-circle-o"></i> Pengisian hasil</a></li>
            <li><a href="?mod=scoreCenter"><i class="fa fa-circle-o"></i> Hasil peribadi</a></li>
            <li><a href="?mod=scoreCenterClass"><i class="fa fa-circle-o"></i>Hasil perkelas</a></li>
        </ul>
    </li>
<?php
    }
?>
</ul>