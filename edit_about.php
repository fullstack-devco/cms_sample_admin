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
    <link rel="stylesheet" href="css/pages/edit_about.css" />
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
        <h1 class="h1">About</h1>
        <span class="color-light-blue">You can edit about info on this page</span>
      </div>
      <!--CONTENT HOLDER-->
      <div id="content-holder">
        <?php $about_id = 0; ?>
        <?php $about_txt = ""; ?>
        <?php $result = $mysqli->query("SELECT * FROM about_tbl") or die($mysqli->error());?>
        <?php $count = mysqli_num_rows($result); ?>
        <?php if($count == 1) { ?>
          <?php $row = $result->fetch_array(); ?>
          <?php $about_id = $row['about_id']; ?>
          <?php $about_txt = $row['about_txt']; ?>
        <?php } ?>
        <!--FORM-->
        <form action="process/edit_about.php" id="form-holder" method="post" enctype="multipart/form-data">  
          <div style="display: none;">
            <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
            <input type="hidden" name="about_id" value="<?php echo $about_id; ?>">
          </div>

          <div class="text-content-holder margin-top-bottom-5">
            <div class="form-content-white-space"></div>
            <div>
              <textarea rows="5" cols="50" name="about_txt" class="textarea textarea-about padding-20 margin-top-bottom-5" placeholder="Add text here" required><?php echo $about_txt; ?></textarea>
            </div>
            <div class="form-content-white-space"></div>
          </div>

          <div class="submit-content-holder margin-top-bottom-5">
            <div class="form-content-white-space"></div>
            <div>
              <?php if(strcmp($about_txt, "") == 0): ?>
              <input type="submit" name="add" id="add" value="ADD" class="btn btn-neutral btn-width-100 padding-10"/>  
              <?php else: ?>
              <input type="submit" name="update" id="update" value="UPDATE" class="btn btn-neutral btn-width-100 padding-10"/>  
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