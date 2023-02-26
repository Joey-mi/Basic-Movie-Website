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

// Check that at least one checkbox was selected, and if so, create array of selections
if(isset($_POST['submit'])){
  if(!empty($_POST['show_date'])){
    $show_date = $_POST['show_date'];

    // Create connection
  include "../logindb_connect.php";

    // Loop through each date in array
    foreach($show_date as $d){

      // Prepare SQL Injection protected statement to delete show times for each selected date and movie, and check if it executed correctly
      $statement = $con->prepare(
        "DELETE FROM show_time WHERE s_date = ? AND movie_name = ?");
        $statement->bind_param("ss", $d, $movie_name);
        $exec = $statement->execute();

      if (!$exec)
        {
        die('Error: ' . mysqli_error($con));
        }

    }
    mysqli_close($con);

  ?>

  <h1> Show times deleted! </h1>
 
<?php
  }
  // If not, let user know there were none selected
else{
  ?>
  <h1> No show times selected to delete! </h1>

<?php
}
}
// If not, let user know there are none in database
else {
  ?>
  <h1> Show times not given </h1>
<?php

}
?>

<input type="submit" value="Back to Movie Menu"> <br> <br>
   <input type="submit" formaction="../adminindex.php" value="Back to Admin Menu">
</form>


?>