<?php
$host = "localhost";
$username = "root";
$password = "";
try {
   $conn = new PDO("mysql:host=$host;dbname=vaccine", $username, $password);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   session_start();
   
   $nameErr = $passwordErr = $loginErr = "";
   $name = $password = "";
   if (isset($_POST['login'])) {
      if (empty($_POST["name"])) {
         $nameErr = " Name is required";
      } else {
         $name = $_POST["name"];
         if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = " Only letters and white space allowed";
         }
      }
      if (empty($_POST["password"])) {
         $passwordErr = "password required";
      } else {
         $password = $_POST["password"];
      }
      session_start(); // Start the session
// //}
     // session_start();
      $sq = "SELECT *FROM users WHERE name='" . $name . "' AND password='" . $password . "'";
      $result = $conn->query($sq);
      $count = 0;
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
         $_SESSION['name'] = $row['name'];
         $_SESSION['password'] = $row['password'];
         $_SESSION['role'] = $row['role'];
         $_SESSION['user_id'] = $row['user_id'];

         $count = $count + 1;
      }
      if ($count == 0) {
         $loginErr = "invalid user";
      } elseif ($_SESSION['name'] == $name && $_SESSION['password'] == $password && $_SESSION['role'] == 'nurse') {
         header("location:nurse.php");
      } elseif ($_SESSION['name'] == $name && $_SESSION['password'] == $password && $_SESSION['role'] == 'nurseclerk') {
         header("location:nurseclerk.php");
      }elseif($_SESSION['name']==$name&&$_SESSION['role']=='parent'&& $_SESSION['password'] == $password){
         if($_SESSION['password']==1234)
         {
            header("location:changepassword.php");

         }
         else{
            header("location:parent.php");
  
         }
      } 
      /*elseif ($_SESSION['name'] == $name && $_SESSION['password'] == $password && $_SESSION['role'] == 'parent') {
         header("location:changepassword.php");
      }*/
   }
   // $conn = null;
} catch (PDOException $e) {
   echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styles.css">
   <ink rel="shortcut icon" href="images/ye.jpg">
      <style>
         .contact {
            float: right;
            width: 38%;
            margin-right: 76px;
         }

         .signin {
            text-align: center;
            color: var(--black);
            margin-bottom: 1rem;
            font-size: 50px;
         }
      </Style>
</head>

<style>
   .notifications {
      float: left;
      width: 50%;
      background-color: lightblue;
      padding: 20px;
      margin-top: 11rem;
      margin-left: 2rem;
   }

   .card {
      background-color: white;
      padding: 20px;
      box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
   }

   .card h2 {
      font-size: 24px;
      margin-top: 0;
   }

   .card p {
      font-size: 16px;
      margin-bottom: 10px;
   }

   .card ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
   }

   .card li {
      font-size: 14px;
      margin-bottom: 5px;
   }
</style>

<body style="background-color:lightblue">
   <div class="container">
      <section class="header">

         <a href="home.php" class="logo"> Jan meda health center</a>
      </section>
      <section class="notifications">
         <div class="card">
            <?php
             $select="select title, content from generalinformation where content_id ORDER BY content_id DESC LIMIT 1";
             $result = $conn->query($select);

             if($result-> rowcount()>0){
               while ($row=$result->fetch(PDO::FETCH_ASSOC)){
                  echo "<span class='signin'>" .$row["title"]. "</span><hr><br>";
                  echo "<h1>".$row['content']."</h1>";
                 }
               
             }
            
            ?>
            <!-- <h2>Daily Notifications</h2>
            <p>Here's some important information for today:</p>
            <ul>
               <li>Reminder: All nurses must attend the weekly meeting at 2pm.</li>
               <li>New vaccine shipment arriving tomorrow.</li>
               <li>Dr. Smith will be out of the office next week.</li>
            </ul> -->
         </div>
      </section>

      <section class="contact">
         <fieldset>
            <form action="" method="post">
               <div class="flex-container">
                  <div class="flex">
                     <span><?php echo $loginErr ?></span>
                     <div class="contact">
                        <div class="signin">Login</div>
                        <div class="inputBox">
                           <!-- <span>your name</span> -->
                           <span class="error" style="color: red;"><?php echo $nameErr; ?></span>
                           <input type="text" placeholder="enter your name" name="name" required>
                        </div>
                        <div class="inputBox">
                           <!-- <span>password</span> -->
                           <span class="error" style="color: red;"><?php echo $passwordErr; ?></span>
                           <input type="password" placeholder="enter password" name="password" required>
                        </div>

                        <input type="submit" name="login" value="login" class="btn">
                        <p class="forgot">Forgot password?</p>
                     </div>
                  </div>
               </div>
            </form>
         </fieldset>
      </section>
   </div>
   <div>
      <section class="services">
         <h1 class="heading">General Information</h1>
         <div class="swiper service-slider">
            <div class="swiper-wrapper">
               <div class="swiper-slide slide">
                  <img src="image/child.jpg" alt="">
                  <div class="content">
                     <h3>WHO says</h3>
                     <a href="https://www.who.int" class="btn">discover more</a>
                  </div>
               </div>
               <div class="swiper-slide slide">
                  <img src="image/happy_child.jpg" alt="">
                  <div class="content">
                     <h3>benefit of vacccination</h3>
                     <a href="https://vaccination-info.eu/en/vaccination/benefits-vaccination-community" class="btn">discover more</a>
                  </div>
               </div>
               <div class="swiper-slide slide">
                  <img src="image/syringe.avif" alt="">
                  <div class="content">
                     <h3>what if i skip vaccianion</h3>
                     <a href="consequence.php" class="btn">discover more</a>
                  </div>
               </div>
               <div class="swiper-slide slide">
                  <img src="image/globe.jpg" alt="">
                  <div class="content">
                     <h3>world-wide statistics</h3>
                     <a href="statistics.php" class="btn">discover more</a>
                  </div>
               </div>
            </div>
            <div class="swiper-pagination"></div>
         </div>
      </section>
      <?php @include 'footer.php'; ?>
   </div>
   <!-- swiper js link  -->
   <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
   <!-- custom js file link  -->
   <script src="js/script.js"></script>
</body>

</html>