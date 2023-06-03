<?php

$host = "localhost";
$username = "root";
$password = "";
try {
    $conn = new PDO("mysql:host=$host;dbname=vaccination_db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $nameErr = $emailErr = $noErr = $passwordErr = $addressErr = $messageErr = $updateErr = $dateErr = $genderErr = $blood_typeErr = $HIVErr = "";
    $name = $email = $number = $date = $address = $password = $gender = $HIV = $blood_type = "";
} catch (PDOException $e) {
    echo $e->getMessage();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["c_name"])) {
        $nameErr = " Name is required";
    } else {
        $c_name = $_POST["c_name"];
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = " Only letters and white space allowed";
        }
    }
    if (empty($_POST["f_name"])) {
        $nameErr = " Name is required";
    } else {
        $f_name = $_POST["f_name"];
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = " Only letters and white space allowed";
        }
    }
    if (empty($_POST["m_name"])) {
        $nameErr = " Name is required";
    } else {
        $m_name = $_POST["m_name"];
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = " Only letters and white space allowed";
        }
    }
    if (empty($_POST["date"])) {
        $dateErr = "DOB is required";
    } else {
        $date = $_POST["date"];
    }
    if (empty($_POST["gender"])) {
        $dateErr = "gender is required";
    } else {
        $gender = $_POST["gender"];
    }
    if (empty($_POST["email"])) {
        $emailErr = " Email is required";
    } else {
        $email = $_POST["email"];
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = " Invalid email format";
        }
    }
    if (empty($_POST['number'])) {
        $noErr = " phone number is required";
    } else {
        $number = (($_POST["number"]));
    }
    if (empty($_POST['address'])) {
        $addressErr = " is required";
    } else {
        $address = $_POST['address'];
    }
    if (empty($_POST['password'])) {
        $passwordErr = " field is required";
    } else {
        $password = $_POST['password'];
    }
    if (empty($_POST['HIV'])) {
        $HIVErr = "field is required";
    } else {
        $HIV = $_POST['HIV'];
    }
    if (empty($_POST['blood_type'])) {
        $blood_typeErr = "field is required";
    } else {
        $blood_type = $_POST['blood_type'];
    }





    // Insert data into the child table
    try {
        $stmt = $conn->prepare("INSERT INTO child (name,DOB,gender,HIV_status,blood_type) VALUES (:name,:DOB,:gender,:HIV_status,:blood_type)");
        $stmt->bindParam(':name', $c_name);
        $stmt->bindParam(':DOB', $date);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':HIV_status', $HIV);
        $stmt->bindParam(':blood_type', $blood_type);
        $stmt->execute();
        // Get the last inserted ID from the child table
        $c_id = $conn->lastInsertId();
    } catch (PDOException $e) {
        echo "Error inserting data into child table: " . $e->getMessage();
    }
    //insert parent table
    try {
        $stmt = $conn->prepare("INSERT INTO parent (f_name,m_name,address,email,number,c_id) VALUES (:f_name,:m_name,:address,:email,:number,:c_id)");
        $stmt->bindParam(':f_name', $f_name);
        $stmt->bindParam(':m_name', $m_name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':number', $number);
        $stmt->bindParam(':c_id', $c_id);
        $stmt->execute();
        echo "Data inserted successfully";
    } catch (PDOException $e) {
        echo "Error inserting data into parent table: " . $e->getMessage();
    }

    try {
        $stmt = $conn->prepare("INSERT INTO schedule (c_id) VALUES (:c_id)");
        $stmt->bindParam(':c_id', $c_id);
        $stmt->execute();
        //echo "Data inserted successfully"; allert 
    } catch (PDOException $e) {
        echo "Error inserting data into parent table: " . $e->getMessage();
    }

    $insert ="INSERT INTO users(name,password,role) VALUES ('$f_name',1234,'parent')";
    $conn->exec($insert);
}


// Close the database connection
$conn = null;

// $insert ="INSERT INTO child(name,DOB,gender,HIV_status,blood_type) VALUES ('$c_name','$date','$gender','$HIV','$blood_type');
// INSERT INTO parent(f_name,m_name,address,email,number) VALUES ('$f_name','$m_name','$address','$email','$number');
//                //  INSERT INTO users(name,password,role) VALUES ('$f_name',1234,'parent')";
//       $conn->exec($insert);
//       $conn = null;
// }} -->
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

        <?php @include 'header.php'; ?>

        <section class="contact">

            <h1 class="heading">contact us</h1>

            <form action="" method="post">

                <div class="flex">

                    <div class="inputBox">
                        <span>child's name</span>
                        <span class="error" style="color: red;"><?php echo $nameErr; ?></span>
                        <input type="text" placeholder="enter child's name" name="c_name" required>
                    </div>
                    <div class="inputBox">
                        <span>father's name</span>
                        <span class="error" style="color: red;"><?php echo $nameErr; ?></span>
                        <input type="text" placeholder="enter father's name" name="f_name" required>
                    </div>
                    <div class="inputBox">
                        <span>mother's name</span>
                        <span class="error" style="color: red;"><?php echo $nameErr; ?></span>
                        <input type="text" placeholder="enter mother's name" name="m_name" required>
                    </div>
                    <div class="inputBox">
                        <span>date of birth:</span>
                        <span class="error" style="color: red;"> <?php echo $dateErr; ?></span>
                        <input type="date" name="date" min="2022-01-00" max="2050-12-30">
                    </div>
                    <div class="inputBox">
                        <span>Gender:</span>
                        <span class="error" style="color: red;"> <?php echo $genderErr; ?></span>
                        <input type="text" name="gender" placeholder="gender of the child">
                    </div>
                    <div class="inputBox">
                        <span>HIV_status</span>
                        <span class="error" style="color: red;"> <?php echo $HIVErr; ?></span>
                        <input type="text" name="HIV" placeholder="HIV status of the child">
                    </div>
                    <div class="inputBox">
                        <span>Blood type:</span>
                        <span class="error" style="color: red;"> <?php echo $blood_typeErr; ?></span>
                        <input type="text" name="blood_type" placeholder="blood type of the child">
                    </div>
                    <div class="inputBox">
                        <span>email address: </span>
                        <span class="error" style="color: red;"> <?php echo $emailErr; ?></span>
                        <input type="email" placeholder="enter your email" name="email" required>
                    </div>
                    <div class="inputBox">
                        <span>phone number:</span>
                        <span class="error" style="color: red;"><?php echo $noErr; ?></span>
                        <input type="number" placeholder="enter your number" name="number" required>
                    </div>
                    <div class="inputBox">
                        <span>your address</span>
                        <span class="error" style="color: red;"> <?php echo $addressErr; ?></span>
                        <textarea name="address" placeholder="enter your address" required cols="3" rows="3" style="height: 5.5rem;"></textarea>
                    </div>

                </div>
                <input type="submit" value="register" name="register" class="btn">
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