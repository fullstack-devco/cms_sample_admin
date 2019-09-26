<?php  
  $mysqli = new mysqli('localhost','id11005518_cms_admin','JesusSaves0211!','id11005518_cms_sample') or die(mysqli_error($mysqli));

  if(isset($_POST["add"])) {  
    $contact_email = validateInput($_POST["contact_email"]);
    $contact_num = validateInput($_POST["contact_num"]);
    $admin_id = validateInput($_POST["admin_id"]);

    $result = $mysqli->query("INSERT INTO contact_tbl (contact_email, contact_num, admin_id) VALUES  ('$contact_email','$contact_num',$admin_id)") or die($mysqli->error());
  
    if($result) {
      echo '<script>alert("Successfully added contact info")</script>';
    }

    //header("refresh:0.5; url=../edit_contact.php");
    ?>
    <script>
      setTimeout(function() { 
          window.location = "../edit_contact.php"; 
      }, 500);
    </script>
    <?php
  }

  if(isset($_POST["update"])) {  
    $contact_email = validateInput($_POST["contact_email"]);
    $contact_num = validateInput($_POST["contact_num"]);
    $contact_id = validateInput($_POST["contact_id"]);

    $result = $mysqli->query("UPDATE contact_tbl SET contact_email = '$contact_email', contact_num = '$contact_num' WHERE contact_id = $contact_id") or die($mysqli->error());

    if($result) {
      echo '<script>alert("Successfully updated contact info")</script>';
    }
    
    //header("refresh:0.5; url=../edit_contact.php");
    ?>
    <script>
      setTimeout(function() { 
          window.location = "../edit_contact.php"; 
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