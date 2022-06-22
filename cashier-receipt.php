<?php
require 'includes/topNav.php';
require 'includes/dbconnection.php'; 
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF-Receipt</title>

    <link href="bootsrap/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link  rel="stylesheet" href="fontawsome/fontawesome-free-5.15.0-web/css/all.css">
    <link rel="stylesheet" href="bootsrap/style.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
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
include 'includes/Cashier-sideNav.php';
include 'includes/Navbarcodes.php';
include 'includes/Cashier-Dashboard.php';
?>

<div class="container">
<div class="row">
  <div class="col-sm-12">
      <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-weight: bold;font-size: 25px;text-align: center;">Printing Receipt</div><br>
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
                 $sql = "SELECT * FROM billing_tbl order by receiptid desc";
                 $query_run = mysqli_query($conn, $sql);
                 ?>
     
                <thead style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    <tr>
                    <th scope="col">Inoviced No</th>
                    <th scope="col">Customer Number</th>
                    <th scope="col">Total Sales</th>
                    <th scope="col">Cash</th>
                    <th scope="col">Balance</th>
                    <th scope="col">Date Sold</th>
                    <th scope="col">Print</th>
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
                    <td><?php  echo $row['total_sales']; ?></td>
                    <td><?php  echo $row['cash']; ?></td>
                    <td><?php  echo $row['balance']; ?></td>
                    <td><?php  echo $row['datesold']; ?></td>


                    <td>
                    <form action="bill-receipt.php" method="POST">
                    <input type="hidden" name="view_id" value="<?php echo $row['receiptid']; ?>" readonly>
                    <button target="_blank" type="submit" name="viewtbtn" class="btn btn-primary"><i class="fa fa-print"></i></button>                    </form>
                    </td>
             
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>








</div>
</div>   
</body>
</html>