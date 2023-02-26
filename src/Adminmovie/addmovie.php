<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/adminmoviecss.css">
</head>
<body>

<form action="addmoviedb.php" method="post">
   <h1> Enter Movie information below </h1>
   Movie name: <br> <input type="text" name="movie_name"><br>
   Movie description: <br><textarea name="description"
      rows="5" cols="51" placeholder="Enter description here..."></textarea><br>
   Genre: <br><select name="genre" id="genre">
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
   Movie Photo: <br><input type="file" name='movie_img' accept='image/png, image/jpeg'>
   <br> <br>
   <input type="submit" value="Submit"> <br> <br>
   <input type="submit" formaction="adminmovie.php" value="Back to Movie Menu">
</form>

</body>
</html>
