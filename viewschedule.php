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
   <title>view schedule</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
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
   width: 80%;
}

/* Navigation styles */
.box {
   background-color: #f2f2f2;
   padding: 20px;
   height: auto;
   position: sticky;
   left: 0;
   top: 0;
   overflow-y: auto;
   margin-top: 5pc;
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
   body {
      background-color: lightblue;
      font-family: Arial, sans-serif;
   }

   table {
      border-collapse: collapse;
      width: 100%;
      margin-bottom: 20px;
      background-color: white;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      overflow: hidden;
   }

   th,
   td {
      text-align: left;
      padding: 12px;
      border-bottom: 1px solid #ddd;
   }

   th {
      background-color: #f2f2f2;
      font-size: 18px;
      text-transform: uppercase;
   }

   td {
      font-size: 16px;
   }

   button {
      display: inline-block;
      padding: 8px 12px;
      border-radius: 6px;
      border: none;
      background-color: #4CAF50;
      color: white;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin: 5%;
   }

   button:hover {
      background-color: #3e8e41;
   }
</style>

<body style="background-color:lightblue">
<?php @include 'Nhome.php'; ?> 
<?php 

$n_id=$_SESSION['n_id'];
                           $host = "localhost";
                           $username = "root";
                           $password = "";
                           $dbname = "vaccination_db";

                           try {
                              $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 ?>
<section class="contact"> 
         <!-- <h1 class="heading">see schedule</h1> -->
     <section class="footer">
     <h1 class="heading">see schedule</h1>

     <!-- <div class="box-container"> -->
     <div class="container">
      <div class="row">
         <div class="col-3">
            <div class="box">
            <?php @include 'nursenavigation.php'; ?> 

            </div>
         </div>
         <div class="col-9 welcome">
            <div class="content">
                        <fieldset style="width: 10;">
                           <?php
                            
                              // Select all rows from the "users" table
                              $stmt = $conn->query("SELECT * FROM schedule where  n_id='$n_id'"); //for the specific nurse and time that time is also specified

                              // Display the results in an HTML table
                              echo "<table>";
                              echo "<tr><th>child ID</th><th>vaccine type</th><th>time</th><th>Action</th>";
                              while ($row = $stmt->fetch()) {
                                 echo "<tr>";
                                 echo "<td>" . $row["c_id"] . "</td>";
                                 echo "<td>" . $row["v_type"] . "</td>";
                                 echo "<td>" . $row["time"] . "</td>";
                                 echo '<td><button onclick="window.location.href = \'immunize.php\';">immunize</button></td>';
                                 //echo "<td>" . $row["c_name"] . "</td>";
                                 echo "</tr>";

                                 $_SESSION['c_id'] = $row["c_id"];
                              }
                              echo "</table>";

                              $conn = null; // Close the database connection

                           } catch (PDOException $e) {
                              echo "Error: " . $e->getMessage();
                           }
                           ?>
                        </fieldset>
                     </div>
                  </div>
               </div>
            </div>
            <?php @include 'footer.php'; ?>

         </section>
         </section>
   <!-- <?php @include 'footer.php'; ?> -->

</body>

</html>