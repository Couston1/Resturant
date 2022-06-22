<?php 
require 'includes/topNav.php';
require 'includes/dbconnection.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit info </title>

    <link href="bootsrap/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link  rel="stylesheet" href="fontawsome/fontawesome-free-5.15.0-web/css/all.css">
    <link  rel="stylesheet" type="text/css" href="Bootstrap/codestyle.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />
    
    <!---header script!-->
    <script src="bootsrap/jquery-3.6.0.slim.js"></script>
    <script src="bootsrap/popper.min.js" ></script>
    <script src="bootsrap/bootstrap.min.js"></script>

<script type="text/javascript">

function DOBAGE() {
    var userinput = document.getElementById("DOB").value;
    var dob = new Date(userinput);
    if(userinput==null || userinput=='') {
      document.getElementById("message").innerHTML = "**Choose a date please!";  
      return false; 
    } else {
    
    //calculate month difference from current date in time
    var month_diff = Date.now() - dob.getTime();
    
    //convert the calculated difference in date format
    var age_dt = new Date(month_diff); 
    
    //extract year from date    
    var year = age_dt.getUTCFullYear();
    
    //now calculate the age of the user
    var age = Math.abs(year - 1970);
    
    //display the calculated age
    return document.getElementById("txtAge").value =  
              age;
    }
}
</script>

<script type="text/javascript" rel="stylesheet"> 
$('document').ready(function(){ 
$(".alert").fadeIn(1000).fadeOut(5000); 
}); 
</script> 



<style>
    #togglePassword 
    {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}
</style>

</head>
<body>
<div id="main"><span style="font-size:22px;cursor:pointer;font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;" onclick="openNav()">&#9776;Menu</span>

<?php 
include 'includes/Navbarcodes.php';
include 'includes/Admin-sideNav.php';
include 'includes/Navbarcodes.php';
include 'includes/Dashboard.php';
?>

<?php
if (isset($_POST['Editbtn']))
{
  $id = $_POST['editid'];

  $sql = "SELECT * FROM ad_tbl WHERE id = '$id' ";
  $query_run=mysqli_query($conn, $sql);

  foreach($query_run as $row)
  {
  
?>
<?php
  }
}
?>

<div class="container-fluid">

<form action="functions.php" method="POST">
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
            Supervisor Profile
        </div>
      <div class="card-body">

       <div class="row">
           <div class="col">
               <div style="text-align:center; font-size: 25px;" ><label class="badge rounded-pill bg-primary">Edit Login Details</label></div> 
           </div>
       </div>
       <br>

       <div class="row">
           <div class="col-sm-6">
           <label>User Name</label>
           <input type="hidden" class="form-control" name="editid" value="<?php echo $row['id']; ?>"/>
            <input class="form-control form-control-sm" name="username" type="text" value="<?php echo $row['username'];?>">
           </div>
           <div class="col-sm-6">
           <label>Password</label>
            <input type="password" class="form-control form-control-sm" name="passwoord" value="<?php echo $row['passwoord'];?>" readonly> 
           </div>
       </div>
       <br>

       <div class="row">
           <div class="col-sm-6">
           <label>Role</label>
           <select class="form-select form-control-sm" name="role" value="<?php echo $row['role'];?>" required>
            <option value=""></option>
            <option value="1">Admin</option>
            <option value="2">Supervisor</option>
            </select>
           </div>

           <div class="col-sm-6">
           <label>Date Created</label>
            <input class="form-control form-control-sm" name="date_created" type="date"  value="<?php echo date("Y-m-d");?>" readonly>
           </div>
       </div>
       <br>

       <div class="row" style="text-align:center;">
           <div class="col">
           <button type="submit" name="btnupdate" class="btn btn-primary btn-default">Update</button>
           </div>
       </div>

      </div>
    </div>
  </div>

</form>


  <div class="col-sm-6">
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
                 $sql = "SELECT * FROM ad_tbl";
                 $query_run = mysqli_query($conn, $sql);
                 ?>
     
                <thead style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Password</th>
                    <th scope="col">Role</th>
                    <th scope="col">Date Created</th>
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
                    <td><?php  echo $row['username']; ?></td>
                    <td><?php  echo $row['passwoord']; ?></td>
                    <td><?php  echo $row['role']; ?></td>
                    <td><?php  echo $row['date_created']; ?></td>
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


</body>
</html>