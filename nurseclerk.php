<!DOCTYPE html>
<html lang="en">
<head?>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nurse clerk Home</title>
  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- swiper css link  -->
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
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

<body style="background-color:lightblue">
  <?php @include 'header.php'; 
  session_start();
   if (!isset($_SESSION['user_id']) || !isset($_SESSION['name']) || $_SESSION['role'] !== 'nurseclerk') {
      header("location:home.php");
      
   }
  ?>
<div class="container">
   <div class="row">
      <div class="col-3">
         <div class="box">
              <?php @include 'NKnavigation.php'; ?>
         </div>
      </div>
      <div class="col-9" welcome>
         <div class="content">
            <h1 class="heading">Welcome to the website!</h1>
<p>Welcome to our Children Vaccination Management System! As a nurseclerk, you play a vital role in ensuring that children receive the necessary vaccinations to protect against preventable diseases. Our system is designed to streamline the vaccination process, making it easier for you to manage appointments, communicate with parents. </p>         </div>
      </div>
   </div>
</div>
<?php @include 'footer.php';?>
 
  
</body>


</html>