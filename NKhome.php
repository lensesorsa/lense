<?php 
  session_start();
  if (!isset($_SESSION['user_id']) || !isset($_SESSION['name']) || $_SESSION['role'] !== 'nurseclerk') {
   header("location:home.php");
   
}
?>
<section class="header">

   <a href="home.php" class="logo"> Jan meda health center</a>

   <nav class="navbar">
      <a href="nurseclerk.php">home</a>
      <a href="logout.php">logout</a>
      <a href="changepassword.php">change password</a>
   </nav>

   <div id="menu-btn" class="fas fa-bars"></div>

</section>