<!--Check for session first-->
<?php require_once("process/session.php"); ?>
<?php require_once("process/session_logout.php"); ?>
<!--Setup session-->
<?php require_once("process/session_setup.php"); ?>
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
    <link rel="stylesheet" href="css/pages/inbox.css" />
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
                <li><a class="link-btn active" href="inbox.php">Inbox</a></li>
                <li><a class="link-btn" href="manage.php">Manage</a></li>
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
          <div id="section-menu" class="shadow">
            <form method="post" action="process/delete_inbox.php">
              <div class="section-menu-inbox-list">
                <?php $selected_inbox = ""; ?>
                <?php if(isset($_GET['msg'])) { ?>
                  <?php $selected_inbox = $_GET['msg']; ?>
                  <?php $mysqli->query("UPDATE inbox_tbl SET inbox_status = 1 WHERE inbox_id = $selected_inbox") or die($mysqli->error()); ?>
                <?php } ?>
                <?php $result = $mysqli->query("SELECT inbox_id, inbox_date, inbox_status FROM inbox_tbl ORDER BY inbox_date DESC, inbox_status ASC") or die($mysqli->error());?>
                <?php while($row = $result->fetch_assoc()) { ?>
                  <?php $inbox_id = $row['inbox_id']; ?>
                  <?php $inbox_status = $row['inbox_status']; ?>
                  <?php $inbox_status_txt = "unread"; ?>
                  <?php if($inbox_status == 1) { ?>
                    <?php $inbox_status_txt = "read"; ?>
                  <?php }?>
                  <?php $inbox_date = $row['inbox_date']; ?>
                  <?php $date_sent = date('Y-m-d h:i:s a', strtotime($inbox_date)); ?>
                  <div class="inbox_list_row inbox_list_row_flex">
                    <div class="inbox_list_row_checkbox">
                      <input type="checkbox" name="checkbox[]" value="<?php echo $inbox_id; ?>">
                    </div>
                    <div class="inbox_list_row_date_status">
                      <?php if($inbox_status == 0): ?>
                        <a class="text-bold" href="inbox.php?msg=<?php echo $inbox_id; ?>" style="width: 100%; height: 50px; font-family: Arial; font-weight: bold; font-size: 12px; color: #29434e;">
                          <?php echo $date_sent . " | " . $inbox_status_txt; ?>
                        </a>
                      <?php else: ?>
                        <a href="inbox.php?msg=<?php echo $inbox_id; ?>" style="width: 100%; height: 50px; font-family: Arial; font-size: 12px; color: #29434e;">
                          <?php echo $date_sent . " | " . $inbox_status_txt; ?>
                        </a>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php } ?>
              </div>
              <div class="delete_inbox">
                <input type="submit" name="delete" id="delete" value="Delete" class="delete_inbox_btn btn-negative"/>  
                <!-- <div id="delete" class="delete_inbox_btn btn-negative">Delete</div> -->
              </div>
            </form>
          </div>
          <div id="section-content">
            <?php if(strcmp($selected_inbox,"") == 0) { ?>
              <iframe src="" name="iframe" id="iframe">
              </iframe>
            <?php } else { ?>
              <iframe src="inbox_message.php?msg=<?php echo $selected_inbox; ?>" name="iframe" id="iframe">
              </iframe>
            <?php }  ?>
          </div> 
        </div>
      </section>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/side_nav.js"></script>
    <script src="js/change_nav_on_scroll.js"></script>
    <script src="js/set_active_link.js"></script>
  </body>
</html>