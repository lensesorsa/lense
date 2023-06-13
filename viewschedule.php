<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<style>
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
   th, td {
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

<body style="background-image:none; background-color:lightblue">
   <div class="container">
<<<<<<< Updated upstream
      <?php @include 'header.php'; ?>
=======
      <?php @include 'Nhome.php'; ?>
      <?php @include 'nursenavigation.php'; ?>

>>>>>>> Stashed changes
      <section class="contact">
      <h1 class="heading">see schedule</h1>

         <fieldset style="width: 10;">
            <?php
            $host = "localhost";
            $username = "root";
            $password = "";
            $dbname = "vaccination_db";

            try {
               $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               session_start();

               // Select all rows from the "users" table
               $stmt = $conn->query("SELECT * FROM schedule where date=curdate()");//for the specific nurse and time that time is also specified

               // Display the results in an HTML table
               echo "<table>";
               echo "<tr><th>child ID</th><th>vaccine type</th><th>time</th><th>child name</th>";
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
      </section>
   </div>

</body>

</html>