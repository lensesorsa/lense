<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add content</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- swiper css link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/Style.css">
    <ink rel="shortcut icon" href="images/ye.jpg">
</head>
<style>
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
    <div class="container">

        <?php @include 'NKhome.php'; ?>
        <?php @include 'NKnavigation.php'; ?>





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

        <?php @include 'footer.php'; ?>
    </div>
    <!-- swiper js link  -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <!-- custom js file link  -->
    <script src="js/script.js"></script>


</body>


</html>