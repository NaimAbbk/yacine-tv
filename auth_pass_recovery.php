<?php
include("includes/connection.php");
include("includes/lb_helper.php"); 
include("language/language.php");
include("language/app_language.php");
include("smtp_email.php");
date_default_timezone_set("Asia/Colombo");
$file_path = getBaseUrl();

function generateRandomPassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if(isset($_POST['submit'])){
    
    $email=addslashes(trim($_POST['email']));

	$qry = "SELECT * FROM tbl_admin WHERE email = '$email' AND `id` <> 0"; 
	$result = mysqli_query($mysqli,$qry);
	$row = mysqli_fetch_assoc($result);
	
	if($row['email']!=""){
		$password=generateRandomPassword(7);
		
		$new_password = $password;

		$to = $row['email'];
		$recipient_name=$row['username'];
		// subject
		$subject = str_replace('###', APP_NAME, $app_lang['forgot_password_sub_lbl']);
 		
		$message='
        <div style="background-color: #f9f9f9;" align="center"><br />
        <table style="font-family: OpenSans,sans-serif; color: #666666;" border="0" width="600" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
        <tbody>
        <tr>
        <td colspan="2" bgcolor="#FFFFFF" align="center"><img src="'.$file_path.'images/'.APP_LOGO.'" alt="header" style="width:100px;height:auto"/></td>
        </tr>
        <tr>
        <td width="600" valign="top" bgcolor="#FFFFFF"><br>
        <table style="font-family:OpenSans,sans-serif; color: #666666; font-size: 10px; padding: 15px;" border="0" width="100%" cellspacing="0" cellpadding="0" align="left">
        <tbody>
        <tr>
        <td valign="top"><table border="0" align="left" cellpadding="0" cellspacing="0" style="font-family:OpenSans,sans-serif; color: #666666; font-size: 10px; width:100%;">
        <tbody>
        <tr>
        <td>
        <p style="color: #262626; font-size: 24px; margin-top:0px;"><strong>'.$app_lang['dear_lbl'].' '.$row['username'].'</strong></p>
        <p style="color:#262626; font-size:20px; line-height:32px;font-weight:500;margin-top:5px;"><br>'.$app_lang['your_password_lbl'].': <span style="font-weight:400;">'.$new_password.'</span></p>
        <p style="color:#262626; font-size:17px; line-height:32px;font-weight:500;margin-bottom:30px;">'.$app_lang['thank_you_lbl'].' '.APP_NAME.'</p>
        </td>
        </tr>
        </tbody>
        </table></td>
        </tr>
        </tbody>
        </table></td>
        </tr>
        <tr>
        <td style="color: #262626; padding: 20px 0; font-size: 18px; border-top:5px solid #52bfd3;" colspan="2" align="center" bgcolor="#ffffff">'.$app_lang['email_copyright'].' '.APP_NAME.'.</td>
        </tr>
        </tbody>
        </table>
        </div>';

		send_email($to,$recipient_name,$subject,$message);

		$sql="UPDATE tbl_admin SET `password`='$new_password' WHERE `id`='".$row['id']."'";
      	mysqli_query($mysqli,$sql);
		 	  
		$_SESSION['msg']="20";
        $_SESSION['class']='success'; 
        header("Location:auth_pass_recovery.php");	 
        exit;
	}else{  	 
		$_SESSION['msg']="21";
        $_SESSION['class']='error'; 
        header("location:auth_pass_recovery.php");	 
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
        <title>Password Recovery | <?php echo APP_NAME;?></title>
        
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
                                <h4>Password Recovery</h4>
                                <p>Enter your email and instructions will sent to you!</p>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">Reset</button>
                            <div class="pb-auth__copy text-center mt-4">
                                <p class="">Go to the login page ? <a href="index.php"> Log in</a></p>
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

    </body>
</html>