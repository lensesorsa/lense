<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Weekly Reports</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/Style.css">
   <link rel="shortcut icon" href="images/ye.jpg">
   <style>
       table {
         margin-bottom: 20px;
        
      }
      h2, h3, p {
         font-size: 24px;
         padding: 10px;
      }
      button {
         font-size: 18px;
         background-color: green;
         color: white;
         padding: 10px 20px;
         border: none;
         border-radius: 5px;
         cursor: pointer;
      }
      button:hover {
         background-color: darkgreen;
      }
   </style>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
      $(document).ready(function() {
         $("#showReportBtn").click(function() {
            $("#detailedReport").show(); // Show the detailed report
         });
      });
   </script>
</head>
<body style="background-color:lightblue">
   <div class="container">
      <?php @include 'header.php'; ?>
      <?php
      // Database connection details
      $host = "localhost";
      $username = "root";
      $password = "";
      $dbname = "vaccination_db";

      try {
         // Create a new PDO instance
         $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

         // Set the PDO error mode to exception
         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         // Query to fetch vaccine data for the current week
         $query = "SELECT v_type, ammount FROM vaccine WHERE WEEK(received_date) = WEEK(CURDATE())";
         $stmt = $db->query($query);

         // Check if there are any records
         if ($stmt->rowCount() >= 0) {
            echo "<h2>Weekly Report</h2>";
            echo "<h3>Week " . date("W") . " Report</h3>";

            // Calculate total vaccines given
            $totalGiven = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
               $totalGiven += $row['ammount'];
            }
            echo "<p>Vaccines given: " . $totalGiven . "</p>";

            // Query to fetch vaccines remaining
            $remainingQuery = "SELECT SUM(ammount) AS remaining FROM vaccine";
            $remainingStmt = $db->query($remainingQuery);
            $remainingRow = $remainingStmt->fetch(PDO::FETCH_ASSOC);
            $remaining = $remainingRow['remaining'] - $totalGiven;
            echo "<p style='font-size: 24px;'>Vaccines remaining: " . $remaining . " <button id='showReportBtn' style='font-size: 24px;'>Show Detailed Report</button></p>";

            // Display the report table initially hidden
            echo "<div id='detailedReport' style='display: none;'>";
            echo "<h3 style='font-size: 22px;'>Detailed Report</h3>";
            echo "<table border='1' style='font-size: 18px; padding: 10px;'>";
            echo "<tr><th>Vaccine Type</th><th style='padding-left: 30px;'>Remaining Quantity</th></tr>";
            
            // Query to fetch each vaccine type with remaining quantity
            $detailQuery = "SELECT v_type, ammount FROM vaccine";
            $detailStmt = $db->query($detailQuery);
            while ($detailRow = $detailStmt->fetch(PDO::FETCH_ASSOC)) {
               echo "<tr><td>".$detailRow['v_type']."</td><td style='padding-left: 30px;'>".$detailRow['ammount']."</td></tr>";
            }
            echo "</table>";
            echo "</div>";

            // Query to fetch vaccines expiring in 10 days
            $expiringQuery = "SELECT COUNT(*) AS expiring FROM vaccine WHERE exp_date <= CURDATE() + INTERVAL 10 DAY";
            $expiringStmt = $db->query($expiringQuery);
            $expiringRow = $expiringStmt->fetch(PDO::FETCH_ASSOC);
            $expiring = $expiringRow['expiring'];
            echo "<p>Vaccines to expire in 10 days: " . $expiring . "</p>";

         } else {
            echo "No records found.";
         }
      } catch(PDOException $e) {
         echo "Connection failed: " . $e->getMessage();
      }

      // Close the database connection
      $db = null;
      ?>
   </div>
</body>
</html>
