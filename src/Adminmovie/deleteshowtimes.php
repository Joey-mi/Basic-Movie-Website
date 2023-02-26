<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/adminmoviecss.css">
</head>
<body>

<form action="deleteshowtimesdb.php" method="post">

<?php

// Get variables from previous page form
$movie_name = $_POST["movie_name"];

// Create connection
include "../logindb_connect.php";

  // Prepare SQL Injection protected statement to select distinct show dates from show times for the movie, and check if it executed correctly
  $statement = $con->prepare(
   "SELECT DISTINCT s_date FROM show_time WHERE movie_name = ?");
   $statement->bind_param("s", $movie_name);
   $exec = $statement->execute();
   $result = $statement->get_result();

 if (!$exec)
  {
  die('Error: ' . mysqli_error());
  }
  // Check if any show dates for selected movie are in database, and if so, display to user as checkboxes to delete
  $check = mysqli_fetch_array($result);
  if ($check >0){
   $exec = $statement->execute();
   $result = $statement->get_result();
   ?>
   <h1> Select show time dates to delete for <?php echo $movie_name?> </h1> 
  <form action="deleteshowtimesdb.php" method="post">
   <?php
  while($row = mysqli_fetch_array($result))
  {
  $d = $row[0];
  ?>
  <input type="checkbox" name="show_date[]" value='<?php echo $d ?>'>
  <?php echo $d?><br>
  <?php
  }
  ?>
  <input type = "hidden" name="movie_name" value = '<?php echo $movie_name?>'>
   <input type="submit" value="Delete show times" name="submit"> <br> <br>
   <input type="submit" formaction="viewshowtimes.php" value="Back to Show Times Menu">
</form>
   <?php


}
// If not, let user know there are none in database
else{
   ?>
   <h1> No show times in database! </h1>
   <input type = "hidden" name="movie_name" value = '<?php echo $movie_name?>'>
   <input type="submit" formaction="viewshowtimes.php" value="Back to Show Times Menu"> <br> <br>
   <input type="submit" formaction="adminmovie.php" value="Back to Movie Menu">
</form>


<?php
}

mysqli_close($con);
  ?>