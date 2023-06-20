<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['name']) || $_SESSION['role'] !== 'nurseclerk') {
        header("location:home.php");
        
     }
   ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add content</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- swiper css link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/Style.css">
    <link rel="shortcut icon" type="image/x-icon" href="image/logo.jpg" />
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

    body {file:///C:/Users/motis/Downloads/Telegram Desktop/content.txt
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

<body style="background-image:none; background-color:lightblue">
<?php @include 'NKhome.php'; ?>

    <div class="container">
    <div class="row">
        <div class="col-3">
            <div class="box">
            <?php @include 'NKnavigation.php'; ?>
            </div>
        </div>
        <div class="col-9 welcome">
            <div class="content">
            <h1 class="heading">Add content</h1>

<fieldset>
    <?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "vaccination_db";
    $content = $title = $time = $curdate = "";
    $conErr = $titErr = "";
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["content"])) {
                $conErr = " con is required";
            } else {
                $content = $_POST["content"];
            }
            if (empty($_POST["title"])) {
                $titErr = " title is required";
            } else {
                $title = $_POST["title"];
            }

           
            $stmt = "INSERT INTO generalinformation(title,content,date)values('$title','$content',curdate())";
            $conn->exec($stmt);
            $conn = null;
        }

        $conn = null; // Close the database connection
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
</fieldset>



<fieldset>
    <section class="contact">

        <form action="" method="post">

            <div class="flex">

                <div class="inputBox">
                    <span>Title</span>
                    <span class="error" style="color: red;"><?php echo $titErr; ?></span>
                    <!-- <label for="title">Title</label> -->
                    <input type="text" name="title" id="title" required>
                </div>
                <div class="inputBox">
                    <span>content</span>
                    <span class="error" style="color: red;"><?php echo $conErr; ?></span>
                    <!-- <label for="content">Content</label> -->
                    <textarea name="content" id="content" rows="5" required></textarea>

                    <!-- <input type="text" placeholder="enter nurse's id" name="n_id" required> -->
                </div>
                <!-- <div class="inputBox">
             <span>time</span>
             <span class="error" style="color: red;"><?php echo $timeErr; ?></span>
             <input type="time" placeholder="enter time of vaccination" name="time" required>
          </div> -->
                <input type="submit" value="add general information" name="update" class="btn">
            </div>
        </form>
    </section>

</fieldset>

</div>
<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<!-- custom js file link  -->
<script src="js/script.js"></script>


            </div>
        </div>

</div>
</div>
<?php @include 'footer.php'; ?>

       
</body>


</html>