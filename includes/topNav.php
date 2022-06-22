<?php 
session_start();
if (!isset($_SESSION['IS LOGIN']))
{
  header('location:index.php');
  die();
}
?>


<div class="container-fluid">
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand"><img width="120px;" src="images/restaurant-logo.jpg"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
       
      </ul>

     <ul  class="navbar-nav mr-auto mb-2 mb-lg-0">
     <div class="dropdown">
  <a href="" class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        <?php
        echo $_SESSION['username'];
        ?>
  </a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
  <li><a class="dropdown-item"><?php Echo $_SESSION['username'];?></a></li>
    <li><a class="dropdown-item" href="logout.php">logout</a></li>
  </ul>
</div>
     </ul>
     </h6> 
    </div>
</nav>
</div>