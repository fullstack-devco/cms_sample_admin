<?php  
  $mysqli = new mysqli('localhost','id11005518_cms_admin','JesusSaves0211!','id11005518_cms_sample') or die(mysqli_error($mysqli));

  if(isset($_POST["add"])) {  
    $file_name = $_FILES["image"]["name"];
    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $main_txt = validateInput($_POST["main_txt"]);
    $sub_txt = validateInput($_POST["sub_txt"]);
    $admin_id = validateInput($_POST["admin_id"]);

    $result = $mysqli->query("INSERT INTO services_extra_tbl (services_extra_img, services_extra_main_txt, services_extra_sub_txt, admin_id) VALUES  ('$file','$main_txt','$sub_txt', $admin_id)") or die($mysqli->error());

    if($result) {
      echo '<script>alert("Successfully added services extra banner")</script>';
    }
  
    //header("refresh:0.5; url=../edit_services_extra.php");
    ?>
    <script>
      setTimeout(function() { 
          window.location = "../edit_services_extra.php"; 
      }, 500);
    </script>
    <?php
  }

  if(isset($_POST["update"])) {  
    $file_name = $_FILES["image"]["name"];
    $main_txt = validateInput($_POST["main_txt"]);
    $sub_txt = validateInput($_POST["sub_txt"]);
    $services_extra_id = validateInput($_POST["services_extra_id"]);

    if($file_name == "") {
      $result = $mysqli->query("UPDATE services_extra_tbl SET services_extra_main_txt = '$main_txt', services_extra_sub_txt = '$sub_txt' WHERE services_extra_id = $services_extra_id") or die($mysqli->error());

      if($result) {
        echo '<script>alert("Successfully updated services extra banner")</script>';
      }
    } else {
      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

      $result = $mysqli->query("UPDATE services_extra_tbl SET services_extra_img = '$file', services_extra_main_txt = '$main_txt', services_extra_sub_txt = '$sub_txt' WHERE services_extra_id = $services_extra_id") or die($mysqli->error());

      if($result) {
        echo '<script>alert("Successfully updated services extra banner")</script>';
      }
    }
    
    //header("refresh:0.5; url=../edit_services_extra.php");
    ?>
    <script>
      setTimeout(function() { 
          window.location = "../edit_services_extra.php"; 
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

  function resize_image($file, $w, $h, $crop = FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
      if ($width > $height) {
        $width = ceil($width-($width*abs($r-$w/$h)));
      } else {
        $height = ceil($height-($height*abs($r-$w/$h)));
      }
      $newwidth = $w;
      $newheight = $h;
    } else {
      if ($w/$h > $r) {
        $newwidth = $h*$r;
        $newheight = $h;
      } else {
        $newheight = $w/$r;
        $newwidth = $w;
      }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
  }
 ?> 