<?php
    $page_title="Privacy Policy";
    include("includes/connection.php");
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
    <title><?php echo (isset($page_title)) ? $page_title.' | '.APP_NAME : APP_NAME; ?></title>

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
    <div id="pb_wrapper">
        <!-- Theme loader -->
        <div id="pb_loader">Loading..</div>
        <div class="pb-main-container mt-4">
            <div class="pb-card">
                <div class="pb-card__head d-sm-flex align-items-sm-center">
                    <div class="pb-header-left">
                        <a href="" class="pb-brand">
                            <img  src="images/<?php echo APP_LOGO;?>" alt="" style="width: 30px; border-radius: 3px; margin-right: 10px;">
                        </a>
                        <a href="" class="pb-brand"><span class="pb-brand__text"><?= APP_NAME ?></span></a>
                    </div>
                </div>
                <div class="p-4">
                    <div class="d-flex justify-content-between privacy-head">
                        <div class="privacyHeader">
                            <h2>Privacy Policy for <?php echo APP_NAME;?></h2>
                            <p>Updated <?php echo date('D m, Y ');?></p>
                        </div>
                        <div class="get-privacy-terms align-self-center">
                            <button onclick="window.print()" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> Print</button>
                        </div>
                    </div>
                     <div class="pb-card__head mb-4"></div>
                    <div class="privacy-content-container">
                        <section>
                            <?=stripslashes($settings_details['app_privacy_policy'])?>
                        </section>
                    </div>
                </div>
                <!-- Begin:: Main footer -->
                <footer class="pb-footer mt-0">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <p class="">Copyright © <?php echo date('Y');?> <?php echo APP_NAME;?></a>, All rights reserved.</p>
                        </div>
                    </div>
                </footer>
                <!-- End:: Main footer  -->
            </div>
            
        </div>
    </div>
    <!-- Scripts -->
    <script src="assets/js/vendors.bundle.js"></script>
    <script src="assets/js/notify.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
</body>
</html>