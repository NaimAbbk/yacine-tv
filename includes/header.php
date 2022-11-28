<?php
date_default_timezone_set("Asia/Colombo");
include("includes/connection.php");
include("includes/session_check.php");

$currentFile = $_SERVER["SCRIPT_NAME"];
$parts = Explode('/', $currentFile);
$currentFile = $parts[count($parts) - 1];

$requestUrl = $_SERVER["REQUEST_URI"];
$urlparts = Explode('/', $requestUrl);
$redirectUrl = $urlparts[count($urlparts) - 1];

$mysqli->set_charset("utf8mb4");
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
    
    <!-- BEGIN SWEET ALERT -->
    <link href="assets/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- END SWEET ALERT -->
    
     <!--[if lt IE 9]>
	    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style>
        h4.pull-left {
            font-size: 20px;
            color: #e91e63; 
            margin-right: 15px;
        }
    </style>
    
</head>
<body>
<!-- Begin:: Theme wrapper -->
<div id="pb_wrapper">
    <!-- Begin:: Theme header -->
    <header id="pb_header">
		<div class="pb-header-container">
            <div class="pb-header-left">
                <button type="button" id="pb_hamburger">
                    <span class="pb-icon-nav"></span>
                </button>
                <!-- Brand -->
                <a href="" class="pb-brand">
                    <?php if (APP_LOGO !='' AND file_exists('images/'.APP_LOGO)) { ?>
                        <img  src="images/<?php echo APP_LOGO;?>" alt="" style="width: 30px; border-radius: 3px; margin-right: 10px;">
                    <?php } else { ?>
                        <img  src="assets/images/300x300.jpg" alt="" style="width: 30px; border-radius: 3px; margin-right: 10px;">
                    <?php } ?>
                </a>
                <a href="" class="pb-brand"><span class="pb-brand__text"><?php echo APP_NAME; ?></span></a>
            </div>
            <nav class="navbar flex-shrink-0 ms-auto">
				<ul class="navbar-nav flex-row align-items-center">
                    <!-- Display after login -->
					<li class="nav-item me-3 dropdown">
                        <a href="javascript:void(0);" class="pb-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php if (PROFILE_IMG !='' AND  file_exists('images/'.PROFILE_IMG)) { ?>
                                <img src="images/<?php echo PROFILE_IMG; ?>" class="pb-avatar__image" alt="">
                            <?php } else { ?>
                                <img src="assets/images/avatar.png" class="pb-avatar__image" alt="">
                            <?php } ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="edit_profile.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    Edit Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="logout.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> 
                                    Sign Out
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item d-inline-flex">
                        <div class="pb-switch d-inline-flex" data-bs-toggle="tooltip" data-bs-placement="left" title="Dark mode">
                            <input type="checkbox" name="mode" id="pb_dark_mode">
                            <label for="pb_dark_mode"></label>
                        </div>
                    </li>
				</ul>
			</nav>
		</div>
	</header>
    <!-- End:: Theme header -->

    <!-- Begin:: Theme sidebar -->
    <aside id="pb_aside">
        <nav class="navbar">
            <ul class="navbar-nav">

                <li class="nav-item <?php if ($currentFile == "dashboard.php") { ?>active<?php } ?>">
                    <a class="nav-link pb-page-link" href="dashboard.php" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M12 18V15" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10.07 2.81997L3.14002 8.36997C2.36002 8.98997 1.86002 10.3 2.03002 11.28L3.36002 19.24C3.60002 20.66 4.96002 21.81 6.40002 21.81H17.6C19.03 21.81 20.4 20.65 20.64 19.24L21.97 11.28C22.13 10.3 21.63 8.98997 20.86 8.36997L13.93 2.82997C12.86 1.96997 11.13 1.96997 10.07 2.81997Z" />
                        </svg>
                        <span class="nav-link__text">Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item <?php if ($currentFile == "manage_category.php" or $currentFile == "add_category.php") { ?>active<?php } ?>">
                    <a class="nav-link pb-page-link" href="manage_category.php" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M22 11V17C22 21 21 22 17 22H7C3 22 2 21 2 17V7C2 3 3 2 7 2H8.5C10 2 10.33 2.44 10.9 3.2L12.4 5.2C12.78 5.7 13 6 14 6H17C21 6 22 7 22 11Z"  />
                        </svg>
                        <span class="nav-link__text">Category</span>
                    </a>
                </li>
                
                <li class="nav-item <?php if ($currentFile == "manage_live.php" or $currentFile == "add_live.php") { ?>active<?php } ?>">
                    <a class="nav-link pb-page-link" href="manage_live.php" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M12.53 20.4201H6.21C3.05 20.4201 2 18.3201 2 16.2101V7.79008C2 4.63008 3.05 3.58008 6.21 3.58008H12.53C15.69 3.58008 16.74 4.63008 16.74 7.79008V16.2101C16.74 19.3701 15.68 20.4201 12.53 20.4201Z" />
                            <path d="M19.52 17.0999L16.74 15.1499V8.83989L19.52 6.88989C20.88 5.93989 22 6.51989 22 8.18989V15.8099C22 17.4799 20.88 18.0599 19.52 17.0999Z" />
                            <path d="M11.5 11C12.3284 11 13 10.3284 13 9.5C13 8.67157 12.3284 8 11.5 8C10.6716 8 10 8.67157 10 9.5C10 10.3284 10.6716 11 11.5 11Z" />
                        </svg>
                        <span class="nav-link__text">Live TV</span>
                    </a>
                </li>
                
                <li class="nav-item <?php if ($currentFile == "manage_banner.php" or $currentFile == "add_banner.php") { ?>active<?php } ?>">
                    <a class="nav-link pb-page-link" href="manage_banner.php" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M16.8199 2H7.17995C5.04995 2 3.31995 3.74 3.31995 5.86V19.95C3.31995 21.75 4.60995 22.51 6.18995 21.64L11.0699 18.93C11.5899 18.64 12.4299 18.64 12.9399 18.93L17.8199 21.64C19.3999 22.52 20.6899 21.76 20.6899 19.95V5.86C20.6799 3.74 18.9499 2 16.8199 2Z" />
                            <path d="M9.58997 11L11.09 12.5L15.09 8.5" />
                        </svg>
                        <span class="nav-link__text">Home Banner</span>
                    </a>
                </li>
                
                <li class="nav-item <?php if ($currentFile == "send_notification.php") { ?>active<?php } ?>">
                    <a class="nav-link" href="send_notification.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square">
                            <path d="M12.02 2.90991C8.70997 2.90991 6.01997 5.59991 6.01997 8.90991V11.7999C6.01997 12.4099 5.75997 13.3399 5.44997 13.8599L4.29997 15.7699C3.58997 16.9499 4.07997 18.2599 5.37997 18.6999C9.68997 20.1399 14.34 20.1399 18.65 18.6999C19.86 18.2999 20.39 16.8699 19.73 15.7699L18.58 13.8599C18.28 13.3399 18.02 12.4099 18.02 11.7999V8.90991C18.02 5.60991 15.32 2.90991 12.02 2.90991Z"/>
                            <path d="M13.87 3.19994C13.56 3.10994 13.24 3.03994 12.91 2.99994C11.95 2.87994 11.03 2.94994 10.17 3.19994C10.46 2.45994 11.18 1.93994 12.02 1.93994C12.86 1.93994 13.58 2.45994 13.87 3.19994Z"/>
                            <path d="M15.02 19.0601C15.02 20.7101 13.67 22.0601 12.02 22.0601C11.2 22.0601 10.44 21.7201 9.90002 21.1801C9.36002 20.6401 9.02002 19.8801 9.02002 19.0601"/>
                        </svg>
                        <span class="nav-link__text">Notification</span>
                    </a>
                </li>
                
                <li class="nav-item <?php if ($currentFile == "manage_suggestion.php") { ?>active<?php } ?>">
                    <a class="nav-link" href="manage_suggestion.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square">
                            <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z"/>
                            <path d="M2 13H5.76C6.52 13 7.21 13.43 7.55 14.11L8.44 15.9C9 17 10 17 10.24 17H13.77C14.53 17 15.22 16.57 15.56 15.89L16.45 14.1C16.79 13.42 17.48 12.99 18.24 12.99H21.98"/>
                            <path d="M10.34 7H13.67"/>
                            <path d="M9.5 10H14.5"/>
                        </svg>
                        <span class="nav-link__text">Suggestion</span>
                    </a>
                </li>
                
                <li class="nav-item <?php if ($currentFile == "manage_report.php") { ?>active<?php } ?>">
                    <a class="nav-link" href="manage_report.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square">
                            <path d="M1.97998 13H5.76998C6.52998 13 7.21998 13.43 7.55998 14.11L8.44998 15.9C8.99998 17 9.99998 17 10.24 17H13.77C14.53 17 15.22 16.57 15.56 15.89L16.45 14.1C16.79 13.42 17.48 12.99 18.24 12.99H21.98" />
                            <path d="M19 8C20.6569 8 22 6.65685 22 5C22 3.34315 20.6569 2 19 2C17.3431 2 16 3.34315 16 5C16 6.65685 17.3431 8 19 8Z" />
                            <path d="M14 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22H15C20 22 22 20 22 15V10" />
                        </svg>
                        <span class="nav-link__text">Reports</span>
                    </a>
                </li>
                
                <li class="nav-item <?php if ($currentFile == "manage_users.php" or $currentFile == "add_user.php") { ?>active<?php } ?>">
                    <a class="nav-link" href="manage_users.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span class="nav-link__text">Users</span>
                    </a>
                </li>
                
                <li class="nav-item <?php if ($currentFile == "manage_subscription.php" or $currentFile == "add_subscription.php") { ?>active<?php } ?>">
                    <a class="nav-link" href="manage_subscription.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                            <path d="M16.29 2.15002H7.69995C5.99995 2.15002 5.24995 3.00002 4.78995 4.04002L2.22995 9.80002C1.76995 10.84 2.01995 12.39 2.78995 13.23L9.64995 20.77C10.95 22.19 13.07 22.19 14.36 20.77L21.21 13.22C21.98 12.37 22.23 10.83 21.76 9.79002L19.2 4.03002C18.74 3.00002 17.99 2.15002 16.29 2.15002Z"/>
                            <path d="M3.5 8H20.5" />
                        </svg>
                        <span class="nav-link__text">Subscription</span>
                    </a>
                </li>
                
                <li class="nav-item <?php if ($currentFile == "app_update.php") { ?>active<?php } ?>">
                    <a class="nav-link" href="app_update.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                            <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 3.11 16.44 3.11 16.44M3.11 16.44H7.63M3.11 16.44V21.44M2 12C2 6.48 6.44 2 12 2C18.67 2 22 7.56 22 7.56M22 7.56V2.56M22 7.56H17.56" />
                        </svg>
                        <span class="nav-link__text">App Update</span>
                    </a>
                </li>
                
                <li class="nav-item <?php if ($currentFile == "smtp_settings.php") { ?>active<?php } ?>">
                    <a class="nav-link" href="smtp_settings.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square">
                            <path d="M17 20.5H7C4 20.5 2 19 2 15.5V8.5C2 5 4 3.5 7 3.5H17C20 3.5 22 5 22 8.5V15.5C22 19 20 20.5 17 20.5Z"/>
                            <path d="M17 9L13.87 11.5C12.84 12.32 11.15 12.32 10.12 11.5L7 9" />
                        </svg>
                        <span class="nav-link__text">SMTP Settings</span>
                    </a>
                </li>
                
               <li class="nav-item <?php if ($currentFile == "settings.php") { ?>active<?php } ?>">
                    <a class="nav-link pb-page-link" href="settings.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                            <path d="M3 9.11011V14.8801C3 17.0001 3 17.0001 5 18.3501L10.5 21.5301C11.33 22.0101 12.68 22.0101 13.5 21.5301L19 18.3501C21 17.0001 21 17.0001 21 14.8901V9.11011C21 7.00011 21 7.00011 19 5.65011L13.5 2.47011C12.68 1.99011 11.33 1.99011 10.5 2.47011L5 5.65011C3 7.00011 3 7.00011 3 9.11011Z"/>
                            <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" />
                            </svg>
                        <span class="nav-link__text">Settings</span>
                    </a>
                </li>

                <li class="nav-item <?php if ($currentFile == "verification.php") { ?>active<?php } ?>">
                    <a class="nav-link" href="verification.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square">
                            <polyline points="9 11 12 14 22 4"></polyline>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                        </svg>
                        <span class="nav-link__text">Verification</span>
                    </a>
                </li>

                <li class="nav-item <?php if ($currentFile == "api_urls.php") { ?>active<?php } ?>">
                    <a class="nav-link pb-page-link" href="api_urls.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link">
                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                        </svg>
                        <span class="nav-link__text">URLs</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
    <!-- End:: Theme sidebar -->