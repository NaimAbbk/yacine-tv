<?php 
    $page_title="SMTP Settings";
    include("includes/header.php");
    require("includes/lb_helper.php");
    require("language/language.php");
    
    $qry = "SELECT * FROM tbl_smtp_settings where id='1'";
    $result = mysqli_query($mysqli, $qry);
    $row = mysqli_fetch_assoc($result);

    if (isset($_POST['submit'])) {
        $key = ($_POST['smtpIndex'] == 'gmail') ? '0' : '1';
        $password = '';
        if ($_POST['smtp_password'][$key] != '') {
            $password = $_POST['smtp_password'][$key];
        } else {
            if ($key == 0) {
                $password = $row['smtp_gpassword'];
            } else {
                $password = $row['smtp_password'];
            }
        }
        if ($key == 0) {
            $data = array(
                'smtp_type'  =>  'gmail',
                'smtp_ghost'  =>  $_POST['smtp_host'][$key],
                'smtp_gemail'  =>  $_POST['smtp_email'][$key],
                'smtp_gpassword'  =>  $password,
                'smtp_gsecure'  =>  $_POST['smtp_secure'][$key],
                'gport_no'  =>  $_POST['port_no'][$key]
            );
        } else {
            $data = array(
                'smtp_type'  =>  'server',
                'smtp_host'  =>  $_POST['smtp_host'][$key],
                'smtp_email'  =>  $_POST['smtp_email'][$key],
                'smtp_password'  =>  $password,
                'smtp_secure'  =>  $_POST['smtp_secure'][$key],
                'port_no'  =>  $_POST['port_no'][$key]
            );
        }
        $sql = "SELECT * FROM tbl_smtp_settings WHERE id='1'";
        $res = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
        if (mysqli_num_rows($res) > 0) {
            $update = Update('tbl_smtp_settings', $data, "WHERE id = '1'");
        } else {
            $insert = Insert('tbl_smtp_settings', $data);
        }
        $_SESSION['class'] = "success";
        $_SESSION['msg'] = "11";
        header("Location:smtp_settings.php");
        exit;
    }
?>

