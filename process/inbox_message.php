<?php 
  $inbox_id = 0;

  if(isset($_POST["submit"])) {
    $inbox_id = $_POST["inbox_id"];

    //Sender Info
    $sender_name = $_POST["sender_name"];
    $sender_email = $_POST["sender_email"];
    $sender_password = $_POST["sender_password"];

    //Receiver Info
    $receiver_email = $_POST["receiver_email"];
    $email_subject = $_POST['subject'];
    $email_body = $_POST['msg'];

    //Add mailer library
    require_once("../phpmailer/PHPMailerAutoload.php");

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Username = $sender_email;
    $mail->Password = $sender_password;
    $mail->setFrom($sender_email, $sender_name);
    $mail->addAddress($receiver_email);
    $mail->addReplyTo($sender_email);
    $mail->isHTML(true);
    $mail->Subject = $email_subject;
    $mail->Body = "<p style='text-align-left; font-size: 14px;'>" . $email_body . "</p>";

    if(!$mail->send()) {
      echo '<script>alert("Something went wrong. Please try again.")</script>';
    } else {
      echo '<script>alert("Message successfully sent.")</script>';
    }
  }

  ?>
  <script>
    setTimeout(function() { 
      var inbox_id = <?php echo $inbox_id; ?>;
      window.location = "../inbox_message.php?msg="+inbox_id; 
    }, 500);
  </script>
  <?php
?>