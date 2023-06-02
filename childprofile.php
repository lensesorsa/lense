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

<body style="background-image:none; background-color:lightblue">
   <div class="container">
      <?php @include 'header.php'; ?>
      <section class="contact">
         <fieldset style="width: 10;">
            <?php
            $host = "localhost";
            $username = "root";
            $password = "";
            $dbname = "vaccination_db";

            try {
               $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

               // Select all rows from the "users" table
               $stmt = $conn->query("SELECT * FROM schedule where date=curdate()");

               // Display the results in an HTML table
               echo "<table>";
               echo "<tr><th>child ID</th><th>vaccine type</th><th>time</th><th>child name</th>";
               while ($row = $stmt->fetch()) {
                  echo "<tr>";
                  echo "<td>" . $row["c_id"] . "</td>";
                  echo "<td>" . $row["v_type"] . "</td>";
                  echo "<td>" . $row["time"] . "</td>";
                  //echo "<td>" . $row["c_name"] . "</td>";
                  echo "</tr>";
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