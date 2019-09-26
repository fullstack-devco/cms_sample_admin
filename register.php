<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>CMS Admin</title>
    <link rel="stylesheet" href="css/fonts/font.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/pages/index.css" />
  </head>
  <body>
    <div id="body-container">
      <div id="main-container">
        <div class="main-container-blank-space"></div>
        <div id="form-container">
          <div class="form-container-blank-space"></div>
          <div id="form-holder" class="bg-white box-grey box-rect">
            <h3 class="header header-3 txt-align-center padding-20">CMS Admin</h3>
            <span class="header-3 font-light color-light-blue display-block txt-align-center padding-0">Register</span>
            <!--Check for session first-->
            <?php require_once("process/session.php"); ?>
            <?php require_once("process/session_login.php"); ?>
            <?php require_once("process/register.php"); ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="padding-20">
              <input type="text" id="name" class="input input-width-100 padding-20 margin-top-bottom-5" placeholder="Name" name="name" value="<?php echo $name; ?>" required autofocus>

              <input type="text" id="uname" class="input input-width-100 padding-20 margin-top-bottom-5" placeholder="Username" name="uname" value="<?php echo $uname; ?>" required autofocus>

              <input type="password" id="pw" class="input input-width-100 padding-20 margin-top-bottom-5" placeholder="Password" name="pw" value="<?php echo $pw; ?>" required>

              <input type="password" id="pw_confirm" class="input input-width-100 padding-20 margin-top-bottom-5" placeholder="Confirm Password" name="pw_confirm" value="<?php echo $pw_confirm; ?>" required>

              <button style="margin-bottom: 10px; margin-left: 5px;" class="btn btn-width-100 btn-positive padding-10 margin-top-bottom-5" id="register" type="submit" name="register">Register</button>
            </form>
          </div>
          <div class="form-container-blank-space"></div>
        </div>
        <div class="main-container-blank-space"></div>
      </div>
    </div>
  </body>
</html>
