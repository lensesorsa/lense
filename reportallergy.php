<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "vaccination_db";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $symptomErr = $dateErr = "";
    $rash = $fever = $vomit = $date = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["rash"]) && empty($_POST["fever"]) && empty($_POST["vomit"])) {
            $symptomErr = "At least one symptom must be selected.";
        } else {
            $rash = isset($_POST["rash"]) ? 1 : 0;
            $fever = isset($_POST["fever"]) ? 1 : 0;
            $vomit = isset($_POST["vomit"]) ? 1 : 0;
        }

        if (empty($_POST["date"])) {
            $dateErr = "Date is required.";
        } else {
            $date = $_POST["date"];
        }

        if (!empty($rash) || !empty($fever) || !empty($vomit)) {
            $insert = "INSERT INTO symptom (date, rash, fever, vomit) VALUES (:date, :rash, :fever, :vomit)";
            $statement = $conn->prepare($insert);

            $statement->bindParam(':date', $date);
            $statement->bindParam(':rash', $rash);
            $statement->bindParam(':fever', $fever);
            $statement->bindParam(':vomit', $vomit);

            $statement->execute();

            // echo "Records inserted successfully."; //make it allert
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-image:none; background-color:lightblue">
    <div class="container">
        <?php @include 'header.php'; ?>
        <section class="contact">
            <h1 class="heading">report allergy</h1>
            <form action="" method="post">
                <div class="flex">
                    <div class="inputBox">
                        <span>Symptom:</span>
                        <span class="error" style="color: red;"><?php echo $symptomErr; ?></span>
                        <input type="checkbox" name="rash" value="1"> Rash
                        <input type="checkbox" name="fever" value="1"> Fever
                        <input type="checkbox" name="vomit" value="1"> Vomit
                    </div>
                    <div class="inputBox">
                        <span>Date of vaccination</span>
                        <span class="error" style="color: red;"><?php echo $dateErr; ?></span>
                        <input type="date" name="date" min="2022-01-01" max="2050-12-31">
                    </div>
                    <input type="submit" value="Send" name="send" class="btn">
                </div>
            </form>
        </section>
        <?php @include 'footer.php'; ?>
    </div>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>