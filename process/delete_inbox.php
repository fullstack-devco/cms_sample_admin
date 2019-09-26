<?php
  $mysqli = new mysqli('localhost','id11005518_cms_admin','JesusSaves0211!','id11005518_cms_sample') or die(mysqli_error($mysqli));

  if(isset($_POST["delete"])) {
    $chkarr = $_POST["checkbox"];

    foreach($chkarr as $inbox_id) {
      $mysqli->query("DELETE FROM inbox_tbl WHERE inbox_id = $inbox_id") or die($mysqli->error());
    }

    echo '<script>alert("Successfully deleted selected inbox message/s")</script>';

    ?>
    <script>
      setTimeout(function() { 
          window.location = "../inbox.php"; 
      }, 500);
    </script>
    <?php
  }
?>