<?php
session_start();
unset($_SESSION["p_id"]);
unset($_SESSION["c_id"]);
unset($_SESSION["name"]);
unset($_SESSION["password"]);
session_destroy();
header("Location:home.php");
?>
<!-- correct  -->