<style>
    .pb-theme-dark  .form-check-input {
    border: 1px solid rgb(255 255 255 / 25%);
}
</style>

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
                    <div class="col-md-7">
                        <form action="" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            <div class="form-group row mb-4">
                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">SMTP Type</label>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input type="radio" name="smtp_type" id="gmail" class="form-check-input" value="gmail" <?php if ($row['smtp_type'] == 'gmail') { echo ' checked="" id="disabledFieldsetCheck"';} ?>>
                                        <label class="form-check-label" for="gmail"> Gmail SMTP</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input type="radio" name="smtp_type" id="server" class="form-check-input" value="server" <?php if ($row['smtp_type'] == 'server') { echo ' checked="" disabled="disabled"';} ?>>
                                        <label class="form-check-label" for="server">Server SMTP</label>
                                    </div>
                                    </div>
                            </div>
                            <input type="hidden" name="smtpIndex" value="<?= $row['smtp_type'] ?>">
                            <div class="gmailContent" 
                            <?php if ($row['smtp_type'] == 'gmail') {
                                echo 'style="display:block"';
                            } else {
                                echo 'style="display:none"';
                            } ?>>
                            <div class="form-group row mb-4">
                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">SMTP Host</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="text" name="smtp_host[]" class="form-control col-md-7" value="<?= $row['smtp_ghost'] ?>" placeholder="mail.example.in" <?php if ($row['smtp_type'] == 'gmail') {echo 'required';} ?>> 
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Email</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="text" name="smtp_email[]" class="form-control col-md-7" value="<?= $row['smtp_gemail'] ?>" placeholder="info@example.com" <?php if ($row['smtp_type'] == 'gmail') { echo 'required';} ?>>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Password</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="password" name="smtp_password[]" class="form-control col-md-7" value="" placeholder="********">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">SMTPSecure</label>
                                <div class="col-md-3">
                                    <select name="smtp_secure[]" class="select2 form-control" <?php if ($row['smtp_type'] == 'gmail') { echo 'required';} ?>>
                                        <option value="tls" <?php if ($row['smtp_gsecure'] == 'tls') {
                                            echo 'selected';
                                        } ?>>TLS</option>
                                        <option value="ssl" <?php if ($row['smtp_gsecure'] == 'ssl') {
                                            echo 'selected';
                                        } ?>>SSL</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="port_no[]" class="form-control" value="<?= $row['gport_no'] ?>" placeholder="Enter Port No." <?php if ($row['smtp_type'] == 'gmail') { echo 'required';} ?>>
                                </div>
                            </div>
                            </div>
                            <div class="serverContent" 
                            <?php if ($row['smtp_type'] == 'server') {
                                echo 'style="display:block"';
                            } else {
                                echo 'style="display:none"';
                            } ?>>
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">SMTP Host</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" name="smtp_host[]" id="smtp_host" class="form-control col-md-7" value="<?= $row['smtp_host'] ?>" placeholder="mail.example.in" <?php if ($row['smtp_type'] == 'server') { echo 'required';} ?>>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Email</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="text" name="smtp_email[]" id="smtp_email" class="form-control col-md-7" value="<?= $row['smtp_email'] ?>" placeholder="info@example.com" <?php if ($row['smtp_type'] == 'server') { echo 'required';} ?>>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Password</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="password" name="smtp_password[]" id="smtp_password" class="form-control col-md-7" value="" placeholder="********">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">SMTPSecure</label>
                                    <div class="col-md-3">
                                        <select name="smtp_secure[]" class="select2 form-control" <?php if ($row['smtp_type'] == 'server') { echo 'required';} ?>>
                                            <option value="tls" <?php if ($row['smtp_secure'] == 'tls') { echo 'selected'; } ?>>TLS</option>
                                            <option value="ssl" <?php if ($row['smtp_secure'] == 'ssl') { echo 'selected'; } ?>>SSL</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="port_no[]" id="port_no" class="form-control" value="<?= $row['port_no'] ?>" placeholder="Enter Port No." <?php if ($row['smtp_type'] == 'server') { echo 'required';} ?>>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="server_data" data-stuff='<?php echo htmlentities(json_encode($row)); ?>'>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" name="submit" class="btn btn-primary mt-3">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5">
                        <div class="form-control" style="padding: 10px 20px;border-radius: 6px;margin-top:15px;">
                            <h4>Check Mail Configuration</h4>
                            <p style="color:#8a8a8a;">Send test mail to your email to check Email functionality work or not.</p>
                            <hr />
                            <form action="" method="post" id="check_smtp_form">
                                <div class="form-group">
                                    <label class="control-label">Email <span style="color: red">*</span>:-</label>
                                    <div>
                                        <input type="text" name="email" class="form-control" autocomplete="off" placeholder="info@example.com" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <button type="submit" name="btn_send" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </form>
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
<script type="text/javascript">
  $("input[name='smtp_type']").on("click", function(e) {

    var checkbox = $(this);

    $("input[name='smtp_password[]']").attr("required", false);

    e.preventDefault();
    e.stopPropagation();

    var _val = $(this).val();
    if (_val == 'gmail') {

      swal({
        title: "Are you sure?",
        type: "warning",
		confirmButtonClass: 'btn btn-primary mb-2',
        cancelButtonClass: 'btn btn-danger mb-2',
        buttonsStyling: false,
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: false
      }).then(function(result) {
        if (result.value) {

          checkbox.attr("disabled", true);
          checkbox.prop("checked", true);
          $("#server").attr("disabled", false);
          $("#server").prop("checked", false);


          $(".serverContent").hide();
          $(".gmailContent").show();

          $(".serverContent").find("input").attr("required", false);
          $(".gmailContent").find("input").attr("required", true);

          $("input[name='smtpIndex']").val('gmail');

          swal.close();

        } else {
          swal.close();
        }

      });
    } else {

      swal({
        title: "Are you sure?",
        type: "warning",
		confirmButtonClass: 'btn btn-primary mb-2',
        cancelButtonClass: 'btn btn-danger mb-2',
        buttonsStyling: false,
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: false
        
      }).then(function(result) {
        if (result.value) {

          checkbox.attr("disabled", true);
          checkbox.prop("checked", true);
          $("#gmail").attr("disabled", false);
          $("#gmail").prop("checked", false);

          $(".gmailContent").hide();
          $(".serverContent").show();

          $("input[name='smtpIndex']").val('server');

          $(".serverContent").find("input").attr("required", true);
          $(".gmailContent").find("input").attr("required", false);

          swal.close();

        } else {
          swal.close();
        }

      });

    }

  });
  
    $("#check_smtp_form").on("submit", function(e) {
        e.preventDefault();
        
        var email = $(this).find("input[name='email']").val();
        
        swal({
            title: "Are you sure?",
            text: 'Email will receive to ' + email,
    		type: "warning",
    	    confirmButtonClass: 'btn btn-primary mb-2',
            cancelButtonClass: 'btn btn-danger mb-2',
            buttonsStyling: false,
    		showCancelButton: true,
    		confirmButtonText: "Yes",
    		cancelButtonText: "No",
    		closeOnConfirm: false,
    		closeOnCancel: false,
    		showLoaderOnConfirm: true
        }).then(function(result) {
          if (result.value) {
            $.ajax({
                type: 'post',
                url: 'processData.php',
                dataType: 'json',
                data: {
                  'action': 'check_smtp',
                  'email': email
                },
                success: function(res) {
                    console.log(res);
                    location.reload();
                }
            });
          } else {
                swal.close();
          }
        });
    });
</script>