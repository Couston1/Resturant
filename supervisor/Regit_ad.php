<?php 
  include 'Configuration/header.php';
  require 'Configuration/dbconnection.php';
?>


<?php 
include 'Configuration/sideNav.php';
?>

<?php 
include 'Configuration/Admin_Navbar.php';
?>


<div id="main">
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;Open</span><br><br>



    <div class="container">
    <div class="row">
      <div class="col-md-8 mt-3">
      <div class="card- shadow mb-8">
    <div class="card-header py-3">
    <div class="card-body">

          
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

<form action="Main_configuration.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label>User Name</label>
    <input type="text" class="form-control" name="username" required/>
  </div>

  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" name="passsword" required/>
  </div>

  <div class="form-group">
    <label>Confirm Password</label>
    <input type="password" class="form-control" name="cpasssword" required>
  </div>

  <div class="form-group">
    <label>Phone Number</label>
    <input type="text" class="form-control" name="pnumber" maxlength = "10" required>
  </div>

  <div class="form-group">
    <label>passport pic</label>
    <input type="file" class="form-control" name="pic">
  </div>


  <div class="form-group">
  <label><b>Select Role</b></label>

  <select name="role" class="form-control form-select" required>
  <option  value="managerAdmin">Admin</option>
  </select>
  </div><br>

  <div class="d-grid gap-2">
  <button type="submit" name="registermanager" class="btn btn-primary col-12 mx-auto btn-block" name="">Save Changes</button>
  </div>

</form>
</div>
</div>
</div>
</div>

<div class="col-md-4 mt-3">
      <div class="card">
        <div class="bg-danger text-white p-4">
        <i class="fas fa-list-ul"></i>  
        <?php
             $sql = "SELECT * FROM mgr_account";
              $query_run=mysqli_query($conn, $sql);

             $row = mysqli_num_rows($query_run);
                 echo '<h2 class="float-right font-weight-bold" style="font-size:50px; text-align:center">Total Users: '.$row.'</h2>';
          ?>
        </div>
        <div class="card-footer tex-primary">
          <h6 class="text-center"><a href="User_tbl.php">Veiw All <i class="fas fa-arrow-alt-circle-right"></i></a></h6>
        </div>
       
    </div>
  </div>



</div>


