<?php 
  session_start();
  if (!isset($_SESSION['user_id']) || !isset($_SESSION['name']) || $_SESSION['role'] !== 'nurse') {
   header("location:home.php");
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Nurse Home</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="shortcut icon" type="image/x-icon" href="image/logo.jpg" />
</head>
<style>
  /* Reset styles */
* {
   box-sizing: border-box;
   margin: 0;
   padding: 0;
}

/* Global styles */
body {
   font-family: Arial, sans-serif;
   font-size: 16px;
   line-height: 1.5;
   color: #333;
}

a {
   color: #007bff;
   text-decoration: none;
}

a:hover {
   color: #0056b3;
}

.container {
   max-width: 1000px;
   margin: 0 auto;
   padding: 20px;
   margin-top: 10px;
}

.row {
   display: flex;
   flex-direction: row;
   column-gap:10rem;
}

.col-3 {
   width: 20%;
   margin-right: 20px;
}

.col-9 {
   width: 75%;
}

/* Navigation styles */
.box {
   background-color: #f2f2f2;
   padding: 20px;
   height: 100%;
   position: sticky;
   left: 0;
   top: 0;
   overflow-y: auto;
}

.box a {
   display: block;
   margin-bottom: 15px;
   padding: 10px;
   color: #333;
   text-decoration: none;
   font-size: 18px;
   transition: background-color 0.2s ease-in-out;
}

.box a:hover {
   background-color: #007bff;
   color: #fff;
}

.box a i {
   margin-right: 10px;
}

/* Content styles */
.content {
   max-width: 800px;
   margin: 0 auto;
   padding: 40px;
}

.content h1 {
   font-size: 48px;
   font-weight: bold;
   margin-bottom: 20px;
}

.content p {
   font-size: 20px;
   line-height: 1.5;
   margin-bottom: 20px;
}

.btn {
   display: inline-block;
   padding: 10px 20px;
   background-color: #007bff;
   color: #fff;
   text-align: center;
   font-size: 18px;
   border-radius: 5px;
   transition: background-color 0.2s ease-in-out;
}

.btn:hover {
   background-color: #0056b3;
}
</style>
<body style="background-color: lightblue;">
   <?php @include 'header.php'; 
   $host = "localhost";
   $username = "root";
   $password = "";
   try {
      $conn = new PDO("mysql:host=$host;dbname=vaccination_db", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $n_name=$_SESSION['name'];
   $select=$conn->query("SELECT n_id from nurse where name='$n_name'");
   while($row=$select->fetch()){
      $_SESSION['n_id']=$row['n_id'];
   }

}catch(PDOException $e)
{
   echo $e->getMessage();
}?>
   <div class="container">
      <div class="row">
         <div class="col-3">
            <div class="box">
            <?php @include 'nursenavigation.php'; ?>
            </div>
         </div>
         <div class="col-9 welcome">
            <div class="content">
               <h1>Welcome to the website!</h1>
<p>Dear Nurses,

It is my pleasure to extend a warm welcome to all of you who have dedicated your lives to the noble profession of nursing. Your unwavering commitment to providing compassionate care to patients in their times of need is truly inspiring, and we are honored to have you as part of our healthcare team.
<br>
Once again, welcome to all nurses, and thank you for your service.</p>               <!-- <a href="#" class="btn">Learn More</a> -->
            </div>
         </div>
      </div>
   </div>
   <?php @include 'footer.php'; ?>
</body>
</html>