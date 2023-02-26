<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/adminmoviecss.css">
</head>
<body>

<?php
// Get variables from previous page form
$movie_name = $_POST["movie_name"];
?>

  <form action="addshowtimesdb.php" method="post">
  <h1> Select Date and Times for <br> <?php echo $movie_name ?> </h1> 
    Start date:
    <input type="date" name="start_date" value='<?php echo $date;?>'
    min='<?php echo $date;?>' max='<?php echo date('Y-m-d', strtotime($date. '+ 1 years'));?>'><br> <br>
    End date:
    <input type="date" name="end_date" value='<?php echo date('Y-m-d', strtotime($date. '+ 1 months'));?>'
    min='<?php echo date('Y-m-d', strtotime($date. '+ 1 days'));?>' 
    max='<?php echo date('Y-m-d', strtotime($date. '+ 2 years'));?>'><br> <br>
    <select name="times" id="times">
         <option value="twoH11AM">2.5 Hour slots starting at 11:00AM</option>
         <option value="twoH1130AM">2.5 Hour slots starting at 11:30AM</option>
         <option value="twoH12PM">2.5 Hour slots starting at 12:00PM</option>
         <option value="twoH1230PM">2.5 Hour slots starting at 12:30PM</option>
         <option value="twoH1PM">2.5 Hour slots starting at 1:00PM</option>
         <option value="threeH11AM">3 Hour slots starting at 11:00AM</option>
         <option value="threeH1130AM">3 Hour slots starting at 11:30AM</option>
         <option value="threeH12PM">3 Hour slots starting at 12:00PM</option>
         <option value="threeH1230PM">3 Hour slots starting at 12:30PM</option>
         <option value="threeH1PM">3 Hour slots starting at 1:00PM</option>
         <option value="threeH130PM">3 Hour slots starting at 1:30PM</option>
   </select> <br> <br>
   <input type = "hidden" name="movie_name" value = '<?php echo $movie_name?>'>
   <input type="submit" value="Set Show Times"> <br> <br>
   <input type="submit" formaction="viewshowtimes.php" value="Back to Show Times Menu"> <br> <br>
   <input type="submit" formaction="adminmovie.php" value="Back to Movie Menu">
</form>
</body>
</html>
