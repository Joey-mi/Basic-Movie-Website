<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/adminmoviecss.css">
</head>
<body>
<form action="addshowtimes.php" method="post">
<?php 
// Get variables from previous page form
$movie_name = $_POST["movie_name"];
?>
<h1> Show time options for <?php echo $movie_name ?> </h1>



<input type = "hidden" name="movie_name" value = '<?php echo $movie_name?>'>
   <input type="submit" value="Add New Show Times"> <br> <br>
   <input type="submit" formaction="deleteshowtimes.php" value="Delete Show Times"> <br> <br>
   <input type="submit" formaction="adminmovie.php" value="Back to Movie Menu">
</form>

</body>
</html>