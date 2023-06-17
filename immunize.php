<?php session_start();
$c_id = $_SESSION['c_id'];
$host = "localhost";
$username = "root";
$password = "";
try {

   $conn = new PDO("mysql:host=$host;dbname=vaccination_db", $username, $password);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $v_typeErr = $fv_typeErr = $weightErr = $ZscoreErr = $dateErr = "";
   $v_type = $fv_type = $weight = $z_score = $date = "";
   // $successful= false;

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["v_type"])) {
         $v_typeErr = " field is required";
      } else {
         $v_type = $_POST["v_type"];
      }
      if (empty($_POST["weight"])) {
         $weightErr = " field is required";
      } else {
         $weight = $_POST["weight"];
      }
      if (empty($_POST["Z_score"])) {
         $ZscoreErr = " field is required";
      } else {
         $z_score = $_POST["Z_score"];
      }
      if (empty($_POST["fv_type"])) {
         $fv_typeErr = " field is required";
      } else {
         $fv_type = $_POST["fv_type"];
      }
      if (empty($_POST["date"])) {
         $dateErr = " field is required";
      } else {
         $date = $_POST["date"];
      }
      $sql = "INSERT INTO variable_child_information(c_id,weight,z_score,date) VALUES ('$c_id','$weight','$z_score',curdate());
            -- insert into schedule(date)values('$date');
            insert into vaccination_record(date,vaccine_type,c_id)values(curdate(),'$v_type','$c_id')";
      $update = "UPDATE schedule SET v_type = '$fv_type', date = '$date' WHERE c_id = '$c_id'";
      $conn->exec($sql);
      $conn->exec($update);
      $update1 = "update vaccine set ammount=ammount-1 where v_type='$v_type' LIMIT 1";
      $conn->exec($update1);

      $conn = null;
   }
} catch (PDOException $e) {
   echo $e->getMessage();
}

if ($v_typeErr == "" && $fv_typeErr == "" && $weightErr == "" && $ZscoreErr == "" && $dateErr == "") {
   // no errors, set successful to true
   $successful = true;
}

// your PHP code for registration goes here
//  $successfull = true;

if ($successful) {
   // show modal using JavaScript
   echo "<script>$(document).ready(function() { $('#myModal').modal('show'); });</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <style>
      table {
         border-collapse: collapse;
         width: 100%;
         margin-bottom: 20px;
      }

      th,
      td {
         text-align: left;
         padding: 8px;
         border: 2px solid #ddd;
         font-size: 18px;
      }

      th {
         background-color: white;

      }

      /* Add hover effect to rows */
      tr:hover {
         background-color: #f5f5f5;
         cursor: pointer;
      }

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
         column-gap: 10rem;
      }

      .col-3 {
         width: 30%;
         margin-right: 20px;
      }

      .col-9 {
         width: 85%;
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
         padding-top: 10rem;
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

      span.error {
         color: #FF0000;
      }
   </style>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>immunize</title>
   <!-- Add the Bootstrap CSS file -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

   <!-- Add the jQuery library -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <!-- Add the Bootstrap JS file -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body style="background-image:none; background-color:lightblue">
   <?php @include 'header.php'; ?>

   <div class="container">
      <h1 class="heading">immunize</h1>

      <section class="footer">

         <!-- <div class="container"> -->
         <section class="contact">
            <div class="row">
               <div class="col-3">
                  <div class="box">
                     <?php @include 'nursenavigation.php'; ?>
                  </div>
               </div>
               <div class="col-9 welcome">
                  <div class="content">
                     <form action="" method="post">

                        <div class="flex">
                           <div class="inputBox">
                              <span>enter vaccine given today</span>
                              <span class="error" style="color: red;"><?php echo $v_typeErr; ?></span>
                              <select name="v_type">
                                 <option value="none"> none</option>
                                 <option value="BCG">BCG</option>
                                 <option value="polio 0">polio 0</option>
                                 <option value="polio 1">polio 1</option>
                                 <option value="polio 2">polio 2</option>
                                 <option value="polio 3">polio 3</option>
                                 <option value="rota 1">rota 1</option>
                                 <option value="rota 2">rota 2</option>
                                 <option value="penta">penta</option>
                                 <option value="PCV">PCV</option>
                                 <option value="measles">measles</option>
                                 <option value="vit_A">vit_A</option>
                              </select>
                           </div>
                           <div class="inputBox">
                              <span>weight </span>
                              <span class="error" style="color: red;"><?php echo $weightErr; ?></span>
                              <input type="text" placeholder="enter weight" name="weight" required>
                           </div>
                           <div class="inputBox">
                              <span>Z_score:</span>
                              <span class="error" style="color: red;"> <?php echo $ZscoreErr; ?></span>
                              <input type="text" placeholder="enter z_score" name="Z_score">
                           </div>
                           <div class="inputBox">
                              <span>enter next vaccine to be given</span>
                              <span class="error" style="color: red;"><?php echo $fv_typeErr; ?></span>
                              <select name="fv_type">
                                 <option value="none"> none</option>
                                 <option value="BCG">BCG</option>
                                 <option value="polio 0">polio0</option>
                                 <option value="polio 1">polio1</option>
                                 <option value="polio 2">polio2</option>
                                 <option value="polio 3">polio3</option>
                                 <option value="measles">measles</option>
                                 <option value="rota 1">rota1</option>
                                 <option value="rota 2">rota2</option>
                                 <option value="penta">penta</option>
                                 <option value="PCV">PCV</option>
                                 <option value="vit_A">vit_A</option>
                              </select>
                           </div>
                           <div class="inputBox">
                              <span>Appoint next vaccination</span>
                              <span class="error" style="color: red;"> <?php echo $dateErr; ?></span>
                              <input type="date" name="date" min="2022-01-00" max="2050-12-30">
                           </div>
                        </div>
                        <input type="submit" value="submit" name="submit" id="submit" class="btn">
                     </form>
                  </div>
               </div>
            </div>
   </div>
   </section>

   <form>
      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
         <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"> immunize Successful!!</h4>
               </div>
               <div class="modal-body">
                  <p> immunization successful send.</p>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
   </form>
   </section>
   <script>
      $(document).ready(function() {
         $("#myModal").modal('hide');

         $("#submit").click(function() {
            $("#myModal").modal('show');
         });
      });
   </script>

   </div>

   <?php @include 'footer.php'; ?>
   <!-- swiper js link  -->
   <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
   <!-- custom js file link  -->
   <script src="js/script.js"></script>
</body>

</html>