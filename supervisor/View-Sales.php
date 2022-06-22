<?php 
require 'includes/topNav.php';
require 'includes/dbconnection.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta  name="viewport" content="width=device-width 5, initial-scale=1.0">
    <title>Main-page</title>

    <link href="bootsrap/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link  rel="stylesheet" href="fontawsome/fontawesome-free-5.15.0-web/css/all.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />
    
    <!---header script!-->
    <script src="bootsrap/jquery-3.6.0.slim.js"></script>
    <script src="bootsrap/popper.min.js" ></script>
    <script src="bootsrap/bootstrap.min.js"></script>

    <style>
       .scroll
        {
            height: 300px;
            overflow-y: scroll;
        }
    </style>

    
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
<div class="row">
  <div class="col-sm-9">
      <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-weight: bold;font-size: 25px;text-align: center;">Menu Infomation</div><br>
      <div>
      <input style="text-align: center;" type="hidden" class="form-control form-control-sm" name="search_date" value="<?php echo date('Y-m-d');?>" readonly>
          <a href="export-csv.php"><button type="button" class="btn btn-success btn-sm"><i class="fas fa-file-export"></i>Export Data</button></a>
      </div><br>
      <span>
          <?php
            if (isset($_POST['start_date']) && isset($_POST['end_date']))
            {
              $from_date = $_POST['start_date'];
              $end_date = $_POST['end_date'];
              
              $sql = "SELECT * FROM billing_tbl WHERE search_date BETWEEN '$from_date' AND '$end_date'";
              $query_run = mysqli_query($conn, $sql);

              $row = mysqli_num_rows($query_run);
              echo '<h2 class="float-right font-weight-bold" style="font-size:20px; text-align:center; color: green;">Total Records: '.$row.'</h2>';  

            }
            else
            {
              $sql = "SELECT * FROM billing_tbl";
              $query_run=mysqli_query($conn, $sql);
  
              $row = mysqli_num_rows($query_run);
              echo '<h2 class="float-right font-weight-bold" style="font-size:20px; text-align:center; color: green;">Total Records: '.$row.'</h2>';

            }
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
              $sql = "SELECT * FROM billing_tbl ORDER BY receiptid DESC";
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
                    <th scope="col">View Details</th>
                    </tr>
                </thead>
                 <tbody style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    <?php

                    if(mysqli_num_rows($query_run))
                    {
                        while($row = mysqli_fetch_assoc($query_run))
                        {
                            
                        ?>
                    <tr>
                    <td><?php  echo $row['receiptid']; ?></td>
                    <td><?php  echo $row['customer_name']; ?></td>
                    <td><?php  echo $row['username']; ?></td>
                    <td><?php  echo $row['total_sales']; ?></td>
                    <td><?php  echo $row['cash']; ?></td>
                    <td><?php  echo $row['balance']; ?></td>
                    <td><?php  echo $row['datesold']; ?></td>

                    <td>
                    <input type="hidden" name="view_idnumber" value="<?php echo $row['receiptid']; ?>" readonly>
                    <button disabled type="button" name="viewdetails" class="btn btn-primary viewbtn"><i class="fa fa-eye" ></i></button>
                    </td>
             
                    </tr>

                     <?php
                        }
                    }else 
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




  <div class="col-sm-3">
    <div>
    <form action="" method="post">
      <label for="" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-weight: bold;font-size: 18px;text-align: center; color: black;"></label>
     <div class="row">
    
     <div class="col-md-6">
            <label for="">Start Date</label>
          <div class="form-group">
          <input type="date" class="form-control" name="start_date" required/>
          </div>
          </div>

          <div class="col-md-6">
          <label for="" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-weight: bold;font-size: 18px;text-align: center; color: black;">End Date</label>
          <div class="form-group">
          <div class="input-group">
          <input type="date" class="form-control" name="end_date" required/>
          <button type="submit" class="btn btn-success btn-block"><i class="fas fa-search"></i></button>
          </div>
          </div>
          </div>
    </form>
   </div><br>

    <div class="row">
      <div class="col">
      <div class="card">
      <div class="card-header" style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 18px;background-color: #442814;"></div>
      <div class="card-body">
      <i class="fas fa-database fa-2x"></i>

      <?php
        $sql = "SELECT sum(total_sales) As total FROM billing_tbl WHERE month(current_date)=month(datesold)";
        $result = mysqli_query($conn,$sql);

        $row = mysqli_fetch_array($result);
        $total_cost = $row['total'];
        echo '<h4 style="font-size:25px; text-align:center">Monthly Total Sales:</h4>';
        echo '<h4 style="font-size:25px; text-align:center">GHC: '.$total_cost.'</h4>';

      ?>

      </div>
      </div>
      </div>

    </div>

  </div>



  <!-- View food details data into modal table-->

  <div class="modal fade" id="viewmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <B>Sales Details</B></h5>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
      </div>
      <div class="modal-body">
      <div class="scroll">
      <div class="table-responsive">
      <form action="" method="post">
      <input type="text" name="receiptid" class="form-control" id="receiptid"/>
      <table id="table" class="table table-bordered table-striped table-hover">
                <?php
                  if (isset($_POST['viewdetails']))
                  {
                  $id = $_POST['view_idnumber'];

                  $sql = "SELECT * FROM menu_cashier_tbl WHERE receiptid = '$id' ";
                  $query_run=mysqli_query($conn, $sql); 
                  }
                ?>
     
                <thead style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    <tr>
                    <th scope="col">Menu Type</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Package Type</th>
                    <th scope="col">Total Cost</th>
                    </tr>
                </thead>
                 <tbody style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    <?php

                    if(mysqli_num_rows($query_run))
                    {
                        while($row = mysqli_fetch_assoc($query_run))
                        {
                            
                        ?>
                    <tr>
                    <td><?php  echo $row['foodtype']; ?></td>
                    <td><?php  echo $row['price']; ?></td>
                    <td><?php  echo $row['quantity']; ?></td>
                    <td><?php  echo $row['packagetype']; ?></td>
                    <td><?php  echo $row['total_cost']; ?></td>
                    </tr>

                     <?php
                        }
                    }else 
                    {    
                      echo '<h4 class="float-right font-weight-bold" style="font-size:30px; text-align:left;color:red;">No record found</h4>';
                    }
                    ?>
                  </tbody>
              </table>

      </form>
      </div>
    </div>

      </div>

        <script>
        $(document).ready(function(){
        $('.viewbtn').on('click', function(){

          $('#viewmodal').modal('show');

          $tr = $(this.closest('tr'));

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          console.log(data);

          $('#receiptid').val(data[0]);

        });

        });
        </script>



</div>
</div>   
</body>
</html>