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
<body class="activity-result-page">

  <div class="container activity-result-page">

    <div class="row" id="first-container-normal">
      <div class="col">
        <br>
          <h5>Activity Hub - Leaderbaord</h5>
          <br>
      </div>
    </div>


    <?php

    $sql_hub = "SELECT * FROM " . $SETTINGS['data_table'] . " where score !=0 order by score DESC limit 10";
    $r_hub = mysqli_query($connection,$sql_hub) or die ('request "Could not execute SQL query"');

    if (mysqli_num_rows($r_hub)>0) {
      while ($row = mysqli_fetch_assoc($r_hub)) {
        echo '<div class="row">
      <div class="col-12 leader-board-item">
        <div class="score-box">
          '.$row['score'].'
        </div>
        <div class="name-box">
          <div class="participant-name">
            '.$row['name'].'
          </div>
          <div class="participant-college">
            '.$row['college'].'
          </div>
        </div>
      </div>
    </div>';

        // echo '<li class="list-group-item"><div class="btn"><span class="badge badge-secondary">'.$row['score'].'</span></div> - '.$row['name'].' - <span class="">'.$row['college'].'</span></li>';
      }
    }
    echo "</ul><br>";
    ?>


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
