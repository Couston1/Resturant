<?php 
require 'includes/topNav.php';
require 'includes/dbconnection.php';

//custom id generation
$sql = "SELECT user_id FROM user_account_tbl order by user_id desc";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result);
$lastid = $row['user_id']; 

if (empty($lastid))
{
    $number = "EMP_1001";
}
else
{
    $idd = str_replace("EMP_","",$lastid);
    $id = str_pad($idd + 1, 4,0);
    $number = 'EMP_'.($id);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

    <link href="bootsrap/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link  rel="stylesheet" href="fontawsome/fontawesome-free-5.15.0-web/css/all.css">
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
include 'includes/Supervisor-sideNav.php';
include 'includes/Navbarcodes.php';
include 'includes/Supervisor-Dashboard.php';
?>

<?php
if (isset($_POST['Editbtn']))
{
  $id = $_POST['editid'];

  $sql = "SELECT * FROM user_account_tbl WHERE user_id = '$id' ";
  $query_run=mysqli_query($conn, $sql);

  foreach($query_run as $row)
  {
  
?>
<?php
  }
}
?>

<div class="container-fluid">

<form action="functions.php" method="POST" enctype="multipart/form-data">
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
            Cashier Profile
        </div>
      <div class="card-body">

       <div class="row">
           <div class="col-sm-4">
           <label>User ID</label>
           <input type="hidden" class="form-control" name="editid" value="<?php echo $row['user_id']; ?>"/>
            <input class="form-control form-control-sm" name="user_id" type="text" value="<?php echo $number;?>" readonly>
           </div>
           <div class="col-sm-4">
           <label>First Name</label>
            <input class="form-control form-control-sm" name="firstname" type="text" value="<?php echo $row['firstname'];?>">
           </div>
           <div class="col-sm-4">
           <label>Surname</label>
            <input class="form-control form-control-sm" name="lastname" type="text" value="<?php echo $row['lastname'];?>">
           </div>
       </div>
       <br>

       <div class="row">
           <div class="col-sm-4">
           <label>DOB</label>
            <input class="form-control form-control-sm" name="dob" type="date" id="DOB" onchange="DOBAGE()" value="<?php echo $row['dob'];?>">
           </div>
           <div class="col-sm-4">
           <label>Age</label>
            <input class="form-control form-control-sm" name="age" type="text" id="txtAge" value="<?php echo $row['age'];?>" readonly>
           </div>
           <div class="col-sm-4">
           <label>Gender</label>
           <select class="form-control-sm form-select" name="gender" required>
               <option value=""></option>
               <option value="male">Male</option>
               <option value="female">Female</option>
           </select>
           </div>
       </div>
       <br>

       <div class="row">
           <div class="col-sm-6">
           <label>Address</label>
            <input class="form-control form-control-sm" name="resident" type="text"  value="<?php echo $row['resident'];?>">
           </div>
           <div class="col-sm-6">
           <label>Contact</label>
            <input class="form-control form-control-sm" name="tel" type="tel" pattern="[0-9]{4}[0-9]{3}[0-9]{3}" placeholder="0123456780" maxlength="10"  value="<?php echo $row['tel'];?>">
           </div>
       </div>
       <br>

       <div class="row">
           <div class="col">
               <div style="text-align:center; font-size: 25px;" ><label class="badge rounded-pill bg-primary">Login Details</label></div> 
           </div>
       </div>
       <br>

       <div class="row">
           <div class="col-sm-4">
           <label>User Name</label>
            <input class="form-control form-control-sm" name="username" type="text"  value="<?php echo $row['username'];?>">
           </div>
           <div class="col-sm-4">
           <label>Password</label>
            <input class="form-control form-control-sm" name="passwoord" type="password" readonly> 
           </div>
           <div class="col-sm-4">
           <label>Confimed Password</label>
            <input class="form-control form-control-sm" name="cpasssword" type="password" readonly>
           </div>
       </div>
       <br>

       <div class="row">
           <div class="col-sm-6">
           <label>Role</label>
           <select class="form-select form-control-sm" name="role" readonly>
            <option value="1">Cashier</option>
            </select>
           </div>

           <div class="col-sm-6">
           <label>Date Started</label>
            <input class="form-control form-control-sm" name="datestart" type="date"  value="<?php echo date("Y-m-d");?>" readonly>
           </div>
       </div>
       <br>

       <div class="row" style="text-align:center;">
           <div class="col">
           <button type="submit" name="btnupdatecashier" class="btn btn-primary btn-default">Update</button>
           </div>
       </div>

      </div>
    </div>
  </div>

</form>


  <div class="col-sm-6">
    <div class="card">
    <div class="card-header">
    <div class="float-end">
            User Info
        </div>
    </div>

      <div class="card-body">
          <div class="row">
              <div class="col">
              <div class="table-responsive">

            <table class="table table-striped table-hover">
                <?php
                 $sql = "SELECT * FROM user_account_tbl";
                 $query_run = mysqli_query($conn, $sql);
                 ?>
     
                <thead style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">DOB</th>
                    <th scope="col">Age</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Address</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Delete Account</th>

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
                    <td><?php  echo $row['user_id']; ?></td>
                    <td><?php  echo $row['firstname']; ?></td>
                    <td><?php  echo $row['lastname']; ?></td>
                    <td><?php  echo $row['dob']; ?></td>
                    <td><?php  echo $row['age']; ?></td>
                    <td><?php  echo $row['gender']; ?></td>
                    <td><?php  echo $row['resident']; ?></td>
                    <td><?php  echo $row['tel']; ?></td>

                    <td>
                    <button type="submit" name="btndeletechashier" class="btn btn-danger deletebtn"><i class="far fa-trash-alt"></i></button>
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

<div class="modal fade" id="deletecashiermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <B>Delete Account</B></h5>
      </div>
      <form action="functions.php" method="post">
       
        <div class="modal-body">
         <input type="hidden" class="form-control" name="delete_id" id="delete_id"/>
          <h4 style="text-align:center; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Are you sure you want to Delete this Account?</h4>  

          <div style="float: right;">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>      
          <button type="submit" name="btndeletecahsier" class="btn btn-primary">Yes! Delete</button>

          </div>
       </div>
     </form>
      
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function(){
    $('.deletebtn').on('click', function(){

      $('#deletecashiermodal').modal('show');

      $tr = $(this.closest('tr'));

      var data = $tr.children("td").map(function(){
        return $(this).text();
      }).get();

      console.log(data);

      $('#delete_id').val(data[0]);
    });

  });
</script>













</div>   
</body>
</html>