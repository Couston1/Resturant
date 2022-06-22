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

    .scroll
        {
            height: 400px;
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

<div class="container">
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

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header"></div>
                        <div class="card-body">
                            <div class="scroll">
                                <div class="table-responsive">
                                    <?php
                                    $sql = "SELECT * FROM menu_food_tbl";
                                    $query_run = mysqli_query($conn, $sql);
                                    ?>
                                    <table id="table" class="table table-striped table-hover">
                                        <thead style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                                            <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Menu Type</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Package Type</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
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
                                            <td>
                                            <button type="submit"  class="btn btn-danger deletebtn"><i class="far fa-trash-alt"></i></button>
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


<div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <B>Delete Menu</B></h5>
      </div>
      <form action="functions.php" method="post">
       
        <div class="modal-body">
         <input type="hidden" class="form-control" name="delete_id" id="delete_id"/>
          <h4 style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Are you sure you want to Delete this menu?</h4>  

          <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>      
          <button type="submit" name="btndeletemenu" class="btn btn-primary">Yes! Delete</button>

          </div>
       </div>
     </form>
      
      </div>
    </div>
  </div>
</div>

<!-- fetching data into modal form-->
<script>
  $(document).ready(function(){
    $('.deletebtn').on('click', function(){

      $('#deletemodal').modal('show');

      $tr = $(this.closest('tr'));

      var data = $tr.children("td").map(function(){
        return $(this).text();
      }).get();

      console.log(data);

      $('#delete_id').val(data[0]);
    });

  });
</script>
  
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