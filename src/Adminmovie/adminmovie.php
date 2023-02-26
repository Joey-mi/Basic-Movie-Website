<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/adminmoviecss.css">
</head>
<body>

<form action="addmovie.php" method="post">
   <h1> Movie options </h1>
   <input type="submit" value="Add New Movie"> <br> <br>
   <input type="submit" formaction="editmovie.php" value="Edit Movie"> <br> <br>
   <input type="submit" formaction="deletemovie.php" value="Delete Movie"> <br> <br>
   <input type="submit" formaction="showtimes.php" value="Update Showtimes"> <br> <br>
   <input type="submit" formaction="../adminindex.php" value="Back to Admin Menu">
</form>

</body>
</html>