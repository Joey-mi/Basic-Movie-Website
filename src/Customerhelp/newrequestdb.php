   <!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/customerhelpcss.css">
</head>
<body>

<form action="customerhelp.php" method="post">
<?php

// Get variables from previous page form
$cus_email = $_POST["cus_email"];
$details = $_POST["details"];


// Check that details for the request were provided
if (!empty($details)){

   $details = $details."\n";

// Create connection
include "../logindb_connect.php";
  
  // Prepare SQL Injection protected statement to insert new request into database. The assigned admin defaults to the admin@email.com account,
  // as this is the only admin account so it will manage all requests
  $statement = $con->prepare(
   "INSERT INTO `help_issues` (`a_email`, `c_email`, `help_id`, `issue_details`, `status`)
   VALUES ('admin@email.com', ?, NULL, ?, 'O')");
   $statement->bind_param("ss", $cus_email, $details);
   $exec = $statement->execute();
 
 if (!$exec)
  {
  die('Error: ' . mysqli_error($con));
  }

?> <h1> Help request submitted! </h1> <?php
mysqli_close($con);
}
// If left empty, let the user know that they did not type anything for their request
else{
   ?>
   <h1> Reply field left empty. </h1> <?php
}

?>
   <input type = "hidden" name="cus_email" value = '<?php echo $cus_email?>'>
   <input type="submit" value="Back to Help Menu">
</form>

</body>
</html>

