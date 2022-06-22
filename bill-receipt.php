<?php
require 'includes/dbconnection.php'; 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing-Receipt</title>

    <link href="bootsrap/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link  rel="stylesheet" href="fontawsome/fontawesome-free-5.15.0-web/css/all.css">
    <link rel="stylesheet" href="bootsrap/style.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />

      <!---header script!-->
      <script src="bootsrap/jquery-3.6.0.slim.js"></script>
      <script src="bootsrap/popper.min.js" ></script>
      <script src="bootsrap/bootstrap.min.js"></script>

</head>
<body>
    <div class="container" style="border: 1px solid;">
        <div class="row">
            <div class="col-sm-12">
                <h1 style="text-align: center; font-weight: bold;"><img src="images/restaurant-logo.jpg" style="width: 100px; height: 80px; padding-bottom: 10px;">Good Morning Kitichen</h1>
                <h5 style="text-align: center; font-weight: bold; font-size: 18px;">E-mail: Goodmorningkitchen@gmail.com</h5>
                <h5 style="text-align: center; font-weight: bold; font-size: 18px;">Contact: 0202800080/0249909097</h5>
                <h5 style="text-align: center; font-weight: bold; font-size: 18px;">Location: Kanishie-Accra</h5>
                <hr style="border: 3px solid black; ">


                    <?php
                    if (isset($_POST['viewtbtn']))
                    {
                    $id = $_POST['view_id'];

                    $sql = "SELECT * FROM billing_tbl WHERE receiptid = '$id' ";
                    $query_run=mysqli_query($conn, $sql);

                    foreach($query_run as $row)
                    {
                    
                    ?> 
                    <?php
                    }
                    }
                    ?> 
              <div class="row">
                    <div class="col-sm-6">
                        <p>Inovoice No: <?php echo $row['receiptid'];?></p>
                        <p>Customer No: <?php echo $row['customer_name'];?></p>
                        <p>Cashier Name: <?php echo $row['username'];?></p>
                        <p>Date: <?php echo $row['datesold'];?></p>

                    </div>

                    <div class="col-sm-6">

                    </div>
                </div>

            <table id="table" class="table table-striped">
     
                <thead style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    <tr>
                    <th scope="col">Food Type</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantiy</th>
                    <th scope="col">Package Type</th>
                    <th scope="col">Sub-Total</th>
                    </tr>
                </thead>
                 <tbody style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">

                     <?php
                    if (isset($_POST['viewtbtn']))
                    {
                    $id = $_POST['view_id'];

                    $sql = "SELECT * FROM menu_cashier_tbl WHERE receiptid = '$id' ";
                    $query_run=mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_assoc($query_run))
                    {
                        $total = '';
                        if (!isset($total))
                        {
                            $total = $total + ($row['price'] * $row['quantity']);

                        }
                    
                    ?> 
                    <tr>
                        <td><?php echo $row['foodtype'];?></td>
                        <td><?php echo $row['price'];?></td>
                        <td><?php echo $row['quantity'];?></td>
                        <td><?php echo $row['packagetype'];?></td>
                        <td><?php echo $row['total_cost'];?></td>


                    </tr>
                     <?php
                    
                      }
                        }
                        ?> 

                        <tr>
                            <th colspan="4">Grand-Total</th>
                            <th><?php echo $total;?></th>
                        </tr>
                 </tbody>
             </table>


            
        </div>
        <script>
            window.print();
        </script>
    </div>    
</body>
</html>