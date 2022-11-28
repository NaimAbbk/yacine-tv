<?php 
    $page_title=(isset($_GET['banner_id'])) ? 'Edit Banner' : 'Add Banner';
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    require_once("thumbnail_images.class.php");
    
    $page_save=(isset($_GET['banner_id'])) ? 'Save' : 'Create';
    
    $post_qry="SELECT * FROM tbl_live ORDER BY tbl_live.id DESC"; 
    $post_result=mysqli_query($mysqli,$post_qry); 

    if(isset($_POST['submit']) and isset($_GET['add'])){
        
        $ext = pathinfo($_FILES['banner_image']['name'], PATHINFO_EXTENSION);
        $banner_image=rand(0,99999)."_banner.".$ext;
        $tpath1='images/'.$banner_image;
        
        if($ext!='png')  {
            $pic1=compress_image($_FILES["banner_image"]["tmp_name"], $tpath1, 80);
        }else{
            $tmp = $_FILES['banner_image']['tmp_name'];
            move_uploaded_file($tmp, $tpath1);
        }

        $data = array( 
            'banner_title'  =>  $_POST['banner_title'],
            'banner_info'  =>  $_POST['banner_info'],
            'banner_image'  =>  $banner_image,
            'banner_post_id'  =>  implode(',',$_POST['banner_post_id'])
        );		
        
        $qry = Insert('tbl_banner',$data);	
        
        $_SESSION['msg']="10";
        $_SESSION['class']='success'; 
        header( "Location:manage_banner.php");
        exit;			 
    }
    
    if(isset($_GET['banner_id'])){
        $qry="SELECT * FROM tbl_banner where bid='".$_GET['banner_id']."'";
        $result=mysqli_query($mysqli,$qry);
        $row=mysqli_fetch_assoc($result);
    }
    
    if(isset($_POST['submit']) and isset($_POST['banner_id'])){
        if($_FILES['banner_image']['name']!=""){		
        
            $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_banner WHERE bid='.$_GET['banner_id'].'');
            $img_res_row=mysqli_fetch_assoc($img_res);
            if($img_res_row['banner_image']!=""){
                unlink('images/'.$img_res_row['banner_image']);
            }
            
            $ext = pathinfo($_FILES['banner_image']['name'], PATHINFO_EXTENSION);
            $banner_image=rand(0,99999)."_banner.".$ext;
            $tpath1='images/'.$banner_image;
            
            if($ext!='png')  {
                $pic1=compress_image($_FILES["banner_image"]["tmp_name"], $tpath1, 80);
            }else{
                $tmp = $_FILES['banner_image']['tmp_name'];
                move_uploaded_file($tmp, $tpath1);
            }

            $data = array(
                'banner_title'  =>  $_POST['banner_title'],
                'banner_info'  =>  $_POST['banner_info'],
                'banner_image'  =>  $banner_image,
                'banner_post_id'  =>  implode(',',$_POST['banner_post_id'])
            );
            
            $banner_edit=Update('tbl_banner', $data, "WHERE bid = '".$_POST['banner_id']."'");
        
        }else{
        
            $data = array(
                'banner_title'  =>  $_POST['banner_title'],
                'banner_info'  =>  $_POST['banner_info'],
                'banner_post_id'  =>  implode(',',$_POST['banner_post_id'])
            );
            
            $banner_edit=Update('tbl_banner', $data, "WHERE bid = '".$_POST['banner_id']."'");
        }
        $_SESSION['msg']="11";
        $_SESSION['class']='success'; 
        header( "Location:add_banner.php?banner_id=".$_POST['banner_id']);
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
            		    <a href="manage_banner.php"><h4 class="pull-left"><i class="fa fa-arrow-left"></i> Back</h4></a>
                	<?php } ?>
                    <?=$page_title ?>
                </span>
            </div>
            <div class="pb-card__body py-4">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input  type="hidden" name="banner_id" value="<?=(isset($_GET['banner_id'])) ? $_GET['banner_id'] : ''?>" />
                    <div class="row">
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Banner title</label>
                            <div class="col-sm-9">
                                <input type="text" name="banner_title" class="form-control" value="<?php if(isset($_GET['banner_id'])){echo $row['banner_title'];}?>" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Banner info</label>
                            <div class="col-sm-9">
                                <input type="text" name="banner_info" class="form-control" value="<?php if(isset($_GET['banner_id'])){echo $row['banner_info'];}?>" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Live</label>
                            <div class="col-sm-9">
                                <select name="banner_post_id[]" id="banner_post_id" class="form-control tagging " required multiple="multiple">
                                    <option value="">--Select Live--</option>
                                    <?php while($post_row=mysqli_fetch_array($post_result)){ ?>   
                                            <?php if(isset($_GET['banner_id'])){?>
                                               <option value="<?php echo $post_row['id'];?>" <?php $post_list=explode(",", $row['banner_post_id']);
                                                     foreach($post_list as $post_id){
                                                     if($post_row['id']==$post_id){?>selected<?php }}?>><?php echo $post_row['live_title'];?>
                                                </option>
                                            <?php }else{?>  
                                              <option value="<?php echo $post_row['id'];?>"><?php echo $post_row['live_title'];?></option>
                                            <?php }?>   
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Select Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control-file" name="banner_image"  accept=".png, .jpg, .JPG .PNG" onchange="fileValidation()" id="fileupload">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">&nbsp;</label>
                            <div class="col-sm-9">
                                <div class="fileupload_img" id="imagePreview">
                                    <?php if(isset($_GET['banner_id']) AND file_exists('images/'.$row['banner_image'])){ ?>
                                        <img class="col-sm-7 img-thumbnail" type="image" src="images/<?=$row['banner_image']?>" alt="image" />
                                    <?php }else{ ?>
                                        <img class="col-sm-7 img-thumbnail" type="image" src="assets/images/600x300.jpg" alt="image" />
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