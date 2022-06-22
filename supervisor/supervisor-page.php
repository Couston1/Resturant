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
      <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-weight: bold;font-size: 25px;text-align: center;">Daily Menu Infomation</div><br>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
              <div class="scroll">
              <div class="table-responsive">
				     <table id="table" class="table table-bordered table-striped table-hover">
                <?php
                 $sql = "SELECT * FROM billing_tbl WHERE month(current_date)=month(datesold) AND day(current_date)=day(datesold)";
                 $query_run = mysqli_query($conn, $sql);
                 ?>
     
                <thead style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    <tr>
                    <th scope="col">Inoviced No</th>
                    <th scope="col">Customer Number</th>
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
                    <button type="button" class="btn btn-primary viewbtn"><i class="fa fa-eye"></i></button>
                    </td>
             
                    </tr>

                     <?php
                        }
                    }else 
                    {    
                      echo '<h4 class="float-right font-weight-bold" style="font-size:20px; text-align:center;color:red;">No record found for today</h4>';
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
    <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-weight: bold;font-size: 25px;text-align: center; color: black;">Transactions Report</div><br>
    <div class="row">
      <div class="col">
      <div class="card">
      <div class="card-header" style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 18px;">Total Amount for the Day</div>
      <div class="card-body">
      <i class="fas fa-database fa-2x"></i>

      <?php
        $sql = "SELECT sum(total_sales) As total FROM billing_tbl WHERE month(current_date)=month(datesold) AND day(current_date)=day(datesold)";
        $result = mysqli_query($conn,$sql);

        $row = mysqli_fetch_array($result);
        $total_cost = $row['total'];
        echo '<h4 style="font-size:20px; text-align:center">Daily Total Sales:</h4>';
        echo '<h4 style="font-size:20px; text-align:center">GHC'.$total_cost.'</h4>';

      ?>

      </div>
      </div>
      </div>
    </div><br>

    <div class="row">
      <div class="col">
      <div class="card">
      <div class="card-header" style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 18px;">Total Amount for the Month</div>
      <div class="card-body">
      <i class="fas fa-database fa-2x"></i>

      <?php
        $sql = "SELECT sum(total_sales) As total FROM billing_tbl WHERE month(current_date)=month(datesold)";
        $result = mysqli_query($conn,$sql);

        $row = mysqli_fetch_array($result);
        $total_cost = $row['total'];
        echo '<h4 style="font-size:20px; text-align:center">Mothly Total Sales:</h4>';
        echo '<h4 style="font-size:20px; text-align:center">GHC'.$total_cost.'</h4>';

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
      <input type="hidden" class="form-control" id="receiptid"/>
      <table id="table" class="table table-bordered table-striped table-hover">
                <?php
                 $sql = "SELECT * FROM menu_cashier_tbl";
                 $query_run = mysqli_query($conn, $sql);
                 ?>
     
                <thead style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    <tr>
                    <th scope="col">Inoviced No</th>
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
                    <td><?php  echo $row['receiptid']; ?></td>
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