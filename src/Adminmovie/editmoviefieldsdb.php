<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/adminmoviecss.css">
</head>
<body>

<form action="editmovie.php" method="post">

<?php

// Get variables from previous page form
// Note that the old and new movie names are both used, as the old one will be used to locate the entry in the database, and the new one will replace it as the 
// new primary key
$movie_name_new = $_POST["movie_name_new"];
$movie_name = $_POST["movie_name"];
$description = $_POST["description"];
$genre = $_POST["genre"];
$movie_img = $_POST["movie_img"];
$movie_img_old = $_POST["movie_img_old"];

if (strlen($movie_name_new) == 0){
  ?>
  <h1> Movie name cannot be blank!</h1>
  <input type="submit" formaction="adminmovie.php" value="Back to Movie Menu"> <br> <br>
  <input type="submit" formaction="../adminindex.php" value="Back to Admin Menu">
</form>
<?php
}
else{
// For images, if nothing is selected in the edit, we will use the previous image again
if (strlen($movie_img) == 0){
  $movie_img = "../images/".$movie_img_old;
}
// If a new file is selected, replace the image with the new one
else{

$movie_img = "../images/".$movie_img;
}

// Create connection
include "../logindb_connect.php";

  // Prepare SQL Injection protected statement to check movies, and check if it executed correctly
  $statement = $con->prepare(
    "SELECT * FROM movie WHERE movie_name = ?");
    $statement->bind_param("s", $movie_name_new);
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

  // Prepare SQL Injection protected statement to update fields of selected movie, and check if it executed correctly
$statement = $con->prepare(
  "UPDATE movie SET 
  movie_name = ?, movie_desc = ?, genre = ?, movie_path = ?
  WHERE movie_name = ?");
  $statement->bind_param("sssss", $movie_name_new, $description, $genre, $movie_img, $movie_name);
  $exec = $statement->execute();
 
 if (!$exec)
  {
  die('Error: ' . mysqli_error($con));
  }
  ?>
<h1> Movie edited!</h1> <?php
  }

mysqli_close($con);

?>

   <input type="submit" value="Edit Another Movie"> <br> <br>
   <input type="submit" formaction="adminmovie.php" value="Back to Movie Menu"> <br> <br>
   <input type="submit" formaction="../adminindex.php" value="Back to Admin Menu">
</form>
<?php
}
?>

</body>
</html>

