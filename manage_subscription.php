<?php 
    $page_title="Manage Subscription";
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    
    $tableName="tbl_subscription";   
    $targetpage = "manage_subscription.php"; 
    $limit = 12; 

    $query = "SELECT COUNT(*) as num FROM $tableName";
    
    $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query));
    $total_pages = $total_pages['num'];
    
    $stages = 3;
    $page=0;
    if(isset($_GET['page'])){
        $page = mysqli_real_escape_string($mysqli,$_GET['page']);
    }
    if($page){
        $start = ($page - 1) * $limit; 
    }else{
        $start = 0; 
    } 
    
    $sql_query="SELECT * FROM tbl_subscription ORDER BY tbl_subscription.`id` DESC LIMIT $start, $limit";
    $result=mysqli_query($mysqli,$sql_query) or die(mysqli_error($mysqli));
    
?>
<!-- Begin:: Theme main content -->

<main id="pb_main">
    <div class="pb-main-container">
        <div class="pb-card">
            <div class="pb-card__head d-sm-flex align-items-sm-center">
                <span class="pb-card__title mb-2 mb-sm-0">
                    <?php if (isset($_SERVER['HTTP_REFERER'])) { echo '<a href="' . $_SERVER['HTTP_REFERER'] . '"><h4 class="pull-left"><i class="fa fa-arrow-left"></i> Back</h4></a>'; }?>
                    <?=$page_title ?>
                </span>
                <div class="pb-card__head__option">
                    <div class="pb-card__head__option__item">
                        <a href="add_subscription.php?add=yes" class="btn btn-sm btn-primary">+ <span class="d-none d-sm-inline-block">Add Subscription</span></a>
                    </div>
                </div>
            </div>
            <div class="pb-card__body py-4">
                <?php if(mysqli_num_rows($result) > 0){ ?>
                    <div class="row">
                        <?php $i=0; while($row=mysqli_fetch_array($result)) { ?>
                            <div class="col-md-4 col-sm-6">
                                <div class="pb-card-post-text">
                                    <h5><?php echo $row['name'];?></h5>
                                    <p><?php echo $row['price'];?> <?php echo $row['currency_code'];?>, <?php echo $row['duration'];?> Day's</p>
                                    <ul>
                                        <li><a href="add_subscription.php?sub_id=<?php echo $row['id'];?>" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit"><i class="fa fa-edit"></i></a></li> 
                                        <li><a href="" class="delete_data" data-id="<?php echo $row['id'];?>" data-table="<?=$tableName ?>" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete"><i class="fa fa-trash"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        <?php $i++; } ?>
                    </div>
                    <?php }else{ ?>
                        <ul class="p-5">
                            <h1 class="text-center">No data found</h1>
                        </ul>
                    <?php } ?>
                <!-- Begin:: Pagination -->
                <?php include("pagination.php"); ?>
                <!-- End:: Pagination -->
            </div>
        </div>
         <!-- Begin:: Main footer -->
        <?php include("includes/main_footer.php");?> 
        <!-- End:: Main footer  -->
    </div>
</main>
<!-- End:: Theme main content -->
<?php include("includes/footer.php");?> 