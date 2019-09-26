<?php
  require_once("session.php");
  require_once("session_login.php");

  $mysqli = new mysqli('localhost','id11005518_cms_admin','JesusSaves0211!','id11005518_cms_sample') or die(mysqli_error($mysqli));

  $name = "";
  $uname = "";
  $pw = "";
  $pw_confirm = "";
  $valid = true;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Check field validity
    if(strcmp($_POST["name"], "") == 0 || 
        strcmp($_POST["uname"], "") == 0 ||
        strcmp($_POST["pw"], "") == 0 ||
        strcmp($_POST["pw_confirm"], "") == 0) {
          
      //header("location: index.php"); //Redirect user to login page if all field is blank
      ?>

        <script>
          setTimeout(function() { 
              window.location = "../index.php"; 
          }, 0);
        </script>

      <?php
    }

    $name = validateInput($_POST["name"]);
    $uname = validateInput($_POST["uname"]);
    $pw = validateInput($_POST["pw"]);
    $pw_confirm = validateInput($_POST["pw_confirm"]);

    //Check if user exist
    $result = $mysqli->query("SELECT admin_uname FROM admin_tbl WHERE admin_uname = '$uname'") or die($mysqli->error());
    $count = mysqli_num_rows($result);
    if($count == 1) {
      //Prompt user that account already exists
      echo '<script language="javascript">';
      echo 'alert("Username already exists. Please use another username and try again.")';
      echo '</script>';
    } else {
      if(!(strcmp($pw, $pw_confirm) == 0)) {
        //Prompt user that password and confirm password does not match
        echo '<script language="javascript">';
        echo 'alert("Warning! Password and confirm password does not match.")';
        echo '</script>';
      } else {
        //Encrypt password before saving for security
        $pw_hash = password_hash($pw, PASSWORD_DEFAULT);
        $mysqli->query("INSERT INTO admin_tbl (admin_name,admin_uname,admin_pw) VALUES ('$name','$uname','$pw_hash')") or die($mysqli->error());

        //Prompt user for successful registration
        echo '<script language="javascript">';
        echo 'alert("Successfull registration! You can now log in.")';
        echo '</script>';

        //header("refresh:1; url=index.php?valid=".$valid); //wait for 1 second before redirecting
        ?>
        <script>
          var valid = "<?php echo $valid; ?>";
          setTimeout(function() { 
              window.location = "../index.php?valid="+valid; 
          }, 500);
        </script>
        <?php
      }
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