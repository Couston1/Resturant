<?php 
session_start(); 
require 'includes/dbconnection.php';    

if(isset($_POST['btnlogin']))
{
    $username = $_POST['username'];
    $password = sha1($_POST['passwoord']);

    $sql = "SELECT * from ad_tbl WHERE username = '$username' AND passwoord = '$password'";
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
          header('location:admin-page.php');
        } 
        if($row['role']=="2")
        {
          header('location:supervisor-page.php');
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

    <link  rel="stylesheet" href="bootsrap/bootstrap.min.css">
    <link rel="stylesheet" href="bootsrap/style.css">
    <link rel="stylesheet" href="fontawsome/fontawesome-free-5.15.0-web/css/all.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />

      <!---header script!-->
      <script src="bootsrap/jquery-3.6.0.slim.js"></script>
      <script src="bootsrap/popper.min.js" ></script>
      <script src="bootsrap/bootstrap.min.js"></script>

    <style>
        body{
            background: url('images/foodimage.jpg');
            background-repeat: no-repeat;
            background-position: center; 
            background-size: cover; 
             }

        #card
        {
          padding-top: 250px;
          padding-bottom: 300px;

        }
        .card{
            border-radius: 10px;
            backdrop-filter: blur(14px);
            opacity: 0.9;
            background-color: #442814;
            }
        .btn-primary
         {
        background-color: white; 
        color: black; 
        border: 2px solid #4CAF50;
        }
        #togglePassword 
          {
          float: right;
          margin-left: -25px;
          margin-top: -25px;
          position: relative;
          z-index: 2;
        }

        .textbox{
          width: 100%;
          overflow: hidden;
          font-size: 18px;
          padding: 8px 0;
          margin: 8px 0;
          border-bottom: 1px solid white;
        }

        .textbox input{
          border: none;
          outline: none;
          background: none;
          color: white;
          font-size: 18p;
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

    <div class="container">
        <div class="row">

            <div class="col-sm-6 mx-auto">
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
                          <div class="textbox">
                          <i class="fa fa-user" aria-hidden="true"></i>
                              <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
                            </div>
                          </div><br>

                          <div class="textbox">
                            <div class="input-group">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                              <input type="password" id="psw" class="form-control" name="passwoord" placeholder="Enter password...." required>
                              <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;margin-right:15px; margin-top:10px; padding: 0px;"></i>
                            </div>
                          </div><br>

                          <div class="form-group">
                            <div style="text-align: center;">
                              <button name="btnlogin" style="text-align: center; border-radius: 12px; width: 150px; background-color: #442814; color: rgb(235, 231, 231); font-family: sans-serif; font-weight: bold;" type="submit" class="btn btn-primary btn-block">login</button>
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