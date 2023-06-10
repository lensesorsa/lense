<?php
SESSION_start();
$c_id =  $_SESSION["c_id"];
$host = "localhost";
$username = "root";
$password = "";
$dbname = "vaccination_db";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $symptomErr = $dateErr = "";
    $rash = $fever = $vomit = $date = "";
} catch (PDOException $e) {
    echo $e->getMessage();
}

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

    $registration_is_successful = true;


    // your PHP code for registration goes here

    if ($registration_is_successful) {
        // show modal using JavaScript
        echo "<script>$(document).ready(function() { $('#myModal').modal('show'); });</script>";
    }

    if (!empty($rash) || !empty($fever) || !empty($vomit)) {

        $insert = "INSERT INTO symptom (c_id, date, rash, fever, vomit) VALUES (:c_id, :date, :rash, :fever, :vomit)";
        $statement = $conn->prepare($insert);

        $statement->bindParam(':c_id', $c_id);
        $statement->bindParam(':date', $date);
        $statement->bindParam(':rash', $rash);
        $statement->bindParam(':fever', $fever);
        $statement->bindParam(':vomit', $vomit);
        $statement->execute();

        //echo "Records inserted successfully.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report allergy</title>
    <!-- Add the Bootstrap CSS file -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- Add the jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Add the Bootstrap JS file -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-image:none; background-color:lightblue">
    <div class="container">
        <?php @include 'header.php'; ?>
        <section class="contact">
            <h1 class="heading">Report Allergy</h1>
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
                    <input type="submit" value="Send" name="send" id="send" class="btn">
                </div>




                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"> Allergy Report Successful!!</h4>
                            </div>
                            <div class="modal-body">
                                <p>Your allergy report has been successful send.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </section>
        <script>
            $(document).ready(function() {
                $("#myModal").modal('hide');

                $("#send").click(function() {
                    $("#myModal").modal('show');
                });
            });
        </script>
        <?php @include 'footer.php'; ?>
    </div>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>