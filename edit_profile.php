<?php 
    $page_title="Edit Profile";
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    
    if(isset($_SESSION['id'])){
		$qry="select * from tbl_admin where id='".$_SESSION['id']."'";
		$result=mysqli_query($mysqli,$qry);
		$row=mysqli_fetch_assoc($result);
	}
	
	if(isset($_POST['submit'])){
		if($_FILES['image']['name']!=""){		
            $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_admin WHERE id='.$_SESSION['id'].'');
            $img_res_row=mysqli_fetch_assoc($img_res);
            
            if($img_res_row['image']!=""){
                unlink('images/'.$img_res_row['image']);
            }
            
            $image="profile.png";
            $pic1=$_FILES['image']['tmp_name'];
            $tpath1='images/'.$image;
            
            copy($pic1,$tpath1);
            
            if($_POST['password']!=""){
                $data = array( 
                    'username'  =>  $_POST['username'],
                    'email'  =>  $_POST['email'],
                    'password'  =>  $_POST['password'],
                    'image'  =>  $image
                );
            }else{
                $data = array( 
                    'username'  =>  $_POST['username'],
                    'email'  =>  $_POST['email'],
                    'image'  =>  $image
                );
            }
            
            $channel_edit=Update('tbl_admin', $data, "WHERE id = '".$_SESSION['id']."'"); 
        }else{
            
            if($_POST['password']!=""){
                $data = array( 
                    'username'  =>  $_POST['username'],
                    'email'  =>  $_POST['email'],
                    'password'  =>  $_POST['password']
                );
            }else{
                $data = array( 
                    'username'  =>  $_POST['username'],
                    'email'  =>  $_POST['email']
                );
            }

            $channel_edit=Update('tbl_admin', $data, "WHERE id = '".$_SESSION['id']."'"); 
		}
		$_SESSION['msg']="11"; 
		header( "Location:edit_profile.php");
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
            <div class="pb-card__body py-4">
                <form action="" name="editprofile" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="username" value="<?php echo $row['username'];?>" class="form-control" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" name="email" value="<?= $row['email']?>" class="form-control" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="text" name="password" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Select Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control-file" name="image"  accept=".png, .jpg, .JPG .PNG" onchange="fileValidation()" id="fileupload">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">&nbsp;</label>
                            <div class="col-sm-9">
                                <div class="fileupload_img" id="imagePreview">
                                    <?php if($row['image']!='' AND file_exists('images/'.$row['image'])) {?>
                                        <img class="col-sm-3 img-thumbnail" type="image" src="images/<?php echo PROFILE_IMG; ?>" alt="image" />
                                    <?php }else{?>
                                        <img class="col-sm-3 img-thumbnail" type="image" src="assets/images/avatar.png" alt="image" />
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" name="submit" class="btn btn-primary" style="min-width: 110px;">Save</button>
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