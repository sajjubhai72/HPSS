<?php session_start(); ?>
<div class="top_header">
         <div class="row">
            <div class="col-lg-12"><span id="english_date">2024 August 28, Wednesday</span><span id="nepali_date"></span>
               <!-- <a href="./login.php">Login</a> -->
               <?php 
          if (isset($_SESSION['user_id'])) {
            echo '
            <a href="dashboard.php" id="dashboard_link">Dashboard</a>
            <a href="logout.php" id="logout_link">Logout</a>
          ';
          } else {
          echo '<a href="login.php" id="login_link">Login</a>';
          }
        ?>
            </div>
         </div>
      </div>
      
<!-- navigation -->
<nav>
  <img src="./image/hpsslogo.jpg" alt="" />
  <div class="navigation">
    <ul>
      <i class="fa fa-times" id="menu-cl"></i>
      <li><a href="index.php"> Home </a></li>
          <li><a href="./dashboard/Notice-Dashboard/N-admin.php"> Notice </a></li>
          <li><a href="./dashboard/admission/A-admin.php"> Admission </a></li>
          <li><a href="./dashboard/teacher/admin/dashboard.php"> Teacher Details </a></li>
          <li><a href="./Dashboard/results/dashboard.php"> Student Result </a></li>
    </ul>
  </div>
</nav>
