<?php 
  session_start();
  if (!isset($_SESSION['user_id']) || !isset($_SESSION['name']) || $_SESSION['role'] !== 'parent') {
   header("location:home.php");
   
}
?>
<div class="box">
            <a href="seeschedule.php"> <i class="fas fa-calendar-alt"></i> See Schedule</a>
            <a href="reportallergy.php"> <i class="fas fa-exclamation-triangle"></i> Report Allergy</a>
</div>