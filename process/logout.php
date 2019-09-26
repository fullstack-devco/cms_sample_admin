<?php
  require_once("session.php");

  //Destroying the session clears the $_SESSION variable, thus "logging" the user
  //out. This also happens automatically when the browser is closed
  session_destroy();

  $valid = true;

  //Redirect user to login page
  //header("location: ../index.php?valid=".$valid);

  ?>
  <script>
    var valid = "<?php echo $valid; ?>";
    setTimeout(function() { 
        window.location = "../index.php?valid="+valid; 
    }, 0);
  </script>
  <?php
?>