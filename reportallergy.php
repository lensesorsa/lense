<?php
SESSION_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['name']) || $_SESSION['role'] !== 'parent') {
    header("location:home.php");
    
 }

$c_id =  $_SESSION["c_id"];
$host = "localhost";
$username = "root";
$password = "";
$dbname = "vaccination_db";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $symptomErr = $dateErr = "";
    $rash = $fever = $vomit = $date = "";
} catch (PDOException $e) {
    echo $e->getMessage();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["rash"]) && empty($_POST["fever"]) && empty($_POST["vomit"])) {
        $symptomErr = "At least one symptom must be selected.";
    } else {
        $rash = isset($_POST["rash"]) ? 1 : 0;
        $fever = isset($_POST["fever"]) ? 1 : 0;
        $vomit = isset($_POST["vomit"]) ? 1 : 0;
    }

    if (empty($_POST["date"])) {
        $dateErr = "Date is required.";
    } else {
        $date = $_POST["date"];
    }

    $registration_is_successful = true;


    // your PHP code for registration goes here

    if ($registration_is_successful) {
        // show modal using JavaScript
        echo "<script>$(document).ready(function() { $('#myModal').modal('show'); });</script>";
    }

    if (!empty($rash) || !empty($fever) || !empty($vomit)) {

        $insert = "INSERT INTO symptom (c_id, date, rash, fever, vomit) VALUES (:c_id, :date, :rash, :fever, :vomit)";
        $statement = $conn->prepare($insert);

        $statement->bindParam(':c_id', $c_id);
        $statement->bindParam(':date', $date);
        $statement->bindParam(':rash', $rash);
        $statement->bindParam(':fever', $fever);
        $statement->bindParam(':vomit', $vomit);
        $statement->execute();

        //echo "Records inserted successfully.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report allergy</title>
    <!-- Add the Bootstrap CSS file -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- Add the jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Add the Bootstrap JS file -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="image/logo.jpg" />

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
      /* margin-right: 20px; */
   }

   .col-9 {
      width: 75%;
   }

   /* Navigation styles */
   .box {
      background-color: #f2f2f2;
      padding: 10px;
      height: 80%;
      /* position: sticky; */
      left: 0;
      top: 0;
      margin-top: 7rem;
      /* margin-left:-2rem; */
/* margin-left:0; */
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

<body style="background-image:none; background-color:lightblue">
    <div class="container">
        <?php @include 'header.php'; ?>
        <section class="contact">
            <section class="footer">
            <h1 class="heading">Report Allergy</h1>

         <!-- <div class="box-container"> -->
            <!-- <div class="container"> -->
               <div class="row">
                  <div class="col-3">
                     <div class="box">
                        <?php @include 'parentnavigation.php'; ?>
                     </div>
                  </div>
                  <div class="col-9 welcome">
                     <div class="content">
            <form action="" method="post" class="form">
            <div class="form-group">
                    <label for="date" class="label">child name:</label>
                    <!-- <span class="error"><?php echo $dateErr; ?></span> -->
                    <input type="text" name="date" placeholder="enter your child name" class="input">
                </div>
                <div class="form-group">
                    <label for="symptoms" class="label">Symptoms:</label>
                    <span class="error"><?php echo $symptomErr; ?></span>
                    <div class="checkbox-group">
                        <label class="checkbox-label"><input type="checkbox" name="rash" value="1">Rash </label>
                        <label class="checkbox-label"><input type="checkbox" name="fever" value="1"> Fever</label>
                        <label class="checkbox-label"><input type="checkbox" name="vomit" value="1">Vomit </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date" class="label">Date of vaccination:</label>
                    <span class="error"><?php echo $dateErr; ?></span>
                    <input type="date" name="date" min="2022-01-01" max="2050-12-31" class="input">
                </div>
                <div class="form-group">
                    <input type="submit" value="Report" name="send" id="send" class="btn">
                </div>
            </form>


            
                     </div>
                  </div>
               </div>
            </div>

      
   </div>


            <form>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"> Allergy Report Successful!!</h4>
                            </div>
                            <div class="modal-body">
                                <p>Your allergy report has been successful send.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <script>
            $(document).ready(function() {
                $("#myModal").modal('hide');

                $("#send").click(function() {
                    $("#myModal").modal('show');
                });
            });
        </script>
        <?php @include 'footer.php'; ?>
    </div>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>