<?php 
    $page_title=(isset($_GET['live_id'])) ? 'Edit Live' : 'Add Live';
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    require_once("thumbnail_images.class.php");
    
    $page_save=(isset($_GET['live_id'])) ? 'Save' : 'Create';
    
    $cat_qry="SELECT * FROM tbl_category ORDER BY category_name";
    $cat_result=mysqli_query($mysqli,$cat_qry); 
    
    if(isset($_POST['submit']) and isset($_GET['add'])){
        
        if($_FILES['live_image']['name']!=""){
            
            $ext = pathinfo($_FILES['live_image']['name'], PATHINFO_EXTENSION);
            $live_image=rand(0,99999)."_live.".$ext;
            $tpath1='images/'.$live_image;
            
            if($ext!='png')  {
                $pic1=compress_image($_FILES["live_image"]["tmp_name"], $tpath1, 80);
            }else{
                $tmp = $_FILES['live_image']['tmp_name'];
                move_uploaded_file($tmp, $tpath1);
            }
            
        }else{
             $live_image = '';
        }

        $data = array( 
            'cat_id'  =>  $_POST['cat_id'],
            'live_title'  =>  cleanInput($_POST['live_title']),
            'isPremium'  =>  'false',
            'live_type'  =>  $_POST['live_type'],
            'live_url'  =>  $_POST['live_url'],
            'live_description'  => addslashes($_POST['live_description']),
            'live_image'  =>  $live_image
        );
        
        $qry = Insert('tbl_live',$data);
        
        $_SESSION['msg']="10";
        $_SESSION['class']='success';
        header( "Location:add_live.php?add=yes");
        exit;
    }
    
    if(isset($_GET['live_id'])){
        $qry="SELECT * FROM tbl_live where id='".$_GET['live_id']."'";
        $result=mysqli_query($mysqli,$qry);
        $row=mysqli_fetch_assoc($result);
    }
    
    if(isset($_POST['submit']) and isset($_POST['live_id'])){
        
        if($_FILES['live_image']['name']!=""){
            
            if($row['live_image']!=""){
                unlink('images/'.$row['live_image']);
            }
            
            $ext = pathinfo($_FILES['live_image']['name'], PATHINFO_EXTENSION);
            $live_image=rand(0,99999)."_live.".$ext;
            $tpath1='images/'.$live_image;
            
            if($ext!='png')  {
                $pic1=compress_image($_FILES["live_image"]["tmp_name"], $tpath1, 80);
            }else{
                $tmp = $_FILES['live_image']['tmp_name'];
                move_uploaded_file($tmp, $tpath1);
            }
            
        }else{
            $live_image=$row['live_image'];
        }
        
        
        $data = array( 
            'cat_id'  =>  $_POST['cat_id'],
            'live_title'  =>  cleanInput($_POST['live_title']),
            'isPremium'  =>  'false',
            'live_type'  =>  $_POST['live_type'],
            'live_url'  =>  $_POST['live_url'],
            'live_description'  =>  addslashes($_POST['live_description']),
            'live_image'  =>  $live_image
        );

        $category_edit=Update('tbl_live', $data, "WHERE id = '".$_POST['live_id']."'");
        
        $_SESSION['msg']="11";
        $_SESSION['class']='success';
        header( "Location:add_live.php?live_id=".$_POST['live_id']);
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
            		    <a href="manage_live.php"><h4 class="pull-left"><i class="fa fa-arrow-left"></i> Back</h4></a>
                	<?php } ?>
                    <?=$page_title ?>
                </span>
            </div>
            <div class="pb-card__body py-4">
                <form action="" name="addeditlive" method="POST" enctype="multipart/form-data">
                <input  type="hidden" name="live_id" value="<?=(isset($_GET['live_id'])) ? $_GET['live_id'] : ''?>" />
                <div class="row">
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9">
                                <select name="cat_id" id="cat_id" class="form-control basic" required>
                                    <option value="">--Select Category--</option>
                                    <?php while($cat_row=mysqli_fetch_array($cat_result)){ ?>      
                                        <?php if(isset($_GET['live_id'])){ ?>
                  							<option value="<?php echo $cat_row['cid'];?>" <?php if($cat_row['cid']==$row['cat_id']){?>selected<?php }?>><?php echo $cat_row['category_name'];?></option>	          							 
                                        <?php }else{ ?>
                  						        <option value="<?php echo $cat_row['cid'];?>"><?php echo $cat_row['category_name'];?></option>   							 
                                        <?php } ?>
                                    <?php } ?> 
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Live title</label>
                            <div class="col-sm-9">
                                <input type="text" name="live_title"  id="live_title"  value="<?php if(isset($_GET['live_id'])){echo $row['live_title'];}?>" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Video Type</label>
                            <div class="col-sm-9">
                                <select name="live_type" id="live_type" class="form-control" required>
                                    <option value="">--Select Video Type--</option>
                                    <?php if(isset($_GET['live_id'])){ ?>
                                        <option value="youtube" <?php if($row['live_type']=='youtube'){?>selected<?php }?>>Youtube</option> 
                                        <option value="hls" <?php if($row['live_type']=='hls'){?>selected<?php }?>>HLS/M3U8/HTTP</option>
                                        <option value="mp4" <?php if($row['live_type']=='mp4'){?>selected<?php }?>>MP4/AVI/MOV/MKV</option>
                                        <option value="rtmp" <?php if($row['live_type']=='rtmp'){?>selected<?php }?>>RTMP</option>
                                        <option value="webview" <?php if($row['live_type']=='webview'){?>selected<?php }?>>Browser</option>
                                        <option value="browser" <?php if($row['live_type']=='browser'){?>selected<?php }?>>External Browser</option>
                                        <option value="external" <?php if($row['live_type']=='external'){?>selected<?php }?>>External Player</option>
                                    <?php }else{ ?>
                                        <option value="youtube">Youtube</option><option value="youtube">Youtube</option>    
                                        <option value="hls">HLS/M3U8/HTTP</option>
                                        <option value="mp4">MP4/AVI/MOV/MKV</option>
                                        <option value="rtmp">RTMP</option>
                                        <option value="webview">Browser</option>
                                        <option value="browser">External Browser</option>
                                        <option value="external">External Player</option>
                                    <?php } ?> 
                                </select>
                            </div>
                        </div>
                        
                        
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Live URL</label>
                            <div class="col-sm-9">
                                <input type="text" name="live_url"  id="live_url"  value="<?php if(isset($_GET['live_id'])){echo $row['live_url'];}?>" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea id="editor" name="live_description" cols="30" rows="10"><?php if(isset($_GET['live_id'])){echo $row['live_description'];}?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Select Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control-file" name="live_image"  accept=".png, .jpg, .JPG .PNG" onchange="fileValidation()" id="fileupload">
                            </div>
                        </div>
                        
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">&nbsp;</label>
                            <div class="col-sm-9">
                                <div class="fileupload_img" id="imagePreview">
                                    <?php if(isset($_GET['live_id']) AND file_exists('images/'.$row['live_image'])) {?>
                                      <img class="col-sm-3 img-thumbnail" type="image" src="images/<?php echo $row['live_image'];?>" alt="image" />
                                    <?php }else{?>
                                      <img class="col-sm-3 img-thumbnail" type="image" src="assets/images/300x300.jpg" alt="image" />
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" name="submit" class="btn btn-primary" style="min-width: 110px;"><?=$page_save ?></button>
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