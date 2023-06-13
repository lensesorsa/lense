<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>


<body style="background-color:lightblue">
   <?php @include 'header.php';


   $host = "localhost";
   $username = "root";
   $password = "";
   try {
      $conn = new PDO("mysql:host=$host;dbname=vaccine", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      session_start();
      $f_name = $_SESSION['name'];
      $select = $conn->query("select c_id from parent where f_name='$f_name'");

      echo "<table>";
      //echo "<tr> <th> p_id</th></tr>";
      while ($row = $select->fetch()) {
         // echo"<tr>";
         // //echo"<td>".$row["p_id"]."</td>";
         // echo"</tr>";
         $_SESSION["c_id"] = $row["c_id"];
      }

      $nameErr = $emailErr = $noErr = $passwordErr = $addressErr = $messageErr = $updateErr = $dateErr = $genderErr = $blood_typeErr = $HIVErr = "";
      $name = $email = $number = $date = $address = $password = $gender = $HIV = $blood_type = "";
   } catch (PDOException $e) {
      echo $e->getMessage();
   }
   // // Prepare a statement and execute a query

   // Fetch the result as an associative array


   // Assign the result to the session variable
   // $_SESSION['p_id'] = $result['p_id'];
   // $stmt = $conn->query("select c_id from parent where p_id='{$_SESSION['name']}'");


   ?>
   <section class="footer">
      <div class="box-container">
         <div class="box">
            <a href="seeschedule.php"> <i class="fas fa-angle-right"></i> see schedule</a>
            <a href="reportallergy.php"> <i class="fas fa-angle-right"></i> report allergy</a>
         </div>
         
      </div>
   </section>
   <?php @include 'footer.php'; ?>
</body>

</html>