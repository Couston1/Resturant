<?php 
require 'includes/topNav.php';
require 'includes/dbconnection.php';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password-Change</title>

    <link href="bootsrap/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link  rel="stylesheet" href="fontawsome/fontawesome-free-5.15.0-web/css/all.css">
    <link  rel="stylesheet" type="text/css" href="Bootstrap/codestyle.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />
    
    <!---header script!-->
    <script src="bootsrap/jquery-3.6.0.slim.js"></script>
    <script src="bootsrap/popper.min.js" ></script>
    <script src="bootsrap/bootstrap.min.js"></script>

    <script type="text/javascript" rel="stylesheet"> 
    $('document').ready(function(){ 
    $(".alert").fadeIn(1000).fadeOut(5000); 
    }); 
    </script> 
    
    <style>
/* The message box is shown when the user clicks on the password field */
#message
{
    display:none;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#message p 
{
 padding: 10px 35px;
  font-size: 18px; padding: 10px 35px;
  font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "&#10004;";
  content: "✔";
}

/* Add a red text color and an "x" icon when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}

#togglePassword 
    {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}

.card{
    border-radius: 20px;
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

<div>
     
</div>

<form action="" method="POST">
  <div class="container">
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
    </div>
  <div class="row">
      <div class="col-md-6">
      </div><br>

      <div class="col-md-6">
        <label for="">Cashier Name</label>
     <div class="row"> 
     <div class="col-12">
     <div class="form-group">
       <div class="input-group">
       <input type="text" class="form-control" name="username" required/>
     <button type="submit" name="SupervisorAdmin_btnsearch" class="btn btn-dark "><i class="fa fa-search"></i></button>
       </div>
     </div>
     </div>
     </div>
      </div><br>
    </div><br>
 </div>
</form>

 <?php  
  if (isset($_POST['SupervisorAdmin_btnsearch']))
  {
    $username = $_POST['username'];
    
    $sql = "SELECT * FROM user_account_tbl WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0)
    {
      while ($row = mysqli_fetch_array($result))
      {
  ?>
  <form action="functions.php" method="Post">
<div class="container">
       <div style="text-align: center; font-family:Georgia, 'Times New Roman', Times, serif;font-size: 20px;font-weight: bold;">
       Change Password
       </div>
        <div class="row">
            <div class="col-md-6 mx-auto">
                 <div class="card  mb-3">
                     <div class="card-header"></div>
                        <div class="card-body">
                             <div class="row">
                                 <div class="col">
                                 <div class="form-group">
                                        <label>Enter New Password</label>
                                        <input type="hidden" class="form-control" name="edit_id" value="<?php echo $row['id']; ?>"/>
                                        <input type="password" class="form-control" id="psw" name="passwoord" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required/>
                                        <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;margin-right:10px;"></i>
                                        </div><br>

                                        <div class="form-group">
                                        <label>Confirm New Password</label>
                                        <input type="password" class="form-control" id="psw" name="cpasssword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required/>
                                        </div><br>

                                        <div class="d-grid gap-2">
                                    <button type="submit" name="btnresetuserpassword" class="btn btn-primary  mx-auto btn-block">Reset Password</button>
                                    </div>
                                 </div>
                             </div>
                         </form>
                      </div>
                     </div>
                    </div>    
                  </div>
<?php
      }

    }
    else
    {
      echo '<h4 class="float-right font-weight-bold" style="font-size:25px; text-align:center;color:red;">No record found</h4>';
    }
    
  }


?>

<div id="message" style="text-align: center; font-family:Georgia, 'Times New Roman', Times, serif;font-size: 20px;font-weight: bold;">
  <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>6 characters</b></p>
</div>



<script>
var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
}

  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate length
  if(myInput.value.length >= 6) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}

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
</div>  
</body>
</html>