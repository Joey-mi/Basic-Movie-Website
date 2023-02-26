<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/adminreportcss.css">
</head>
<body>

<?php
// Create connection
include "../logindb_connect.php";

  // Prepare SQL Injection protected statement to select movies, and check if it executed correctly
  $statement = $con->prepare(
   "SELECT * FROM movie");
   $exec = $statement->execute();
   $result = $statement->get_result();

 if (!$exec)
  {
  die('Error: ' . mysqli_error());
  }
  // Check if there are any movies in database, and add them to dropdown in form if so
  $check = mysqli_fetch_array($result);
  if ($check >0){
   $exec = $statement->execute();
   $result = $statement->get_result();
   ?>
  <form action="moviereport.php" method="post" name="selectmovie">
  <h1> Select Movie below </h1>
  Movie name: <select name="movie_name" id="movie_name">
   <?php
  while($row = mysqli_fetch_array($result))
  {
  $movie_name = $row[0];
  ?>
  <option value='<?php echo $movie_name?>'><?php echo $movie_name?></option>
  <?php
  }
  ?>
  </select>
   <input type="submit" value="Select"> <br><br>
   <input type="submit" formaction="../adminindex.php" value="Back to Admin Menu">
   </form>
   <?php
}

// If not, let user know there are none in database
else{
   ?>

<form action="../adminindex.php" method="post">
<h1> No movies in database! </h1>
   <input type="submit" value="Back to Admin Menu">
</form>


<?php
}
?>

</body>
</html>