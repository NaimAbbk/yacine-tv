<?php 
    $page_title=(isset($_GET['user_id'])) ? 'Edit User' : 'Add User';
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
	require_once("thumbnail_images.class.php");
	
	$page_save=(isset($_GET['user_id'])) ? 'Save' : 'Create';
	
	if(isset($_POST['submit']) and isset($_GET['add'])){
	    
	    if($_FILES['profile_img']['name']!=""){ 
	        
	        $ext = pathinfo($_FILES['profile_img']['name'], PATHINFO_EXTENSION);
            $profile_img=rand(0,99999)."_user.".$ext;
            $tpath1='images/'.$profile_img;
            
            if($ext!='png')  {
                $pic1=compress_image($_FILES["profile_img"]["tmp_name"], $tpath1, 80);
            }else{
                $tmp = $_FILES['profile_img']['tmp_name'];
                move_uploaded_file($tmp, $tpath1);
            }
            
	     } else{
	         $profile_img = "";
	     }
	     
        $data = array(
          'user_type'=>'Normal',											 
          'user_name'  => addslashes(trim($_POST['user_name'])),				    
          'user_email'  =>  addslashes(trim($_POST['user_email'])),
          'user_password'  =>  md5(trim($_POST['user_password'])),
          'user_phone'  =>  addslashes(trim($_POST['user_phone'])),
          'user_gender'  =>  $_POST['user_gender'],
          'registered_on'  =>  strtotime(date('d-m-Y h:i:s A')),
          'profile_img'  => $profile_img,
          'status'  =>  '1'
        );
        
        $qry = Insert('tbl_users',$data);
        
        $_SESSION['msg']="10";
        $_SESSION['class']='success'; 
        header("location:manage_users.php");	 
        exit;
    }
	
	if(isset($_GET['user_id'])){
        $user_qry="SELECT * FROM tbl_users where id='".$_GET['user_id']."'";
        $user_result=mysqli_query($mysqli,$user_qry);
        $user_row=mysqli_fetch_assoc($user_result);
    }
    
    if(isset($_POST['submit']) and isset($_POST['user_id'])){
        if($_POST['user_password']!="" AND $_FILES['category_image']['name']!=""){
            
            $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_users WHERE id='.$_GET['user_id'].'');
            $img_res_row=mysqli_fetch_assoc($img_res);
            
            if($img_res_row['profile_img']!=""){
                unlink('images/'.$img_res_row['profile_img']);
            }
            
            $ext = pathinfo($_FILES['profile_img']['name'], PATHINFO_EXTENSION);
            $profile_img=rand(0,99999)."_user.".$ext;
            $tpath1='images/'.$profile_img;
            
            if($ext!='png')  {
                $pic1=compress_image($_FILES["profile_img"]["tmp_name"], $tpath1, 80);
            }else{
                $tmp = $_FILES['profile_img']['tmp_name'];
                move_uploaded_file($tmp, $tpath1);
            }
            
            $data = array(
                  'user_name'  => addslashes(trim($_POST['user_name'])),				    
                  'user_email'  =>  addslashes(trim($_POST['user_email'])),
                  'user_password'  =>  md5(trim($_POST['user_password'])),
                  'user_phone'  =>  addslashes(trim($_POST['user_phone'])),
                  'user_gender'  =>  $_POST['user_gender'],
                  'profile_img'  => $profile_img,
            );
        } else if($_FILES['category_image']['name']!=""){
            
            $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_users WHERE id='.$_GET['user_id'].'');
            $img_res_row=mysqli_fetch_assoc($img_res);
            
            if($img_res_row['profile_img']!=""){
                unlink('images/'.$img_res_row['profile_img']);
            }
            
            $ext = pathinfo($_FILES['profile_img']['name'], PATHINFO_EXTENSION);
            $profile_img=rand(0,99999)."_user.".$ext;
            $tpath1='images/'.$profile_img;
            
            if($ext!='png')  {
                $pic1=compress_image($_FILES["profile_img"]["tmp_name"], $tpath1, 80);
            }else{
                $tmp = $_FILES['profile_img']['tmp_name'];
                move_uploaded_file($tmp, $tpath1);
            }
            
            $data = array(
                  'user_name'  => addslashes(trim($_POST['user_name'])),				    
                  'user_email'  =>  addslashes(trim($_POST['user_email'])),
                  'user_phone'  =>  addslashes(trim($_POST['user_phone'])),
                  'user_gender'  =>  $_POST['user_gender'],
                  'profile_img'  => $profile_img,
            );
        } else if($_POST['user_password']!=""){
             $data = array(
                  'user_name'  => addslashes(trim($_POST['user_name'])),				    
                  'user_email'  =>  addslashes(trim($_POST['user_email'])),
                  'user_password'  =>  md5(trim($_POST['user_password'])),
                  'user_phone'  =>  addslashes(trim($_POST['user_phone'])),
                  'user_gender'  =>  $_POST['user_gender']
            );
        } else{
            $data = array(
                'user_name'  => addslashes(trim($_POST['user_name'])),				    
                'user_email'  =>  addslashes(trim($_POST['user_email'])),
                'user_phone'  =>  addslashes(trim($_POST['user_phone'])),
                'user_gender'  =>  $_POST['user_gender'],
            );
        }
        
        $user_edit=Update('tbl_users', $data, "WHERE id = '".$_POST['user_id']."'");
        
        $_SESSION['msg']="11";
        $_SESSION['class']='success'; 
        header("Location:add_user.php?user_id=".$_POST['user_id']);
        exit;
    }
    
