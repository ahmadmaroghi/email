<?php 
  include('header.php');
  include ('class/user.php'); 
  include ('class/mail.php'); 

  $username = $_SESSION['login']['email'];

  if(isset($_POST['submit-compose'])){  
    $mail_subject = $_POST['subject'];
    $mail_message = $_POST['message'];
    $mail_date = date("Y-m-d H:i:s");
    $mail_status = 1;
    $mail_detail = $_POST['email'];
    
  
    //INSERT MAIL HEADER
    $mail_id= $mail->sentMailHeader($username,$mail_subject,$mail_message,$mail_date);
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