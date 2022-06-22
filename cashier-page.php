<?php
require 'includes/topNav.php';
require 'includes/dbconnection.php'; 

//custom id generation
$sql = "SELECT receiptid FROM billing_tbl order by receiptid desc";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result);
$lastid = $row['receiptid']; 

if (empty($lastid))
{
    $number = "RECEIPT_10000";
}
else
{
    $idd = str_replace("RECEIPT_","",$lastid);
    $id = str_pad($idd + 1, 5,0);
    $number = 'RECEIPT_'.($id);
}
//End ofcustom id generation

//custom id generation for customer
$sql = "SELECT customer_name FROM billing_tbl order by customer_name desc";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result);
$lastid = $row['customer_name']; 

if (empty($lastid))
{
    $customer = "CUSTOMER_1";
}
else
{
    $idd = str_replace("CUSTOMER_","",$lastid);
    $id = str_pad($idd + 1, 1,0);
    $customer = 'CUSTOMER_'.($id);
}
//End ofcustom id generation
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing-POS</title>

    <link href="bootsrap/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link  rel="stylesheet" href="fontawsome/fontawesome-free-5.15.0-web/css/all.css">
    <link rel="stylesheet" href="bootsrap/style.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />

      <!---header script!-->
      <script src="bootsrap/jquery-3.6.0.slim.js"></script>
      <script src="bootsrap/popper.min.js" ></script>
      <script src="bootsrap/bootstrap.min.js"></script>

      <script type="text/javascript" rel="stylesheet"> 
        $('document').ready(function(){ 
        $(".alert").fadeIn(1000).fadeOut(5000); 
        }); 
     </script> 

     <script>
    function minus()
    {
    var total_sales = document.getElementById("total_sales").value;
    var cash = document.getElementById("cash").value;
    var balanced = parseFloat(total_sales)-parseFloat(cash);
    document.getElementById("balance").value = balanced;
    }
    </script>

     <style>
        .scroll
        {
          height: 300px;
          overflow-y: scroll;
        }
        #maincard
        {
        }
     </style>

     <script>
       function fill_selected()
       {
         $output = '';
         $sql = "SELECT * FROM menu_food_tbl";
         $query_run=mysqli_query($conn, $sql);
         foreach($query_run as $row)
         {
           $output = '<option value="'.$row['foodtype'].'">'.$row['foodtype'].'</option>';
         }
         return $output;
       }
     </script>

     <script>
       function multiply()
       {
        var unitprice = document.getElementById("price").value;
        var Quantity = document.getElementById("quantity").value;
        var Total = parseFloat(unitprice)*parseFloat(Quantity);
        document.getElementById("total_cost").value = Total;
        }
     </script>

</head>
<body>
<div id="main"><span style="font-size:22px;cursor:pointer;font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;" onclick="openNav()">&#9776;Menu</span>

<?php 
include 'includes/Navbarcodes.php';
include 'includes/Cashier-sideNav.php';
include 'includes/Cashier-Dashboard.php';
?>


<div class="container">
<div class="row">
  <div class="col-sm-12">
      <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-weight: bold;font-size: 25px;text-align: center;">Restaurant Billing System</div><br>

      <form action="response.php" method="POST">

      <div class="row">
        <div class="col-sm-9">
        <input style="text-align: center;" type="hidden" class="form-control form-control-sm" name="search_date" value="<?php echo date('Y-m-d');?>" readonly>
          <a href="cashier-receipt.php"><button type="button" class="btn btn-secondary btn-sm"><i class="fa fa-print"></i>Print</button></a>

        </div>

        <div class="col-sm-3">
          <div class="row">
            <div class="col-sm-12">
              <input style="text-align: center;" type="text" class="form-control form-control-sm" name="receiptid" value="<?php echo $number;?>" readonly>
            </div>
          </div><br>
          
          <div class="row">
            <div class="col-sm-12">
              <input style="text-align: center;" type="datetime" class="form-control form-control-sm" name="datesold" value="<?php echo date('Y-m-d h:i:s');?>" readonly>
            </div>
          </div>
        </div>
      </div><br>

      <div class="row">
        <div class="col-sm-12">
          <input type="text" class="form-control form-control-sm" name="customer_name"  value="<?php echo $customer;?>" readonly>
        </div>
      </div><br>
       
      <div class="row">
        <div class="col">
          <div class="card" id="maincard">
            <div class="card-header">
              
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

          </div>

            <div class="card-body">
              <div>
              <button type="button" class="btn btn-success btn-sm" onclick="addItem();"><i class="fa fa-plus">Add Item</i></button>
              </div><br>
              <div class="scroll">
              <div class="table-responsive">
				     <table id="table" class="table table-bordered table-striped table-hover">
                <thead style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Menu Type</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Package Type</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Remove</th>
                    </tr>
                </thead>
                <tr id="rowid">
                <tbody id="Tbody" style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                </tbody>

                </tr>
              </table>
              </div>
            </div>
            </div>

        <div class="row">
          <div class="col-sm-8">

          </div>

              <div class="col-sm-4">
                <div class="card">
                <div class="card-header"> Account Billing </div>
                  <div class="card-body">
                  <div class="row">
                  <div class="col-sm-12">
                    <div class="input-group">
                     <label for="" style="text-align:left; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 25px;">Total Sales:  &nbsp;</label>
                      <input style="text-align: center;" type="text" class="form-control form-control-sm" name="total_sales" id="total_sales" placeholder="Total Sales..." >
                    </div>
                  </div>
                </div><br>
                
                <div class="row">
                  <div class="col-sm-12">
                    <div class="input-group">
                    <label for="" style="text-align:left; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 25px;">Cash At Hand: &nbsp;</label>
                    <input style="text-align: center;" type="number" class="form-control form-control-sm" name="cash" id="cash" onchange="minus();" placeholder="Cash at Hand..." required>
                    </div>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="input-group">
                    <label for="" style="text-align:left; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 25px;">Balance:  &nbsp;</label>
                    <input style="text-align: center;" type="datetime" class="form-control form-control-sm" name="balance" id="balance" placeholder="Balance..." readonly>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><br>

            <div style="text-align:center">
              <button type="submit" name="btnsavebills" class="btn btn-primary btn-sm">Save</button>
            </div><br>
          </div>
        </div>
      </div>
    </div>
    </form>
  </div>







  <script>
  var items = 0;
  function addItem(){
    function calculate()
    {
    var price = document.getElementById("price").value;
    var Quantity = document.getElementById("quantity").value;
    var Total = parseFloat(unitprice)*parseFloat(Quantity);
    document.getElementById("total_cost").value = Total;
    }

    var html = "<tr>";
    html += "<td>" + items + "</td>";
    html += "<td><input name='foodtype[]' class='form-control'></td>";
    html += "<td><input name='price[]' class='form-control' id='price'></td>";
    html += "<td><input type='number' name='quantity[]' id='quantity' value='0' class='form-control' style='text-align: center;' onchange='calculate();'></td>";
    html += "<td><input name='packagetype[]' class='form-control'></td>";
    html += "<td><input name='total_cost[]' id='total_cost' class='form-control'></td>";
    html += "<td><button type='button' class='btn btn-danger' onclick='removeItem();'><i class='fa fa-trash-alt'></i></button></td>";
    html += "</tr>";
    document.getElementById("Tbody").insertRow().innerHTML = html;
  };

  function removeItem()
  {
    document.getElementById("Tbody").remove().innerHTML = html;
  }



 

  </script>




</div>
</div>
</body>
</html>