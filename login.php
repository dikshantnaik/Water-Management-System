<?php
        session_start(); 
include "utils.php";

//If user make a requeuest to register
if(isset($_POST['register'])){

Register($_POST['username'],$_POST['password'],$_POST['email']);
}
if(isset($_POST['login'])) {
    if(Login($_POST['username'],$_POST['password'])=="logedin"){
        $_SESSION['success'] = "Loged IN";
        $_SESSION['user_logged_in'] = "True";
        redirect('index.php');
        
    }
    else{
        $_SESSION['failure'] = "Wrong Credential";
    };
}

//If user chose register
//It coul'd be done using css but i cant
$register = false;
if (isset($_GET['register'])){
    $register = true;    
}
?>
<html>


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrator</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <!-- <link rel="icon" href="https://img.icons8.com/doodle/50/000000/home--v1.png" type="image/x-icon"> -->
    <!-- MetisMenu CSS -->
    <link href="assets/js/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>

    <script src="assets/js/jquery.min.js" type="text/javascript"></script>

</head>

<body>
    <?php include 'includes/flash_messages.php'?>
    <div id="page-" class="col-md-4 col-md-offset-4 -align-center">
        <form class="form loginform" method="POST" action="login.php">
            <div class="login-panel panel panel-default">
                <?php if($register){ ?>
                <div class="panel-heading">Please Register Here</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label">Username</label>
                        <input type="text" name="username" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input type="email" name="email" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <input type="password" name="password" class="form-control" required="required">
                    </div>



                    <button type="submit" name="register" value="register"
                        class="btn btn-success loginField">Login</button>
                </div>
                <h4 style="padding-left: 3%;">Have an Accoun ? <a href="login.php">Login</a> </h4>
                <?php } else{?>


                <div class="panel-heading">Please Sign in</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label">Username</label>
                        <input type="text" name="username" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <input type="password" name="password" class="form-control" required="required">
                    </div>
                    <!-- <div class="checkbox">
                        <label>
                            <input name="remember" type="checkbox" value="1">Remember Me
                        </label>
                    </div> -->

                    <button type="submit" name="login" value="login" class="btn btn-success loginField">Login</button>
                </div>
                <h4 style="padding-left: 3%;">Don't Have an Account ? <a href="login.php?register=true">Register</a>
                </h4>
                <?php } ?>
            </div>
        </form>
    </div>

</body>

<?php include 'includes/footer.php'; ?>