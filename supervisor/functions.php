<?php
session_start(); 
require_once 'includes/dbconnection.php';

// saving supervisor info
if (isset($_POST['registeruser']))
{
  $username = $_POST['username'];
  $password = sha1($_POST['passwoord']);
  $usertype = $_POST['role'];
  $date = $_POST['date_created'];

    $sql = "SELECT * FROM ad_tbl WHERE username = '$username'";
    $query_run = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query_run) > 0)
    {
        $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">User Already Exist &nbsp;<i class="fa fa-times"></i></h4>';
        $_SESSION['msg_type'] = "danger";
        header('location: regit-supervisor.php');
        }
        else
        {
        $sql = "INSERT INTO ad_tbl (username,passwoord,role,date_created) VALUES('$username','$password','$usertype','$date')";
        $query_run=mysqli_query($conn, $sql);

        if ($query_run)
        {
            $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Data Saved Successfully &nbsp;<i class="fa fa-check"></i></h4>';
            $_SESSION['msg_type'] = "success";
            header('location: regit-supervisor.php');
        }
        else
        {
            $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Data NOT Saved &nbsp;<i class="fa fa-times"></i></h4>';
            $_SESSION['msg_type'] = "danger";
            header('location: regit-supervisor.php');
        }
    }
   
   
}


//  updating supervisor
   if(isset($_POST['btnupdate']))
   {
    $editid = $_POST['editid'];
    $editusername = $_POST['username'];
    $editusertype = $_POST['role'];

      $sql = "UPDATE ad_tbl SET username='$editusername', role='$editusertype' WHERE id =' $editid '";
      $query_run=mysqli_query($conn, $sql);
  
      if($query_run)
      {
          $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Data Updated Successfully &nbsp;<i class="fa fa-check"></i></h4>';
          $_SESSION['msg_type'] = "success";
          header('location: regit-supervisor.php');
      }
      else
      {
          $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Data Not Updated &nbsp;<i class="fa fa-times"></i></h4>';
          $_SESSION['msg_type'] = "danger";
          header('location: regit-supervisor-edit.php');
      }
    }

    // update password
    if (isset($_POST['btnresetpassword']))
    {
      $id = $_POST['edit_id'];
      $password = sha1($_POST['passsword']);
      $cpassword = sha1($_POST['cpasssword']);

      if($password==$cpassword)
      {
        $sql = "UPDATE ad_tbl SET passwoord='$password' WHERE id =' $id'";
        $query_run=mysqli_query($conn, $sql);

        if($query_run)
        {
          $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Password Reset Successfully &nbsp;<i class="fa fa-check"></i></h4>';
          $_SESSION['msg_type'] = "success";
          header('location: Admin-change-password.php');
        }
        else
        {
          $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Error: password did not change &nbsp;<i class="fa fa-times"></i></h4>';
          $_SESSION['msg_type'] = "danger";
          header('location: Admin-change-password.php');
        }
      }
      else
      {
        $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Error: Password did not match &nbsp;<i class="fa fa-times"></i></h4>';
        $_SESSION['msg_type'] = "danger";
        header('location: Admin-change-password.php');
      }
    }

//Delete supervisor
if(isset($_POST['btndelete']))
{
    $id = $_POST['delete_id'];

    $sql = "DELETE FROM ad_tbl WHERE id ='$id'";
    $query_run=mysqli_query($conn, $sql);

    if($query_run)
    {
      $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Deleted Successfully &nbsp;<i class="fa fa-check"></i></h4>';
      $_SESSION['msg_type'] = "success";
      header('location: regit-supervisor.php');
      }
    else
    {
      $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Not Deleted &nbsp;<i class="fa fa-times"></i></h4>';
      $_SESSION['msg_type'] = "danger";
      header('location: regit-supervisor-edit.php');
    }
}

//saving cashier info
if (isset($_POST['btnregistercashier']))
{
  $userid = $_POST['user_id'];
  $firstname = $_POST['firstname'];
  $surname = $_POST['lastname'];
  $DOB = date('Y-m-d', strtotime($_POST['dob']));
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $address = $_POST['resident'];
  $contact = $_POST['tel'];
  $username = $_POST['username'];
  $password = sha1($_POST['passwoord']);
  $cpassword = sha1( $_POST['cpasssword']);
  $usertype = $_POST['role'];
  $datestart = date('Y-m-d', strtotime($_POST['datestart']));


    if ($password == $cpassword)
    {
        $sql = "SELECT * FROM user_account_tbl WHERE user_id = '$userid'";
        $query_run = mysqli_query($conn, $sql);
  
        if (mysqli_num_rows($query_run) > 0)
        {
            $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">User Already Exist &nbsp;<i class="fa fa-times"></i> </h4>';
            $_SESSION['msg_type'] = "danger";
            header('location: regit-cashier.php');
            }   
            else
            {
            $sql = "INSERT INTO user_account_tbl (user_id,firstname,lastname,dob,age,gender,resident,tel,username,passwoord
            ,role,datestart) VALUES('$userid','$firstname','$surname','$DOB','$age','$gender ','$address',
            '$contact','$username','$password','$usertype','$datestart')";
            $query_run=mysqli_query($conn, $sql);

          if ($query_run)
            {
              $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Data Saved Successfully &nbsp;<i class="fa fa-check"></i></h4>';
              $_SESSION['msg_type'] = "success";
              header('location: regit-cashier.php');
            }
            else
            {
                $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Data NOT Saved  &nbsp;<i class="fa fa-times"></i></h4>';
                $_SESSION['msg_type'] = "danger";
              header('location: regit-cashier.php');
            }
        }
   
    }
    else
    {
        $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Password does not match  &nbsp;<i class="fa fa-times"></i></h4>';
        $_SESSION['msg_type'] = "danger";
        header('location: regit-cashier.php');
    }
}

