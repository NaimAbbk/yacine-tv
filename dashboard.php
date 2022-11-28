<?php 
    $page_title="Dashboard";
    include("includes/header.php");
    require("includes/lb_helper.php");
    
    $qry_post="SELECT COUNT(*) as num FROM tbl_live";
    $total_post= mysqli_fetch_array(mysqli_query($mysqli,$qry_post));
    $total_post = $total_post['num'];
    
    $qry_cat="SELECT COUNT(*) as num FROM tbl_category";
    $total_category= mysqli_fetch_array(mysqli_query($mysqli,$qry_cat));
    $total_category = $total_category['num'];
    
    $qry_banner="SELECT COUNT(*) as num FROM tbl_banner";
    $total_banner = mysqli_fetch_array(mysqli_query($mysqli,$qry_banner));
    $total_banner = $total_banner['num'];
    
    $qry_users="SELECT COUNT(*) as num FROM tbl_users";
    $total_users = mysqli_fetch_array(mysqli_query($mysqli,$qry_users));
    $total_users = $total_users['num'];
    
    $qry_re="SELECT COUNT(*) as num FROM tbl_reports";
    $total_reports = mysqli_fetch_array(mysqli_query($mysqli,$qry_re));
    $total_reports = $total_reports['num'];
    
    $qry_sug="SELECT COUNT(*) as num FROM tbl_suggest";
    $total_suggestion = mysqli_fetch_array(mysqli_query($mysqli,$qry_sug));
    $total_suggestion = $total_suggestion['num'];
    
    $qry_sub="SELECT COUNT(*) as num FROM tbl_subscription";
    $total_subscription = mysqli_fetch_array(mysqli_query($mysqli,$qry_sub));
    $total_subscription = $total_subscription['num'];

    $sql_reports="SELECT * FROM tbl_reports ORDER BY tbl_reports.`id` DESC LIMIT 7";
    $result_reports=mysqli_query($mysqli,$sql_reports);
    
    $sql_user="SELECT * FROM tbl_users ORDER BY tbl_users.`id` DESC LIMIT 7";
    $result_user=mysqli_query($mysqli,$sql_user);
    
    $countStr='';
    $no_data_status=false;
    $count=$monthCount=0;
    for ($mon=1; $mon<=12; $mon++) {
        if(date('n') < $mon){
            break;
        }
        $monthCount++;
        if(isset($_GET['filterByYear'])){
            $year=$_GET['filterByYear'];
            $month = date('M', mktime(0,0,0,$mon, 1, $year));
            $sql_user="SELECT `id` FROM tbl_users WHERE DATE_FORMAT(FROM_UNIXTIME(`registered_on`), '%c') = '$mon' AND DATE_FORMAT(FROM_UNIXTIME(`registered_on`), '%Y') = '$year'";
        }else{
            $month = date('M', mktime(0,0,0,$mon, 1, date('Y')));
            $sql_user="SELECT `id` FROM tbl_users WHERE DATE_FORMAT(FROM_UNIXTIME(`registered_on`), '%c') = '$mon'";
        }
        $count=mysqli_num_rows(mysqli_query($mysqli, $sql_user));
        $countStr.="['".$month."', ".$count."], ";
        if($count!=0){
            $count++;
        }
    }
    
    if($count!=0){
        $no_data_status=false;
    }else{
        $no_data_status=true;
    }
    $countStr=rtrim($countStr, ", ");
    
?>

