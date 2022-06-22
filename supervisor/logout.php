<?php
session_start();
unset($_SESSION['ROLE']);
unset($_SESSION['IS LOGIN']);
header('location:index.php');
die();
?>