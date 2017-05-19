<?php 
  // session_start();
  include('header.php');
  include ('class/user.php'); 
  include ('class/mail.php');
  include('class/Rsa.php');

  $session    = $_SESSION['login'];
  $username   = $_SESSION['login']['email'];
  
  if(isset($_POST['submit-compose'])){  
    $mail_subject = $_POST['subject'];
    $mail_message = $_POST['message'];
    $mail_date = date("Y-m-d H:i:s");
    $mail_status = 1;
    $mail_detail = $_POST['email'];
    

    $Encrypt_rsa->set_rsa_public_key($session["rsa_publickey"]);
    $mail_message = $Encrypt_rsa->encrypt($mail_message);
  
    //INSERT MAIL HEADER
    $mail_id= $mail->sentMailHeader($username,$mail_subject,$mail_message,$mail_date,0);
    //INSERT MAIL DETAIL
    foreach ($mail_detail as $email) {
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
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="#Compose" class="btn btn-primary btn-block margin-bottom openMessage">Compose</a>
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
        <div class="col-md-9">
          <div id="inbox" class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Inbox</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" id="trash" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  <?php
                    $result = $mail->getMailAll($username);
                    if($result == 0){
                  ?>
                    <tr>
                    <td colspan="5"> No Item </td>
                  </tr>

                  <?php
                    }else{
                        $arr = array();
                        foreach ($result as $row) {
                  ?>
                    <tr>
                    <td><input type="checkbox" class="list" value="<?php echo $row['mail_id']; ?>" id="list[]"></td>
                    <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                    <td class="mailbox-name">
                        <a href="read.php?mail_id=<?php echo $row['mail_id']; ?>" class="openRead"><?php echo $row['username']; ?></a>
                    </td>
                    <td class="mailbox-subject">
                    <?php 
                      $mail_id = $row['mail_id'];
                      array_push($arr, $mail_id);

                      if($row['mail_status'] == "2"){
                          echo $row['mail_subject'];
                      }else{
                          echo "<b>".$row['mail_subject']."</b>";
                      }
                    ?>
                    </td>
                    <td class="mailbox-date"><?php echo $row['mail_date']; ?></td>
                  </tr>
                  <?php
                    }
                  }

                  ?>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <div id="compose" style="display: none;" class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Compose New Message</h3>
            </div>
            <!-- /.box-header -->
            <form name="form-compose" method="post">
            <div class="box-body">
              <div class="form-group" >
                <!-- <input class="form-control" placeholder="To:"> -->
                <select name="email[]" class="select2-multiple form-control" multiple="multiple" placeholder="To:">
                <!--Get Email from user table-->
                <?php
                  $r = $obj->getUserEmail($_SESSION['login']['username']);
                  foreach( $r as $row) {
                    echo "<option value='".$row['email']."'>".$row['email']."</option>";
                  }
                ?>
                <!--/Get Email from user table-->
                </select>
              </div>
              <div class="form-group">
                <input name="subject" id="subject" class="form-control" placeholder="Subject:">
              </div>
              <div class="form-group">
                    <textarea name="message" id="compose-textarea" class="form-control" style="height: 300px"></textarea>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <input type="submit" name="submit-compose" class="btn btn-primary" value="Send" />
              </div>
              <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
             </form>
            </div>
            <!-- /.box-footer -->
          </div>        
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <?php include('footer.php'); ?>
  <?php 
    $trash = @$_POST['trash'];
    if(isset($trash)){
      $trashArray = explode(',', $trash);
      foreach ($trashArray as $ar) {
         $mail->setTrash($ar, $username);
       } 
    }
  ?>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
  $(document).ready(function() { 
      $(".select2-multiple").select2({
        placeholder: "To:"
      });

      $(".openMessage").on("click", function(){
        document.getElementById("inbox").style.display = "none";
        document.getElementById("compose").style.display = "block";
      });

      $(".openInbox").on("click", function(){
        document.getElementById("inbox").style.display = "block";
        document.getElementById("compose").style.display = "none";
      });

      $('#trash').click(function(){
        
        var trash = [];
        $('.list').each(function(){
         if($(this).is(":checked")){
          trash.push($(this).val());
         }
        });
        trash = trash.toString();
        
        $.ajax({
          url: "mail.php",
          method: "POST",
          data:{trash:trash},
          success:function(data){
            location.reload(alert('Mail removed'));
            //alert(trash);
            //$('#result').html(data);
          }
        });
      });
    });
  </script>