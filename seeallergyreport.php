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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-0J1gK7rmOF/sJbq0RqQrGVAfH3f2z3W5sJy3a3HcL9hJ9yTscN+R6J3k5j3lYwoF2+Gg7WbTn7rQoQf4QV3RlA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
</style>

<body style="background-image:none; background-color:lightblue">
   <div class="container">
      <?php @include 'NKhome.php'; ?>
      <?php @include 'NKnavigation.php'; ?>

      <h1 class="heading">Allergy report</h1>

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

               $stmt = $conn->query("SELECT * FROM symptom");

               // Display the results in an HTML table with borders
               echo "<table>";
               echo "<tr><th>s_ID</th><th>rash</th><th>vomit</th><th>fever</th><th>c_id</th><th>date</th><th>Action</th></tr>";
               while ($row = $stmt->fetch()) {
                  echo "<tr id='row_" . $row["s_id"] . "'>";
                  echo "<td>" . $row["s_id"] . "</td>";
                  echo "<td>" . ($row["rash"] == 1 ? "<i class='fas fa-check'></i>" : "<i class='fas fa-times'></i>") . "</td>";
                  echo "<td>" . ($row["vomit"] == 1 ? "<i class='fas fa-check'></i>" : "<i class='fas fa-times'></i>") . "</td>";
                  echo "<td>" . ($row["fever"] == 1 ? "<i class='fas fa-check'></i>" : "<i class='fas fa-times'></i>") . "</td>";
                  echo "<td>" . $row["c_id"] . "</td>";
                  echo "<td>" . $row["date"] . "</td>";
                  echo "<td>



                              <form method='POST' action=''>
                              <form>
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

                  $date = $row["date"];
                  $c_id = $row["c_id"];
               }
               echo "</table>";

               if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  if (isset($_POST["reject"])) {
                     $sId = $_POST["reject"];
                     $stmt = $conn->prepare("DELETE FROM symptom WHERE s_id = :sId");
                     $stmt->bindParam(':sId', $sId);
                     $stmt->execute();
                  } elseif (isset($_POST["accept"])) {
                     $sId = $_POST["accept"];

                     $select = $conn->query("SELECT vaccine_type FROM vaccination_record WHERE c_id='$c_id' AND date='$date'");
                     while ($row = $select->fetch()) {
                        $v_type = $row["vaccine_type"];
                     }
                     $dates = date('Y-m-d');
                     $stmt = $conn->prepare("INSERT INTO variable_child_information (allergy,c_id,date) VALUES (:allergy,:c_id,:date)");
                     $stmt->bindParam(':allergy', $v_type);
                     $stmt->bindParam(':c_id', $c_id);
                     $stmt->bindParam(':date', $dates);
                     // set $date to the current date in YYYY-MM-DD format
                     $stmt->execute();

                     // Delete the row from the "symptom" table


                     $stmt = $conn->prepare("DELETE FROM symptom WHERE s_id = :sId");
                     $stmt->bindParam(':sId', $sId);
                     $stmt->execute();
                  }
               }



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