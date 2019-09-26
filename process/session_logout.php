<?php 
  $valid = true;

  //Check if user is not logged
  if(!isset($_SESSION['uname'])){
    //header("location: ../index.php?valid=".$valid); //Redirect user to login page if true
    ?>
    <script>
      setTimeout(function() { 
        var valid = "<?php echo $valid; ?>";
        window.location = "../index.php?valid="+valid; 
      }, 0);
    </script>
    <?php
  }
?>