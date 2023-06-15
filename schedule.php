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
   height: 100;
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


<body style="background-color: lightblue;">
<?php @include 'NKheader.php'; ?>
<div class="container">
      <div class="row">
         <div class="col-3">
            <div class="box">
               <?php @include 'NKnavigation.php'; ?>
            </div>
         </div>
         <div class="col-9 welcome">
            <div class="content">
               <?php
                  $c_id=$n_id=$time="";
                  $idErr = $timeErr = "";
               ?> 
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
            // echo "<h4>Please assign a designated appointment time for each child on this list for their next visit</h4>";
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
            </div>
         </div>
   

         </div>
   </div>
   
       

      <?php @include 'footer.php'; ?>
   </div>
   <!-- swiper js link  -->
   <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
   <!-- custom js file link  -->
   <script src="js/script.js"></script>


</body>


</html>