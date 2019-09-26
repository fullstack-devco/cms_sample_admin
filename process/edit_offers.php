<?php  
  $mysqli = new mysqli('localhost','id11005518_cms_admin','JesusSaves0211!','id11005518_cms_sample') or die(mysqli_error($mysqli));

  $offers_id = 0;
  $offers_img = "";
  $offers_name = "";
  $offers_desc = "";
  $update = false;  

  if(isset($_POST["add"])) {  
    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $offers_name = validateInput($_POST["offers_name"]);
    $offers_desc = validateInput($_POST["offers_desc"]);
    $admin_id = validateInput($_POST["admin_id"]);

    $result = $mysqli->query("INSERT INTO offers_tbl (offers_img, offers_name, offers_desc, admin_id) VALUES  ('$file','$offers_name','$offers_desc',$admin_id)") or die($mysqli->error());

    if($result) {
      echo '<script>alert("Successfully added offer")</script>';
    }
  
    //header("refresh:0.5; url=../edit_offers.php");
    ?>
    <script>
      setTimeout(function() { 
          window.location = "../edit_offers.php"; 
      }, 500);
    </script>
    <?php
  }

  if(isset($_GET['delete'])) {
    $offers_id = $_GET['delete'];

    $result = $mysqli->query("DELETE FROM offers_tbl WHERE offers_id = $offers_id") or die($mysqli->error());

    if($result) {
      echo '<script>alert("Successfully deleted offer")</script>';
    }

    //header("refresh:0.5; url=../edit_offers.php");
    ?>
    <script>
      setTimeout(function() { 
          window.location = "../edit_offers.php"; 
      }, 500);
    </script>
    <?php
  }

  if(isset($_GET['edit'])) {
    $offers_id = $_GET['edit'];
    $update = true;

    $result = $mysqli->query("SELECT * FROM offers_tbl WHERE offers_id = $offers_id") or die($mysqli->error());
    $count = mysqli_num_rows($result);

    if($count == 1) {
      $row = $result->fetch_array();
      $offers_id = $row['offers_id'];
      $offers_img = $row['offers_img'];
      $offers_name = $row['offers_name'];
      $offers_desc = $row['offers_desc'];
    }
  }

  if(isset($_POST["update"])) {  
    $file_name = $_FILES["image"]["name"];
    $offers_id = validateInput($_POST["offers_id"]);
    $offers_name = validateInput($_POST["offers_name"]);
    $offers_desc = validateInput($_POST["offers_desc"]);

    if($file_name == "") {
      $result = $mysqli->query("UPDATE offers_tbl SET offers_name = '$offers_name', offers_desc = '$offers_desc' WHERE offers_id = $offers_id") or die($mysqli->error());

      if($result) {
        echo '<script>alert("Successfully updated offer")</script>';
      }
    } else {
      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

      $result = $mysqli->query("UPDATE offers_tbl SET offers_img = '$file', offers_name = '$offers_name', offers_desc = '$offers_desc' WHERE offers_id = $offers_id") or die($mysqli->error());

      if($result) {
        echo '<script>alert("Successfully updated offer")</script>';
      }
    }
    
    //header("refresh:0.5; url=../edit_offers.php");
    ?>
    <script>
      setTimeout(function() { 
          window.location = "../edit_offers.php"; 
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