<?php 
    $page_title="Manage Live";
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    
    $tableName="tbl_live";   
    $targetpage = "manage_live.php"; 
    $limit = 12; 
    $keyword='';

    if(!isset($_GET['keyword'])){
        $query = "SELECT COUNT(*) as num FROM $tableName";
    }else{
        
        $keyword=addslashes(trim($_GET['keyword']));
        $query = "SELECT COUNT(*) as num FROM $tableName WHERE `live_title` LIKE '%$keyword%'";
        $targetpage = "manage_live.php?keyword=".$_GET['keyword'];
    }
    
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
    
    if(!isset($_GET['keyword'])){
        $sql_query="SELECT * FROM tbl_live ORDER BY tbl_live.`id` DESC LIMIT $start, $limit"; 
    }else{
        $sql_query="SELECT * FROM tbl_live WHERE `live_title` LIKE '%$keyword%' ORDER BY tbl_live.`id` DESC LIMIT $start, $limit"; 
    }
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
                     <form method="get" id="searchForm" action="">
                        <div class="pb-card__head__option__item">
                            <div class="input-group input-group-sm">
                                <input type="text" id="search_input" name="search_input"  class="form-control" placeholder="Search here..." name="keyword" value="<?php if(isset($_GET['keyword'])){ echo $_GET['keyword'];} ?>" required="required">
                                <button type="search" class="btn btn-outline-secondary" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="pb-card__head__option__item">
                        <a href="add_live.php?add=yes" class="btn btn-sm btn-primary">+ <span class="d-none d-sm-inline-block">Add live</span></a>
                    </div>
                </div>
            </div>
            <div class="pb-card__body py-4">
                <?php if(mysqli_num_rows($result) > 0){ ?>
                    <div class="row">
                        <?php $i=0; while($row=mysqli_fetch_array($result)) { ?>
                            <div class="col-md-4 col-sm-6">
                                <div class="pb-card-post">
                                    <div class="bottom_block">
                                        <h3 class="post_title"><?php echo $row['live_title'];?></h3>
                                        <ul>
                                            <li><a href="add_live.php?live_id=<?php echo $row['id'];?>" target="_blank" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit"><i class="fa fa-edit"></i></a></li> 
                                            <li><a href="" class="delete_data" data-id="<?php echo $row['id'];?>" data-table="<?=$tableName ?>" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete"><i class="fa fa-trash"></i></a></li>
                                            <li>
                                                <div class="row toggle_btn">
                                                    <?php if ($row['status'] != "0") { ?>
                                                        <a class="toggle_btn_a enable_disable" href="javascript:void(0)" data-id="<?php echo $row['id'];?>" data-table_id="id" data-table="<?=$tableName ?>" data-action="deactive" data-column="status" data-bs-toggle="tooltip" data-placement="top" title="Enable">
                                                            <img src="assets/images/btn_enabled.png" alt="">
                                                        </a>
                                                    <?php } else { ?>
                                                        <a class="toggle_btn_a enable_disable" href="javascript:void(0)" data-id="<?php echo $row['id'];?>" data-table_id="id" data-table="<?=$tableName ?>" data-action="active" data-column="status" data-bs-toggle="tooltip" data-placement="top" title="Disable">
                                                            <img src="assets/images/btn_disabled.png" alt="">
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <span><img class="image-post" src="images/<?=$row['live_image']?>"></span>
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