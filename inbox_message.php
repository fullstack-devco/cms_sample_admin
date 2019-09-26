<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMS Admin</title>
    <link rel="stylesheet" href="css/fonts/font.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/pages/inbox_message.css" />
  </head>
  <body>
    <!--Check for session first-->
    <?php require_once("process/session.php"); ?>
    <?php require_once("process/session_logout.php"); ?>
    <!--Setup session-->
    <?php require_once("process/session_setup.php"); ?>

    <?php $inbox_id = 0; ?>

    <?php if(isset($_GET["msg"])) { ?>
      <?php $inbox_id = validateInput($_GET["msg"]); ?>
      <!--Update inbox status from unread(0) to read(1)-->
      <?php $mysqli->query("UPDATE inbox_tbl SET inbox_status = 1 WHERE inbox_id = $inbox_id") or die($mysqli->error()); ?>
    <?php } ?>
    <?php $result = $mysqli->query("SELECT * FROM inbox_tbl WHERE inbox_id = $inbox_id") or die($mysqli->error());?>
    <?php $count = mysqli_num_rows($result); ?>

    <div id="main-container">
      <div id="receiver-container">
        <?php if($count == 1) { ?>
          <?php $row = $result->fetch_array(); ?>
          <?php $inbox_id = $row['inbox_id']; ?>
          <?php $inbox_status = $row['inbox_status']; ?>
          <?php $inbox_txt = $row['inbox_txt']; ?>
          <?php $inbox_from = $row['inbox_from']; ?>
          <?php $inbox_contact = $row['inbox_contact']; ?>
          <?php $inbox_date = $row['inbox_date']; ?>
          <div class="msg-detail">
            Sender: <span class="info"><?php echo $inbox_from; ?></span>
          </div>
          <div class="msg-detail">
            Date Sent: <span class="info"><?php echo $inbox_date; ?></span>
          </div>
          <div class="msg-detail">
            Contact Details: <span class="info"><?php echo $inbox_contact; ?></span>
          </div>
          <div id="msg-detail-content-identifier">Message</div>
          <div id="msg-detail-content">
            <p>
              <?php echo $inbox_txt; ?>
            </p>
          </div>
        <?php } else { ?>
          <div>Cannot display inbox message. Please contact IT Support...</div>
        <?php } ?>
      </div>
      <div id="sender-container">
        <form action="process/inbox_message.php" method="post">
          <input type="hidden" name="inbox_id" value="<?php echo $inbox_id; ?>">
          <div class="sender-msg-detail">
            <input type="text" name="sender_name" id="sender_name" class="input input-width-100 padding-20 margin-top-bottom-5" placeholder="Your name." style="margin: 0;" required>
          </div>
          <div class="sender-msg-detail">
            <input type="email" name="sender_email" id="sender_email" class="input input-width-100 padding-20 margin-top-bottom-5" placeholder="Your email id." style="margin: 0;" required>
          </div>
          <div class="sender-msg-detail">
            <input type="password" name="sender_password" id="sender_password" class="input input-width-100 padding-20 margin-top-bottom-5" placeholder="Your email password." style="margin: 0;" required>
          </div>
          <div class="sender-msg-detail">
            <input type="email" name="receiver_email" id="receiver_email" class="input input-width-100 padding-20 margin-top-bottom-5" placeholder="Recipient email id." style="margin: 0;" required>
          </div>
          <div class="sender-msg-detail">
            <input type="text" name="subject" id="subject" class="input input-width-100 padding-20 margin-top-bottom-5" placeholder="Subject" style="margin: 0;" required>
          </div>
          <div stlye="width: 100%; height: 270px; background: red;">
            <textarea rows="5" cols="50" name="msg" id="msg" class="textarea padding-20 margin-top-bottom-5" placeholder="Message" style="width: 100%; height: 250px;" required></textarea>
          </div>
          <div style="width: 100%; height: 100px;">
            <input type="submit" name="submit" id="submit" value="SEND" class="btn btn-positive btn-width-100 padding-10"/>
          </div>
        </form>
      </div>
    </div>

    <?php
      //Perform validation to avoid potential hacking of inputs
      function validateInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    ?>
  </body>
</html>