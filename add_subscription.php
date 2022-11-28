<?php 
    $page_title=(isset($_GET['sub_id'])) ? 'Edit Subscription' : 'Add Subscription';
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    
    $page_save=(isset($_GET['sub_id'])) ? 'Save' : 'Create';
    
    if(isset($_POST['submit']) and isset($_GET['add'])){

        $data = array( 
            'name'  =>  $_POST['name'],
            'duration'  =>  $_POST['duration'],
            'price'  =>  $_POST['price'],
            'currency_code'  =>  $_POST['currency_code'],
            'subscription_id'  =>  $_POST['subscription_id'],
            'base_key'  =>  $_POST['base_key'],
        );    

        $qry = Insert('tbl_subscription',$data);  
        
        $_SESSION['msg']="10";
        $_SESSION['class']='success'; 
        header( "Location:manage_subscription.php");
        exit; 
    }
    
    if(isset($_GET['sub_id'])){
        $qry="SELECT * FROM tbl_subscription where id='".$_GET['sub_id']."'";
        $result=mysqli_query($mysqli,$qry);
        $row=mysqli_fetch_assoc($result);
    }
    
    if(isset($_POST['submit']) and isset($_POST['sub_id'])){
        
        $data = array( 
            'name'  =>  $_POST['name'],
            'duration'  =>  $_POST['duration'],
            'price'  =>  $_POST['price'],
            'currency_code'  =>  $_POST['currency_code'],
            'subscription_id'  =>  $_POST['subscription_id'],
            'base_key'  =>  $_POST['base_key'],
        );
        
        $category_edit=Update('tbl_subscription', $data, "WHERE id = '".$_POST['sub_id']."'");
    
        $_SESSION['msg']="11";
        $_SESSION['class']='success'; 
        header( "Location:add_subscription.php?sub_id=".$_POST['sub_id']);
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
            		    <a href="manage_subscription.php"><h4 class="pull-left"><i class="fa fa-arrow-left"></i> Back</h4></a>
                	<?php } ?>
                    <?=$page_title ?>
                </span>
            </div>
            <div class="pb-card__body py-4">
                <form action="" name="addeditcategory" method="POST" enctype="multipart/form-data">
                    <input  type="hidden" name="sub_id" value="<?=(isset($_GET['sub_id'])) ? $_GET['sub_id'] : ''?>" />
                    <div class="row">
                        
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Plan name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" value="<?php if(isset($_GET['sub_id'])){echo $row['name'];}?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Plan Duration</label>
                            <div class="col-sm-9">
                                <input type="number" name="duration" class="form-control" value="<?php if(isset($_GET['sub_id'])){echo $row['duration'];}?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Plan price</label>
                            <div class="col-sm-9">
                                <input type="number" name="price" class="form-control" value="<?php if(isset($_GET['sub_id'])){echo $row['price'];}?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Currency code</label>
                            <div class="col-sm-9">
                                <input type="text" name="currency_code" class="form-control" value="<?php if(isset($_GET['sub_id'])){echo $row['currency_code'];}?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Subscription id</label>
                            <div class="col-sm-9">
                                <input type="text" name="subscription_id" class="form-control" value="<?php if(isset($_GET['sub_id'])){echo $row['subscription_id'];}?>" required>
                                <small id="sh-text1" class="form-text text-muted col-md-6" style="padding: 0px;"> <a style="color: #f44336; font-weight: 700;">To get key go to Developer Console > Select your app > Products > Subscriptions.</a></small>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Base key</label>
                            <div class="col-sm-9">
                                <input type="text" name="base_key" class="form-control" value="<?php if(isset($_GET['sub_id'])){echo $row['base_key'];}?>" required>
                                <small id="sh-text1" class="form-text text-muted col-md-6" style="padding: 0px;"> <a style="color: #f44336; font-weight: 700;">To get key go to Developer Console > Select your app > Products > Subscriptions.</a></small>
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