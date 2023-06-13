<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

      <!-- Add the Bootstrap CSS file -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- Add the jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Add the Bootstrap JS file -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/Style.css">
   <ink rel="shortcut icon" href="images/ye.jpg">
</head>
<style>
   body {
      background-color: lightblue;
      font-family: Arial, sans-serif;
   }

   table {
      border-collapse: collapse;
      width: 100%;
      margin-bottom: 20px;
      background-color: white;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      overflow: hidden;
   }

   th,
   td {
      text-align: left;
      padding: 12px;
      border-bottom: 1px solid #ddd;
   }

   th {
      background-color: #f2f2f2;
      font-size: 18px;
      text-transform: uppercase;


   }

   td {
      font-size: 16px;
   }

   button {
      display: inline-block;
      padding: 8px 12px;
      border-radius: 6px;
      border: none;
      background-color: #4CAF50;
      color: white;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin: 5%;
   }

   button:hover {
      background-color: #3e8e41;
   }
</style>

<body>
   <?php
$c_id=$n_id=$time="";
         $idErr = $timeErr = "";
        ?> 
   <div class="container">

      <?php @include 'NKheader.php'; ?>
      <?php @include 'NKnavigation.php'; ?>


      <h1 class="heading"> schedule</h1>

      

      <fieldset>
         <section class="contact">

            <form action="" method="post">

               <div class="flex">

                  <div class="inputBox">
                     <span>child's id</span>
                     <span class="error" style="color: red;"><?php echo $idErr; ?></span>
                     <input type="text" placeholder="enter child's id" name="c_id" required>
                  </div>
                  <div class="inputBox">
                     <span>nurse's id</span>
                     <span class="error" style="color: red;"><?php echo $idErr; ?></span>
                     <input type="text" placeholder="enter nurse's id" name="n_id" required>
                  </div>
                  <div class="inputBox">
                     <span>time</span>
                     <span class="error" style="color: red;"><?php echo $timeErr; ?></span>
                     <input type="time" placeholder="enter time of vaccination" name="time" required>
                  </div>
                  <input type="submit" value="schedule" name="update" id="update" class="btn">
               </div>
                <!-- Modal -->

               <div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">schedule Successful !!</h4>
      </div>
      <div class="modal-body">
       
       <!-- <p> successful.</p> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>
            </form>
         </section>
         
      </fieldset>


      <fieldset>
         <?php
         $host = "localhost";
         $username = "root";
         $password = "";
         $dbname = "vaccination_db";
         try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Select all rows from the "schedule" table
            $stmt = $conn->query("SELECT * FROM schedule where time is  null");
            //  $stmt=$db->prepare('UPDATE mytable SET time =? WHERE id =?');

            // $stmt = $conn->prepare("SELECT child.name , schedule.time AS time , schedule.date As date 
            // FROM schedule 
            // iNNER JOIN child ON schedule.s_id = schedule.c_id");
            $stmt->execute();
            
            // Display the results in an HTML table with styled buttons
            echo "<h3>a list of children that needs to be given a specific time to come on the next appointment</h3>";
            echo "<table>";
            
            echo "<tr><th>Child ID</th><th>Date</th><th>Vaccine Type</th></tr>";
            while ($row = $stmt->fetch()) {
               echo "<tr>";
               echo "<td>" . $row["c_id"] . "</td>";
               echo "<td>" . $row["date"] . "</td>";
               echo "<td>" . $row["v_type"] . "</td>";

               // echo "<td><button onclick=\"handleButtonClick({$row['c_id']})\">update time </button> <button onclick=\"handleButtonClick({$row['c_id']})\">update nurse </button></td>";

               // echo "<td><button>update time</button><button>update nurse</button></td>";
               echo "</tr>";
            }
            echo "</table>";

            //$c_id=$_POST['c_id'];
            //$time=$_POST['time'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["c_id"])) {
        $idErr = " id is required";
    } else {
        $c_id = $_POST["c_id"];
        
    }
    if (empty($_POST["n_id"])) {
      $idErr = " id is required";
  } else {
      $n_id = $_POST["n_id"];
      
  }
  if (empty($_POST["time"])) {
   $timeErr = " time is required";
} else {
   $time = $_POST["time"];
   
}
$registration_is_successful = true;

    
// your PHP code for registration goes here

if ($registration_is_successful) {
    // show modal using JavaScript
    echo "<script>$(document).ready(function() { $('#myModal').modal('show'); });</script>";
}

$update="update schedule set time='$time', n_id='$n_id' where c_id='$c_id'";
$conn->exec($update);
}

            $conn = null; // Close the database connection
         } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
         }
         ?>
      </fieldset>

      <script>
    $(document).ready(function(){
        $("#myModal").modal('hide');

        $("#update").click(function(){
            $("#myModal").modal('show');
        });
    });
</script>
       

      <?php @include 'footer.php'; ?>
   </div>
   <!-- swiper js link  -->
   <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
   <!-- custom js file link  -->
   <script src="js/script.js"></script>


</body>


</html>