<?php  
  $mysqli = new mysqli('localhost','id11005518_cms_admin','JesusSaves0211!','id11005518_cms_sample') or die(mysqli_error($mysqli));

  if(isset($_POST["add"])) {  
    $file_name = $_FILES["image"]["name"];
    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $main_txt = validateInput($_POST["main_txt"]);
    $sub_txt = validateInput($_POST["sub_txt"]);
    $admin_id = validateInput($_POST["admin_id"]);

    $result = $mysqli->query("INSERT INTO header_tbl (header_file_name, header_img, header_main_txt, header_sub_txt, admin_id) VALUES  ('$file_name','$file','$main_txt','$sub_txt', $admin_id)") or die($mysqli->error());

    if($result) {
      echo '<script>alert("Successfully added header banner")</script>';
    }
  
    //header("refresh:0.5; url=../edit_header.php");
    ?>
    <script>
      setTimeout(function() { 
          window.location = "../edit_header.php"; 
      }, 500);
    </script>
    <?php
  }

  if(isset($_POST["update"])) {  
    $file_name = $_FILES["image"]["name"];
    $main_txt = validateInput($_POST["main_txt"]);
    $sub_txt = validateInput($_POST["sub_txt"]);
    $header_id = validateInput($_POST["header_id"]);

    if($file_name == "") {
      $result = $mysqli->query("UPDATE header_tbl SET header_main_txt = '$main_txt', header_sub_txt = '$sub_txt' WHERE header_id = $header_id") or die($mysqli->error());

      if($result) {
        echo '<script>alert("Successfully updated header banner")</script>';
      }
    } else {
      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

      $result = $mysqli->query("UPDATE header_tbl SET header_file_name = '$file_name', header_img = '$file', header_main_txt = '$main_txt', header_sub_txt = '$sub_txt' WHERE header_id = $header_id") or die($mysqli->error());

      if($result) {
        echo '<script>alert("Successfully updated header banner")</script>';
      }
    }
    
    //header("refresh:0.5; url=../edit_header.php");
    ?>
    <script>
      setTimeout(function() { 
          window.location = "../edit_header.php"; 
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