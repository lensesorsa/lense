<?php
SESSION_start();
// $c_id =  $_SESSION["c_id"];
$host = "localhost";
$username = "root";
$password = "";
$dbname = "vaccination_db";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $exp_date_err = $received_date_err = $amount_err = $v_type_err = "";
    $exp_date = $received_date = $amount = $v_type = "";
} catch (PDOException $e) {
    echo $e->getMessage();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["exp_date"])) {
        $exp_date = " Expiry date is required";
    } else {
        $exp_date = $_POST["exp_date"];
    }
    if (empty($_POST["received_date"])) {
        $received_date_err = " received date is required";
    } else {
        $received_date = $_POST["received_date"];
    }
    if (empty($_POST["amount"])) {
        $amount_err = " amount is required";
    } else {
        $amount = $_POST["amount"];
    }
    if (empty($_POST["v_type"])) {
        $v_type_err = "name is required";
    } else {
        $v_type = $_POST["v_type"];
    }

    // Insert data into the child table
    try {
        $stmt = $conn->prepare("INSERT INTO vaccine (v_type,received_date,ammount,exp_date) VALUES (:v_type,:received_date,:ammount,:exp_date)");
        $stmt->bindParam(':v_type', $v_type);
        $stmt->bindParam(':received_date', $received_date);
        $stmt->bindParam(':ammount', $amount);
        $stmt->bindParam(':exp_date', $exp_date);
        $stmt->execute();
        // Get the last inserted ID from the child table
        // $c_id = $conn->lastInsertId();
        //echo "data succesfully inserted"; allert
    } catch (PDOException $err) {
        echo "Error: " . $err->getMessage();
    }
}
// Close the database connection
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report allergy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-image:none; background-color:lightblue">
    <div class="container">
        <?php @include 'header.php'; ?>
        <div class="container-fluid p-5">
    <div class="container-fluid">
        <div class="row col-sm-12 fs-2 d-flex align-items-center justify-content-center" style="height: 580px;">
            JAN MEDA HEALTH CENTER<br/>
            Well-managed Vaccination center<br/>
            For all communities<br/>
            Safe environment<br/>
            <!-- <div classs="col-sm-6 d-flex align-items-center justify-content-center"> -->
            <div class="row">
                <div class="col">
                <a href="#addForm"><button class="btn btn-primary w-100">Add to Inventory</button></a>
            </div>
                <div class="col">
                <a href="#inventory"><button class="btn btn-secondary w-100">Go to Inventory</button></a>
            </div>
            </div>
            
        </div>
        <div class="col-md-10 fs-1 text-primary text-center font-weight-bold">Vaccine Report in <?php echo date('F') . "-" . date('Y');?></div>
        <div class="row" style="height:400px;">
            <div class="col-md-10 fs-2">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col"></th>
                        <th scope="col">BCG</th>
                        <th scope="col">Penta</th>
                        <th scope="col">Rota</th>
                        <th scope="col">smtn</th>
                        <th scope="col">smtn</th>
                        <th scope="col">smtn</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <tr>
                            <th scope="row">Used</th>
                            <td>200</td>
                            <td>200</td>
                            <td>200</td>
                            <td>200</td>
                            <td>200</td>
                            <td>200</td>
                        </tr>
                        <tr>
                            <th scope="row">Expired</th>
                            <td>200</td>
                            <td>200</td>
                            <td>200</td>
                            <td>200</td>
                            <td>200</td>
                            <td>200</td>
                        </tr>
                        <tr>
                            <th scope="row">Overall</th>
                            <td>200</td>
                            <td>200</td>
                            <td>200</td>
                            <td>200</td>
                            <td>200</td>
                            <td>200</td>
                        </tr>
                    </tbody>
                </table>
            </div>  
        </div>
        
        <div class="buttons">

        </div>
            
         <!-- add vaccine  -->
        <div class="row">
            <div class="col-md-6 fs-2 text-center" style="width: 270px; height:600px; margin:10px 50px;">
                The vaccines are imported from the governmetal Agency EPSA.
                The Vaccines Recieved for the vaccination include ...
            </div>
            <div class="col-md-6 fs-2 text-center mx-auto" style="width: 700px; height:600px; margin:10px 50px;">
            <form  method="post" action="" id="addForm">
                
                <div class="row mb-3">
                <label for="vaccine_type" class="col-sm-2 col-form-label">Vaccine Type</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="vaccine_type" name="v_type" placeholder="Vaccine Name">
                    </div>
                </div>
                <div class="row mb-3">
                <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                <div class="col-sm-10">
                    <input type="amount" class="form-control" id="colFormLabel" placeholder="Amount" name="amount">
                </div>
                </div>
                <div class="row mb-3">
                <label for="received_date" class="col-sm-2 col-form-label">Received Date</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="colFormLabel"  name="received_date">
                </div>
                </div>
                <div class="row mb-3">
                <label for="expiry_date" class="col-sm-2 col-form-label">Expiry Date</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="colFormLabel"  name="exp_date">
                </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
            <!-- <button type="submit" class="btn btn-primary">See Inventory</button> -->
            </div>
        </div>
        <div class="col-md-10 fs-1 text-primary text-center font-weight-bold">Vaccine Inventory in <?php echo date('F') . "-" . date('Y');?></div>   
        <div class="col-md-12 fs-2" id="inventory">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Vaccine ID</th>
                    <th scope="col">Vaccine Name</th>
                    <th scope="col">Expiry Date</th>
                    <th scope="col">Recieved Date</th>
                    <th scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // connect to the database using PDO
                    $dsn = 'mysql:host=localhost;dbname=vaccination_db';
                    $username = 'root';
                    $password = '';
                    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
                    $conn = new PDO($dsn, $username, $password, $options);

                    // execute a query using PDO
                    $sql = 'SELECT * FROM vaccine';
                    $stmt = $conn->query($sql);

                    // fetch the results
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>"; 
                    echo "<td>" . $row['v_id'] . "</td>";
                    echo "<td>" . $row['v_type'] . "</td>";
                    echo "<td>" . $row['exp_date'] . "</td>";
                    echo "<td>" . $row['received_date'] . "</td>";
                    echo "<td>" . $row['ammount'] . "</td>";
                    echo "<td>".  "<button>Expired</button>" . "</td>";
                    echo "</tr>";
                    // echo $row['v_type'];
                    }

                    // close the database connection
                    $conn = null;

                    ?>
                </tbody>
            </table>
        </div>
    </div>
        <?php @include 'footer.php'; ?>
    </div>
</body>

</html>