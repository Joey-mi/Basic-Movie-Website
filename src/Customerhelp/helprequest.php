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
$cus_email = $_POST["cus_email"];

// Create connection
include "../logindb_connect.php";

  // Prepare SQL Injection protected statement to select the customer's selectd help issue, and check if it executed correctly
  $statement = $con->prepare(
   "SELECT * FROM help_issues WHERE help_id = ?");
   $statement->bind_param("s", $help_id);
   $exec = $statement->execute();
   $result = $statement->get_result();

 if (!$exec)
  {
  die('Error: ' . mysqli_error());
  }
  // Check if the request exists and add its details to the form
  $count = 0;
  while($row = mysqli_fetch_array($result))
  {
  $count = 1;
  $details = $row[3];
  $status = $row[4];
  }

  // If not, let the user know it could not be found
  if ($count == 0){
   ?>

   <form action="customerhelp.php" method="post">
      <h1> Request not found! </h1>
      <input type = "hidden" name="cus_email" value = '<?php echo $cus_email?>'>
      <input type="submit" value="Back to Help Menu">
      <input type="submit" formaction="../cu_dashboard.php" value="Back to Customer Homepage">
   </form>

<?php
  }
  // Once the request is found, populate the form based on if the request is open or closed
  else{
   
   ?>

   <?php if($status=='O'){ ?>
   <form action="replyhelprequest.php" method="post">
   <h1> Request Details </h1>
      <h3> Request ID: <?php echo $help_id ?> </h3>
      <h3> Status: Open </h3>
   <h3> Issue Details: </h3>
   <textarea name="details"
      rows="10" cols="51" disabled><?php echo $details?></textarea><br>

   
      Response: <br><textarea name="reply"
      rows="5" cols="51" placeholder="Enter response..."></textarea><br>

   <input type = "hidden" name="help_id" value = '<?php echo $help_id?>'>
   <input type = "hidden" name="history" value = '<?php echo $details?>'>
   <input type = "hidden" name="cus_email" value = '<?php echo $cus_email?>'>
      <input type="submit" value="Submit"> <br> <br>
      <input type="submit" formaction="customerhelp.php" value="Back to Help Menu">
   </form>
   <?php }
   else {
      ?>
      <form action="customerhelp.php" method="post">
      <h1> Request Details </h1>
      <h3> Request ID: <?php echo $help_id ?> </h3>
      <h3> Status: Closed </h3>
   <h3> Issue Details: </h3>
   <textarea name="details"
      rows="10" cols="51" disabled><?php echo $details?></textarea><br>
   <input type = "hidden" name="help_id" value = '<?php echo $help_id?>'>
   <input type = "hidden" name="details" value = '<?php echo $details?>'>
   <input type = "hidden" name="status" value = '<?php echo $status?>'>
   <input type = "hidden" name="fname" value = '<?php echo $fname?>'>
   <input type = "hidden" name="lname" value = '<?php echo $lname?>'>
   <input type = "hidden" name="cus_email" value = '<?php echo $cus_email?>'>
      <input type="submit" value="Back to Help Menu">
   </form>
   <?php
   }
   
  }
  
mysqli_close($con);


?>

</body>
   </html>


