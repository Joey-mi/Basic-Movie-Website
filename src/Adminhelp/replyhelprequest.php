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
$history = $_POST["history"];
$reply = $_POST["reply"];

?>
  <form action="closerequest.php" method="post">
   <?php
   // Check that a response was provided
if (!empty($reply)){

// If so, update the details to include all previous information, and a new line with the admin's new message
$details = $history."\nAdmin says: ".$reply."\n";

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
  
  // After updating, prompt adim to ask if they want to close the request
?> <h1> Reply submitted! Close request? </h1> <?php
mysqli_close($con);
}
// If no reply provided, don't update request, but prompt admin to ask if they want to close the request
else{
   ?>
   <h1> Reply field left empty. Close request? </h1> <?php
}
?>
<input type = "hidden" name="help_id" value = '<?php echo $help_id?>'>
   <input type="submit" value="Close Request">
   <input type="submit" formaction="adminhelp.php" value="Back to Help Menu">
</form>


</body>
</html>

