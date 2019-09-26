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
    <link rel="stylesheet" href="css/pages/format.css" />
  </head>
  <body>
    <!--Check for session first-->
    <?php require_once("process/session.php"); ?>
    <?php require_once("process/session_logout.php"); ?>
    <!--Setup session-->
    <?php require_once("process/session_setup.php"); ?>
    <div id="main-container">
      <header id="top" class="header-banner">
        <nav id="nav">
          <div id="logo-div"><a href="#top">CMS</a></div>
          <div id="in-between-div"></div>
          <div id="nav-div">
            <div class="horizontal-nav">
              <ul id="menu">
                <li><a class="link-btn" href="#top"></a></li>
                <li><a class="link-btn" href="inbox.php">Inbox</a></li>
                <li><a class="link-btn active" href="manage.php">Manage</a></li>
                <li><a class="link-btn" href="process/logout.php">Logout</a></li>
              </ul>
            </div>
            <div id="sidenav-body" class="sidenav">
              <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
              <a href="inbox.php" onclick="closeNav()">Inbox</a>
              <a href="manage.php" onclick="closeNav()">Manage</a>
              <a href="process/logout.php" onclick="closeNav()">Logout</a>
            </div>
            <div id="sidenav-burger">
              <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
            </div>
          </div>
        </nav>
      </header>
      
      <section id="section">
        <div id="section-container">
          <!--SECTION MENU-->
          <div id="section-menu" class="shadow">
            <a class="section-menu-content padding-10 txt-align-center bg-black color-white margin-10 btn-neutral" href="edit_header.php" target="iframe">Header</a>
            <a class="section-menu-content padding-10 txt-align-center bg-black color-white margin-10 btn-neutral"  href="edit_about.php" target="iframe">About</a>
            <a class="section-menu-content padding-10 txt-align-center bg-black color-white margin-10 btn-neutral"  href="edit_services.php" target="iframe">Services</a>
            <a class="section-menu-content padding-10 txt-align-center bg-black color-white margin-10 btn-neutral"  href="edit_services_extra.php" target="iframe">Services Extra</a>
            <a class="section-menu-content padding-10 txt-align-center bg-black color-white margin-10 btn-neutral"  href="edit_offers.php" target="iframe">Offers</a>
            <a class="section-menu-content padding-10 txt-align-center bg-black color-white margin-10 btn-neutral"  href="edit_feedback.php" target="iframe">Feedback</a>
            <a class="section-menu-content padding-10 txt-align-center bg-black color-white margin-10 btn-neutral"  href="edit_contact.php" target="iframe">Contact</a>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
          </div>

          <!--SECTION CONTENT-->
          <div id="section-content">
            <iframe src="" name="iframe" id="iframe">
            </iframe>
          </div>

          <!--END OF SECTION CONTAINER-->
        </div>
      </section>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/side_nav.js"></script>
    <script src="js/change_nav_on_scroll.js"></script>
    <script src="js/set_active_link.js"></script>
  </body>
</html>