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
    <link rel="stylesheet" href="css/pages/edit_services.css" />
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
        <h1 class="h1">Services</h1>
        <span class="color-light-blue">You can edit services info on this page</span>
      </div>
      <!--CONTENT HOLDER-->
      <div id="content-holder">
        <?php require_once("process/edit_services.php"); ?>

        <!--IMG-->
        <div id="img-holder">
          <div></div>
          <div id="img-content">
            <?php if($services_img == ""): ?>
            <img src="" alt="">
            <?php else: ?>
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($services_img).'" style="width: 40px; height: 40px;" />'; ?> 
            <?php endif; ?>
          </div>
          <div></div>
        </div>

        <!--FORM-->
        <form action="process/edit_services.php" id="form-holder" method="post" enctype="multipart/form-data">  
          <div style="display: none;">
            <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
            <input type="hidden" name="services_id" value="<?php echo $services_id; ?>">
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
              <input type="text" name="services_name" id="services_name" class="input input-width-100 padding-20 margin-top-bottom-5" placeholder="Add service name here" value="<?php echo $services_name; ?>" required>
            </div>
            <div class="form-content-white-space"></div>
          </div>

          <div class="form-content-holder margin-top-bottom-5">
            <div class="form-content-white-space"></div>
            <div>
              <?php if(strcmp($services_name, "") == 0): ?>
              <input type="submit" name="add" id="add" value="ADD" class="btn btn-neutral btn-width-100 padding-10" style="margin-left: 5px;"/>  
              <?php else: ?>
              <input type="submit" name="update" id="update" value="UPDATE" class="btn btn-neutral btn-width-100 padding-10" style="margin-left: 5px;"/>  
              <?php endif; ?>
            </div>
            <div class="form-content-white-space"></div>
          </div>
        </form>

        <br>

        <div id="table-holder">
          <div id="table-th">
            <div class="box-white bg-black color-white padding-10">IMAGE</div>
            <div class="box-white bg-black color-white padding-10">NAME</div>
            <div class="box-white bg-black color-white padding-10">EDIT</div>
            <div class="box-white bg-black color-white padding-10">DELETE</div>
          </div>
          <?php $result = $mysqli->query("SELECT * FROM services_tbl") or die($mysqli->error());?>
          <?php while($row = $result->fetch_assoc()) {?>
            <?php $services_id = $row['services_id']; ?>
            <?php $services_img = $row['services_img']; ?>
            <?php $services_name = $row['services_name']; ?>
            <div id="table-tr">
              <div class="table-td">
                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($services_img).'" style="width: 40px; height: 40px;" />'; ?>
              </div>
              <div class="table-td padding-top-bottom-10">
                <?php echo $services_name; ?>
              </div>
              <div class="table-td padding-top-bottom-10">
                <a class="btn btn-positive btn-width-100 padding-10" href="edit_services.php?edit=<?php echo $services_id; ?>">Edit</a>
              </div>
              <div class="table-td padding-top-bottom-10">
                <a class="btn btn-negative btn-width-100 padding-10" href="process/edit_services.php?delete=<?php echo $services_id; ?>">Delete</a>
              </div>
            </div>
          <?php } ?>
          <!--PUT EXTRA TR TO VIEW ALL TABLE TR CONTENTS-->
          <div id="table-tr-blank">
            <div></div>
            <div></div>
            <div></div>
          </div>
        </div>
      <!--END OF CONTENT HOLDER-->
      </div>
    <!--END OF MAIN CONTAINER-->
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/add_img.js"></script>
  </body>
</html>