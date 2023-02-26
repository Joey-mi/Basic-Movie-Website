<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/adminhelpcss.css">
</head>
<body>

<?php
// Create connection
include "../logindb_connect.php";

  // Prepare SQL Injection protected statement to select all help issues, and check if it executed correctly
  $statement = $con->prepare(
   "SELECT * FROM help_issues");
   $exec = $statement->execute();
   $result = $statement->get_result();

 if (!$exec)
  {
  die('Error: ' . mysqli_error());
  }
  // Check if there are any help requests in the database, and add them to dropdown in form if so
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
   <input type="submit" formaction="../adminindex.php" value="Back to Admin Menu">
   </form>
   <?php
}

// If not, let admin know that there are no help requests
else{
   ?>

<form action="../adminindex.php" method="post">
<h1> No help requests in database! </h1>
   <input type="submit" value="Back to Admin Menu">
</form>


<?php
}
?>

</body>
</html>