?>
<!-- Begin:: Theme main content -->
<main id="pb_main">
    <div class="pb-main-container">
        <div class="pb-card">
            <div class="pb-card__head">
                <span class="pb-card__title mb-2 mb-sm-0">
                    <?php if(isset($_GET['redirect'])){?>
        			    <a href="<?php echo $_GET['redirect']?>"><h4 class="pull-left"><i class="fa fa-arrow-left"></i> Back</h4></a>
                	<?php }else{ ?>
            		    <a href="manage_users.php"><h4 class="pull-left"><i class="fa fa-arrow-left"></i> Back</h4></a>
                	<?php } ?>
                    <?=$page_title ?>
                </span>
            </div>
            <div class="pb-card__body py-4">
                <form action="" name="addedituser" method="POST" enctype="multipart/form-data">
                    <input  type="hidden" name="user_id" value="<?=(isset($_GET['user_id'])) ? $_GET['user_id'] : ''?>" />
                    <div class="row">
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Full name</label>
                            <div class="col-sm-9">
                                <input type="text" name="user_name" value="<?php if(isset($_GET['user_id'])){echo $user_row['user_name'];}?>"  class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Email ID</label>
                            <div class="col-sm-9">
                                <input type="text" name="user_email" value="<?php if(isset($_GET['user_id'])){echo $user_row['user_email'];}?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Mobile</label>
                            <div class="col-sm-9">
                                <input type="text" name="user_phone" value="<?php if(isset($_GET['user_id'])){echo $user_row['user_phone'];}?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="text" name="user_password" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                                <select name="user_gender" id="user_gender" class="form-control" required>
                                    <option value="">--Select Gender--</option>
                                    <?php if(isset($_GET['user_id'])){ ?>
                                        <option value="Male" <?php if($user_row['user_gender']=="Male"){?>selected<?php }?>>Male</option>
                                        <option value="Female" <?php if ($user_row['user_gender'] == 'Female') { ?>selected<?php } ?>>Female</option>         							 
                                    <?php }else{ ?>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>  						 
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Select Profile Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control-file" name="profile_img"  accept=".png, .jpg, .JPG .PNG" onchange="fileValidation()" id="fileupload">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">&nbsp;</label>
                            <div class="col-sm-9">
                                <div class="fileupload_img" id="imagePreview">
                                    <?php if($row['profile_img']!="" AND file_exists("images/".$row['profile_img'])){ ?>
                                        <img class="col-sm-3 img-thumbnail" type="image" src="images/'.$row['profile_img']" alt="image" />
                                    <?php }else{ ?>
                                        <img class="col-sm-3 img-thumbnail" type="image" src="assets/images/300x300.jpg" alt="image" />
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" name="submit" class="btn btn-primary" style="min-width: 110px;"><?=$page_save?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Begin:: Main footer -->
        <?php include("includes/main_footer.php");?>  
        <!-- End:: Main footer  -->
    </div>
</main>
<!-- End:: Theme main content -->
<?php include("includes/footer.php");?> 