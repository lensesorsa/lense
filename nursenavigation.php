<?php 
  session_start();
  if (!isset($_SESSION['user_id']) || !isset($_SESSION['name']) || $_SESSION['role'] !== 'nurse') {
   header("location:home.php");
   
}
?>
<a href="viewschedule.php" class="active"><i class="fas fa-calendar-alt"></i> View Schedule</a>
<a href="index.php"><i class="fas fa-user"></i> Child Profile</a>
<a href="generatereport.php"><i class="fas fa-file-alt"></i> Generate Report</a>