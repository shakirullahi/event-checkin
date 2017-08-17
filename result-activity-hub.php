<?php
error_reporting(0);
include("config.php");
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>IEDC Summit 2017 - Activity Hub</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css">
  <style>
    BODY, TD {
      font-family:Arial, Helvetica, sans-serif;
      font-size:12px;
    }
  </style>
</head>
<body>

  <div class="container">

    <div class="row" id="first-container-normal">
      <div class="col">
          <br><br><br>
          <h3>Activity Hub</h3>
          <br><br>
      </div>
    </div>

  <div class="row">

    <?php

    $sql_hub = "SELECT * FROM " . $SETTINGS['data_table'] . " where score !=0 order by score DESC limit 10";
    $r_hub = mysqli_query($connection,$sql_hub) or die ('request "Could not execute SQL query"');
    echo '<ul class="list-group col-4"><li class="list-group-item active">Activity Hub result</li>';
    if (mysqli_num_rows($r_hub)>0) {
      while ($row = mysqli_fetch_assoc($r_hub)) {
        echo '<li class="list-group-item"><div class="btn"><span class="badge badge-secondary">'.$row['score'].'</span></div> - '.$row['name'].' - <span class="">'.$row['college'].'</span></li>';
      }
    }
    echo "</ul><br>";
    ?>
    </div>
  </div>

<!-- Script starts -->
<!-- <script src="js/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script type="text/javascript" src="js/jquery-1.12.4.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.bootstrap4.min.js"></script>
<!-- Script ends -->

</body>
</html>
