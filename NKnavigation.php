
<?php 
  session_start();
  if (!isset($_SESSION['user_id']) || !isset($_SESSION['name']) || $_SESSION['role'] !== 'nurseclerk') {
   header("location:home.php");
   
}
?>
<a href="register.php"><i class="fas fa-user-plus"></i> Register</a>
            <a href="schedule.php"><i class="fas fa-calendar-alt"></i> Schedule</a>
            <a href="managevaccine.php"><i class="fas fa-syringe"></i> Manage Vaccine</a>
            <a href="seeallergyreport.php"><i class="fas fa-notes-medical"></i> See Allergy Report</a>
            <a href="content.php"><i class="fas fa-plus-circle"></i> Post General Information</a>