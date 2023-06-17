<?php 
  session_start();
  if (!isset($_SESSION['user_id']) || !isset($_SESSION['name']) || $_SESSION['role'] !== 'nurse') {
   header("location:home.php");
   
}
  $c_id =  $_SESSION["c_id"];
?>
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
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
      width: 65%;
   }

   /* Navigation styles */
   .box {
      background-color: #f2f2f2;
      padding: 20px;
      height: auto;
      /* position: sticky; */
      left: 0;
      top: 0;
      overflow-y: auto;
      margin-top:10rem;
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
      <h1 class="heading">Child Profile</h1>
      <!-- <section class="footer"> -->
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
                        <fieldset>
                           <?php
                           $host = "localhost";
                           $username = "root";
                           $password = "";
                           $dbname = "vaccination_db";

                           try {
                              $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                              $stmt = $conn->query("SELECT name, DOB,gender,HIV_status,blood_type FROM child where c_id='$c_id'"); //where child is his own child's session

                              while (($row = $stmt->fetch())) {
                                 // echo '<table>';
                                //  echo "<tr>";
                                 // echo '<td>' . $rows['f_name'] . "<br>";
                                 // echo 'Mother Name' . $rows['m_name'] . "<br>";
                                    echo '<div class="card bg-success" style="width: 28rem;">';
                                    echo '<ul class="list-group list-group-flush">';
                                    echo '<li class="list-group-item " style="list-style-type:none;">' . "Child Info" . '</li>';
                                    echo '<li class="list-group-item" style="list-style-type:none;">'.'Name: ' . $row['name'] . '</li>';
                                    echo '<li class="list-group-item" style="list-style-type:none;">'.'Date of birth: ' . $row['DOB'] . '</li>';
                                    echo '<li class="list-group-item" style="list-style-type:none;">'.'Gender: ' . $row['gender'] . '</li>';
                                    echo '<li class="list-group-item" style="list-style-type:none;">'.'Blood type: ' . $row['blood_type'] . '</li>';
                                    echo '<li class="list-group-item" style="list-style-type:none;">'.'HIV : ' . $row['HIV_status'] . '</li>';

                                    echo '</ul>';
                                    echo '</div>';
                              }
                              

                              // $stmt = $conn->query("SELECT name, blood_type, DOB FROM child where c_id='$c_id'"); //where child is his own child's session
                              $select = $conn->query("SELECT f_name, m_name, email, number from parent where c_id='$c_id'");
 
                              
                              while ( ($rows = $select->fetch())) {
                                 // echo '<table>';
                                 echo "<tr>";
                                 // echo '<td>' . $rows['f_name'] . "<br>";
                                 // echo 'Mother Name' . $rows['m_name'] . "<br>";
                                    echo '<div class="card bg-success" style="width: 28rem;">';
                                    echo '<ul class="list-group list-group-flush">';
                                    echo '<li class="list-group-item " style="list-style-type:none;">' . "Parent Info" . '</li>';
                                    echo '<li class="list-group-item" style="list-style-type:none;">'.'Father\'s name: ' . $rows['f_name'] . '</li>';
                                    echo '<li class="list-group-item" style="list-style-type:none;">'.'Mother\'s name: ' . $rows['m_name'] . '</li>';
                                    echo '<li class="list-group-item" style="list-style-type:none;">'.'Email: '. $rows['email'] . '</li>';
                                    echo '<li class="list-group-item" style="list-style-type:none;">'.'Phone number: '. $rows['number'] . '</li>';

                                    echo '</ul>';
                                    echo '</div>';
                              }
                              
                              $vacc=$conn->query("SELECT allergy from variable_child_information where c_id='$c_id'");
                              echo '<div class="card bg-success" style="width: 28rem;">';
                              echo '<ul class="list-group list-group-flush">';
                              echo '<li class="list-group-item " style="list-style-type:none;">' . "Allergy Info" . '</li>';

                              while ( ($rows = $vacc->fetch())) {
                                echo '<li class="list-group-item" style="list-style-type:none;">' . $rows['allergy'] . '</li>';
                              }
                              echo '</ul>';
                              echo '</div>';
                              
                              // from the vaccination record 
                              $stmt = $conn->query("SELECT vaccination_record.vaccine_type, vaccination_record.date, variable_child_information.z_score, variable_child_information.weight 
                      FROM vaccination_record 
                      JOIN variable_child_information ON variable_child_information.date = vaccination_record.date 
                      WHERE vaccination_record.c_id = '$c_id' 
                      AND vaccination_record.date = variable_child_information.date 
                      AND vaccination_record.c_id = variable_child_information.c_id");
                              // $stmt = $conn->query("SELECT vaccination_record.vaccine_type, vaccination_record.date, variable_child_information.z_score, variable_child_information.weight FROM vaccination_record JOIN variable_child_information ON variable_child_information.date = vaccination_record.date WHERE vaccination_record.c_id = '$c_id' AND vaccination_record.date = variable_child_information.date");
                              echo '<h2 class="text-primary"><mark> Vaccine Administered</mark></h2>';
                              echo "<table>";
                              // echo "<tr><th>Child Name</th>"; 
                              echo "<th>Vaccine Type</th>";
                              echo "<th>date</th>"; 
                              echo "<th>weight</th>";
                              echo "<th>z-Score</th>";
                              // echo "<th>Allergy</th>";
                              echo "</tr>";
                              
                              while(($row=$stmt->fetch())){
                                // echo "<td>" . $row["vaccination_record.name"] . "</td>";
                                 echo "<td>" . $row["vaccine_type"] . "</td>";
                                 echo "<td>" . $row["date"] . "</td>";
                                 echo "<td>" . $row["weight"] . "</td>";
                                 echo "<td>" . $row["z_score"] . "</td>";
                                //  echo "<td>" . $row["variable_child_information.allergy"] . "</td>";
                                 echo "</tr>";

                              }
                              
                              echo "</table>";


                              $sql = "SELECT * from child";
                              $stmt = $conn->prepare($sql);
                          
                              if ($stmt->rowCount() > 0) {
                              // Output data of each row
                              while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                  $name = $row['name'];
                                  $dob = $row['DOB'];
                                  $blood_type=$row['blood_type'];
                              }
                           } else {
                                 $mess="No results found!";
                                 echo "<script>$mess</script>";
                           }

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

