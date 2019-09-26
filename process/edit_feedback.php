<?php  
  $mysqli = new mysqli('localhost','id11005518_cms_admin','JesusSaves0211!','id11005518_cms_sample') or die(mysqli_error($mysqli));

  $feedback_id = 0;
  $feedback_txt = "";
  $feedback_from = "";
  $update = false;  

  if(isset($_POST["add"])) {  
    $feedback_txt = validateInput($_POST["feedback_txt"]);
    $feedback_from = validateInput($_POST["feedback_from"]);
    $admin_id = validateInput($_POST["admin_id"]);

    $result = $mysqli->query("INSERT INTO feedback_tbl (feedback_txt, feedback_from, admin_id) VALUES  ('$feedback_txt','$feedback_from',$admin_id)") or die($mysqli->error());

    if($result) {
      echo '<script>alert("Successfully added feedback info")</script>';
    }
  
    //header("refresh:0.5; url=../edit_feedback.php");
    ?>
    <script>
      setTimeout(function() { 
          window.location = "../edit_feedback.php"; 
      }, 500);
    </script>
    <?php
  }

  if(isset($_GET['delete'])) {
    $feedback_id = $_GET['delete'];

    $result = $mysqli->query("DELETE FROM feedback_tbl WHERE feedback_id = $feedback_id") or die($mysqli->error());

    if($result) {
      echo '<script>alert("Successfully deleted feedback info")</script>';
    }

    //header("refresh:0.5; url=../edit_feedback.php");
    ?>
    <script>
      setTimeout(function() { 
          window.location = "../edit_feedback.php"; 
      }, 500);
    </script>
    <?php
  }

  if(isset($_GET['edit'])) {
    $feedback_id = $_GET['edit'];
    $update = true;

    $result = $mysqli->query("SELECT * FROM feedback_tbl WHERE feedback_id = $feedback_id") or die($mysqli->error());
    $count = mysqli_num_rows($result);

    if($count == 1) {
      $row = $result->fetch_array();
      $feedback_id = $row['feedback_id'];
      $feedback_txt = $row['feedback_txt'];
      $feedback_from = $row['feedback_from'];
    }
  }

  if(isset($_POST["update"])) {  
    $feedback_id = validateInput($_POST["feedback_id"]);
    $feedback_txt = validateInput($_POST["feedback_txt"]);
    $feedback_from = validateInput($_POST["feedback_from"]);

    $result = $mysqli->query("UPDATE feedback_tbl SET feedback_txt = '$feedback_txt', feedback_from = '$feedback_from' WHERE feedback_id = $feedback_id") or die($mysqli->error());
    
    if($result) {
      echo '<script>alert("Successfully updated feedback info")</script>';
    }

    //header("refresh:0.5; url=../edit_feedback.php");
    ?>
    <script>
      setTimeout(function() { 
          window.location = "../edit_feedback.php"; 
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