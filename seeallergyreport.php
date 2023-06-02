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
   table {
      border-collapse: collapse;
      width: 100%;
      margin-bottom: 20px;
   }
   th, td {
      text-align: left;
      padding: 8px;
      border: 2px solid #ddd;
      font-size: 18px;
   }
   th {
      background-color: white;
   }
</style>

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

               if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  if (isset($_POST["reject"])) {
                     $sId = $_POST["reject"];
                     $stmt = $conn->prepare("DELETE FROM symptom WHERE s_id = :sId");
                     $stmt->bindParam(':sId', $sId);
                     $stmt->execute();
                  } elseif (isset($_POST["accept"])) {
                     $sId = $_POST["accept"];
                     $stmt = $conn->prepare("SELECT * FROM symptom WHERE s_id = :sId");
                     $stmt->bindParam(':sId', $sId);
                     $stmt->execute();
                     $row = $stmt->fetch();

                     // Move the row to the "variable_child_information" table and update the "allergy" column
                     $stmt = $conn->prepare("INSERT INTO variable_child_information (allergy) VALUES (:allergy)");
                     $stmt->bindParam(':allergy', $row['rash']);
                     $stmt->execute();

                     // Delete the row from the "symptom" table
                     $stmt = $conn->prepare("DELETE FROM symptom WHERE s_id = :sId");
                     $stmt->bindParam(':sId', $sId);
                     $stmt->execute();
                  }
               }

               // Select all rows from the "symptom" table
               $stmt = $conn->query("SELECT * FROM symptom");

               // Display the results in an HTML table with borders
               echo "<table>";
               echo "<tr><th>s_ID</th><th>rash</th><th>vomit</th><th>fever</th><th>c_id</th></tr>";
               while ($row = $stmt->fetch()) {
                  echo "<tr id='row_" . $row["s_id"] . "'>";
                  echo "<td>" . $row["s_id"] . "</td>";
                  echo "<td>" . $row["rash"] . "</td>";
                  echo "<td>" . $row["vomit"] . "</td>";
                  echo "<td>" . $row["fever"] . "</td>";
                  echo "<td>" . $row["c_id"] . "</td>";
                  echo "<td>
                           <form method='POST' action=''>
                              <input type='hidden' name='reject' value='" . $row["s_id"] . "'>
                              <button type='submit'>Reject</button>
                           </form>
                        </td>";
                  echo "<td>
                           <form method='POST' action=''>
                              <input type='hidden' name='accept' value='" . $row["s_id"] . "'>
                              <button type='submit'>Accept</button>
                           </form>
                        </td>";
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