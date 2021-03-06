<?php 
  include('header.php');
  include ('class/user.php'); 
  include ('class/mail.php'); 
  include ('class/Rsa.php');

  $session  = $_SESSION['login'];
  $username = $_SESSION['login']['email'];
  $from = "";
  if(!isset($_GET['mail_id'])){
    header('location:mail.php');
  }
  $mail_id = $_GET['mail_id'];
  $mail->setStatusMessage($mail_id, $username);
  $Encrypt_rsa->set_rsa_private_key($session["rsa_privatekey"]);
  // $plaintext = $Encrypt_rsa->decrypt($chipertext);
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mailbox
      </h1>
      <ol class="breadcrumb">
        <li><a href="mail.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mailbox</li>
      </ol>
    </section>
    <!-- Main content -->
    <form method="post" action="">
      <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="mail.php" class="btn btn-primary btn-block margin-bottom openMessage">Compose</a>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="mail.php" class="openInbox"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right"><?php echo $mail->getInboxCount($username); ?></span></a></li>
                <li><a href="sent.php"><span class="label label-primary pull-right"><?php echo $mail->getSentCount($username); ?></span><i class="fa fa-envelope-o"></i> Sent</a></li>
                <li><a href="trash.php"><span class="label label-primary pull-right"><?php echo $mail->getTrashCount($username); ?></span><i class="fa fa-trash-o"></i> Trash</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
        <?php
          $result = $mail->getMailRead($mail_id);    
        ?>
        <div class="col-md-9">
          <div id="read" class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $mail->getSubject($mail_id); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <ul class="timeline">
            <?php 
              foreach ($result as $row) { 
              ?>
              <li>
                <i class="fa fa-envelope bg-blue"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo $row['mail_date']; ?></span>
                    <h3 class="timeline-header">
                         <?php 
                              echo $row['username']; 
                              $from = $row['username'];
                          ?>
                    </h3>
                    <div class="timeline-body">
                      <?php 
                          // echo $row['mail_message'];
                          echo $Encrypt_rsa->decrypt($row['mail_message']);
                      ?>

                      </div>
                  </div>
                </li>

            <?php
              }
            ?>
                <li>
                  <div class="timeline-item">
                    <div class="timeline-body">
                      <div id="formGroup" style="display: none;" class="form-group">
                      <!-- <input class="form-control" placeholder="To:"> -->
                      <select id="email" name="email[]" class="select2-multiple form-control" multiple="multiple" placeholder="To:">
                      <!--Get Email from user table-->
                      <?php
                        $r = $obj->getUserEmail($username);
                        foreach( $r as $row) {
                          if($row['email'] == $from){
                              echo "<option value='".$row['email']."' selected>".$row['email']."</option>";
                          }else{
                              echo "<option value='".$row['email']."'>".$row['email']."</option>";
                          }
                        }
                      ?>
                      <!--/Get Email from user table-->
                      </div>
                    </div>
                     <div class="timeline-body">
                      <div class="form-group">
                        <input name="subject" id="subject" class="form-control" value="<?php echo $mail->getSubject($mail_id); ?>">
                      </div>
                      <div class="form-group">
                        <textarea id="compose-textarea" name="mail_message" class="form-control" style="height: 100px"></textarea></div>
                      </div>
                  </div>
                  </div>
                </li>
            </ul>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <a id="replyOne" href="#">Reply |</a> <a id="replyAll" href="#">Reply All</a>  
                <input id="idSubmit" style="display: none;" type="submit" class="btn btn-primary" name="send" value="Send">
              </div>
              <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
            </div>
            <!-- /.box-footer -->
          </div>
          
          </div>
        
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    </form>
    
    <!-- /.content -->
  </div>
  <?php
    if(isset($_POST['send'])){
        $mail_subject = "RE : ".$_POST['subject'];
        $mail_message = $_POST['mail_message'];
        $mail_id = $_GET['mail_id'];
        $mail_date = date("Y-m-d H:i:s");
        $reply_detail = $_POST['email'];
        $mail_status = 1;

        //INSERT HEADER
        $mail_id= $mail->sentMailHeader($username,$mail_subject,$mail_message,$mail_date,$mail_id);

        //INSERT DETAIL
        foreach ($reply_detail as $email) {
          $mail->sentMailDetail($mail_id, $email,$mail_status);
        }

        echo "
          <script>
            alert('Message has been successfully sent');
            window.location.href='mail.php';
          </script>";
          exit();
  }
  ?>
  <?php include('footer.php'); ?>
  <script type="text/javascript">
  $(document).ready(function() { 
      $(".select2-multiple").select2({
        placeholder: "To:"
      });

      $("#replyOne").on("click", function(){
        document.getElementById("formGroup").style.display = "block";
        document.getElementById("idSubmit").style.display = "block";
        document.getElementById("replyOne").style.display = "none";
        document.getElementById("replyAll").style.display = "none";
      });

      $(".replyAll").on("click", function(){
        document.getElementById("formGroup").style.display = "block";
        document.getElementById("idSubmit").style.display = "block";
      });
  });
  </script>
  <!-- /.content-wrapper -->