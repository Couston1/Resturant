<?php 
require 'includes/topNav.php';
require 'includes/dbconnection.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export-csv</title>

    <link href="bootsrap/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link  rel="stylesheet" href="fontawsome/fontawesome-free-5.15.0-web/css/all.css">
    <link rel="stylesheet" href="bootsrap/bootstrap-datepicker.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />
    
    <!---header script!-->
    <script src="bootsrap/jquery-3.6.0.slim.js"></script>
    <script src="bootsrap/popper.min.js" ></script>
    <script src="bootsrap/bootstrap.min.js"></script>
    <script src="bootsrap/bootstrap-datepicker.js"></script>

    <script type="text/javascript" rel="stylesheet"> 
    $('document').ready(function()
    { 
    $(".alert").fadeIn(1000).fadeOut(5000); 
    }); 
  </script>

</head>
<body>
<div id="main"><span style="font-size:22px;cursor:pointer;font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;" onclick="openNav()">&#9776;Menu</span>
<?php 
include 'includes/Navbarcodes.php';
include 'includes/Supervisor-sideNav.php';
include 'includes/Navbarcodes.php';
include 'includes/Supervisor-Dashboard.php';
?>

<div class="container-fluid">
 <?php 
  if (isset($_SESSION['message'])): 
  ?>

      <div class="alert alert-<?=$_SESSION['msg_type']?>">

      <?php
      echo $_SESSION['message'];
      unset($_SESSION['message']);
      ?>
      </div>

   <?php endif ?>

<div class="row">

  <div class="col-sm-12">
      <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-weight: bold;font-size: 25px;text-align: center;">Export Data to Excel</div><br>

      <div class="row">
        <div class="col-sm-6">
          <div class="row">
            <form action="functions.php" method="Post" enctype="multipart/form-data">
              <button type="submit" name="exportbtn" class="btn btn-success btn-sm"><i class="fas fa-file-export"></i>Export All Data</button>
            </form>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="row">

          <form action="functions.php" method="POST" enctype="multipart/form-data">
            <div class="input-daterange">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <input type="date" class="form-control" name="start_date" />
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <div class="input-group">
                <input type="date" class="form-control" name="end_date" />
                <button type="submit" name="filterdateexport" class="btn btn-success btn-block"><i class="fas fa-file-export"></i></button>
                </div>
                </div>
              </div>
          </form>
          </div>
        </div>
      </div>


      </div>
      <span>
          <?php
            $sql = "SELECT * FROM billing_tbl";
            $query_run=mysqli_query($conn, $sql);

            $row = mysqli_num_rows($query_run);
            echo '<h2 class="float-right font-weight-bold" style="font-size:20px; text-align:center; color: green;">Total Records: '.$row.'</h2>';
        ?>

      </span>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
              <?php
              if (isset($_POST['start_date']) && isset($_POST['end_date']))
              {
                $from_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                
                $sql = "SELECT sum(total_sales) As total FROM billing_tbl WHERE search_date BETWEEN '$from_date' AND '$end_date'";
                $query_run = mysqli_query($conn, $sql);

                $row = mysqli_fetch_array($query_run);
                $Totalsales = $row['total'];
                echo '<h4 class="float-right font-weight-bold" style="font: size 20px;px; text-align:center">Total Sales:</h4>';
                echo '<h4 class="float-right font-weight-bold" style="font: size 20px;px; text-align:center">GHC: '.$Totalsales.'</h4>';
             

              }else
              $sql = "SELECT * FROM billing_tbl";
              $query_run=mysqli_query($conn, $sql);
              ?>

              <div class="scroll">
              <div class="table-responsive">
				     <table id="table" class="table table-bordered table-striped table-hover">
                <?php
              if (isset($_POST['start_date']) && isset($_POST['end_date']))
              {
              $from_date = $_POST['start_date'];
              $end_date = $_POST['end_date'];
              
              $sql = "SELECT * FROM billing_tbl WHERE search_date BETWEEN '$from_date' AND '$end_date'";
              $query_run = mysqli_query($conn, $sql);

              }else
              $sql = "SELECT * FROM billing_tbl";
              $query_run=mysqli_query($conn, $sql);
              ?>
     
                <thead style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    <tr>
                    <th scope="col">Inoviced No</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Cashier Name</th>
                    <th scope="col">Total Sales</th>
                    <th scope="col">Cash</th>
                    <th scope="col">Balance</th>
                    <th scope="col">Date Sold</th>
                    </tr>
                </thead>
                 <tbody style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    <?php

                    if(mysqli_num_rows($query_run))
                    {
                        while($row = mysqli_fetch_assoc($query_run))
                        {
                          $receiptid = $row['receiptid'];
                          $customer_name = $row['customer_name'];
                          $username = $row['username'];
                          $total_sales = $row['total_sales'];
                          $cash = $row['cash'];
                          $balance = $row['balance'];
                          $datesold = $row['datesold'];
            
                            
                        ?>
                    <tr>
                    <td><?= $receiptid; ?></td>
                    <td><?= $customer_name; ?></td>
                    <td><?= $username; ?></td>
                    <td><?= $total_sales; ?></td>
                    <td><?= $cash; ?></td>
                    <td><?= $balance; ?></td>
                    <td><?= $datesold; ?></td>
                    </tr>

                     <?php
                        }
                    }
                    else 
                    {    
                      echo '<h4 class="float-right font-weight-bold" style="font-size:20px; text-align:left;color:red;">No record found</h4>';
                    }
                    ?>
                  </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!--
<script>
$(document).ready(function(){
  $('.input-daterange').datepicker({
  todayBtn:'linked',
  format: "yyyy-mm-dd",
  autoclose: true
 });
});
</script>
-->



</div>
</div>  
</body>
</html>