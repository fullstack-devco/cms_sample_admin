<?php
  $mysqli = new mysqli('localhost','id11005518_cms_admin','JesusSaves0211!','id11005518_cms_sample') or die(mysqli_error($mysqli));

  $admin_id = "";
  $unameSession = "";

  $unameSession = validateInputSession($_SESSION["uname"]); //Get logged user session detail

  //Check for the admin_id of logged user
  $result = $mysqli->query("SELECT admin_id FROM admin_tbl WHERE admin_uname = '$unameSession'") or die($mysqli->error());

  $count = mysqli_num_rows($result);
  if($count == 1) {
    while($row = $result->fetch_assoc()) {
      $admin_id = $row['admin_id']; //Set admin_id of logged user
    }
  }

  //Perform validation to avoid potential hacking of inputs
  function validateInputSession($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>