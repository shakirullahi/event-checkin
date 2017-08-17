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

    <div class="row" id="second-container">
      <div class="col">
        <a href="index.html" class="btn btn-light btn-block">Home</a>
      </div>
      <div class="col">
        <a href="checkedlist.php" class="btn btn-light btn-block">Checked In List</a>
      </div>
      <div class="col">
        <a href="register.php" class="btn btn-light btn-block">New Registration</a>
      </div>
      <div class="col">
	      <a href="activity-hub.php" class="btn btn-light btn-block">Activity Hub</a>
	    </div>

    </div>
    <hr>
  <div class="row">

    <?php
      if ($_REQUEST["name"]<>'') {
        $search_string = " AND name LIKE '%".$_REQUEST['name']."%'";
      $sql = "SELECT * FROM " . $SETTINGS['data_table'] . " WHERE slno>0 AND status='checkedin'" . $search_string;
      }

      elseif ($_REQUEST["college"]<>'') {
        $search_string = " AND college LIKE '%".$_REQUEST['college']."%'";
        $sql = "SELECT * FROM " . $SETTINGS['data_table'] . " WHERE slno>0 AND status='checkedin'" . $search_string;
      }

      else
      {
        $sql = "SELECT count(*) as total FROM " . $SETTINGS['data_table'] . " WHERE status='checkedin'";
        $sql_tot = "SELECT count(*) as total FROM " . $SETTINGS['data_table'];
        $sql_collegebycount = "SELECT college, count(*) as count FROM " . $SETTINGS['data_table'] . " group by college";
        $sql_studentscount = "SELECT count(*) as total FROM " . $SETTINGS['data_table'] . " where designation = 'Student' and status='checkedin'";
        $sql_facultycount = "SELECT count(*) as total FROM " . $SETTINGS['data_table'] . " where designation = 'Faculty' and status='checkedin'";
        $sql_visitorcount = "SELECT count(*) as total FROM " . $SETTINGS['data_table'] . " where designation = 'Visitor' and status='checkedin'";
        $sql_spotcount = "SELECT count(*) as total FROM " . $SETTINGS['data_table'] . " where spot = 1";

      }
      $r_studcount1 = mysqli_query($connection,$sql_tot) or die ('request "Could not execute SQL query"');
      while ($row = mysqli_fetch_assoc($r_studcount1)) {
        $alltot = $row['total'];
      }
      // $result = mysqli_query($connection,$sql) or die ('request "Could not execute SQL query" '.$sql);
      // Attendance
      $r_studcount = mysqli_query($connection,$sql_studentscount) or die ('request "Could not execute SQL query"');

      echo '<ul class="list-group col-4"><li class="list-group-item active">Attendance</li>';
      // print_r($r_studcount);die();
        while ($row = mysqli_fetch_assoc($r_studcount)) {

          echo '<li class="list-group-item">Students - '.$row['total'].'</li>';
          $tot = $row['total'];
        }

        $r_studcount = mysqli_query($connection,$sql_facultycount) or die ('request "Could not execute SQL query"');

        while ($row = mysqli_fetch_assoc($r_studcount)) {

          echo '<li class="list-group-item">Faculties - '.$row['total'].'</li>';
          $tot = $tot + $row['total'];
        }

        $r_visitcount = mysqli_query($connection,$sql_visitorcount) or die ('request "Could not execute SQL query"');

        while ($row = mysqli_fetch_assoc($r_visitcount)) {

          echo '<li class="list-group-item">Visiters - '.$row['total'].'</li>';
          $tot = $tot + $row['total'];
        }

        $r_studcount = mysqli_query($connection,$sql_spotcount) or die ('request "Could not execute SQL query"');

        while ($row = mysqli_fetch_assoc($r_studcount)) {

          echo '<li class="list-group-item" >Spot - '.$row['total'].'</li>';
        }
          // $tot = $tot + $row['total'];
      echo '<li class="list-group-item" style="font-size:22px">Total - '.$tot.'/'.$alltot.'</li>';
      echo "</ul><br>";
      // Attendance
      // college wise count
      $result = mysqli_query($connection,$sql_collegebycount) or die ('request "Could not execute SQL query"');
      echo '<ul class="list-group col-7"><li class="list-group-item active">College wise count</li>';
      if (mysqli_num_rows($result)>0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<li class="list-group-item">'.$row['college'].' <span style="float: right;">'.$row['count'].'</span></li>';
        }
      }
      echo "</ul>";
      // college wise count

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
