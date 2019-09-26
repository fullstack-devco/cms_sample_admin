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
    <link rel="stylesheet" href="css/pages/edit_services_extra.css" />
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
        <h1 class="h1">Services Extra</h1>
        <span class="color-light-blue">You can edit services extra banner on this page</span>
      </div>
      <!--CONTENT HOLDER-->
      <div id="content-holder">
        <?php $result = $mysqli->query("SELECT * FROM services_extra_tbl") or die($mysqli->error());?>
        <?php $row = $result->fetch_array(); ?>
        <!--IMG-->
        <div id="img-holder">
          <div></div>
          <div id="img-content">
            <?php if($row['services_extra_img'] == null): ?>
            <img src="" alt="">
            <?php else: ?>
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['services_extra_img']).'" style="width: 100%; height: 150px;" />'; ?> 
            <?php endif; ?>
          </div>
          <div></div>
        </div>

        <!--FORM-->
        <form action="process/edit_services_extra.php" id="form-holder" method="post" enctype="multipart/form-data">  
          <div style="display: none;">
            <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
            <input type="hidden" name="services_extra_id" value="<?php echo $row['services_extra_id']; ?>">
          </div>

          <div class="form-content-holder margin-top-bottom-5">
            <div class="form-content-white-space"></div>
            <div>
              <input type="file" name="image" id="image"/>  
            </div>
            <div class="form-content-white-space"></div>
          </div>

          <div class="form-content-holder margin-top-bottom-5">
            <div class="form-content-white-space"></div>
            <div>
              <input type="text" name="main_txt" id="main_txt" class="input input-width-100 padding-20 margin-top-bottom-5" placeholder="Add main text here" value="<?php echo $row['services_extra_main_txt']; ?>" required>
            </div>
            <div class="form-content-white-space"></div>
          </div>

          <div class="form-content-holder margin-top-bottom-5">
            <div class="form-content-white-space"></div>
            <div>
              <input type="text" name="sub_txt" id="sub_txt" class="input input-width-100 padding-20 margin-top-bottom-5" placeholder="Add sub text here" value="<?php echo $row['services_extra_sub_txt']; ?>"  required>
            </div>
            <div class="form-content-white-space"></div>
          </div>

          <div class="form-content-holder margin-top-bottom-5">
            <div class="form-content-white-space"></div>
            <div>
              <?php if((strcmp($row['services_extra_main_txt'], "") == 0) && (strcmp($row['services_extra_sub_txt'], "") == 0)): ?>
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

    <script src="js/jquery.js"></script>
    <script src="js/add_img.js"></script>
  </body>
</html>