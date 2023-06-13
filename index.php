<?php

// SESSION_start();
// $c_id =  $_SESSION["c_id"];
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
    <title>Report allergy</title>
    <!-- Add the Bootstrap CSS file -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->

    <!-- Add the jQuery library -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

    <!-- Add the Bootstrap JS file -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
    <!-- <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" /> -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-image:none; background-color:lightblue">
<div class="container-fluid fs-2">
<nav class="navbar navbar-expand-lg navbar-light ml-auto">

  <form action="" method="get" class="form-inline my-2 my-lg-0 ">
    <div class="input-group  fs-2">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" name="search" type="submit">Search</button>
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
    $sql = "SELECT * FROM child WHERE name LIKE :search";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind the search parameter
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    
    // Execute the statement
    $stmt->execute();
    
    // Check if there are any results
    if ($stmt->rowCount() > 0) {
        // Loop through the results and display them
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>". "ID" . "</th>";
            echo "<th>". "First Name" . "</th>";
            echo "<th>". "Father Name" . "</th>";
            echo "<th>". "Mother Name" . "</th>";
            echo "<th>". "Allergy To:" . "</th>";
            echo "<th>". " Z-Score" . "</th>";
            echo "<th>". "Actions" . "</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            echo "<tr>";
            echo "<td>". $row['c_id'] ."</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['f_name'] . "</td>";
            echo "<td>" . $row['m_name'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['DOB'] . "</td>";
            echo "<td>" . $row['blood_type'] . "</td>";
            echo "<td>" . $row['hiv_status'] . "</td>";
            echo "</tr>";
            echo "</tbody>";
            echo "<table>";
            // Display the data here
                    echo "<td>" . $row['c_id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['f_name'] . "</td>";
                    echo "<td>" . $row['m_name'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['DOB'] . "</td>";
                    echo "<td>" . $row['blood_type'] . "</td>";

                    echo "<td>" . $row['hiv_status'] . "</td>";

                    // echo "<button>Delete</button>"; 

        }
    } else {
        echo "No results found";
    }
}

// Close the database connection
$conn = null;
?>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First Name</th>
      <th scope="col">Father Name</th>
      <th scope="col">Mother Name</th>
      <th scope="col">Allergy To:</th>
      <th scope="col">Z-Score</th>

      <th scope="col">Actions</th>
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
                    $sql = 'SELECT child.c_id, child.name, child.HIV_status, child.gender, child.blood_type FROM child
                            JOIN parent ON child.c_id= parent.c_id';
                    $stmt = $conn->query($sql);
                    

                    // fetch the results
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>"; 
                    echo "<td>" . $row['c_id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['f_name'] . "</td>";
                    echo "<td>" . $row['m_name'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['DOB'] . "</td>";
                    echo "<td>" . $row['blood_type'] . "</td>";

                    echo "<td>" . $row['hiv_status'] . "</td>";
                   
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
        <?php @include 'footer.php'; ?>
    </div>
</body>

</html>