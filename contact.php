<?php
   $nameErr = $emailErr = $messageErr = "";
   $name = $email = $message = "";
   $success = false;

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["name"])) {
         $nameErr = "Name is required";
      } else {
         $name = test_input($_POST["name"]);
         if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
         }
      }

      if (empty($_POST["email"])) {
         $emailErr = "Email is required";
      } else {
         $email = test_input($_POST["email"]);
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
         }
      }

      if (empty($_POST["message"])) {
         $messageErr = "Message is required";
      } else {
         $message = test_input($_POST["message"]);
      }

      if ($nameErr == "" && $emailErr == "" && $messageErr == "") {
         // Send email or save message to database
         // Set $success to true if message is sent successfully
         $success = true;
      }
   }

   function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
   }
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Contact Us</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
      <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
      <link rel="stylesheet" href="css/Style.css">
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
         .inputBox1 {
            width: 100%;
            margin-bottom: 20px;
         }
         .inputBox1 span {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #333;
         }
         .inputBox1 input,
         .inputBox1 textarea {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            font-size: 1rem;
            font-family: sans-serif;
            background-color: #f2f2f2;
            color: #333;
         }
         .inputBox1 input:focus,
         .inputBox1 textarea:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 140, 186, 0.5);
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
            background-color: light-blue;
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
         textarea {
            min-height: 150px;
            resize: vertical;
         }
         .success-message {
            background-color: #c1e7c3;
            border: 2px solid #6ac47e;
            color: #333;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
         }
         .success-message p {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 500;
         }
      </style>
   </head>
   <body style="background-color:lightblue">
   <?php @include 'Phome.php'; ?>

      <div class="container">
         <section class="contact">
            <h1 class="heading">Contact Us</h1>
            <form action="" method="post">
               <div class="flex">
                  <div class="inputBox1">
                     <label for="name">Name</label>
                     <input type="text" id="name" name="name" required>
                     <span class="error"><?php echo $nameErr; ?></span>
                  </div>
                  <div class="inputBox1">
                     <label for="email">Email</label>
                     <input type="email" id="email" name="email" required>
                     <span class="error"><?php echo $emailErr; ?></span>
                  </div>
                  <div class="inputBox1">
                     <label for="message">Message</label>
                     <textarea id="message" name="message" required></textarea>
                     <span class="error"><?php echo $messageErr; ?></span>
                  </div>
                  <div class="inputBox1">
                     <input type="submit" value="Send Message" name="submit" class="btn">
                  </div>
               </div>
            </form>
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $success) { ?>
            <div class="success-message">
               <p>Thank you for contacting us! We will get back to you as soon as possible.</p>
            </div>
            <?php } ?>
         </section>
      </div>
      <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
      <script src="js/main.js"></script>
   </body>
</html>