<?php  
  $mysqli = new mysqli('localhost','id11005518_cms_admin','JesusSaves0211!','id11005518_cms_sample') or die(mysqli_error($mysqli));

  $services_id = 0;
  $services_img = "";
  $services_name = "";
  $update = false;  

  if(isset($_POST["add"])) {  
    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $services_name = validateInput($_POST["services_name"]);
    $admin_id = validateInput($_POST["admin_id"]);

    $result = $mysqli->query("INSERT INTO services_tbl (services_img, services_name, admin_id) VALUES  ('$file','$services_name',$admin_id)") or die($mysqli->error());

    if($result) {
      echo '<script>alert("Successfully added service")</script>';
    }
  
    //header("refresh:0.5; url=../edit_services.php");
    ?>
    <script>
      setTimeout(function() { 
          window.location = "../edit_services.php"; 
      }, 500);
    </script>
    <?php
  }

  if(isset($_GET['delete'])) {
    $services_id = $_GET['delete'];

    $result = $mysqli->query("DELETE FROM services_tbl WHERE services_id = $services_id") or die($mysqli->error());

    if($result) {
      echo '<script>alert("Successfully deleted service")</script>';
    }

    //header("refresh:0.5; url=../edit_services.php");
    ?>
    <script>
      setTimeout(function() { 
          window.location = "../edit_services.php"; 
      }, 500);
    </script>
    <?php
  }

  if(isset($_GET['edit'])) {
    $services_id = $_GET['edit'];
    $update = true;

    $result = $mysqli->query("SELECT * FROM services_tbl WHERE services_id = $services_id") or die($mysqli->error());
    $count = mysqli_num_rows($result);

    if($count == 1) {
      $row = $result->fetch_array();
      $services_id = $row['services_id'];
      $services_img = $row['services_img'];
      $services_name = $row['services_name'];
    }
  }

  if(isset($_POST["update"])) {  
    $file_name = $_FILES["image"]["name"];
    $services_id = validateInput($_POST["services_id"]);
    $services_name = validateInput($_POST["services_name"]);

    if($file_name == "") {
      $result = $mysqli->query("UPDATE services_tbl SET services_name = '$services_name' WHERE services_id = $services_id") or die($mysqli->error());

      if($result) {
        echo '<script>alert("Successfully updated service")</script>';
      }
    } else {
      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

      $result = $mysqli->query("UPDATE services_tbl SET services_img = '$file', services_name = '$services_name' WHERE services_id = $services_id") or die($mysqli->error());

      if($result) {
        echo '<script>alert("Successfully updated service")</script>';
      }
    }
    
    //header("refresh:0.5; url=../edit_services.php");
    ?>
    <script>
      setTimeout(function() { 
          window.location = "../edit_services.php"; 
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