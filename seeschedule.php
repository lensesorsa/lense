<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>see schedule</title>
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
      width: 20%;
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
</style>

<body style="background-color:lightblue">
   <?php @include 'Phome.php'; ?>
   <div class="container">
      <h1 class="heading">see schedule</h1>
      <section class="footer">
         <!-- <div class="box-container"> -->
         <div class="container">
            <div class="row">
               <div class="col-3">
                  <div class="box">
                     <?php @include 'parentnavigation.php'; ?>
                  </div>
               </div>
               <div class="col-9 welcome">
                  <div class="content">
                     <fieldset>
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


                           $stmt = $conn->query("SELECT c_id, v_type,date,time FROM schedule where c_id='$c_id'"); //where child is his own child's session
                           $select = $conn->query("SELECT name from child where c_id='$c_id'");

                           //Display the results in an HTML table with borders and clickable rows
                           echo "<table>";
                           echo "<tr><th>Child Name</th><th>Vaccine Type</th><th>date</th><th>time</th></tr>";
                           while (($row = $stmt->fetch()) && ($rows = $select->fetch())) {

                              echo "<td>" . $rows["name"] . "</td>";
                              echo "<td>" . $row["v_type"] . "</td>";
                              echo "<td>" . $row["date"] . "</td>";
                              if ($row["time"] != null) {
                                 if (strtotime($row["date"]) < time()) {
                                    // schedule date has passed, show a warning message
                                    echo "<h2 class=error>The schedule for this event has passed</td>";
                                 } else {
                                    // schedule date is in the future, show the time
                                    echo "<td>" . $row["time"] . "</td>";
                                 }
                              } else {
                                 echo "<h2>The schedule is not yet set!!<hr>please come later</td>";
                              }


                              echo "</tr>";
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

      </section>
   </div>

   <?php @include 'footer.php'; ?>

   <!-- swiper js link  -->
   <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
   <!-- custom js file link  -->
   <script src="js/script.js"></script>
</body>

</html>