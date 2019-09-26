<?php 
  //Check if user is already logged
  if(isset($_SESSION['uname'])){
    //header("location: ../inbox.php"); //Redirect user to inbox page if true
    ?>
    <script>
      setTimeout(function() { 
          window.location = "../inbox.php"; 
      }, 0);
    </script>
    <?php
  }
?>