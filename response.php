<?php
session_start(); 
require_once 'includes/dbconnection.php';

if (isset($_POST['btnsavebills']))
{
    $balance = $total_sales - $cash ;

    $receiptid = $_POST['receiptid'];
    $customername = $_POST['customer_name'];
    $username = $_SESSION['username'];
    $total_sales = $_POST['total_sales'];
    $cash = $_POST['cash'];
    $balance = $_POST['balance'];
    $datesold = date('Y-m-d h:i:s', strtotime($_POST['datesold']));
    $serachdatesold = date('Y-m-d', strtotime($_POST['search_date']));


    $sql = "INSERT INTO billing_tbl (receiptid,customer_name,username,total_sales,cash,balance,datesold,search_date) 
    VALUES('$receiptid','$customername','$username','$total_sales','$cash','$balance','$datesold', '$serachdatesold')";
    $query_run=mysqli_query($conn, $sql);
    

    for($count = 0; $count < count($_POST['foodtype']); $count++)
    {
        $sql = "INSERT INTO menu_cashier_tbl (receiptid,foodtype,price,quantity,packagetype,total_cost) 
        VALUES('". $_POST["receiptid"] ."', '". $_POST["foodtype"][$count] ."', '". $_POST["price"][$count] ."', '". $_POST["quantity"][$count] ."', '". $_POST["packagetype"][$count] ."', '". $_POST["total_cost"][$count] ."')";
        $query_run=mysqli_query($conn, $sql);
    }
    if ($query_run)
    {
        $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Data Saved Successfully &nbsp;<i class="fa fa-check"></i></h4>';
        $_SESSION['msg_type'] = "success";
        header('location: cashier-page.php');
    }
    else
    {
        $_SESSION['message'] = '<h4 style="font-size:20px; text-align:center;  font-family: Gill Sans, Gill Sans MT, Calibri, Trebuchet MS, sans-serif">Data NOT Saved &nbsp;<i class="fa fa-times"></i></h4>';
        $_SESSION['msg_type'] = "danger";
        header('location: cashier-page.php');
    }



}
















?>