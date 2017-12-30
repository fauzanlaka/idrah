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

        <title>JISDA</title>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
        <!--if lt IE 9
        script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
        script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
        -->
    </head>
    <body>
        <section class="material-half-bg">
          <div class="cover"></div>
        </section>
        <section class="login-content">
            <div class="logo">
              <img class="img-responsive center-block" src="images/jisda_logo.png" width="350px" height="300px">
            </div>
            <div class="login-box">
                <form class="login-form" name="loginForm" id="loginForm">
                    <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
                    <div class="form-group">
                        <label class="control-label">USERNAME</label>
                        <input class="form-control" type="text" placeholder="username" name="username" id="username" onkeypress="return isPressEnterLogin()" autofocus>
                    </div>
                    <div class="form-group">
                        <label class="control-label">PASSWORD</label>
                        <input class="form-control" type="password" placeholder="password" name="password" id="password" onkeypress="return isPressEnterLogin()">
                    </div>
                    <div class="form-group btn-container">
                        <a class="btn btn-primary btn-block" onclick="login()"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</a>
                    </div>
                    <div class="form-group">
                        <div id="loginStatus"></div>
                    </div>
                </form>
            </div>
        </section>
    </body>
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/pace.min.js"></script>
    <script src="js/main.js"></script>
    <!-- Ajax -->
    <script type="text/javascript" src="ajax/framework.js"></script>
    <script type="text/javascript" src="ajax/login.js"></script>
    <script type="text/javascript" src="ajax/global.js"></script>
    <script type="text/javascript" src="ajax/private.js"></script>
</html>