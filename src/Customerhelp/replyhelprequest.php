<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/customerhelpcss.css">
</head>
<body>

<?php

// Get variables from previous page form
$help_id = $_POST["help_id"];
$history = $_POST["history"];
$reply = $_POST["reply"];
$cus_email = $_POST["cus_email"];
?>
<form action="customerhelp.php" method="post">
   <?php

// Check that a response was provided
if (!empty($reply)){

   // If so, update the details to include all previous information, and a new line with the customer's new message
$details = $history."\nCustomer says: ".$reply."\n";

// Create connection
include "../logindb_connect.php";
  
  // Prepare SQL Injection protected statement to update the request into database
  $statement = $con->prepare(
   "UPDATE help_issues SET 
  issue_details = ?
  WHERE help_id = ?");
   $statement->bind_param("ss", $details, $help_id);
   $exec = $statement->execute();
 
 if (!$exec)
  {
  die('Error: ' . mysqli_error($con));
  }
  ?>

<h1> Reply submitted! </h1> <?php
mysqli_close($con);
}
// If not, let user know that they did not enter any reply
else{
   ?> <h1> Reply field left empty. </h1> <?php
}

?>

<input type = "hidden" name="cus_email" value = '<?php echo $cus_email?>'>
   <input type="submit" value="Back to Help Menu">
</form>

</body>
</html>

