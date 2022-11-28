<?php 
    $page_title="Envato Verify Purchase";
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");;

    $qry="SELECT * FROM tbl_settings where id='1'";
    $result=mysqli_query($mysqli,$qry);
    $settings_row=mysqli_fetch_assoc($result);
    
    if(isset($_POST['submit'])){
        
        $key = generateStrongPassword();
        
        $envato = verify_envato_purchase_code(trim($_POST['envato_purchase_code']), '25587728');
        
        if($envato['status'] != true){
            
            $data = array(
                'envato_buyer_name' => trim($_POST['envato_buyer_name']),
                'envato_purchase_code' => trim($_POST['envato_purchase_code']),
                'envato_package_name' => trim($_POST['envato_package_name'])
            );

            $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
            
            $_SESSION['class']="error";
            $_SESSION['msg']="18";
            header( "Location:verification.php");
            exit;
            
        } else {
            
            $apikey = $key;
            
            $verify_server = verify_license_android(trim($_POST['envato_purchase_code']), $apikey, trim($_POST['envato_package_name']));
            
            if($verify_server['status'] != true){
                $data = array(
                    'envato_buyer_name' => trim($_POST['envato_buyer_name']),
                    'envato_purchase_code' => trim($_POST['envato_purchase_code']),
                    'envato_package_name' => trim($_POST['envato_package_name'])
                );
                
                $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
                
                $_SESSION['class']="error";
                $_SESSION['msg']="18";
            } else {
                $data = array(
                    'envato_buyer_name' => trim($_POST['envato_buyer_name']),
                    'envato_purchase_code' => trim($_POST['envato_purchase_code']),
                    'envato_api_key' => $apikey,
                    'envato_package_name' => trim($_POST['envato_package_name'])
                );
                
                $settings_edit =Update('tbl_settings', $data, "WHERE id = '1'");
                 
                $_SESSION['class']="success";
                $_SESSION['msg']="19";
            }
            header( "Location:verification.php");
            exit;
            
        }
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
                    <form action="" name="verify" method="POST" enctype="multipart/form-data">
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Envato Username</label>
                            <div class="col-sm-9">
                                <input type="text" name="envato_buyer_name" class="form-control" placeholder="Enter your envato user name" value="<?php echo $settings_row['envato_buyer_name'];?>" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Envato Purchase Code</label>
                            <div class="col-sm-9 col-lg-9">
                                <input type="text" name="envato_purchase_code"class="form-control" placeholder="Enter your item purchase code" value="<?php echo $settings_row['envato_purchase_code'];?>" autocomplete="off" required>
                                <small id="sh-text1" class="form-text text-muted"><a style="color: #f44336c7;" href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code" target="_blank">Where Is My Purchase Code?</a></small>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">ApiKey</label>
                            <div class="col-sm-9 col-lg-9">
                                <input type="text" name="envato_api_key" class="form-control" placeholder="<?php echo $settings_row['envato_api_key'];?>"  disabled readonly>
                                <small id="sh-text1" class="form-text text-muted col-md-6" style="padding: 0px;">Click the Save button This key will be generated automatically.</small>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label">Android Package Name</label>
                            <div class="col-sm-9 col-lg-9">
                                <input type="text" name="envato_package_name"class="form-control" placeholder="Enter your android application id" value="<?php echo $settings_row['envato_package_name'];?>" autocomplete="off" required>
                                <small id="sh-text1" class="form-text text-muted">(More info in Android Doc)</small>
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