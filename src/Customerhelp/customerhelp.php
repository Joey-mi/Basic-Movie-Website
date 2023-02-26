<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/customerhelpcss.css">
</head>
<body>

<?php

// Start customer session to access customer email
session_start();
if(!isset($_SESSION["user_name"]))
{
    header("Location: login.php");
}

// Create connection
include "../logindb_connect.php";

  // Get customer email from session
  $cus_email = $_SESSION["user_name"];

  // Prepare SQL Injection protected statement to select all of the customer's help issue, and check if it executed correctly
  $statement = $con->prepare(
   "SELECT * FROM help_issues WHERE c_email = ?");
   $statement->bind_param("s", $cus_email);
   $exec = $statement->execute();
   $result = $statement->get_result();

 if (!$exec)
  {
  die('Error: ' . mysqli_error());
  }
  // Check if there are any help request for the customer in the database, and add them to dropdown in form if so
  $check = mysqli_fetch_array($result);
  if ($check >0){
   $exec = $statement->execute();
   $result = $statement->get_result();
   ?>
  
  <form action="helprequest.php" method="post">
   <h1> Select Help Request below </h1>
  Request ID: <select name="help_id" id="help_id">
   <?php
  while($row = mysqli_fetch_array($result))
  {
  $help_id = $row[2];
  ?>
  <option value='<?php echo $help_id?>'><?php echo $help_id?></option>
  <?php
  }
  ?>
  </select>
   <input type="submit" value="Select"> <br> <br>
   <input type = "hidden" name="cus_email" value = '<?php echo $cus_email?>'>
   <input type="submit" formaction="newrequest.php" value="Create New Request"> <br> <br>
   <input type="submit" formaction="../cu_dashboard.php" value="Back to Customer Homepage">

   <?php
}

// If not, let the user know
else{
   ?>

   <form action="newrequest.php" method="post">
      <h1> No help request in database! </h1>
      <input type = "hidden" name="cus_email" value = '<?php echo $cus_email?>'>
   <input type="submit" value="Create New Request">
   <input type="submit" formaction="../cu_dashboard.php" value="Back to Customer Homepage">

<?php
}
?>

</body>
</html>