//Delete Cashier Account
if(isset($_POST['btndeletecahsier']))
{
    $id = $_POST['delete_id'];

    $sql = "DELETE FROM user_account_tbl WHERE user_id ='$id'";
    $query_run=mysqli_query($conn, $sql);

    if($query_run)
    {
      $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Deleted Successfully &nbsp;<i class="fa fa-check"></i></h4>';
      $_SESSION['msg_type'] = "success";
      header('location: regit-cashier.php');
      }
    else
    {
      $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Not Deleted &nbsp;<i class="fa fa-times"></i></h4>';
      $_SESSION['msg_type'] = "danger";
      header('location: regit-cashier.php');
    }
}

//Update cashier info
if (isset($_POST['btnupdatecashier']))
{
  $edit_id = $_POST['editid'];
  $firstname = $_POST['firstname'];
  $surname = $_POST['lastname'];
  $DOB = date('Y-m-d', strtotime($_POST['dob']));
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $address = $_POST['resident'];
  $contact = $_POST['tel'];
  $username = $_POST['username'];
  $usertype = $_POST['role'];

    $sql = "UPDATE user_account_tbl SET firstname='$firstname', lastname='$surname',dob='$DOB',age='$age',gender='$gender',
    resident='$address',tel='$contact',username='$username', role='$usertype' WHERE user_id ='$edit_id'";
     $query_run=mysqli_query($conn, $sql);

  if ($query_run)
  {
    $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Data Updated Successfully &nbsp;<i class="fa fa-check"></i></h4>';
    $_SESSION['msg_type'] = "success";
    header('location: regit-cashier.php');
  }
  else
  {
      $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Data NOT Updated &nbsp;<i class="fa fa-times"></i></h4>';
      $_SESSION['msg_type'] = "danger";
      header('location: regit-cashier-edit.php');
  }

}


//saving Menu food info
if (isset($_POST['btnmenu']))
{
  $menu = $_POST['foodtype'];
  $price = $_POST['price'];
  $packagetype = $_POST['packagetype'];

        $sql = "SELECT * FROM menu_food_tbl WHERE foodtype = '$menu'";
        $query_run = mysqli_query($conn, $sql);
  
        if (mysqli_num_rows($query_run) > 0)
        {
            $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Food Menu Already Exist &nbsp;<i class="fa fa-times"></i> </h4>';
            $_SESSION['msg_type'] = "danger";
            header('location: New_food_menu.php');
            }   
            else
            {
            $sql = "INSERT INTO menu_food_tbl (foodtype,price,packagetype) VALUES('$menu','$price','$packagetype')";
            $query_run=mysqli_query($conn, $sql);

          if ($query_run)
            {
              $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Data Saved Successfully &nbsp;<i class="fa fa-check"></i></h4>';
              $_SESSION['msg_type'] = "success";
              header('location: New_food_menu.php');
            }
            else
            {
                $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Data NOT Saved  &nbsp;<i class="fa fa-times"></i></h4>';
                $_SESSION['msg_type'] = "danger";
              header('location: regit-cashier.php');
            }
        }
   

}


//Update Menu food info
if (isset($_POST['btnupdatemenu']))
{
  $edit_id = $_POST['update_id'];
  $foodtype = $_POST['foodtype'];
  $price = $_POST['price'];
  $packagetype = $_POST['packagetype'];

    $sql = "UPDATE menu_food_tbl SET foodtype='$foodtype', price='$price',packagetype='$packagetype' WHERE id ='$edit_id'";
     $query_run=mysqli_query($conn, $sql);

  if ($query_run)
  {
    $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Data Updated Successfully &nbsp;<i class="fa fa-check"></i></h4>';
    $_SESSION['msg_type'] = "success";
    header('location: New_food_menu.php');
  }
  else
  {
      $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Data NOT Updated &nbsp;<i class="fa fa-times"></i></h4>';
      $_SESSION['msg_type'] = "danger";
      header('location: New_food_menu.php');
  }

}

