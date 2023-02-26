<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/adminmoviecss.css">
</head>
<body>

<form action="adminmovie.php" method="post">

<?php
// Get variables from previous page form
$movie_name = $_POST["movie_name"];
$description = $_POST["description"];
$genre = $_POST["genre"];
$movie_img = $_POST["movie_img"];

if (strlen($movie_img) == 0){
  $movie_img = "../images/default.jpg";
}
else{

$movie_img = "../images/".$movie_img;
}

// Check if movie name contains text
if (strlen($movie_name) > 0){

// Create connection
include "../logindb_connect.php";
  
  // Prepare SQL Injection protected statement to check movies, and check if it executed correctly
  $statement = $con->prepare(
    "SELECT * FROM movie WHERE movie_name = ?");
    $statement->bind_param("s", $movie_name);
    $exec = $statement->execute();
    $result = $statement->get_result();

    if (!$exec)
    {
      die('Error: ' . mysqli_error($con));
    }

    // Check if movie name already exists in database
    $check = mysqli_fetch_array($result);
  if ($check >0){
   ?> <h1> Movie name already exists in database! </h1> <?php
  }
  else{

    // Prepare SQL Injection protected statement to insert movie, , and check if it executed correctly
    $statement2 = $con->prepare(
      "INSERT INTO movie (movie_name, movie_desc, genre, movie_path) VALUES 
  (?,?,?,?)");
      $statement2->bind_param("ssss", $movie_name, $description, $genre, $movie_img);
      $exec = $statement2->execute();

      if (!$exec)
    {
      die('Error2: ' . mysqli_error($con));
    }

  
?> <h1> Movie added! </h1> <?php

mysqli_close($con);
  }
}
else{
   ?> <h1> Movie name field cannot be blank! </h1> <?php
}

?>

   <input type="submit" formaction="addmovie.php" value="Add Another Movie"> <br> <br>
   <input type="submit" value="Back to Movie Menu"> <br> <br>
   <input type="submit" formaction="../adminindex.php" value="Back to Admin Menu">
</form>

</body>
</html>

