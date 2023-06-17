<?php

SESSION_start();
$host = "localhost";
$username = "root";
$password = "";
$dbname = "vaccination_db";

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // $c_id=$name = $email = $number = $date = $address = $password = $gender = $HIV = $blood_type = "";
} catch (PDOException $e) {
  echo $e->getMessage();
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
  <title>child Profile</title>
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
    max-width: auto;
    margin: auto;
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
  }

  .col-9 {
    width: 65%;
    margin-left:0;
  }

  /* Navigation styles */
  .box {
    background-color: #f2f2f2;
    padding: 10px;
    height: auto;
    position: sticky;
    left: 0;
    top: 0;
    overflow-y: auto;
    padding: -10;
    margin-top: 15rem;

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
  <?php @include 'Nhome.php'; ?>
  <div class="container">
    <div class="row">
      <div class="col-3">
        <div class="box">
          <?php @include 'nursenavigation.php'; ?>
        </div>
      </div>
      <div class="col-9" welcome>
        <div class="content">
          <div class="container-fluid fs-2">
            <nav class="navbar navbar-expand-lg navbar-light ml-auto">

              <form action="" method="get" class="form-inline my-2 my-lg-0 ">
                <div class="input-group  fs-2">
                  <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </div>
              </form>
            </nav>
            <?php
            // Connect to the database
            $host = "localhost";
            $username = "root";
            $password = "";
            $dbname = "vaccination_db";

            try {
              $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              // $c_id=$name = $email = $number = $date = $address = $password = $gender = $HIV = $blood_type = "";
            } catch (PDOException $e) {
              echo $e->getMessage();
            }

            // Check if the search form has been submitted
            if (isset($_GET["search"])) {
              // Sanitize the search query to prevent SQL injection
              $search = $_GET["search"];
              $search = preg_replace("#[^0-9a-z]#i", "", $search); // Sanitize the search query

              // SQL query to search for matching records
              $sql = "SELECT child.*, parent.* FROM child JOIN parent ON child.c_id= parent.c_id WHERE name LIKE :search";

              // Prepare the statement
              $stmt = $conn->prepare($sql);

              // Bind the search parameter
              $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);

              // Execute the statement
              $stmt->execute();

              // Check if there are any results
              if ($stmt->rowCount() > 0) {
                // Loop through the results and display them
                  echo '<table class="table table-striped table-hover">';
                  echo "<tr>";
                  echo "<th>" . "ID" . "</th>";
                  echo "<th>" . "First Name" . "</th>";
                  echo "<th>" . "Father Name" . "</th>";
                  echo "<th>" . "Mother Name" . "</th>";
                  echo "<th>" . "Gender" . "</th>";
                  echo "<th>" . "Actions" . "</th>";
                  echo "</tr>";
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                  echo "<tr>";
                  echo "<td>" . $row['c_id'] . "</td>";
                  echo "<td>" . $row['name'] . "</td>";
                  echo "<td>" . $row['f_name'] . "</td>";
                  echo "<td>" . $row['m_name'] . "</td>";
                  echo "<td>" . $row['gender'] . "</td>";
                  echo '<td><button onclick="window.location.href = \'childprofile.php\';">profile</button></td>';
                  $_SESSION["c_id"]=$row['c_id'];

                  echo "</tr>";
                }
                echo "<table>";

              } else {
                echo "No results found";
              }
            }

            // Close the database connection
            $conn = null;
            ?>

            <h1>Children Table</h1>

            <table class="table table-striped table-hover">
              <th>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First Name</th>
                  <th scope="col">Father Name</th>
                  <th scope="col">Mother Name</th>
                  <th scope="col">Gender</th>
                </tr>
              </th>
              <tbody>
                <?php
                // connect to the database using PDO
                $dsn = 'mysql:host=localhost;dbname=vaccination_db';
                $username = 'root';
                $password = '';
                $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
                $conn = new PDO($dsn, $username, $password, $options);

                // execute a query using PDO
                $sql = 'SELECT child.c_id, child.name, child.gender,parent.f_name,parent.m_name FROM child JOIN parent ON child.c_id= parent.c_id';
                $stmt = $conn->query($sql);


                // fetch the results
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  echo "<tr>";
                  echo "<td>" . $row['c_id'] . "</td>";
                  echo "<td>" . $row['name'] . "</td>";
                  echo "<td>" . $row['f_name'] . "</td>";
                  echo "<td>" . $row['m_name'] . "</td>";
                  echo "<td>" . $row['gender'] . "</td>";


                  echo "</tr>";
                  // echo $row['v_type'];
                }

                // close the database connection
                $conn = null;

                ?>
              </tbody>
            </table>
            <!-- </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php @include 'footer.php'; ?>

</body>

</html>