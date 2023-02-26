<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="./styles/adminmoviecss.css">
</head>
<body>

<?php
session_start();
include "logindb_connect.php";

$firstName = mysqli_real_escape_string($con, $_POST['fname']);
    $lastName = mysqli_real_escape_string($con, $_POST['lname']);
    $cusEmail = $_SESSION["user_name"];

    $statement = $con->prepare(
        "UPDATE customer SET 
        fname = ?, lname = ?
        WHERE customer_email = ?");
        $statement->bind_param("sss", $firstName, $lastName, $cusEmail);
        $exec = $statement->execute();
        
        if (!$exec)
        {
        die('Error: ' . mysqli_error($con));
        }
        echo "Profile updated!";
        mysqli_close($con);

?>
<a href="cu_dashboard.php">
    <button> Back to Movie Menu</button> <br>
</a>
</body>
</html>