<!-- Begin:: Theme main content -->
<main id="pb_main">
    <div class="pb-main-container">
        <div class="row">
            
            <div class="col-lg-3 col-xs-6">
                <a class="decoration-link" href="manage_category.php" >
                    <div class="pb-card pb-card--air pb-card--data pb-card--primary mb-4 overflow-hidden">
                        <div class="pb-card__body d-flex align-items-center">
                            <div class="pb-card__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                <path d="M22 11V17C22 21 21 22 17 22H7C3 22 2 21 2 17V7C2 3 3 2 7 2H8.5C10 2 10.33 2.44 10.9 3.2L12.4 5.2C12.78 5.7 13 6 14 6H17C21 6 22 7 22 11Z"></path>
                                </svg>
                            </div>
                            <div class="ms-auto text-end">
                                <span>Categories</span>
                                <h3 class="mb-0"><?php echo thousandsNumberFormat($total_category); ?></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-xs-6">
                <a class="decoration-link" href="manage_live.php" >
                    <div class="pb-card pb-card--air pb-card--data pb-card--danger mb-4 overflow-hidden">
                        <div class="pb-card__body d-flex align-items-center">
                            <div class="pb-card__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                    <path d="M12.53 20.4201H6.21C3.05 20.4201 2 18.3201 2 16.2101V7.79008C2 4.63008 3.05 3.58008 6.21 3.58008H12.53C15.69 3.58008 16.74 4.63008 16.74 7.79008V16.2101C16.74 19.3701 15.68 20.4201 12.53 20.4201Z" />
                                    <path d="M19.52 17.0999L16.74 15.1499V8.83989L19.52 6.88989C20.88 5.93989 22 6.51989 22 8.18989V15.8099C22 17.4799 20.88 18.0599 19.52 17.0999Z" />
                                    <path d="M11.5 11C12.3284 11 13 10.3284 13 9.5C13 8.67157 12.3284 8 11.5 8C10.6716 8 10 8.67157 10 9.5C10 10.3284 10.6716 11 11.5 11Z" />
                                </svg>
                            </div>
                            <div class="ms-auto text-end">
                                <span>Live TV</span>
                                <h3 class="mb-0"><?php echo thousandsNumberFormat($total_post); ?></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-xs-6">
                <a class="decoration-link" href="manage_banner.php" >
                    <div class="pb-card pb-card--air pb-card--data pb-card--info mb-4 overflow-hidden">
                        <div class="pb-card__body d-flex align-items-center">
                            <div class="pb-card__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                <path d="M16.8199 2H7.17995C5.04995 2 3.31995 3.74 3.31995 5.86V19.95C3.31995 21.75 4.60995 22.51 6.18995 21.64L11.0699 18.93C11.5899 18.64 12.4299 18.64 12.9399 18.93L17.8199 21.64C19.3999 22.52 20.6899 21.76 20.6899 19.95V5.86C20.6799 3.74 18.9499 2 16.8199 2Z" />
                                <path d="M9.58997 11L11.09 12.5L15.09 8.5" />
                                </svg>
                            </div>
                            <div class="ms-auto text-end">
                                <span>Banner</span>
                                <h3 class="mb-0"><?php echo thousandsNumberFormat($total_banner); ?></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-xs-6">
                <a class="decoration-link" href="manage_suggestion.php" >
                    <div class="pb-card pb-card--air pb-card--data pb-card--warning mb-4 overflow-hidden">
                        <div class="pb-card__body d-flex align-items-center">
                            <div class="pb-card__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                    <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z"/>
                                    <path d="M2 13H5.76C6.52 13 7.21 13.43 7.55 14.11L8.44 15.9C9 17 10 17 10.24 17H13.77C14.53 17 15.22 16.57 15.56 15.89L16.45 14.1C16.79 13.42 17.48 12.99 18.24 12.99H21.98"/>
                                    <path d="M10.34 7H13.67"/>
                                    <path d="M9.5 10H14.5"/>
                                </svg>
                            </div>
                            <div class="ms-auto text-end">
                                <span>Suggestion</span>
                                <h3 class="mb-0"><?php echo thousandsNumberFormat($total_suggestion); ?></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-xs-6">
                <a class="decoration-link" href="manage_report.php" >
                    <div class="pb-card pb-card--air pb-card--data pb-card--gren mb-4 overflow-hidden">
                        <div class="pb-card__body d-flex align-items-center">
                            <div class="pb-card__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                    <path d="M1.97998 13H5.76998C6.52998 13 7.21998 13.43 7.55998 14.11L8.44998 15.9C8.99998 17 9.99998 17 10.24 17H13.77C14.53 17 15.22 16.57 15.56 15.89L16.45 14.1C16.79 13.42 17.48 12.99 18.24 12.99H21.98" />
                                    <path d="M19 8C20.6569 8 22 6.65685 22 5C22 3.34315 20.6569 2 19 2C17.3431 2 16 3.34315 16 5C16 6.65685 17.3431 8 19 8Z" />
                                    <path d="M14 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22H15C20 22 22 20 22 15V10" />
                                </svg>
                            </div>
                            <div class="ms-auto text-end">
                                <span>Reports</span>
                                <h3 class="mb-0"><?php echo thousandsNumberFormat($total_reports); ?></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-xs-6">
                <a class="decoration-link" href="manage_subscription.php" >
                    <div class="pb-card pb-card--air pb-card--data pb-card--primary mb-4 overflow-hidden">
                        <div class="pb-card__body d-flex align-items-center">
                            <div class="pb-card__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                    <path d="M16.29 2.15002H7.69995C5.99995 2.15002 5.24995 3.00002 4.78995 4.04002L2.22995 9.80002C1.76995 10.84 2.01995 12.39 2.78995 13.23L9.64995 20.77C10.95 22.19 13.07 22.19 14.36 20.77L21.21 13.22C21.98 12.37 22.23 10.83 21.76 9.79002L19.2 4.03002C18.74 3.00002 17.99 2.15002 16.29 2.15002Z"/>
                                    <path d="M3.5 8H20.5" />
                                </svg>
                            </div>
                            <div class="ms-auto text-end">
                                <span>Subscription</span>
                                <h3 class="mb-0"><?php echo thousandsNumberFormat($total_subscription); ?></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-xs-6">
                <a class="decoration-link" href="manage_users.php" >
                    <div class="pb-card pb-card--air pb-card--data pb-card--danger mb-4 overflow-hidden">
                        <div class="pb-card__body d-flex align-items-center">
                            <div class="pb-card__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                            <div class="ms-auto text-end">
                                <span>Users</span>
                                <h3 class="mb-0"><?php echo thousandsNumberFormat($total_users); ?></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="pb-card pb-card--air pb-card--data pb-card--info mb-4 overflow-hidden">
                    <div class="pb-card__body d-flex align-items-center">
                        <div class="pb-card__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <div class="ms-auto text-end">
                            <span>Admin user</span>
                            <h3 class="mb-0">1</h3>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="pb-card container-fluid p-4">
                    <div class=" d-sm-flex align-items-sm-center">
                        <div class="col-lg-10">
                            <h3 style="font-weight: 900;">Users Analysis</h3>
                            <p style="font-weight: 200;">New registrations</p>
                        </div>
                        <div class="pb-card__head__option">
                            <form method="get" id="graphFilter">
                                <select class="form-control" name="filterByYear" style="width: 120px;" >
                                <?php 
                                    $currentYear=date('Y');
                                    $minYear=2020;
                                    for ($i=$currentYear; $i >= $minYear ; $i--) { 
                                ?>
                                <option value="<?=$i?>" <?=(isset($_GET['filterByYear']) && $_GET['filterByYear']==$i) ? 'selected' : ''?>><?=$i?></option>
                                <?php } ?>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <?php if($no_data_status){ ?>
                            <h3 class="text-muted text-center" style="padding-bottom: 2em">No data found !</h3>
                        <?php } else{ ?>
                            <div id="registerChart"></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-xl-6">
                <div class="pb-card mb-4">
                    <div class="pb-card__head">
                        <span class="pb-card__title">New Reports</span>
                    </div>
                    <div class="pb-card__body">
                        <div class="table-responsive">
                            <?php if(mysqli_num_rows($result_reports) > 0){ ?>
                                <table class="table">
                                    <tbody>
                                    <?php $i=0; while($row=mysqli_fetch_array($result_reports)) { ?>
                                        <tr>
                                            <td><?php echo user_info($row['user_id'],"user_name");?></td>
                                            <td><?php echo $row['report_msg'];?></td>
                                        </tr>
                                    <?php $i++; } ?> 
                                    </tbody>
                                </table>
                            <?php }else{ ?>
                                <ul class="p-2">
                                    <h3 class="text-center">No data found !</h3>
                                </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="pb-card mb-4">
                    <div class="pb-card__head">
                        <span class="pb-card__title">New users</span>
                    </div>
                    <div class="pb-card__body">
                        <div class="table-responsive">
                            <?php if(mysqli_num_rows($result_user) > 0){ ?>
                            <table class="table">
                                <tbody>
                                <?php $i=0; while($row=mysqli_fetch_array($result_user)) { ?>
                                    <tr>
                                        <td><?php echo $row['user_name'];?></td>
                                        <td><?php echo $row['user_email'];?></td>
                                    </tr>
                                <?php $i++; } ?> 
                                </tbody>
                            </table>
                            <?php }else{ ?>
                                <ul class="p-2">
                                    <h3 class="text-center">No data found !</h3>
                                </ul>
                            <?php } ?>
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

<?php if(!$no_data_status){ ?>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
  <script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'line']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Month');
      data.addColumn('number', 'Users');

      data.addRows([<?=$countStr?>]);

      var options = {
        curveType: 'function',
        fontSize: 15,
        hAxis: {
          title: "Months of <?=(isset($_GET['filterByYear'])) ? $_GET['filterByYear'] : date('Y')?>",
          titleTextStyle: {
            color: '#000',
            bold:'true',
            italic: false
          },
        },
        vAxis: {
          title: "Nos of Users",
          titleTextStyle: {
            color: '#000',
            bold:'true',
            italic: false,
          },
          gridlines: { count: 5},
          format: '#',
          viewWindowMode: "explicit", viewWindow:{ min: 0 },
        },
        height: 400,
        chartArea:{
          left:100,top:20,width:'100%',height:'auto'
        },
        legend: {
          position: 'none'
        },
        lineWidth:4,
        animation: {
          startup: true,
          duration: 1200,
          easing: 'out',
        },
        pointSize: 5,
        pointShape: "circle",
        colors: ['#2196f3']

      };
      var chart = new google.visualization.LineChart(document.getElementById('registerChart'));

      chart.draw(data, options);
    }

    $(document).ready(function () {
      $(window).resize(function(){
        drawChart();
      });
    });
  </script>
<?php } ?>

<script type="text/javascript">
  // filter of graph
  $("select[name='filterByYear']").on("change",function(e){
    $("#graphFilter").submit();
  });
</script>