<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- swiper css link  -->
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <!-- custom css file link  -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="images/ye.jpg">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .box-container {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: flex-start;
      width: 100%;
      margin-bottom: 100px;
      margin-bottom: 80px;

    }

    .box {
      background-color: #fff;
      padding: 20px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      width: 20%;
      position: fixed;
      left: 0;
      top: 120px;
      bottom: 0;
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

    .box a i.fa-user:before {
      content: "\f007";
    }

    .box a i.fa-calendar-alt:before {
      content: "\f073";
    }

    .box a i.fa-syringe:before {
      content: "\f48e";
    }

    .box a i.fa-notes-medical:before {
      content: "\f481";
    }

    .box a i.fa-plus-circle:before {
      content: "\f055";
    }

    .container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 40px;
      margin-left: 21%;
      margin-top: 80px;
    }

    .heading {
      font-size: 32px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.2s ease-in-out;
    }

    .btn:hover {
      background-color: #0062cc;
    }
    
.footer {
  background-color: #333;
  color: #fff;
  text-align: center;
  padding: 20px;
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  margin-top: 50px; /* add margin-top */
}
  </style>
</head>
<body>
  <?php @include 'header.php'; ?>

  <div class="box-container">
    <div class="box">
      <a href="register.php"><i class="fas fa-user-plus"></i> Register</a>
      <a href="schedule.php"><i class="fas fa-calendar-alt"></i> Schedule</a>
      <a href="vaccinemanagement.php"><i class="fas fa-syringe"></i> Manage Vaccine</a>
      <a href="seeallergyreport.php"><i class="fas fa-notes-medical"></i> See Allergy Report</a>
      <a href="content.php"><i class="fas fa-plus-circle"></i> Post General Information</a>
    </div>
  </div>

  <div class="container">
    <h1 class="heading">Welcome to our website!</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed felis quam. Sed id libero vel elit ornare finibus. Aliquam tincidunt justo id nulla fermentum, in aliquet orci ultrices. Aliquamerat volutpat. Vivamus maximus nisi nisi, a interdum nulla dictum sit amet. Nullam consequat libero ut nibh aliquam, non dapibus enim bibendum. Donec at elit ac urna interdum luctus. Donec sed metus tincidunt, aliquam mauris eget, molestie nunc. Sed sitamet odio vel sapien blandit tincidunt. Fusce vulputate nulla diam, eu consequat sem sagittis vel. Donec et enim eu erat bibendum bibendum. Sed in libero vel elit ornare finibus.</p>

    <a href="#" class="btn">Learn More</a>
  </div>
</body>


</html>