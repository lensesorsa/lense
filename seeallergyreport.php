<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['name']) || $_SESSION['role'] !== 'nurseclerk') {
                  header("location:home.php");
                  
               }?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>See Allergy Report</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-0J1gK7rmOF/sJbq0RqQrGVAfH3f2z3W5sJy3a3HcL9hJ9yTscN+R6J3k5j3lYwoF2+Gg7WbTn7rQoQf4QV3RlA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
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
   width: 75%;
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
<?php @include 'NKhome.php'; ?>
   
<div class="container">
   <div class="row">
      <div class="col-3">
         <div class="box">
            <?php @include 'NKnavigation.php'; ?>
         </div>
      </div>
      <div class="col-9">
         <div class="content">
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
               
            //    $stmt = $conn->query("SELECT * FROM symptom");
            //    while ($row = $stmt->fetch()) { 
                  
            //       $session = array(
            //          "c_id" => $row["c_id"],
            //          "date" => $row["date"]
            //      );
             


            //       // $session['c_id']=$row["c_id"];
            //       // $session['date']=$row["date"];

            //       $stmts = $conn->query("SELECT vaccine_type FROM vaccination_record where c_id='{$session["c_id"]}' AND date='{$session["date"]}' ");
              
            //    echo "<table>";
            //    echo "<tr><th>#</th><th>rash</th><th>vomit</th><th>fever</th><th>Vaccine type</th><th>Action</th><th></th></tr>";
               
               
            //    // Display the results in an HTML table with borders
            //    while ($rows=$stmts->fetch()) {
            //          echo "<tr>";
            //       echo "<td>" . $row["c_id"] . "</td>";
            //       echo "<td>" . ($row["rash"] == 1 ? "<i class='fas fa-check'></i>" : "<i class='fas fa-times'></i>") . "</td>";
            //       echo "<td>" . ($row["vomit"] == 1 ? "<i class='fas fa-check'></i>" : "<i class='fas fa-times'></i>") . "</td>";
            //       echo "<td>" . ($row["fever"] == 1 ? "<i class='fas fa-check'></i>" : "<i class='fas fa-times'></i>") . "</td>";
            //       echo "<td>" . $rows["vaccine_type"] . "</td>";
            //       echo "<td>
            //                <form method='POST' action=''>
            //                   <input type='hidden' name='reject' value='" . $row["s_id"] . "'>
            //                   <button type='submit'>Reject</button>
            //                </form>
            //             </td>";
            //      echo "<td>
            //                <form method='POST' action=''>
            //                   <input type='hidden' name='accept' value='" . $row["s_id"] . "'>
            //                   <button type='submit'>Accept</button>
                              
            //                </form>
            //             </td>";

            //       echo "</tr>";
            //    }
            // }
            //    echo "</table>";


            $stmt = $conn->query("SELECT * FROM symptom");

               // Display the results in an HTML table with borders
               echo "<table>";
               echo "<tr><th>#</th><th>rash</th><th>vomit</th><th>fever</th><th>date</th><th>Action</th><th></th></tr>";
               while ($row = $stmt->fetch()) {
                  echo "<td>" . $row["c_id"] . "</td>";
                  echo "<td>" . ($row["rash"] == 1 ? "<i class='fas fa-check'></i>" : "<i class='fas fa-times'></i>") . "</td>";
                  echo "<td>" . ($row["vomit"] == 1 ? "<i class='fas fa-check'></i>" : "<i class='fas fa-times'></i>") . "</td>";
                  echo "<td>" . ($row["fever"] == 1 ? "<i class='fas fa-check'></i>" : "<i class='fas fa-times'></i>") . "</td>";
                  echo "<td>" . $row["date"] . "</td>";
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
                     while($row=$select->fetch()){
                     // $select = $conn->query("SELECT vaccine_type FROM vaccination_record WHERE c_id='{$session["c_id"]}' AND date='{$session["date"]}'");                     while ($row = $select->fetch()) {
                        $v_type = $row["vaccine_type"];
                     }
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
               

               $conn = null; // Close the database connection
            } catch (PDOException $e) {
               echo "Error: " . $e->getMessage();
            }
            ?>
         </fieldset>
         </section>

      </div>
   </div>
         
</div>

<?php @include 'footer.php'; ?>

</body>

</html>