<?php

  session_start();
  if (!isset($_SESSION['user_id']) || !isset($_SESSION['name'])) {
   header("location:home.php");
   
}

$host = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=vaccination_db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $passErr = $matchErr = $name = "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['newpassword'])) {
            $passErr = "New password is required";
        } else {
            $new_password = $_POST['newpassword'];
        }

        if (empty($_POST['newpassword2'])) {
            $passErr = "Confirm new password is required";
        } else {
            $new_password2 = $_POST['newpassword2'];
        }

        if ($new_password != $new_password2) {
            $matchErr = "Passwords do not match. Please re-enter your new password.";
        } else {
            // $passErr = "";
            if (isset($_POST['update'])) {
                $sql1 = "UPDATE users SET password='$new_password' WHERE name='{$_SESSION['name']}'";
                $conn->exec($sql1);
            } else {
                $updateErr = "get registered in first";
            }

            $sq = "SELECT * FROM users WHERE user_id = '{$_SESSION['user_id']}' AND password IS NOT NULL";
            $result = $conn->query($sq);
            $count = 0;

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION['name'] = $row['name'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['role'] = $row['role'];
                $count = $count + 1;
            }

            if ($count == 0) {
                $passErr = "Invalid user";
            } else {
                header("location: parent.php");
            }
        }

        $conn = null;
    }
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
      <title>Change Password</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
      <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
      <link rel="shortcut icon" type="image/x-icon" href="image/logo.jpg" />

      <style>
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
         }
         body {
            font-family: sans-serif;
            background-color: #f2f2f2;
         }
         .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 50px 20px;
         }
         .contact {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
         }
         .heading {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 30px;
            color: #333;
         }
         .flex {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
         }
         .inputBox {
            width: 100%;
            margin-bottom: 20px;
         }
         .inputBox span {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #333;
         }
         .inputBox input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            font-size: 1rem;
            font-family: sans-serif;
         }
         .btn {
            background-color: #008CBA;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2rem;
            font-weight: 500;
            text-transform: uppercase;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
         }
         /* .btn:hover {
            background-color: #006080;
         } */
         .error {
            font-size: 0.8rem;
            font-weight: 500;
            margin-top: 5px;
            color: red;
         }
         /* Additional styles */
         label {
            display: block;
            margin-bottom: 10px;
            font-size: 1.2rem;
            color: #333;
         }
         input[type="password"] {
            font-size: 1.2rem;
            padding: 10px;
            border: none;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            background-color: #f2f2f2;
            color: #333;
         }
         input[type="password"]:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 140, 186, 0.5);
         }
         .inputBox input[type="submit"] {
            background-color: #006080;
         }
         .inputBox input[type="submit"]:hover {
            background-color: #004256;
         }
      </style>
   </head>
   <body style="background-color:lightblue">
      <div class="container">
         <section class="contact">
            <h1 class="heading">Change Password</h1>
            <form action="" method="post">
               <div class="flex">
                  <div class="inputBox">
                     <label for="newpassword">New Password</label>
                     <input type="password" id="newpassword" name="newpassword" required>
                     <span class="error"><?php echo $passErr; ?></span>
                  </div>
                  <div class="inputBox">
                     <label for="newpassword2">Confirm New Password</label>
                     <input type="password" id="newpassword2" name="newpassword2" required>
                     <span class="error"><?php echo $passErr; ?></span>
                     <span class="error"><?php echo $matchErr; ?></span >                 </div>
                  <div class="inputBox">
                     <input type="submit" value="Change Password" name="update" class="btn">
                  </div>
               </div>
            </form>
         </section>
      </div>
      <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
      <script src="js/main.js"></script>
   </body>
</html>