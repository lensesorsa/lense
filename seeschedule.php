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
</style>

<body style="background-color:lightblue">
   <div class="container">

      <?php @include 'header.php'; ?>
      <h1 class="heading">see schedule</h1>

      <fieldset>
         <!-- <div> 
            <div>
               <h1 class="heading">Schedule</h1>

            </div>

            <div>
               <h6 class="heading">child name: </h6>
            </div>
            <div>
               <h6 class="heading">Date: </h6>
            </div>   <div>
               <h6 class="heading">Time: </h6>
            </div>
         </div>-->
         <?php
         $host = "localhost";
         $username = "root";
         $password = "";
         $dbname = "vaccination_db";

         try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            session_start();

            $c_id =  $_SESSION["c_id"];

 
           $stmt = $conn->query("SELECT c_id, v_type,time FROM schedule where c_id='$c_id'"); //where child is his own child's session
            $select=$conn->query("SELECT name from child where c_id='$c_id'");

            //Display the results in an HTML table with borders and clickable rows
            echo "<table>";
            echo "<tr><th>Child Name</th><th>Vaccine Type</th><th>Time</th></tr>";
            while (($row = $stmt->fetch())&&($rows=$select->fetch())) {
              
               echo "<td>" . $rows["name"] . "</td>";
                echo "<td>" . $row["v_type"] . "</td>";
               echo "<td>" . $row["time"] . "</td>";
              
               echo "</tr>";
            }
            echo "</table>";
            $conn = null; // Close the database connection
         } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
         }
         ?>
      </fieldset>
      <?php @include 'footer.php'; ?>
   </div>
   <!-- swiper js link  -->
   <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
   <!-- custom js file link  -->
   <script src="js/script.js"></script>
</body>

</html>