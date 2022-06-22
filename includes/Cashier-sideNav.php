<div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><button class="btn btn-danger">Hide Me</button></a>
        <?php 
          echo '<h4 style="text-align:center; color:white;font-family:georgia,garamond,serif;font: size 30px;">'.$_SESSION['username'].'</h4>'; 
        ?>

      <div class="treeview">
        <a href=""><i class="fa fa-cog"></i>&nbsp;<span> Manage Bills</span>
            <span class="fa-pull-right-container">
            <i class="fa fa-angle-left fa-pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <a href="cashier-change-password.php"><i class="fa fa-unlock"></i>&nbsp;&nbsp;Change Password</a>
        </ul>
      </div>






  </div>