<?php 
    $page_title="Send Notification";
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    
    $users_qry="SELECT * FROM tbl_users ORDER BY user_name";
    $users_result=mysqli_query($mysqli,$users_qry); 
    
    if(isset($_POST['submit'])){
        
        if($_FILES['big_picture']['name']!=""){   
            
            $big_picture=rand(0,99999)."_".$_FILES['big_picture']['name'];
            $tpath2='images/'.$big_picture;
            move_uploaded_file($_FILES["big_picture"]["tmp_name"], $tpath2);
            
            if( isset($_SERVER['HTTPS'] ) ) {  
              $file_path = 'https://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/images/'.$big_picture;
            }else{
              $file_path = 'http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/images/'.$big_picture;
            }
              
            $content = array(
                "en" => $_POST['notification_msg']                                                 
            );
            
            $fields = array(
                'app_id' => ONESIGNAL_APP_ID,
                'included_segments' => array('All'),                                            
                'data' => array("foo" => "bar"),
                'headings'=> array("en" => $_POST['notification_title']),
                'contents' => $content,
                'big_picture' =>$file_path                    
            );
            
            $fields = json_encode($fields);
            print("\nJSON sent:\n");
            print($fields);
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                       'Authorization: Basic '.ONESIGNAL_REST_KEY));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            
            $response = curl_exec($ch);
            curl_close($ch);
        
        }else{
            
            $content = array(
                "en" => $_POST['notification_msg']
            );
            
            $fields = array(
                'app_id' => ONESIGNAL_APP_ID,
                'included_segments' => array('All'),                                      
                'data' => array("foo" => "bar"),
                'headings'=> array("en" => $_POST['notification_title']),
                'contents' => $content
            );
            
            $fields = json_encode($fields);
            print("\nJSON sent:\n");
            print($fields);
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                       'Authorization: Basic '.ONESIGNAL_REST_KEY));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            
            $response = curl_exec($ch);
            
            curl_close($ch);
        }
        
        $_SESSION['class'] = "success";
        $_SESSION['msg']="16";
        header( "Location:send_notification.php");
        exit; 
    }
    
    else if(isset($_POST['notification_submit'])) {
        
        $data = array(
          'onesignal_app_id' => trim($_POST['onesignal_app_id']),
          'onesignal_rest_key' => trim($_POST['onesignal_rest_key']),
        );
        
        $settings_edit = Update('tbl_settings', $data, "WHERE id = '1'");
        
        $_SESSION['class'] = "success";
        $_SESSION['msg'] = "11";
        header("Location:send_notification.php");
        exit;
    }
    
    else if(isset($_POST['user_submit'])) {
        
        $data = array(
            'user_id' => $_POST['user_id'],
            'notification_title' => $_POST['notification_title'],
            'notification_msg' => $_POST['notification_msg'],
            'notification_on' =>  strtotime(date('d-m-Y h:i:s A')) 
        );
        
        $qry = Insert('tbl_notification',$data);	
        
        $_SESSION['class'] = "success";
        $_SESSION['msg']="16";
        header("Location:send_notification.php");
        exit;
    }
?>
<!-- Begin:: Theme main content -->
<main id="pb_main">
    <div class="pb-main-container">
        <div class="pb-card">
            <div class="pb-card__head">
                <span class="pb-card__title mb-2 mb-sm-0">
                    <?php if (isset($_SERVER['HTTP_REFERER'])) { echo '<a href="' . $_SERVER['HTTP_REFERER'] . '"><h4 class="pull-left"><i class="fa fa-arrow-left"></i> Back</h4></a>'; }?>
                    <?=$page_title ?>
                </span>
            </div>
            <div class="pb-card__body">
                <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                        Notification Settings
                    </button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-navigation"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>
                        Notification OneSignal
                    </button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-navigation"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>
                        Notification send to a User
                    </button>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                      <div class="row mt-4">
                            <form action="" name="notification_submit" method="POST" enctype="multipart/form-data">
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">OneSignal App ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="onesignal_app_id" id="onesignal_app_id" value="<?php echo $settings_details['onesignal_app_id']; ?>"  class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">OneSignal Rest Key</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="onesignal_rest_key" id="onesignal_rest_key" value="<?php echo $settings_details['onesignal_rest_key']; ?>"   class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <button type="submit" name="notification_submit" class="btn btn-primary" style="min-width: 100px;">Save</button>
                                     </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                      <div class="row mt-4">
                            <form action="" name="addeditone" method="POST" enctype="multipart/form-data">
                            
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="notification_title" id="notification_title" value=""  class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Message</label>
                                    <div class="col-sm-9">
                                         <textarea name="notification_msg" id="notification_msg" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">Select Image</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="file"  name="big_picture"  accept=".png, .jpg, .JPG .PNG" onchange="fileValidation()" id="fileupload">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <button type="submit" name="submit" class="btn btn-primary" style="min-width: 100px;">Save</button>
                                     </div>
                                </div>
                            </form>
                        </div>
                    </div>
                  
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="row mt-4">
                            <form action="" name="addedituser"  method="POST" enctype="multipart/form-data">
                                
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label">User</label>
                                    <div class="col-sm-9">
                                        <select name="user_id" id="user_id" class="form-control basic" required>
                                            <option value="">--Select User--</option>
                                            <?php while($users_row=mysqli_fetch_array($users_result)){ ?>      
                                                <option value="<?php echo $users_row['id'];?>"><?php echo $users_row['user_name'];?></option> 
                                            <?php } ?> 
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label" >Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="notification_title" id="notification_title" value=""  class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-3 col-form-label" >Message</label>
                                    <div class="col-sm-9">
                                       <textarea name="notification_msg" id="notification_msg" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <button type="submit" name="user_submit" class="btn btn-primary" style="min-width: 100px;">Save</button>
                                     </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Begin:: Main footer -->
        <?php include("includes/main_footer.php");?> 
        <!-- End:: Main footer  -->
    </div>
</main>
<!-- End:: Theme main content -->
<?php include("includes/footer.php");?> 