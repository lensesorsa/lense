<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>parent home</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="shortcut icon" href="images/ye.jpg">

</head>
<style>
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
      width: 30%;
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
</style>

<body style="background-color:lightblue">
   <?php @include 'header.php';


   $host = "localhost";
   $username = "root";
   $password = "";
   try {
      $conn = new PDO("mysql:host=$host;dbname=vaccination_db", $username, $password);
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
      if (!isset($_SESSION['user_id']) || !isset($_SESSION['name']) || $_SESSION['role'] !== 'parent') {
         header("location:home.php");
         
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
         <div class="container">
            <div class="row">
               <div class="col-3">
                  <div class="box">
                     <?php @include 'parentnavigation.php'; ?>
                  </div>
               </div>
               <div class="col-9 welcome">
                  <div class="content">
                     <!-- <img src="image/parent.jpg" /> -->
                     <h1>Welcome to the website!</h1>
<p>Welcome to our Children Vaccination Management System! We are committed to ensuring that every child receives the necessary vaccinations to protect against preventable diseases. Our system is designed to streamline the vaccination process, making it easier for parents to see  appointments, keep track of their child's vaccinations,<br> Thank you for choosing our health center.</p>                     <!-- <a href="#" class="btn">Learn More</a> -->
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
   </section>
   <?php @include 'footer.php'; ?>
</body>

</html>