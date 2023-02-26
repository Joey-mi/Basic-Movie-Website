<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/adminhelpcss.css">
</head>
<body>

<?php

// Get variables from previous page form
$help_id = $_POST["help_id"];
$details = $_POST["details"];
$status = $_POST["status"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];

// Create connection
include "../logindb_connect.php";

  // Prepare SQL Injection protected statement to update the request status to open in database
  $statement = $con->prepare(
   "UPDATE help_issues SET 
  status = 'O'
  WHERE help_id = ?");
   $statement->bind_param("s", $help_id);
   $exec = $statement->execute();
  
 if (!$exec)
  {
  die('Error: ' . mysqli_error());
  }
  
  // After updating the request to open, populate the request for response
   ?>

   <form action="replyhelprequest.php" method="post">
   <h1> Request Details </h1>
      <h3> Request ID: <?php echo $help_id ?> </h3>
      <h3> Status: Open</h3>
   <h3> Customer Name: <?php echo $fname." ".$lname ?> </h3>
   <h3> Issue Details: </h3>
   <textarea name="details"
      rows="10" cols="51" disabled><?php echo $details?></textarea><br>

   
      Response: <br><textarea name="reply"
      rows="5" cols="51" placeholder="Enter response..."></textarea><br>

   <input type = "hidden" name="help_id" value = '<?php echo $help_id?>'>
   <input type = "hidden" name="history" value = '<?php echo $details?>'>
      <input type="submit" value="Submit">
   </form>

   <?php
  
mysqli_close($con);


?>

</body>
   </html>

