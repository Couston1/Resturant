<?php 
require 'includes/topNav.php';
require 'includes/dbconnection.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food-Menu</title>

    <link href="bootsrap/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link  rel="stylesheet" href="fontawsome/fontawesome-free-5.15.0-web/css/all.css">
    <link  rel="stylesheet" type="text/css" href="Bootstrap/codestyle.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />
    
    <!---header script!-->
    <script src="bootsrap/jquery-3.6.0.slim.js"></script>
    <script src="bootsrap/popper.min.js" ></script>
    <script src="bootsrap/bootstrap.min.js"></script>

    <style>
        .card{
            border-radius: 10px;
            backdrop-filter: blur(14px);
            opacity: 0.9;
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
  <div class="col-sm-6">
    <div class="card">
        <div class="card-header">
            New Meu
        </div>
      <div class="card-body">
      <form action="functions.php" method="POST">
      <div class="form-group">
            <label for="">Enter Food Type</label>
            <input type="text" class="form-control" name="foodtype" placeholder="Enter Food Type" required>
        </div><br>

        <div class="form-group">
        <label for="">Enter Amount</label>
            <input type="text" class="form-control" name="price" placeholder="Enter Amount...." required>
        </div><br>

        <div class="form-group">
        <label for="">Package Type</label>
            <input type="text"  class="form-control" name="packagetype" placeholder="Enter Package...." required>
        </div><br>



        <div class="form-group">
        <div style="text-align: center;">
            <button name="btnmenu" style="text-align: center; border-radius: 12px; width: 150px; color: rgb(235, 231, 231); font-family: sans-serif; font-weight: bold;" type="submit" class="btn btn-primary btn-block">Save</button>
        </div>
        </div>
        </form>
      </div>
    </div>
  </div>




  <div class="col-sm-6 mt-2">
    <div class="card">
    <div class="card-header">
            User Info
    </div>
      <div class="card-body">
          <div class="row">
              <div class="col">
              <div class="table-responsive">

            <table class="table table-striped table-hover">
                <?php
                 $sql = "SELECT * FROM menu_food_tbl";
                 $query_run = mysqli_query($conn, $sql);
                 ?>
     
                <thead style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Menu Type</th>
                    <th scope="col">Price</th>
                    <th scope="col">Package Type</th>
                    <th scope="col">Edit</th>
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
                    <td><?php  echo $row['id']; ?></td>
                    <td><?php  echo $row['foodtype']; ?></td>
                    <td><?php  echo $row['price']; ?></td>
                    <td><?php  echo $row['packagetype']; ?></td>
                    <td>
                        <button type="submit" class="btn btn-primary editbtn"><i class="far fa-edit"></i></button>
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

  <!-- Edit data into modal form-->

<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <B>Update Menu</B></h5>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
      </div>
      <div class="modal-body">

        <form action="functions.php" method="POST">
        <div class="row">
        <input type="hidden" class="form-control" name="update_id" id="update_id"/>
        <div class="col-12">
        <div class="form-group">
        <label><b>Menu Type</b></label>
        <input type="text" class="form-control" name="foodtype" id="foodtype"/>
        </div>
        </div>
        </div><br>

        <div class="row">
        <div class="col-12">
        <div class="form-group">
        <label><b>Price</b></label>
        <input type="text" class="form-control" name="price" id="price"/>
        </div>
        </div>
        </div><br>

        <div class="row">
        <div class="col-12">
        <div class="form-group">
        <label><b>Package Type</b></label>
        <input type="text" class="form-control" name="packagetype" id="packagetype"/>
        </div>
        </div>
        </div><br>
        
        <div class="d-grid gap-2">
        <button type="submit" name="btnupdatemenu" class="btn btn-primary mx-auto btn-block">Update Changes</button>
        </div>
        </form>
  </div>

 
 
 <script>
  $(document).ready(function(){
    $('.editbtn').on('click', function(){

      $('#editmodal').modal('show');

      $tr = $(this.closest('tr'));

      var data = $tr.children("td").map(function(){
        return $(this).text();
      }).get();

      console.log(data);

      $('#update_id').val(data[0]);
      $('#foodtype').val(data[1]);
      $('#price').val(data[2]);
      $('#packagetype').val(data[3]);
    });

  });
</script>


</div>
</body>
</html>