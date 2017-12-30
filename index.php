<?php
    session_start();
    if(!isset($_SESSION["u_id"])){
        header("location: login.php");
    }else{
        include 'function/profile.php';
        $connect = 'connect/connect.php';
        $u_id = $_SESSION["u_id"];
        $u_status = $_SESSION['u_status'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="font/awaesom.css">
    <link href="font/font.css" rel="stylesheet" type="text/css">
    <title>JISDA</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
  </head>
  <body class="sidebar-mini fixed">
        <div class="wrapper">
            <!-- Navbar-->
            <header class="main-header hidden-print"><a class="logo" href="index.php?mod=index">JISDA</a>
                  <nav class="navbar navbar-static-top">
                      <!-- Sidebar toggle button--><a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
                      <!-- Navbar Right Menu-->
                      <div class="navbar-custom-menu">
                          <ul class="top-nav">
                            <!-- User Menu-->
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-lg"></i></a>
                              <ul class="dropdown-menu settings-menu">
                                <li><a href="#"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
                                <li><a href="#"><i class="fa fa-user fa-lg"></i> Profile</a></li>
                                <li><a href="#" onclick="logOut()"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                              </ul>
                            </li>
                          </ul>
                      </div>
                  </nav>
            </header>
            <!-- Side-Nav-->
            <aside class="main-sidebar hidden-print">
              <section class="sidebar">
                  <div class="user-panel">
                      <div class="pull-left image"><img class="img-circle" src="images/user.png" alt="User Image"></div>
                      <div class="pull-left info">
                          <p><?= profile($u_id, '1', $connect); ?> <?= profile($u_id, '2', $connect); ?></p>
                          <p class="designation"><?= profile($u_id, '3', $connect); ?></p>
                      </div>
                  </div>
                <!-- Sidebar Menu-->
                <?php 
                  include_once 'menu/menu.php';
                ?>
              </section>
            </aside>
            <!-- main content -->
            <div class="content-wrapper">
                <div id="content">
                    <?php
                        $mod = $_GET['mod'];
                        switch ($mod){
                            case 'index':
                                include 'module/index/main.php';
                                break;
                            case 'scoreCenter':
                                include 'module/scoreCenter/main.php';
                                break;
                            case 'scoreCenterClass':
                                include 'module/scoreCenter/mainClass.php';
                                break;
                            case 'scoreRecord':
                                include 'module/scoreCenter/mainRecord.php';
                                break;
                            case 'student':
                                include 'module/student/main.php';
                                break;
                            case 'dur':
                                include 'module/dur/main.php';
                                break;
                        }
                    ?>
                </div>  
            </div>
            <!-- /main content -->
        </div>
    <!-- Javascripts-->
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/pace.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/plugins/sweetalert.min.js"></script>
    <!-- Ajax -->
    <script type="text/javascript" src="ajax/framework.js"></script>
    <script type="text/javascript" src="ajax/login.js"></script>
    <script type="text/javascript" src="ajax/global.js"></script>
    <script type="text/javascript" src="ajax/private.js"></script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
  </body>
</html>
<?php
    }
?>