//Delete Cashier Account
if(isset($_POST['btndeletemenu']))
{
    $id = $_POST['delete_id'];

    $sql = "DELETE FROM menu_food_tbl WHERE id ='$id'";
    $query_run=mysqli_query($conn, $sql);

    if($query_run)
    {
      $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Deleted Successfully &nbsp;<i class="fa fa-check"></i></h4>';
      $_SESSION['msg_type'] = "success";
      header('location: New_food_menu.php');
      }
    else
    {
      $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Not Deleted &nbsp;<i class="fa fa-times"></i></h4>';
      $_SESSION['msg_type'] = "danger";
      header('location: New_food_menu.php');
    }
}

// supervisor password update
if (isset($_POST['btnSupervisonresetpassword']))
{
  $id = $_SESSION['id'];
  $password = sha1($_POST['passwoord']);
  $cpassword = sha1($_POST['cpasssword']);

  if($password==$cpassword)
  {
    $sql = "UPDATE ad_tbl SET passwoord='$password' WHERE id =' $id'";
    $query_run=mysqli_query($conn, $sql);

    if($query_run)
    {
      $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Password Reset Successfully &nbsp;<i class="fa fa-check"></i></h4>';
      $_SESSION['msg_type'] = "success";
      header('location: Supervisor-change-password.php');
    }
    else
    {
      $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Error: password did not change &nbsp;<i class="fa fa-times"></i></h4>';
      $_SESSION['msg_type'] = "danger";
      header('location: Supervisor-change-password.php');
    }
  }
  else
  {
    $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Error: Password did not match &nbsp;<i class="fa fa-times"></i></h4>';
    $_SESSION['msg_type'] = "danger";
    header('location: Supervisor-change-password.php');
  }


}

// supervisor password update
if (isset($_POST['btnresetuserpassword']))
{
  $id = $_POST['edit_id'];
  $password = sha1($_POST['passwoord']);
  $cpassword = sha1($_POST['cpasssword']);

  if($password==$cpassword)
  {
    $sql = "UPDATE user_account_tbl SET passwoord='$password' WHERE id =' $id'";
    $query_run=mysqli_query($conn, $sql);

    if($query_run)
    {
      $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Password Reset Successfully &nbsp;<i class="fa fa-check"></i></h4>';
      $_SESSION['msg_type'] = "success";
      header('location: SupervisorAdmin-change-password.php');
    }
    else
    {
      $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Error: password did not change &nbsp;<i class="fa fa-times"></i></h4>';
      $_SESSION['msg_type'] = "danger";
      header('location: SupervisorAdmin-change-password.php');
    }
  }
  else
  {
    $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Error: Password did not match &nbsp;<i class="fa fa-times"></i></h4>';
    $_SESSION['msg_type'] = "danger";
    header('location: SupervisorAdmin-change-password.php');
  }


}

// exporting all data to excell
if(isset($_POST["exportbtn"]))
{    
    header('Content-Type: text/csv; charset=utf-8');  
    header('Content-Disposition: attachment; filename=Sales_Report'.date('Ymd').'.csv');  
    $output = fopen("php://output", "w");  
    fputcsv($output, array('ID','Invoice No', 'Customer ID', 'Cashier Name', 'Total Sales', 'Cash','Balance','Date Sold'));  
    $sql = "SELECT * from billing_tbl ORDER BY receiptid ASC";  
    $result = mysqli_query($conn, $sql);  
    while($row = mysqli_fetch_assoc($result))  
    {  
        fputcsv($output, $row);  
    }  
    fclose($output);
}

// exporting data by filtering date
if(isset($_POST["filterdateexport"]))
{
  $from_date = $_POST['start_date'];
  $to_date = $_POST['end_date'];

  $query = "SELECT * FROM billing_tbl where datesold between '".$from_date."' and '".$to_date."' ORDER BY id asc";
  $result = mysqli_query($conn,$query);
  $record_arr = array();

  $filename = 'Sales_Report'.date('Ymd').'.csv';
  header("Content-Description: File Transfer");
  header("Content-Disposition: attachment; filename=$filename");
  header("Content-Type: application/csv;");
  $file = fopen($filename,"w");
  $record_arr = array("Invoice No","Customer ID","Cashier Name","Total Sales","Cash","Balance","Date Sold"); 
  fputcsv($file,$record_arr); 


  while($row = mysqli_fetch_assoc($result))
  {
    $receiptid = $row['receiptid'];
    $customer_name = $row['customer_name'];
    $username = $row['username'];
    $total_sales = $row['total_sales'];
    $cash = $row['cash'];
    $balance = $row['balance'];
    $datesold = $row['datesold'];

    // Write to file 
    $record_arr = array($receiptid,$customer_name,$username,$total_sales,$cash,$balance,$datesold);
    fputcsv($file,$record_arr); 
  
  }

  fclose($file);

  // download
  header("Content-Description: File Transfer");
  header("Content-Disposition: attachment; filename=$filename");
  header("Content-Type: application/csv; ");

  readfile($filename);



 }





















?>