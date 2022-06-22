<?php 
require 'includes/topNav.php';
require 'includes/dbconnection.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user Registration</title>

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
include 'includes/Supervisor-Dashboard.php';
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
               <div style="text-align:center; font-size: 25px;" ><label class="badge rounded-pill bg-primary">Login Details</label></div> 
           </div>
       </div>
       <br>

       <div class="row">
           <div class="col-sm-6">
           <label>User Name</label>
            <input class="form-control form-control-sm" name="username" type="text"  required>
           </div>
           <div class="col-sm-6">
           <label>Password</label>
            <input type="password" id="psw" class="form-control form-control-sm" name="passwoord" required> 
            <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;margin-right:15px; margin-Buttom:40px; padding: 0px;"></i>
           </div>
       </div>
       <br>

       <div class="row">
           <div class="col-sm-6">
           <label>Role</label>
           <select class="form-select form-control-sm" name="role" required>
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
           <button type="submit" name="registeruser" class="btn btn-primary btn-default">Save</button>
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
                    <th scope="col">User Name</th>
                    <th scope="col">Password</th>
                    <th scope="col">Role</th>
                    <th scope="col">Date Created</th>
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

<script>
   const togglePassword = document.querySelector('#togglePassword');
   const password = document.querySelector('#psw');
 
  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>

</body>
</html>