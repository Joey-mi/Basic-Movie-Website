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
  // Confirm that movie to be edited is in database, and if so populate fields with its values
  $count = 0;
  while($row = mysqli_fetch_array($result))
  {
  $count = 1;
  $description = $row[1];
  $genre = $row[2];
  $movie_img = substr($row[3],10);
  }
  // If not, let user know there are movie could not be found
  if ($count == 0){
   ?>
   <h1> Movie not found! </h1> <?php
   ?>

   <input type="submit" value="Edit Another Movie">
   <input type="submit" formaction="adminmovie.php" value="Back to Movie Menu">
   <input type="submit" formaction="../adminindex.php" value="Back to Admin Menu">
   </form>

<?php
  }
  else{
   ?>

   <h1> Edit Movie below </h1>

   <form action="editmoviefieldsdb.php" method="post">
      Movie name: <br><input type="text" name="movie_name_new" value='<?php echo $movie_name?>'><br>
      Movie description: <br><textarea name="description"
      rows="5" cols="51"><?php echo $description?></textarea><br>
      Genre (previously <?php echo $genre?>): <br> <select name="genre" id="genre">
        <option value="Action">Action</option>
        <option value="Horror">Horror</option>
        <option value="Drama">Drama</option>
        <option value="Thriller">Thriller</option>
        <option value="Romance">Romance</option>
        <option value="Comedy">Comedy</option>
        <option value="Adventure">Adventure</option>
        <option value="Science Fiction">Science Fiction</option>
        <option value="Documentary">Documentary</option>
        <option value="Fantasy">Fantasy</option>
        <option value="Animation">Animation</option>
        <option value="Mystery">Mystery</option>
        <option value="Sports">Sports</option>
        <option value="Historical">Historcal</option>
   </select> <br> 
   Movie Photo (previously <?php echo $movie_img?>): <br><input type="file" name='movie_img' accept='image/png, image/jpeg'><br> <br>
   <input type = "hidden" name="movie_name" value = '<?php echo $movie_name?>'>
   <input type = "hidden" name="movie_img_old" value = '<?php echo $movie_img?>'>
      <input type="submit" formaction="editmoviefieldsdb.php" value="Edit"> <br> <br>
      <input type="submit" formaction="adminmovie.php" value="Back to Movie Menu">
   </form>
   
   <?php
   
  }
mysqli_close($con);

?>

</body>
   </html>


