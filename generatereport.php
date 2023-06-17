<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Weekly and Monthly Reports</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/Style.css">
   <link rel="shortcut icon" href="images/ye.jpg">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">

   <style>
      

      table {
         margin-bottom: 20px;
      }
      h1,h2, h3, p {
         font-size: 24px;
         padding: 10px;

      }
      button {
         font-size: 18px;
         background-color: lightgreen;
         color: black;
         padding: 10px 20px;
         border: none;
         border-radius: 5px;
         cursor: pointer;
      }
      button:hover {
         background-color: darkgreen;
         color: White;
      }
   </style>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
   $(document).ready(function() {
      $("#showVaccinesGivenWeeklyBtn").click(function() {
         $("#vaccinesGivenWeeklyReport").toggle(); // Toggle the display of the weekly report for Vaccines Given
         $("#detailedReportWeekly").hide(); // Hide the detailed report for Vaccines Remaining (Weekly)
      });

      $("#showReportWeeklyBtn").click(function() {
         $("#detailedReportWeekly").toggle(); // Toggle the display of the detailed report for Vaccines Remaining (Weekly)
         $("#vaccinesGivenWeeklyReport").hide(); // Hide the weekly report for Vaccines Given
      });

      $("#showVaccinesGivenMonthlyBtn").click(function() {
         $("#vaccinesGivenMonthlyReport").toggle(); // Toggle the display of the monthly report for Vaccines Given
         $("#detailedReportMonthly").hide(); // Hide the detailed report for Vaccines Remaining (Monthly)
      });

      $("#showReportMonthlyBtn").click(function() {
         $("#detailedReportMonthly").toggle(); // Toggle the display of the detailed report for Vaccines Remaining (Monthly)
         $("#vaccinesGivenMonthlyReport").hide(); // Hide the monthly report for Vaccines Given
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
            $queryWeekly = "SELECT v_type, ammount FROM vaccine WHERE WEEK(received_date) = WEEK(CURDATE())";
            $stmtWeekly = $db->query($queryWeekly);

            // Calculate total vaccines given for the specific week
            $givenQueryWeekly = "SELECT COUNT(*) AS total_given FROM vaccination_record WHERE WEEK(date) = :week";
            $givenStmtWeekly = $db->prepare($givenQueryWeekly);
            $givenStmtWeekly->bindValue(':week', date('W'));
            $givenStmtWeekly->execute();
            $givenRowWeekly = $givenStmtWeekly->fetch(PDO::FETCH_ASSOC);
            $totalGivenWeekly = $givenRowWeekly['total_given'];

            // Query to fetch vaccines given for the specific week
            $vaccinesGivenQueryWeekly = "SELECT vaccine_type, COUNT(vaccine_type) AS total_given FROM vaccination_record WHERE WEEK(date) = :week GROUP BY vaccine_type";
            $vaccinesGivenStmtWeekly = $db->prepare($vaccinesGivenQueryWeekly);
            $vaccinesGivenStmtWeekly->bindValue(':week', date('W'));
            $vaccinesGivenStmtWeekly->execute();
            $vaccinesGivenWeekly = $vaccinesGivenStmtWeekly->fetchAll(PDO::FETCH_ASSOC);

            // Query to fetch vaccines remaining
            $remainingQueryWeekly = "SELECT v_type, ammount FROM vaccine";
            $remainingStmtWeekly = $db->query($remainingQueryWeekly);
            $remainingVaccinesWeekly = $remainingStmtWeekly->fetchAll(PDO::FETCH_ASSOC);

            // Query to fetch the total amount of vaccines remaining
            $totalRemainingQueryWeekly = "SELECT SUM(ammount) AS total_remaining FROM vaccine";
            $totalRemainingStmtWeekly = $db->query($totalRemainingQueryWeekly);
            $totalRemainingRowWeekly = $totalRemainingStmtWeekly->fetch(PDO::FETCH_ASSOC);
            $totalRemainingWeekly = $totalRemainingRowWeekly['total_remaining'];

            // Query to fetch vaccines expiring in 10 days
          //  $expiringQueryWeekly = "SELECT COUNT(*) AS expiring FROM vaccine WHERE exp_date <= CURDATE() + INTERVAL 10 DAY";
           // $expiringStmtWeekly = $db->query($expiringQueryWeekly);
           // $expiringRowWeekly = $expiringStmtWeekly->fetch(PDO::FETCH_ASSOC);
           // $expiringWeekly = $expiringRowWeekly['expiring'];

            // Query to fetch vaccine data for the current month
            $queryMonthly = "SELECT v_type, ammount FROM vaccine WHERE MONTH(received_date) = MONTH(CURDATE())";
            $stmtMonthly = $db->query($queryMonthly);

            // Calculate total vaccines given for the specific month
            $givenQueryMonthly = "SELECT COUNT(*) AS total_given FROM vaccination_record WHERE MONTH(date) = :month";
            $givenStmtMonthly = $db->prepare($givenQueryMonthly);
            $givenStmtMonthly->bindValue(':month', date('m'));
            $givenStmtMonthly->execute();
            $givenRowMonthly = $givenStmtMonthly->fetch(PDO::FETCH_ASSOC);
            $totalGivenMonthly = $givenRowMonthly['total_given'];

            // Query to fetch vaccines given for the specific month
            $vaccinesGivenQueryMonthly = "SELECT vaccine_type, COUNT(vaccine_type) AS total_given FROM vaccination_record WHERE MONTH(date) = :month GROUP BY vaccine_type";
            $vaccinesGivenStmtMonthly = $db->prepare($vaccinesGivenQueryMonthly);
            $vaccinesGivenStmtMonthly->bindValue(':month', date('m'));
            $vaccinesGivenStmtMonthly->execute();
            $vaccinesGivenMonthly = $vaccinesGivenStmtMonthly->fetchAll(PDO::FETCH_ASSOC);

            // Query to fetch vaccines remaining for the specific month
            $remainingQueryMonthly = "SELECT v_type, ammount FROM vaccine";
            $remainingStmtMonthly = $db->query($remainingQueryMonthly);
            $remainingVaccinesMonthly = $remainingStmtMonthly->fetchAll(PDO::FETCH_ASSOC);

            // Query to fetch the total amount of vaccines remaining for the specific month
            $totalRemainingQueryMonthly = "SELECT SUM(ammount) AS total_remaining FROM vaccine";
            $totalRemainingStmtMonthly = $db->query($totalRemainingQueryMonthly);
            $totalRemainingRowMonthly = $totalRemainingStmtMonthly->fetch(PDO::FETCH_ASSOC);
            $totalRemainingMonthly = $totalRemainingRowMonthly['total_remaining'];

            // Query to fetch vaccines expiring in 10 days for the specific month
          //  $expiringQueryMonthly = "SELECT v_type FROM vaccine WHERE exp_date <= CURDATE() + INTERVAL 10 DAY";
           // $expiringStmtMonthly = $db->query($expiringQueryMonthly);
           // $expiringVaccines = $expiringStmtMonthly->fetchAll(PDO::FETCH_ASSOC);

           $expiringQueryMonthly = "SELECT COUNT(*) AS num_expired FROM vaccine WHERE exp_date <= CURDATE() + INTERVAL 10 DAY";
            $expiringStmtMonthly = $db->query($expiringQueryMonthly);
            $expiringRowMonthly = $expiringStmtMonthly->fetch(PDO::FETCH_ASSOC);
            $numExpired = $expiringRowMonthly['num_expired'];

            $expiringQueryMonthly = "SELECT v_type, ammount FROM vaccine WHERE exp_date <= CURDATE() + INTERVAL 10 DAY";
            $expiringStmtMonthly = $db->query($expiringQueryMonthly);
            $expiringVaccines = $expiringStmtMonthly->fetchAll(PDO::FETCH_ASSOC);

            // Close the database connection
            $db = null;
         } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
         }
      ?>

      <h1> <strong>Weekly and Monthly Reports</strong></h1>
      
      <h2>Vaccines Given Detail</h2>
      <button id="showVaccinesGivenWeeklyBtn">Weekly Report</button>
      <button id="showVaccinesGivenMonthlyBtn">Monthly Report</button>
      
      <div id="vaccinesGivenWeeklyReport" style="display: none;">
         <h3><strong>Weekly Report for Vaccines Given</strong></h3>
         <table   class="table table-bordered table-striped" style='font-size: 22px; padding: 10px'>
         <tr><th>Vaccine Type</th><th style='padding-left: 30px;'>Vaccines Remaining</th></tr>
            <?php
               foreach ($vaccinesGivenWeekly as $row) {
                  echo "<tr><td>".$row['vaccine_type']."</td><td>".$row['total_given']."</td></tr>";
               }
            ?>
         </table>
         <p>Total Vaccines Given: <?php echo $totalGivenWeekly; ?></p>
      </div>

      <div id="vaccinesGivenMonthlyReport" style="display: none;">
         <h3><strong>Monthly Report for Vaccines Given</strong></h3>
         <table   class="table table-bordered table-striped" style='font-size: 22px; padding: 10px'>
         <tr><th>Vaccine Type</th><th style='padding-left: 30px;'>Vaccines Remaining</th></tr>
            <?php
               foreach ($vaccinesGivenMonthly as $row) {
                  echo "<tr><td>".$row['vaccine_type']."</td><td>".$row['total_given']."</td></tr>";
               }
            ?>
         </table>
         <p>Total Vaccines Given: <?php echo $totalGivenMonthly; ?></p>
         <hr>
      </div>

      <h2>Vaccines Remaining Detail</h2>
      <button id="showReportWeeklyBtn">Weekly Report</button>
      <button id="showReportMonthlyBtn">Monthly Report</button>
      
      <div id="detailedReportWeekly" style="display: none;">
         <h3>Weekly Detailed Report for Vaccines Remaining</h3>
         <table  class="table table-bordered table-striped" style='font-size: 22px; padding: 10px'>
         <tr><th>Vaccine Type</th><th style='padding-left: 30px;'>Vaccines Remaining</th></tr>
            <?php
               foreach ($remainingVaccinesWeekly as $row) {
                  echo "<tr><td>".$row['v_type']."</td><td>".$row['ammount']."</td></tr>";
               }
            ?>
         </table>
         <p>Total Vaccines Remaining: <?php echo $totalRemainingWeekly; ?></p>
         <h3><strong>Detail Report of Expiring Vaccines</strong></h3>
         <?php

if (count($expiringVaccines) > 0) {
    ?>
    <table class="table table-bordered table-striped " style='font-size: 22px; padding: 10px'>
        <tr>
            <th>Vaccine Type</th>
            <th>Number</th>
        </tr>
        <?php foreach ($expiringVaccines as $vaccine) { ?>
            <tr>
                <td><?php echo $vaccine['v_type']; ?></td>
                <td><?php echo  $vaccine['ammount'];  ?></td>
            </tr>
        <?php } ?>
    </table>
    <?php
} else {
    echo "<p>No expiring vaccines found.</p>";
}
?>
         


         <p>Vaccines Expiring in 10 Days: <?php echo $numExpired; ?></p>
      </div>

      <div id="detailedReportMonthly" style="display: none;">
         <h3><strong>Detailed Report of Vaccines Remaining</strong></h3>
         <table  class="table table-bordered table-striped" style='font-size: 22px; padding: 10px'>
         <tr><th>Vaccine Type</th><th style='padding-left: 30px;'>Vaccines Remaining</th></tr>
            <?php
               foreach ($remainingVaccinesMonthly as $row) {
                  echo "<tr><td>".$row['v_type']."</td><td>".$row['ammount']."</td></tr>";
               }
            ?>
         </table>
         <p>Total Vaccines Remaining: <?php echo $totalRemainingMonthly; ?></p>
         <strong><hr></strong>
         <h3><strong>Detail Report of Expiring Vaccines</strong></h3>
      
<?php

if (count($expiringVaccines) > 0) {
    ?>
    <table class="table table-bordered table-striped " style='font-size: 22px; padding: 10px'>
        <tr>
            <th>Vaccine Type</th>
            <th>Number</th>
        </tr>
        <?php foreach ($expiringVaccines as $vaccine) { ?>
            <tr>
                <td><?php echo $vaccine['v_type']; ?></td>
                <td><?php echo  $vaccine['ammount'];  ?></td>
            </tr>
        <?php } ?>
    </table>
    <?php
} else {
    echo "<p>No expiring vaccines found.</p>";
}
?>

<p>Total number of expired vaccines: <?php echo $numExpired; ?></p>   </div>

      <?php @include 'footer.php'; ?>
   </div>

   <!-- swiper js bundle  -->
   <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
   <!-- custom js file link  -->
   <script src="js/main.js"></script>
</body>
</html>
