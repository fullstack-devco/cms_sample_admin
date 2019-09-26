<?php  
  $mysqli = new mysqli('localhost','id11005518_cms_admin','JesusSaves0211!','id11005518_cms_sample') or die(mysqli_error($mysqli));

  if(isset($_POST["add"])) {  
    $about_txt = validateInput($_POST["about_txt"]);
    $admin_id = validateInput($_POST["admin_id"]);

    $result = $mysqli->query("INSERT INTO about_tbl (about_txt, admin_id) VALUES  ('$about_txt', $admin_id)") or die($mysqli->error());

    if($result) {
      echo '<script>alert("Successfully added about message")</script>';
    }
  
    //header("refresh:0.5; url=../edit_about.php");
    ?>
    <script>
      setTimeout(function() { 
          window.location = "../edit_about.php"; 
      }, 500);
    </script>
    <?php
  }

  if(isset($_POST["update"])) {  
    $about_txt = validateInput($_POST["about_txt"]);
    $about_id = validateInput($_POST["about_id"]);

    $result = $mysqli->query("UPDATE about_tbl SET about_txt = '$about_txt' WHERE about_id = $about_id") or die($mysqli->error());

    if($result) {
      echo '<script>alert("Successfully updated about message")</script>';
    }
    
    //header("refresh:0.5; url=../edit_about.php");
    ?>
    <script>
      setTimeout(function() { 
          window.location = "../edit_about.php"; 
      }, 500);
    </script>
    <?php
  }
  
  //Perform validation to avoid potential hacking of inputs
  function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
 ?> 