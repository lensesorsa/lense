<?php
SESSION_start();
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['name']) || $_SESSION['role'] !== 'nurseclerk') {
      header("location:home.php");
      
   }
 
// $c_id =  $_SESSION["c_id"];
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'vaccination_db';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $exp_date_err = $received_date_err = $amount_err = $v_type_err = '';
    $exp_date = $received_date = $amount = $v_type = '';
} catch (PDOException $e) {
    echo $e->getMessage();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['exp_date'])) {
        $exp_date = ' Expiry date is required';
    } else {
        $exp_date = $_POST['exp_date'];
    }
    if (empty($_POST['received_date'])) {
        $received_date_err = ' received date is required';
    } else {
        $received_date = $_POST['received_date'];
    }
    if (empty($_POST['amount'])) {
        $amount_err = ' amount is required';
    } else {
        $amount = $_POST['amount'];
    }
    if (empty($_POST['v_type'])) {
        $v_type_err = 'name is required';
    } else {
        $v_type = $_POST['v_type'];
    }

    // Insert data into the child table
    try {
        $stmt = $conn->prepare('INSERT INTO vaccine (v_type,received_date,ammount,exp_date) VALUES (:v_type,:received_date,:ammount,:exp_date)');
        $stmt->bindParam(':v_type', $v_type);
        $stmt->bindParam(':received_date', $received_date);
        $stmt->bindParam(':ammount', $amount);
        $stmt->bindParam(':exp_date', $exp_date);
        $stmt->execute();
        // Get the last inserted ID from the child table
        // $c_id = $conn->lastInsertId();
        //echo "data succesfully inserted"; allert
    } catch (PDOException $err) {
        echo 'Error: ' . $err->getMessage();
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
    <title>Manage Vaccine</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- swiper css link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!-- custom css file link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
        column-gap: 10rem;
    }

    .col-3 {
        width: 20%;
        margin-right: 20px;
    }

    .col-9 {
        width: 66%;
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

<body style="background-color:lightblue">
    <?php @include 'NKhome.php'; ?>


    <section class="contact">
        <h1 class="heading">vaccine management</h1>
        <section class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <div class="box">
                            <?php @include 'NKnavigation.php'; ?>
                        </div>
                    </div>
                    <div class="col-9">
                            <section class="contact">
                                <h1 class="heading">Add vaccine</h1>
                            <form method="post" action="" id="addForm">
                                <div class="row mb-3">

                                <span>vaccine recieved</span>
                  <select name="v_type">
                     <option value="none"> none</option>
                     <option value="BCG">BCG</option>
                     <option value="polio 0">polio 0</option>
                     <option value="polio 1">polio 1</option>
                     <option value="polio 2">polio 2</option>
                     <option value="polio 3">polio 3</option>
                     <option value="rota 1">rota 1</option>
                     <option value="rota 2">rota 2</option>
                     <option value="penta">penta</option>
                     <option value="PCV">PCV</option>
                     <option value="measles">measles</option>
                     <option value="vit_A">vit_A</option>
                  </select>


                                
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
                                        <input type="date" class="form-control" id="colFormLabel" name="received_date">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="expiry_date" class="col-sm-2 col-form-label">Expiry Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="colFormLabel" name="exp_date">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
        </section>
</section>
        </div>
        </div>

        </div>
        </div>

    </section>
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
                    echo '<tr>';
                    echo '<td>' . $row['v_id'] . '</td>';
                    echo '<td>' . $row['v_type'] . '</td>';
                    echo '<td>' . $row['exp_date'] . '</td>';
                    echo '<td>' . $row['received_date'] . '</td>';
                    echo '<td>' . $row['ammount'] . '</td>';
                    echo '<td>' . '<button>Expired</button>' . '</td>';
                    echo '</tr>';
                    // echo $row['v_type'];
                }

                // close the database connection
                $conn = null;

                ?>
            </tbody>
        </table>
    </div>
    </div>
    </div>
    <!-- add vaccine  -->
    <div class="col-md-10 fs-1 text-primary text-center font-weight-bold">Vaccine Inventory in <?php echo date('F') . '-' . date('Y'); ?></div>


</body>
<?php @include 'footer.php'; ?>

</html>