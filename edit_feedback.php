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
    <link rel="stylesheet" href="css/pages/edit_feedback.css" />
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
        <h1 class="h1" style="margin-left: 5px;">Feedback</h1>
        <span class="color-light-blue" style="margin-left: 5px;">You can edit feedback info on this page</span>
      </div>
      <!--CONTENT HOLDER-->
      <div id="content-holder">
        <?php require_once("process/edit_feedback.php"); ?>
        <!--FORM-->
        <form action="process/edit_feedback.php" id="form-holder" method="post">  
          <div style="display: none;">
            <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
            <input type="hidden" name="feedback_id" value="<?php echo $feedback_id; ?>">
          </div>

          <div class="text-content-holder margin-top-bottom-5">
            <div class="form-content-white-space"></div>
            <div>
              <textarea rows="5" cols="50" name="feedback_txt" class="textarea textarea-about padding-20 margin-top-bottom-5" placeholder="Add feedback here" required style="margin-left: 5px;"><?php echo $feedback_txt; ?></textarea>
            </div>
            <div class="form-content-white-space"></div>
          </div>

          <div class="from-content-holder margin-top-bottom-5">
            <div class="form-content-white-space"></div>
            <div>
              <input type="text" name="feedback_from" id="feedback_from" class="input input-width-100 padding-20 margin-top-bottom-5" placeholder="Add person name here" value="<?php echo $feedback_from; ?>" required>
            </div>
            <div class="form-content-white-space"></div>
          </div>

          <div class="submit-content-holder margin-top-bottom-5">
            <div class="form-content-white-space"></div>
            <div>
              <?php if((strcmp($feedback_txt, "") == 0) && (strcmp($feedback_from, "") == 0)): ?>
              <input type="submit" name="add" id="add" value="ADD" class="btn btn-neutral btn-width-100 padding-10" style="margin-left: 5px;"/>  
              <?php else: ?>
              <input type="submit" name="update" id="update" value="UPDATE" class="btn btn-neutral btn-width-100 padding-10" style="margin-left: 5px;"/>  
              <?php endif; ?>
            </div>
            <div class="form-content-white-space"></div>
          </div>
        </form>

        <div id="table-holder">
          <div id="table-th">
            <div class="box-white bg-black color-white padding-10">FROM</div>
            <div class="box-white bg-black color-white padding-10">TEXT</div>
            <div class="box-white bg-black color-white padding-10">EDIT</div>
            <div class="box-white bg-black color-white padding-10">DELETE</div>
          </div>
          <?php $result = $mysqli->query("SELECT * FROM feedback_tbl") or die($mysqli->error());?>
          <?php while($row = $result->fetch_assoc()) {?>
            <?php $feedback_id = $row['feedback_id']; ?>
            <?php $feedback_txt = $row['feedback_txt']; ?>
            <?php $feedback_from = $row['feedback_from']; ?>
            <div id="table-tr">
              <div class="table-td padding-top-bottom-10 vertical-align-center">
                <?php echo $feedback_from; ?>
              </div>
              <div class="table-td padding-top-bottom-10 feedback-row-desc">
                <?php echo $feedback_txt; ?>
              </div>
              <div class="table-td padding-top-bottom-10 vertical-align-center">
                <a class="btn btn-positive btn-width-100 padding-10" href="edit_feedback.php?edit=<?php echo $feedback_id; ?>">Edit</a>
              </div>
              <div class="table-td padding-top-bottom-10 vertical-align-center">
                <a class="btn btn-negative btn-width-100 padding-10" href="process/edit_feedback.php?delete=<?php echo $feedback_id; ?>">Delete</a>
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
  </body>
</html>