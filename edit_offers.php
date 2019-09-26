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
    <link rel="stylesheet" href="css/pages/edit_offers.css" />
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
        <h1 class="h1">Offers</h1>
        <span class="color-light-blue">You can edit offers info on this page</span>
      </div>
      <!--CONTENT HOLDER-->
      <div id="content-holder">
        <?php require_once("process/edit_offers.php"); ?>

        <!--IMG-->
        <div id="img-holder">
          <div></div>
          <div id="img-content">
            <?php if($offers_img == ""): ?>
            <img src="" alt="">
            <?php else: ?>
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($offers_img).'" style="width: 100%; height: 120px;" />'; ?> 
            <?php endif; ?>
          </div>
          <div></div>
        </div>

        <!--FORM-->
        <form action="process/edit_offers.php" id="form-holder" method="post" enctype="multipart/form-data">  
          <div style="display: none;">
            <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
            <input type="hidden" name="offers_id" value="<?php echo $offers_id; ?>">
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
              <input type="text" name="offers_name" id="offers_name" class="input input-width-100 padding-20 margin-top-bottom-5" placeholder="Add offer name here" value="<?php echo $offers_name; ?>" required>
            </div>
            <div class="form-content-white-space"></div>
          </div>

          <div class="form-content-holder margin-top-bottom-5">
            <div class="form-content-white-space"></div>
            <div>
              <input type="text" name="offers_desc" id="offers_desc" class="input input-width-100 padding-20 margin-top-bottom-5" placeholder="Add offer description here" value="<?php echo $offers_desc; ?>" required>
            </div>
            <div class="form-content-white-space"></div>
          </div>

          <div class="form-content-holder margin-top-bottom-5">
            <div class="form-content-white-space"></div>
            <div>
              <?php if((strcmp($offers_name, "") == 0) && (strcmp($offers_desc, "") == 0)): ?>
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
            <div class="box-white bg-black color-white padding-10">DESCRIPTION</div>
            <div class="box-white bg-black color-white padding-10">EDIT</div>
            <div class="box-white bg-black color-white padding-10">DELETE</div>
          </div>
          <?php $result = $mysqli->query("SELECT * FROM offers_tbl") or die($mysqli->error());?>
          <?php while($row = $result->fetch_assoc()) {?>
            <?php $offers_id = $row['offers_id']; ?>
            <?php $offers_img = $row['offers_img']; ?>
            <?php $offers_name = $row['offers_name']; ?>
            <?php $offers_desc = $row['offers_desc']; ?>
            <div id="table-tr">
              <div class="table-td">
                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($offers_img).'" style="width: 100%; height: 120px;" />'; ?>
              </div>
              <div class="table-td padding-top-bottom-10 vertical-align-center">
                <?php echo $offers_name; ?>
              </div>
              <div class="table-td padding-top-bottom-10 offers-row-desc">
                <?php echo $offers_desc; ?>
              </div>
              <div class="table-td padding-top-bottom-10 vertical-align-center">
                <a class="btn btn-positive btn-width-100 padding-10" href="edit_offers.php?edit=<?php echo $offers_id; ?>">Edit</a>
              </div>
              <div class="table-td padding-top-bottom-10 vertical-align-center">
                <a class="btn btn-negative btn-width-100 padding-10" href="process/edit_offers.php?delete=<?php echo $offers_id; ?>">Delete</a>
              </div>
            </div>
          <?php } ?>
          <!--PUT EXTRA TR TO VIEW ALL TABLE TR CONTENTS-->
          <div id="table-tr-blank">
            <div></div>
            <div></div>
            <div></div>
          </div>
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