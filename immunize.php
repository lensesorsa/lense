<?php
$host = "localhost";
$username = "root";
$password = "";
try 
{

   $conn = new PDO("mysql:host=$host;dbname=vaccination_db", $username, $password);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   session_start();
   $c_id = $_SESSION['c_id'];

   $v_typeErr=$fv_typeErr=$weightErr = $ZscoreErr =$dateErr= "";
   $v_type = $fv_type = $weight = $z_score =$date= "";
    
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
    if (empty($_POST["v_type"])) 
    {
       $v_typeErr = " field is required";
    }
    else
    {
       $v_type = $_POST["v_type"];
       
    }
    if (empty($_POST["weight"])) 
    {
       $weightErr = " field is required";
    }
    else
    {
       $weight = $_POST["weight"];
       
    }
    if (empty($_POST["Z_score"])) 
    {
       $ZscoreErr = " field is required";
    }
    else
    {
       $z_score = $_POST["Z_score"];
       
    }if (empty($_POST["fv_type"])) 
    {
       $fv_typeErr = " field is required";
    }
    else
    {
       $fv_type = $_POST["fv_type"];
       
    }  
    if (empty($_POST["date"])) 
    {
       $dateErr = " field is required";
    }
    else
    {
       $date = $_POST["date"];
       
    }
    $sql ="INSERT INTO variable_child_information(c_id,weight,z_score,date) VALUES ('$c_id','$weight','$z_score',curdate());
            -- insert into schedule(date)values('$date');
            insert into vaccination_record(date,vaccine_type,c_id)values(curdate(),'$v_type','$c_id')";
            $update = "UPDATE schedule SET v_type = '$fv_type', date = '$date' WHERE c_id = '$c_id'";
            $conn->exec($sql);
            $conn->exec($update);
    $update1="update vaccine set ammount=ammount-1 where v_type='$v_type' LIMIT 1";
    $conn->exec($update1);

    $conn = null; 

} 
}
    catch (PDOException $e) {
   echo $e->getMessage();
    }
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <style>
      span.error {
         color: #FF0000;
      }
   </style>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>immunize</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body style="background-image:none; background-color:lightblue">
<?php @include 'header.php'; ?>

   <div class="container">
   <?php @include 'nursenavigation.php'; ?>


      <section class="contact">

         <h1 class="heading">immunize</h1>

         <form action="" method="post">

            <div class="flex">
               <div class="inputBox">
                  <span>enter vaccine given today</span>
                  <span class="error" style="color: red;"><?php echo $v_typeErr; ?></span>
                  <select name="v_type">
                     <option value="none"> none</option>
                     <option value="BCG">BCG</option>
                     <option value="polio 0">polio 0</option>
                     <option value="polio 1">polio 1</option>
                     <option value="polio 2">polio 2</option>
                     <option value="polio 3">polio 3</option>
                     <option value="rota 1">rota 1</option>
                     <option value="rota 2">rota 2</option>
                     <option value="penta">penta</option>
                     <option value="PCV">PCV</option>
                     <option value="measles">measles</option>
                     <option value="vit_A">vit_A</option>
                  </select>
               </div>
               <div class="inputBox">
                  <span>weight </span>
                  <span class="error" style="color: red;"><?php echo $weightErr; ?></span>
                  <input type="text" placeholder="enter weight" name="weight" required>
               </div>
               <div class="inputBox">
                  <span>Z_score:</span>
                  <span class="error" style="color: red;"> <?php echo $ZscoreErr; ?></span>
                  <input type="text" placeholder="enter z_score" name="Z_score" >
               </div>
               <div class="inputBox">
                  <span>enter next vaccine to be given</span>
                  <span class="error" style="color: red;"><?php echo $fv_typeErr; ?></span>
                  <select name="fv_type">
                     <option value="none"> none</option>
                     <option value="BCG">BCG</option>
                     <option value="polio 0">polio0</option>
                     <option value="polio 1">polio1</option>
                     <option value="polio 2">polio2</option>
                     <option value="polio 3">polio3</option>
                     <option value="measles">measles</option>
                     <option value="rota 1">rota1</option>
                     <option value="rota 2">rota2</option>
                     <option value="penta">penta</option>
                     <option value="PCV">PCV</option>
                     <option value="vit_A">vit_A</option>
                  </select>
               </div>
               <div class="inputBox">
                  <span>Appoint next vaccination</span>
                  <span class="error" style="color: red;"> <?php echo $dateErr; ?></span>
                  <input type="date" name="date" min="2022-01-00" max="2050-12-30">
               </div>
            </div>   
            <input type="submit" value="submit" name="submit" class="btn">
         </form>
      </section>
      <?php @include 'footer.php'; ?>
   </div>
   <!-- swiper js link  -->
   <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
   <!-- custom js file link  -->
   <script src="js/script.js"></script>
</body>
</html>