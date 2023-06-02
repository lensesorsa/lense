<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/Style.css">
   <ink rel="shortcut icon" href="images/ye.jpg">
</head>
<body style="background-color:lightblue">
<?php @include 'header.php'; ?>
<section class="footer">

   <div class="box-container">

      <div class="box">
         <a href="childprofile.php"> <i class="fas fa-angle-right"></i> childprofile</a>
         <a href="generatereport.php"> <i class="fas fa-angle-right"></i> generate report</a>
         <a href="immunize.php"> <i class="fas fa-angle-right"></i> immunize</a>
         <a href="appoint.php"> <i class="fas fa-angle-right"></i> appoint</a>
      </div>
      <div>
         <img src="image/nurse.jpg"/>
      </div>
   </div>
</section>
<?php @include 'footer.php'; ?>

</body>
</html>