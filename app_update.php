<?php 
    $page_title="App Update";
    include("includes/header.php");
    require("includes/lb_helper.php");

    $qry="SELECT * FROM tbl_settings where id='1'";
    $result=mysqli_query($mysqli,$qry);
    $settings_row=mysqli_fetch_assoc($result);
    
    if(isset($_POST['submit'])){
        
        $data = array(
            'app_update_status'  =>  ($_POST['app_update_status']) ? 'true' : 'false',
            'app_new_version'  =>  trim($_POST['app_new_version']),
            'app_update_desc'  =>  trim($_POST['app_update_desc']),
            'app_redirect_url'  =>  trim($_POST['app_redirect_url'])
        );
        
        $update = Update('tbl_settings', $data, "WHERE id = '1'");
        
        $_SESSION['msg']="11";
        $_SESSION['class']='success'; 
        header("Location:app_update.php");
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
                <div class="row">
                    <form action="" name="app_update" method="POST" enctype="multipart/form-data">
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">ON/OFF</label>
                            <div class="col-sm-9">
                                <label class="switch">
                                    <input type="checkbox" id="app_update_status" name="app_update_status" value="true" class="cbx hidden" <?php if($settings_row['app_update_status']=='true'){ echo 'checked'; }?>/>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">New App Version Code</label>
                            <div class="col-sm-9 col-lg-9">
                                <input type="number" min="1" name="app_new_version" id="app_new_version" required="" class="form-control" value="<?php echo $settings_row['app_new_version'];?>">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9 col-lg-9">
                                <textarea name="app_update_desc"  class="form-control"><?php echo stripslashes($settings_row['app_update_desc']); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">App Link</label>
                            <div class="col-sm-9 col-lg-9">
                                <input type="text" name="app_redirect_url" id="app_redirect_url" required="" class="form-control" value="<?php echo $settings_row['app_redirect_url'];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" name="submit" class="btn btn-primary" style="min-width: 110px;">Save</button>
                            </div>
                        </div>
                    </form>
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