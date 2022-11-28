<?php
include("includes/connection.php");
include("language/language.php");

$license_filename="includes/.lic";
if(!file_exists($license_filename)){
    header("Location:install/index.php");
    exit;
}else{
    if(isset($_SESSION['admin_name'])){
        header("Location:dashboard.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <!-- Seo Meta -->
        <meta name="description" content="This Admin Panel Made by nemosofts., Copyright © 2022 nemosofts All rights reserved.">
        <meta name="keywords" content="nemosofts, codecanyon, themeforest">
    
        <!-- Website Title -->
        <title>Login | <?php echo APP_NAME;?></title>
        
        <!-- Favicon --> 
        <link href="images/<?php echo APP_LOGO;?>" rel="icon" sizes="32x32">
        <link href="images/<?php echo APP_LOGO;?>" rel="icon" sizes="192x192">
    
        <!-- IOS Touch Icons -->
        <link rel="apple-touch-icon" href="images/<?php echo APP_LOGO;?>">
        <link rel="apple-touch-icon" sizes="152x152" href="images/<?php echo APP_LOGO;?>">
        <link rel="apple-touch-icon" sizes="180x180" href="images/<?php echo APP_LOGO;?>">
        <link rel="apple-touch-icon" sizes="167x167" href="images/<?php echo APP_LOGO;?>">
    
        <!-- Styles -->
        <link rel="stylesheet" href="assets/css/vendors.bundle.css" type="text/css">
        <link rel="stylesheet" href="assets/css/styles.css" type="text/css">
        
        <!--[if lt IE 9]>
    	    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
 
    </head>
    <body>
        <!-- Begin:: Theme wrapper -->
        <div id="pb_wrapper">
            <!-- Theme loader -->
            <div id="pb_loader">Loading..</div>
            <!-- Begin:: Theme auth -->
            <div class="pb-auth">
                <div class="pb-card pb-card--air">
                    <div class="pb-card__body">
                        <form action="login_db.php" method="post" class="text-left">
                            <div class="text-center mb-4">
                                <h4>Sign In</h4>
                                <p>Log in to the account to continue.</p>
                            </div>
                            <div class="mb-2">
                                <label for="pb_username" class="form-label">Username</label>
                                <div class="form-control-icon">
                                    <label for="pb_username" class="form-control-icon__label form-control-icon__label--left">
                                        <i class="fa fa-user"></i>
                                    </label>
                                    <input type="text" name="user_login" id="user_login"  class="form-control" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="d-flex justify-content-between">
                                    <label for="password" class="form-label">Password</label>
                                    <a href="auth_pass_recovery.php" >Forgot Password?</a>
                                </div>
                                <div class="form-control-icon">
                                    <label for="pb_password" class="form-control-icon__label form-control-icon__label--left">
                                        <i class="fa fa-lock"></i>
                                    </label>
                                    <input type="password" name="user_pass" id="user_pass" class="form-control" autocomplete="off" required>
                                    <a href="javascript:void(0);" class="form-control-icon__label form-control-icon__label--right toggle-password">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">Log In</button>
                            <div class="pb-auth__copy text-center mt-4">
                                <p class="">Copyright © <?php echo date('Y ');?> <a target="_blank" href="https://nemosofts.com">nemosofts</a> All rights reserved.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End:: Theme auth -->
    	</div>
        <!-- End:: Theme wrapper -->
        
        <!-- Scripts -->
        <script src="assets/js/vendors.bundle.js"></script>
        <script src="assets/js/notify.js"></script>
        <script src="assets/js/scripts.bundle.js"></script>
    
        <?php if (isset($_SESSION['msg'])) { ?>
            <script type="text/javascript">
                $('.notifyjs-corner').empty();
                $.notify(
                '<?php echo $client_lang[$_SESSION["msg"]]; ?>', {
                    position: "top right",
                    className: '<?= $_SESSION["class"] ?>'
                }
                );
            </script>
            <?php
            unset($_SESSION['msg']);
            unset($_SESSION['class']);
        }?>
        <script>  
            $(".toggle-password").on("click", function(e) {
                e.preventDefault();
                var x = document.getElementById("user_pass");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                    }
            });
        </script>
    </body>
</html>