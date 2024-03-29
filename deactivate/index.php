<?php
require("../includes/lb_helper.php");
$installFile="../includes/.lic";
$errors = false;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Script - Deactivator</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="../assets/css/bulma.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
    <style type="text/css">
      body, html {
        background: #F7F7F7;
      }
      .control-label-help{
        font-weight: 500;
        font-size: 14px;
      }
    </style>
  </head>
  <body>
    <div class="container" style="padding-top: 20px;"> 
      <div class="section">
        <div class="columns is-centered">
          <div class="column is-two-fifths">
            <center>
              <h1 class="title" style="padding-top: 20px">Script Deactivator</h1><br>
            </center>
            <div class="box">
                <?php if(is_writeable($installFile)){ ?>
                    <article class="message is-success">
                        <div class="message-body">
                            Click on deactivate license to deactivate and remove the currently installed license from this installation, So that you can activate the same license on some other domain.
                        </div>
                      </article>
                <?php } ?>
              
                <?php  
                    // Add or remove your script's requirements below
                    if(is_writeable($installFile)){
                        echo "<div class='notification is-success' style='padding:12px;'><i class='fa fa-check'></i> Ready to Deactivate process</div>";
                    }else{
                        $errors = true; 
                      echo "<div class='notification is-danger' style='padding:12px;'><i class='fa fa-times'></i>  The Deactivator process is already complete !</div>";
                    }
                ?>
                
                <?php
                    if(!empty($_POST)){
                        $deactivate_password = strip_tags(trim($_POST["pass"]));
                        $deactivate_response = deactivate_license($deactivate_password);
                        if(empty($deactivate_response)){
                            $msg='Server is unavailable.';
                        }else{
                            $msg=$deactivate_response['message'];
                        }
                        if($deactivate_response['status'] != true){ ?>
                            <form action="index.php" method="POST">
                              <div class="notification is-danger is-light"><?php echo ucfirst($msg); ?></div>
                              <input type="hidden" name="something">
                              <center>
                                <button type="submit" class="button is-danger">Deactivate License</button>
                              </center>
                            </form><?php
                        }else{ ?>
                            <div class="notification is-success is-light"><?php echo ucfirst($msg); ?></div><?php 
                        }
                    }else{ ?>
                      <form action="index.php" method="POST">
                        <input type="hidden" name="something">
                            <div class="field">
                                <label class="label">Deactivate Password</label>
                                <div class="control">
                                   <input class="input" type="text" id="pass" placeholder="Enter your deactivate password" name="pass" autocomplete="off" required>
                                </div>
                            </div>
                        <center>
                            <?php if($errors==true){ ?>
                                <button class="button is-danger is-rounded" disabled>Deactivate License</button>
                            <?php }else{ ?>
                                <button type="submit" class="button is-danger is-rounded">Deactivate License</button>
                            <?php } ?>
                        </center>
                      </form><?php 
                    } ?>
                    
                
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content has-text-centered">
      <p>Copyright © <?php echo date('Y'); ?> nemosofts.com , All rights reserved.</p><br>
    </div>
  </body>
</html>