<?php

$host = "localhost";
$username = "root";
$password = "";
try {
    $conn = new PDO("mysql:host=$host;dbname=vaccination_db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $nameErr = $emailErr = $noErr = $passwordErr = $addressErr = $messageErr = $updateErr = $dateErr = $genderErr = $blood_typeErr = $HIVErr = $woredaErr = $kebeleErr = $housenoErr = "";
    $name = $email = $number = $date = $address = $password = $gender = $HIV = $blood_type = $woreda = $kebele = $house_no = "";
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
    if (empty($_POST['woreda'])) {
        $woredaErr = " is required";
    } else {
        $woreda = $_POST['woreda'];
    }
    if (empty($_POST['kebele'])) {
        $kebeleErr = " is required";
    } else {
        $kebele = $_POST['kebele'];
    }
    if (empty($_POST['house_no'])) {
        $house_no = " is required";
    } else {
        $house_no = $_POST['house_no'];
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

    $registration_is_successful = true;

    
    // your PHP code for registration goes here
    
    if ($registration_is_successful) {
        // show modal using JavaScript
        echo "<script>$(document).ready(function() { $('#myModal').modal('show'); });</script>";
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
        $stmt = $conn->prepare("INSERT INTO parent (f_name,m_name,email,number,c_id,woreda,kebele,house_no) VALUES (:f_name,:m_name,:email,:number,:c_id,:woreda,:kebele,:house_no)");
        $stmt->bindParam(':f_name', $f_name);
        $stmt->bindParam(':m_name', $m_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':number', $number);
        $stmt->bindParam(':c_id', $c_id);
        $stmt->bindParam(':woreda', $woreda);
        $stmt->bindParam(':kebele', $kebele);
        $stmt->bindParam(':house_no', $house_no);



        $stmt->execute();
        //echo "Data inserted successfully"; allert
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

    $insert = "INSERT INTO users(name,password,role) VALUES ('$f_name',1234,'parent')";
    $insert1 = "INSERT INTO schedule(c_id,date,v_type)values('$c_id',curdate(),'BCG')";
    $conn->exec($insert);
    $conn->exec($insert1);
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
    <title>Register</title>


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
    <link rel="stylesheet" href="css/style.css">

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


<body style="background-image:none; background-color:lightblue">
<?php @include 'header.php'; ?>

    <div class="container">
    <div class="row">
         <div class="col-3">
            <div class="box">
                <?php @include 'NKnavigation.php'; ?>
            </div>
        </div>
        <div class="col-9">
            <section class="contact">
                <h1 class="heading">register</h1>
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
                        <input type="tel" placeholder="enter your number" name="number" required>
                    </div>
                    <div class="inputBox">
                        <span>woreda</span>
                        <span class="error" style="color: red;"> <?php echo $woredaErr; ?></span>
                        <textarea name="woreda" placeholder="enter your woreda" required cols="3" rows="3" style="height: 5.5rem;"></textarea>
                    </div>
                    <div class="inputBox">
                        <span>kebele</span>
                        <span class="error" style="color: red;"> <?php echo $kebeleErr; ?></span>
                        <textarea name="kebele" placeholder="enter your kebele" required cols="3" rows="3" style="height: 5.5rem;"></textarea>
                    </div>
                    <div class="inputBox">
                        <span>Gender:</span>
                        <span class="error" style="color: red;"> <?php echo $genderErr; ?></span>
                        <span>
                            <input type="radio" name="gender" value="male">
                            Male
                        </span>

                        <span>
                            <input type="radio" name="gender" value="female">
                            Female
                        </span>

                        <!-- <input type="text" name="gender" placeholder="gender of the child"> -->
                    </div>
                    <div class="inputBox">
                        <span>house number</span>
                        <span class="error" style="color: red;"> <?php echo $housenoErr; ?></span>
                        <textarea name="house_no" placeholder="enter your house number" required cols="3" rows="3" style="height: 5.5rem;"></textarea>
                    </div>
                    <input type="submit" value="register" name="register" id="register" class="btn">
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Registration Successful</h4>
                        <div class="modal-body">
                            <p>Your registration has been successful.</p>
                        </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                    </div>
                    </div>
                </form>
            </section>

        </div>
    </div>
</div>
<?php @include 'footer.php'; ?>
<script>
    $(document).ready(function(){
        $("#myModal").modal('hide');

        $("#register").click(function(){
            $("#myModal").modal('show');
        });
    });
</script>
    </div>
    <!-- swiper js link  -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>
</html>