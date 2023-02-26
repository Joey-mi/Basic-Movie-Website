<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/adminreportcss.css">
</head>
<body>

<?php

// Get variables from previous page form
$movie_name = $_POST["movie_name"];

// Create connection
include "../logindb_connect.php";

  // Prepare SQL Injection protected statement to select show times for the selected movie by theatre, and check if it executed correctly
  $statement = $con->prepare(
   "SELECT DISTINCT sdate, stime, theatre_no FROM ticket WHERE movie_name = ?");
   $statement->bind_param("s", $movie_name);
   $exec = $statement->execute();
   $result = $statement->get_result();
  
 if (!$exec)
  {
  die('Error: ' . mysqli_error());
  }
  // Check if there are any such showtimes in database, and add them to dropdown in form if so
  $check = mysqli_fetch_array($result);
  if ($check >0){
   $exec = $statement->execute();
   $result = $statement->get_result();
   ?>
  <form action="showtimereportdb.php" method="post">
  <h1> Select show time for <br> <?php echo $movie_name?> </h1>
  <select name="show_time" id="show_time">
   <?php
   // Populate dropdown for each show time
  while($row = mysqli_fetch_array($result))
  {
  $d = $row[0];
  $t = $row[1];
  $theatre = $row[2];
  $str = $d.$t.$theatre;
  ?>
  <option value='<?php echo $str ?>'><?php echo"Theatre ".$theatre." - ".$d." ".$t?></option>
  <?php
  }
  ?>
  <input type = "hidden" name="movie_name" value = '<?php echo $movie_name?>'>
   <input type="submit" value="Generate report" name="submit">
</form>
   <?php
}
// If not, let user know there are none in database
else{
   ?>

<form action="adminreport.php" method="post">
<h1> No show times in database for <br> <?php echo $movie_name ?>! </h1>
   <input type="submit" value="Back to Report Menu"> <br> <br>
   <input type="submit" formaction="../adminindex.php" value="Back to Admin Menu">
</form>

<?php
}

mysqli_close($con);
  ?>
</body>
</html>
