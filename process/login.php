<?php
  require_once("session.php");
  require_once("session_login.php");

  $mysqli = new mysqli('localhost','id11005518_cms_admin','JesusSaves0211!','id11005518_cms_sample') or die(mysqli_error($mysqli));

  $uname = "";
  $pw = "";
  $valid = true;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Check field validity
    if(strcmp($_POST["uname"], "") == 0 || strcmp($_POST["pw"], "") == 0) {
      //header("location: ../index.php"); //Redirect user to login page if all field is blank
      ?>
      <script>
        setTimeout(function() { 
            window.location = "../index.php"; 
        }, 0);
      </script>
      <?php
    }
    
    $uname = validateInput($_POST["uname"]);
    $pw = validateInput($_POST["pw"]);

    //Check if user exist
    $result = $mysqli->query("SELECT admin_pw FROM admin_tbl WHERE admin_uname = '$uname'") or die($mysqli->error());
    $count = mysqli_num_rows($result);
    if($count == 1) {
      while($row = $result->fetch_assoc()){
        $pw_hash = $row['admin_pw'];
        if (password_verify($pw, $pw_hash)) {
          $_SESSION['uname'] = $uname; // Initializing Session
          //header("location: ../inbox.php"); //Go to main page if login is successful
          ?>
          <script>
            setTimeout(function() { 
                window.location = "../inbox.php"; 
            }, 0);
          </script>
          <?php
        }
      }
    } else {
      $valid = false; //Change valid value to false if user account checking failed
    }
  }
  
  //Perform validation to avoid potential hacking of inputs
  function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>