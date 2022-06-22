<?php 
session_start(); 
require 'includes/dbconnection.php';    

if(isset($_POST['btncashierlogin']))
{
    $username = $_POST['username'];
    $password = sha1($_POST['passwoord']);

    $sql = "SELECT * from user_account_tbl WHERE username = '$username' AND passwoord = '$password'";
    $query_run=mysqli_query($conn, $sql);
    $count=mysqli_num_rows($query_run);

    if($count>0)
    {
      $row=mysqli_fetch_assoc($query_run);

      $_SESSION['id']=$row['id'];
      $_SESSION['username']=$row['username'];
      $_SESSION['ROLE']=$row->role;
      $_SESSION['IS LOGIN']='yes';

        if($row['role']=="1")
        {
          header('location:cashier-page.php');
        } 
      
    }
    else
    {
      $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Invalid UserName or Password</h4>';
      $_SESSION['msg_type'] = "danger";
    }

 }

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Page</title>

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
        body{
        background-color: #442814;
        }

        #card
        {
          padding-top: 150px;
          padding-bottom: 300px;

        }
        .card{
          border-radius: 6px;;
        }
        #top
        {
          padding-top: 150px;
          color: #FEA47F;
        }
        #togglePassword 
          {
          float: right;
          margin-left: -25px;
          margin-top: -25px;
          position: relative;
          z-index: 2;
        }
     </style>

      <script type="text/javascript" rel="stylesheet"> 
        $('document').ready(function()
        { 
        $(".alert").fadeIn(1000).fadeOut(5000); 
        }); 
      </script>

    
</head>
<body style="font-family: 'Poppins';font-size: 22px;">

    <div class="container">
        <div class="row pt-3 pb-3">
            <div class="col-sm-7">
              
              <div id="top" style="text-align: center; ">
                <h1>GOOD MORNING KITCHEN</h1>
                    <img style="border-radius: 40%; " class="img-fluid" src="images/foodimage.jpg" >
                </div>
            </div>
            <div class="col-sm-5">
              <div class="row">
                <div class="col">
                  <div id="card">
                    <div class="card pt-5">
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

                        <form action="" method="post">

                          <div class="form-group">
                            <div class="input-group">
                              <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
                            </div>
                          </div><br>

                          <div class="form-group">
                            <div class="input-group">
                              <input type="password" id="psw" class="form-control" name="passwoord" placeholder="Enter Password" required>
                              <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;margin-right:10px; margin-top:10px;"></i>
                            </div>
                          </div><br>

                          <div class="form-group">
                            <div style="text-align: center;">
                              <button name="btncashierlogin" style="text-align: center; border-radius: 12px; width: 150px; background-color: #FEA47F; color: rgb(235, 231, 231); font-family: sans-serif; font-weight: bold;" type="submit" class="btn btn-primary btn-block">login</button>

                            </div>
                          </div>
                          </div><br>

                        </form>

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
            
              togglePassword.addEventListener('click', function (e)
              {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
              });
         </script>

    
</body>
</html>