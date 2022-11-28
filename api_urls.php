<?php 
    $page_title="URLs";
    include("includes/header.php");
    require("includes/lb_helper.php");
    
    $file_path = getBaseUrl();
?>
<!-- Begin:: Theme main content -->
<main id="pb_main">
    <div class="pb-main-container">
        <div class="pb-card">
            <div class="pb-card__head">
                <span class="pb-card__title mb-2 mb-sm-0">
                    <?php if (isset($_SERVER['HTTP_REFERER'])) { echo '<a href="' . $_SERVER['HTTP_REFERER'] . '"><h4 class="pull-left"><i class="fa fa-arrow-left"></i> Back</h4></a>'; }?>
                    <h4 style="font-size: 20px;"><?=$page_title ?></h4>
                </span>
            </div>
            <div class="pb-card__body py-4">
                <div class="form-group row mb-4">
                    <label class="col-sm-3 col-form-label">BAS URL</label>
                    <div class="col-sm-9">
                        <div class="pb-clipboard">
                            <span class="pb-clipboard__url" id="pb_clipboard_url"><?php echo $file_path; ?></span>
                            <a class="pb-clipboard__link" href="javascript:void(0);" data-clipboard-action="copy" data-clipboard-target="#pb_clipboard_url">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" />
                                </svg>
                            </a>
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