<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=vaccination_db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $new_password = $new_password2 = $password = $passErr = $name = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['password'])) {
            $passwordErr = "Password is required";
        } else {
            $password = $_POST['password'];
        }

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
            $passErr = "Passwords do not match. Please re-enter your new password.";
        } else {
            $passErr = "";
            if (isset($_POST['update'])) {
                $sql1 = "UPDATE users SET new_password='$new_password' WHERE name='{$_SESSION['name']}'";
                $conn->exec($sql1);
            } else {
                $updateErr = "Sign in first";
            }

            $sq = "SELECT * FROM users WHERE user_id = '{$_SESSION['user_id']}' AND new_password IS NOT NULL";
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
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body style="background-image:none; background-color:lightblue">

   <div class="container">
      <section class="contact">
         <h1 class="heading">Change Password</h1>
         <form action="" method="post">
            <div class="flex">
               <div class="inputBox">
                  <span>Previous Password</span>
                  <span class="error" style="color: red;"><?php echo $passErr; ?></span>
                  <input type="password" placeholder="Enter old password" name="password" required>
               </div><br>
               <div class="inputBox">
                  <span>New Password</span>
                  <span class="error" style="color: red;"><?php echo $passErr; ?></span>
                  <input type="password" placeholder="Enter the new password" name="newpassword" required>
               </div><br>
               <div class="inputBox">
                  <span>Confirm New Password</span>
                  <span class="error" style="color: red;"><?php echo $passErr; ?></span>
                  <input type="password" placeholder="Re-enter the new password" name="newpassword2" required>
               </div><br>
               <input type="submit" value="Update" name="update" class="btn">
            </div>
         </form>
      </section>
   </div>
   <!-- Rest of the code remains the same -->
</body>

</html>  
