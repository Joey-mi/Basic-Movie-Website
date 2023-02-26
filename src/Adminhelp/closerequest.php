<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/adminhelpcss.css">
</head>
<body>

<form action="adminhelp.php" method="post">

<?php

// Get variables from previous page form
$help_id = $_POST["help_id"];

// Create connection
include "../logindb_connect.php";

  // Prepare SQL Injection protected statement to update the request status to closed into database
  $statement = $con->prepare(
    "UPDATE help_issues SET 
  status = 'C'
  WHERE help_id = ?");
    $statement->bind_param("s", $help_id);
    $exec = $statement->execute();
 
 if (!$exec)
  {
  die('Error: ' . mysqli_error($con));
  }

mysqli_close($con);

?>
   <h1> Request has been closed! </h1>
   <input type="submit" value="Back to Help Menu">
</form>

</body>
</html>

