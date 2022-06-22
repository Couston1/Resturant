<?php 
require 'includes/topNav.php';
require 'includes/dbconnection.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor-Info</title>

    <link href="bootsrap/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link  rel="stylesheet" href="fontawsome/fontawesome-free-5.15.0-web/css/all.css">
    <link  rel="stylesheet" type="text/css" href="Bootstrap/codestyle.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />
    
    <!---header script!-->
    <script src="bootsrap/jquery-3.6.0.slim.js"></script>
    <script src="bootsrap/popper.min.js" ></script>
    <script src="bootsrap/bootstrap.min.js"></script>

    <style>
        #table 
        {
            height: 20px;
            overflow: auto;
        }

        .card
        {
            border-radius: 12px;
        }
        .scroll
        {
            overflow-y: scroll;
        }
    </style>

<script type="text/javascript" rel="stylesheet"> 
$('document').ready(function(){ 
$(".alert").fadeIn(1000).fadeOut(5000); 
}); 
</script> 

    
</head>
<body>

<div id="main"><span style="font-size:22px;cursor:pointer;font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;" onclick="openNav()">&#9776;Menu</span>
<?php 
include 'includes/Navbarcodes.php';
include 'includes/Admin-sideNav.php';
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
                                    $sql = "SELECT * FROM ad_tbl";
                                    $query_run = mysqli_query($conn, $sql);
                                    ?>
                                    <table id="table" class="table table-striped table-hover">
                                        <thead style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                                            <tr>
                                                <th>ID</th>
                                                <th>User Name</th>
                                                <th>Password</th>
                                                <th>User Type</th>
                                                <th>Date Created</th>
                                                <th>Edit</th>
                                                <th>Delete Account</th>
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
                                            <td><?php  echo $row['username']; ?></td>
                                            <td><?php  echo $row['passwoord']; ?></td>
                                            <td><?php  echo $row['role']; ?></td>
                                            <td><?php  echo $row['date_created']; ?></td>
                                            
                                            <td>
                                            <form action="regit-supervisor-edit.php" method="POST">
                                            <input type="hidden" name="editid" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="Editbtn" class="btn btn-primary"><i class="far fa-edit"></i></button>
                                            </form>
                                            </td>

                                            <td>
                                            <button type="submit" name="Deletebtn" class="btn btn-danger deletebtn"><i class="far fa-trash-alt"></i></button>
                                            </td>
                                            </tr>
                                            <?php
                                                }
                                            }else 
                                            {                        
                                            $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">No Record Found</h4>';
                                            $_SESSION['msg_type'] = "danger";
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
        <h5 class="modal-title" id="exampleModalLabel"> <B>Delete User</B></h5>
      </div>
      <form action="functions.php" method="post">
       
        <div class="modal-body">
         <input type="hidden" class="form-control" name="delete_id" id="delete_id"/>
          <h4>Are you sure you want to Delete User:</h4>  

          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>      
          <button type="submit" name="btndelete" class="btn btn-primary">Yes! Delete</button>
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
<!--end of fetching data into modal form-->









</div>   
</body>
</html>