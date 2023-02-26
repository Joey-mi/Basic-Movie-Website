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
?>

   <form action="showtimereport.php" method="post">
   <h1> <?php echo "Movie report options for ".$movie_name ?> </h1>
   <input type = "hidden" name="movie_name" value = '<?php echo $movie_name?>'>
   <input type="submit" value="Generate Show Time Report"> <br> <br>
   <input type="submit" formaction="datereport.php" value="Generate Date Report"> <br> <br>
   <input type="submit" formaction="viewreport.php"value="View Reports"> <br> <br>
   <input type="submit" formaction="../adminindex.php"value="Back to Admin Menu">
   </form>

   </body>
   </html>


