<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/adminmoviecss.css">
</head>
<body>

<form action="deletemovie.php" method="post">

<?php

// Get variables from previous page form
$movie_name = $_POST["movie_name"];

// Create connection
include "../logindb_connect.php";

  // Prepare SQL Injection protected statement to select movies equal to selected movie, and check if it executed correctly
  $statement = $con->prepare(
    "SELECT * FROM movie WHERE movie_name = ?");
    $statement->bind_param("s", $movie_name);
    $exec = $statement->execute();
    $result = $statement->get_result();
 if (!$exec)
  {
  die('Error: ' . mysqli_error());
  }
  // Confirm that movie to be deleted is in database
  $count = 0;
  while($row = mysqli_fetch_array($result))
  {
  $count = 1;
  }

  if ($count == 0){
   ?> <h1> Movie not found! </h1> <?php
  }
  else{

    // Prepare SQL Injection protected statement to delete selected movie, and check if it executed correctly
    $statement = $con->prepare(
      "DELETE FROM movie WHERE movie_name = ?");
      $statement->bind_param("s", $movie_name);
      $exec = $statement->execute();
      $result = $statement->get_result();
   if (!$exec)
  {
  die('Error: ' . mysqli_error($con));
  }
  ?>
  <h1> Movie deleted! </h1> <?php
  }

mysqli_close($con);

?>

   <input type="submit" value="Delete Another Movie"> <br> <br>
   <input type="submit" formaction="adminmovie.php" value="Back to Movie Menu"> <br> <br>
   <input type="submit" formaction="../adminindex.php" value="Back to Admin Menu">
</form>

</body>
</html>

