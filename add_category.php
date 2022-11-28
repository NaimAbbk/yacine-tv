<?php 
    $page_title=(isset($_GET['cat_id'])) ? 'Edit Category' : 'Add Category';
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    require_once("thumbnail_images.class.php");
    
    $page_save=(isset($_GET['cat_id'])) ? 'Save' : 'Create';
    
    if(isset($_POST['submit']) and isset($_GET['add'])){
        
        if($_FILES['category_image']['name']!=""){
            
            $ext = pathinfo($_FILES['category_image']['name'], PATHINFO_EXTENSION);
            $category_image=rand(0,99999)."_category.".$ext;
            $tpath1='images/'.$category_image;
            
            if($ext!='png')  {
                $pic1=compress_image($_FILES["category_image"]["tmp_name"], $tpath1, 80);
            }else{
                $tmp = $_FILES['category_image']['tmp_name'];
                move_uploaded_file($tmp, $tpath1);
            }
            
        }else{
            $category_image='';
        }

        $data = array( 
            'category_name'  =>  cleanInput($_POST['category_name']),
            'category_image'  =>  $category_image
        );  
        
        $qry = Insert('tbl_category',$data);
        
        $_SESSION['msg']="10";
        $_SESSION['class']='success';
        header( "Location:manage_category.php");
        exit;
    }
    
    if(isset($_GET['cat_id'])){
        $qry="SELECT * FROM tbl_category where cid='".$_GET['cat_id']."'";
        $result=mysqli_query($mysqli,$qry);
        $row=mysqli_fetch_assoc($result);
    }
    
    if(isset($_POST['submit']) and isset($_POST['cat_id'])){
        
        if($_FILES['category_image']['name']!=""){
            
            if($row['category_image']!=""){
                unlink('images/'.$row['category_image']);
            }
            
            $ext = pathinfo($_FILES['category_image']['name'], PATHINFO_EXTENSION);
            $category_image=rand(0,99999)."_category.".$ext;
            $tpath1='images/'.$category_image;   
            
            if($ext!='png')  {
                $pic1=compress_image($_FILES["category_image"]["tmp_name"], $tpath1, 80);
            }else{
                $tmp = $_FILES['category_image']['tmp_name'];
                move_uploaded_file($tmp, $tpath1);
            }
        }else{
            $category_image=$row['category_image'];
        }
        
        $data = array( 
            'category_name'  =>  cleanInput($_POST['category_name']),
            'category_image'  =>  $category_image
        );
        
        $category_edit=Update('tbl_category', $data, "WHERE cid = '".$_POST['cat_id']."'");
        
        $_SESSION['msg']="11";
        $_SESSION['class']='success';
        header( "Location:add_category.php?cat_id=".$_POST['cat_id']);
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
            		    <a href="manage_category.php"><h4 class="pull-left"><i class="fa fa-arrow-left"></i> Back</h4></a>
                	<?php } ?>
                    <?=$page_title ?>
                </span>
            </div>
            <div class="pb-card__body py-4">
                <form action="" name="addeditcategory" method="POST" enctype="multipart/form-data">
                    <input  type="hidden" name="cat_id" value="<?=(isset($_GET['cat_id'])) ? $_GET['cat_id'] : ''?>" />
                    <div class="row">
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Category name</label>
                            <div class="col-sm-9">
                                <input type="text" name="category_name" class="form-control" value="<?php if(isset($_GET['cat_id'])){echo $row['category_name'];}?>" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Select Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control-file" name="category_image"   accept=".png, .jpg, .JPG .PNG" onchange="fileValidation()" id="fileupload" <?php if(!isset($_GET['cat_id'])){?>required<?php } ?>>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">&nbsp;</label>
                            <div class="col-sm-9">
                                <div class="fileupload_img" id="imagePreview">
                                    <?php if(isset($_GET['cat_id'])) {?>
                                      <img class="col-sm-3 img-thumbnail" type="image" src="images/<?php echo $row['category_image'];?>" alt="image" />
                                    <?php }else{?>
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