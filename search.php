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

  <title>IEDC Summit 2017 - Registration</title>
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
          <h3>Confirmed Participant List</h3>
          <br><br>
      </div>
    </div>

    <div class="row" id="second-container">
      <div class="col">
        <a href="index.html" class="btn btn-light btn-block">Home</a>
      </div>
      <div class="col">
        <a href="search-new.php" class="btn btn-light btn-block">Check In</a>
      </div>      
      <div class="col">
        <a href="register.php" class="btn btn-light btn-block">New Registration</a>
      </div>
      <div class="col">
        <a href="checkedlist.php" class="btn btn-light btn-block">Checked In List</a>
      </div>
      <!-- <div class="col">
	      <a href="activity-hub.php" class="btn btn-light btn-block">Activity Hub</a>
	    </div> -->
    </div>

    <hr>

    <!-- Manual search starts here -->
    <!-- <div class="row">
      <div class="col">
        <form id="form1" name="form1" method="post" action="search.php">
          <div class="row">
            <div class="col-2">
              <label for="name" class="col-form-label">Name</label>
            </div>

              <div class="col-6">
                <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="<?php echo $_REQUEST['name']; ?>">
              </div>
              <div class="col-2">
                <input type="submit" name="button" id="button" value="Find" class="btn btn-secondary"/>
              </div>

            <div class="col-2">
              <a href="search.php" class="form-control"> Reset</a>
            </div>
          </div>
        </form>
      </div>

      <div class="col">
        <form id="form1" name="form1" method="post" action="search.php">
          <div class="row">
            <div class="col-2">
              <label for="inputEmail3" class="col-form-label">College</label>
            </div>

              <div class="col-6">
                <select class="form-control" name="college">
                      <option>--Select--</option>
                      <option>Bangalore</option>
                      <option>Kolkata</option>
                      <option>Madras</option>
                      <option>Sri Lanka</option>
                      <option>Pune</option>
                </select>
              </div>
              <div class="col-2">
                <input type="submit" name="button" id="button" value="Find" class="btn btn-secondary"/>
              </div>

            <div class="col-2">
              <a href="search.php" class="form-control"> Reset</a>
            </div>
          </div>
        </form>
      </div>

    </div> -->
    <!-- Manual search ends here -->


    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Sl.No.</th>
                <th>Name</th>
                <th>College</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Check In</th>
            </tr>
        </thead>
        <tbody>

          <?php
            if ($_REQUEST["name"]<>'') {
              $search_string = " AND name LIKE '%".$_REQUEST['name']."%'";
            $sql = "SELECT * FROM " . $SETTINGS['data_table'] . " WHERE slno>0 AND status='confirmed'" . $search_string;
            }

            elseif ($_REQUEST["college"]<>'') {
              $search_string = " AND college LIKE '%".$_REQUEST['college']."%'";
              $sql = "SELECT * FROM " . $SETTINGS['data_table'] . " WHERE slno>0 AND status='confirmed'" . $search_string;
            }

            else
            {
              $sql = "SELECT * FROM " . $SETTINGS['data_table'] . " WHERE status='confirmed'";
            }

            $sql_result = mysqli_query($connection,$sql) or die ('request "Could not execute SQL query" '.$sql);
            if (mysqli_num_rows($sql_result)>0) {
              while ($row = mysqli_fetch_assoc($sql_result)) {

            ?>
              <tr>
                <td><?php echo $row['slno']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><form action='checkin.php'> <input type="hidden" value="<?php echo $row['college']; ?>" name="college"> <?php echo $row['college']; ?></td>
                <td><?php echo (empty($row['email']))?" <input style='width:150px;background-color: #FFFFE0;' class='form-control form-control-sm' type='text' name='email' value=''>" :$row['email']; ?></td>
                <td><?php echo (empty($row['contact']))?" <input style='width:100px;background-color: #FFFFE0;' class='form-control form-control-sm' type='text' name='contact' value=''>" :$row['contact']; ?></td>
                <td>
                  <?php
                    echo "<input type='hidden' name='id' value='".$row['slno']."'> <input type='checkbox' name='faculty' value='Faculty'>Faculty <input class='btn btn-info' type='submit'value='Check In'></form>";
                  ?>
                </td>
              </tr>
            <?php
              }
            } else {
            ?>
            <tr><td colspan="5">No results found.</td>
            <?php
            }
            ?>

        </tbody>

        <tfoot>
            <tr>
                <th>Sl.No.</th>
                <th>Name</th>
                <th>College</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Check In</th>
            </tr>
        </tfoot>
    </table>

  </div>

<!-- Script starts -->
<!-- <script src="js/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script type="text/javascript" src="js/jquery-1.12.4.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
  } );
</script>
<!-- Script ends -->

</body>
</html>
