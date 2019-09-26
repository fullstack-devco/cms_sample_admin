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
    <link rel="stylesheet" href="css/pages/edit_header.css" />
  </head>
  <body>
    <!--Check for session first-->
    <?php require_once("process/session.php"); ?>
    <?php require_once("process/session_logout.php"); ?>
    <!--Setup session-->
    <?php require_once("process/session_setup.php"); ?>
    <!--MAIN CONTAINER-->
    <div id="main-container">
      <div class="txt-align-center">
        <h1 class="h1">Contact</h1>
        <span class="color-light-blue">You can edit contact info on this page</span>
      </div>
      <!--CONTENT HOLDER-->
      <div id="content-holder">
        <?php $contact_id = 0; ?>
        <?php $contact_email = ""; ?>
        <?php $contact_num = ""; ?>
        <?php $result = $mysqli->query("SELECT * FROM contact_tbl") or die($mysqli->error());?>
        <?php $count = mysqli_num_rows($result); ?>
        <?php if($count == 1) { ?>
          <?php $row = $result->fetch_array(); ?>
          <?php $contact_id = $row['contact_id']; ?>
          <?php $contact_email = $row['contact_email']; ?>
          <?php $contact_num = $row['contact_num']; ?>
        <?php } ?>
        <!--FORM-->
        <form action="process/edit_contact.php" id="form-holder" method="post" enctype="multipart/form-data">  
          <div style="display: none;">
            <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
            <input type="hidden" name="contact_id" value="<?php echo $contact_id; ?>">
          </div>

          <div class="form-content-holder margin-top-bottom-5">
            <div class="form-content-white-space"></div>
            <div>
              <input type="email" name="contact_email" id="contact_email" class="input input-width-100 padding-20 margin-top-bottom-5" placeholder="Add your email here" value="<?php echo $contact_email; ?>" required>
            </div>
            <div class="form-content-white-space"></div>
          </div>

          <div class="form-content-holder margin-top-bottom-5">
            <div class="form-content-white-space"></div>
            <div>
            <input type="number" name="contact_num" id="contact_num" class="input input-width-100 padding-20 margin-top-bottom-5" placeholder="Add contact num here. Ex. 0917xxxxxxx" value="<?php echo $contact_num; ?>"  required>
            </div>
            <div class="form-content-white-space"></div>
          </div>

          <div class="form-content-holder margin-top-bottom-5">
            <div class="form-content-white-space"></div>
            <div>
              <?php if((strcmp($contact_email, "") == 0) && (strcmp($contact_num, "") == 0)): ?>
              <input type="submit" name="add" id="add" value="ADD" class="btn btn-neutral btn-width-100 padding-10" style="margin-left: 5px;"/>  
              <?php else: ?>
              <input type="submit" name="update" id="update" value="UPDATE" class="btn btn-neutral btn-width-100 padding-10" style="margin-left: 5px;"/>  
              <?php endif; ?>
            </div>
            <div class="form-content-white-space"></div>
          </div>
        </form>
      <!--END OF CONTENT HOLDER-->
      </div>
    <!--END OF MAIN CONTAINER-->
    </div>
  </body>
</html>