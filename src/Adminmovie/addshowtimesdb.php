<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/adminmoviecss.css">
</head>
<body>

<form action="createtickets.php" method="post">

<?php
// Get variables from previous page form
$movie_name = $_POST["movie_name"];
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];
$times = $_POST["times"];

// Increase end date by 1 day to allow for end date selected to be included in the date range
$end_date = date('Y-m-d', strtotime($end_date. '+ 1 days'));

// Make sure that the start date is before the end date
if ($start_date < $end_date){

// Create a period of every day in the range to loop through
$start = new DateTime($start_date);
$end = new DateTime($end_date);
$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($start, $interval, $end);

// Create connection
  $config = include('../../config.php');
  $con = mysqli_connect($config['host'], $config['dbUser'], $config['dbPass'], $config['dbName']);

// Check connection
if (!$con)
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  // For each date, check which timeslots are used, and create showtimes for all times slots
  foreach($period as $date){
    $d = $date->format('Y-m-d');

    // Cases for each of the show time windows
    switch($times){
      case "twoH11AM":
        $time_array = array('11:00:00','13:30:00','16:00:00','18:30:00','21:00:00');
        foreach($time_array as $t){
          // Prepare SQL Injection protected statement to insert show time, and check if it executed correctly
          $statement = $con->prepare(
            "INSERT INTO show_time (s_date, s_time, movie_name) SELECT ?, ?, ?
                  WHERE NOT EXISTS
                  (SELECT * FROM show_time WHERE s_date = ? AND s_time = ? AND movie_name = ?)");
          $statement->bind_param("ssssss", $d, $t, $movie_name, $d, $t, $movie_name);
           $exec = $statement->execute();
            if (!$exec)
              {
              die('Error: ' . mysqli_error());
              }
        }
        break;
      case "twoH1130AM":
        $time_array = array('11:30:00','14:00:00','16:30:00','19:00:00','21:30:00');
        foreach($time_array as $t){
          // Prepare SQL Injection protected statement to insert show time, and check if it executed correctly
          $statement = $con->prepare(
            "INSERT INTO show_time (s_date, s_time, movie_name) SELECT ?, ?, ?
                  WHERE NOT EXISTS
                  (SELECT * FROM show_time WHERE s_date = ? AND s_time = ? AND movie_name = ?)");
          $statement->bind_param("ssssss", $d, $t, $movie_name, $d, $t, $movie_name);
           $exec = $statement->execute();
            if (!$exec)
              {
              die('Error: ' . mysqli_error());
              }
        }
        break;
      case "twoH12PM":
        $time_array = array('12:00:00','14:30:00','17:00:00','19:30:00','22:00:00');
        foreach($time_array as $t){
          // Prepare SQL Injection protected statement to insert show time, and check if it executed correctly
          $statement = $con->prepare(
            "INSERT INTO show_time (s_date, s_time, movie_name) SELECT ?, ?, ?
                  WHERE NOT EXISTS
                  (SELECT * FROM show_time WHERE s_date = ? AND s_time = ? AND movie_name = ?)");
          $statement->bind_param("ssssss", $d, $t, $movie_name, $d, $t, $movie_name);
           $exec = $statement->execute();
            if (!$exec)
              {
              die('Error: ' . mysqli_error());
              }
        }
        break;
      case "twoH1230PM":
        $time_array = array('12:30:00','15:00:00','17:30:00','20:00:00','22:30:00');
        foreach($time_array as $t){
          // Prepare SQL Injection protected statement to insert show time, and check if it executed correctly
          $statement = $con->prepare(
            "INSERT INTO show_time (s_date, s_time, movie_name) SELECT ?, ?, ?
                  WHERE NOT EXISTS
                  (SELECT * FROM show_time WHERE s_date = ? AND s_time = ? AND movie_name = ?)");
          $statement->bind_param("ssssss", $d, $t, $movie_name, $d, $t, $movie_name);
           $exec = $statement->execute();
            if (!$exec)
              {
              die('Error: ' . mysqli_error());
              }
        }
        break;
      case "twoH1PM":
        $time_array = array('13:00:00','15:30:00','18:00:00','20:30:00','23:00:00');
        foreach($time_array as $t){
          // Prepare SQL Injection protected statement to insert show time, and check if it executed correctly
          $statement = $con->prepare(
            "INSERT INTO show_time (s_date, s_time, movie_name) SELECT ?, ?, ?
                  WHERE NOT EXISTS
                  (SELECT * FROM show_time WHERE s_date = ? AND s_time = ? AND movie_name = ?)");
          $statement->bind_param("ssssss", $d, $t, $movie_name, $d, $t, $movie_name);
           $exec = $statement->execute();
            if (!$exec)
              {
              die('Error: ' . mysqli_error());
              }
        }
        break;
      case "threeH11AM":
        $time_array = array('11:00:00','14:00:00','17:00:00','20:00:00');
        foreach($time_array as $t){
          // Prepare SQL Injection protected statement to insert show time, and check if it executed correctly
          $statement = $con->prepare(
            "INSERT INTO show_time (s_date, s_time, movie_name) SELECT ?, ?, ?
                  WHERE NOT EXISTS
                  (SELECT * FROM show_time WHERE s_date = ? AND s_time = ? AND movie_name = ?)");
          $statement->bind_param("ssssss", $d, $t, $movie_name, $d, $t, $movie_name);
           $exec = $statement->execute();
            if (!$exec)
              {
              die('Error: ' . mysqli_error());
              }
        }
        break;
      case "threeH1130AM":
        $time_array = array('11:30:00','14:30:00','17:30:00','20:30:00');
        foreach($time_array as $t){
          // Prepare SQL Injection protected statement to insert show time, and check if it executed correctly
          $statement = $con->prepare(
            "INSERT INTO show_time (s_date, s_time, movie_name) SELECT ?, ?, ?
                  WHERE NOT EXISTS
                  (SELECT * FROM show_time WHERE s_date = ? AND s_time = ? AND movie_name = ?)");
          $statement->bind_param("ssssss", $d, $t, $movie_name, $d, $t, $movie_name);
           $exec = $statement->execute();
            if (!$exec)
              {
              die('Error: ' . mysqli_error());
              }
        }
        break;
      case "threeH12PM":
        $time_array = array('12:00:00','15:00:00','18:00:00','21:00:00');
        foreach($time_array as $t){
          // Prepare SQL Injection protected statement to insert show time, and check if it executed correctly
          $statement = $con->prepare(
            "INSERT INTO show_time (s_date, s_time, movie_name) SELECT ?, ?, ?
                  WHERE NOT EXISTS
                  (SELECT * FROM show_time WHERE s_date = ? AND s_time = ? AND movie_name = ?)");
          $statement->bind_param("ssssss", $d, $t, $movie_name, $d, $t, $movie_name);
           $exec = $statement->execute();
            if (!$exec)
              {
              die('Error: ' . mysqli_error());
              }
        }
        break;
      case "threeH1230PM":
        $time_array = array('12:30:00','15:30:00','18:30:00','21:30:00');
        foreach($time_array as $t){
          // Prepare SQL Injection protected statement to insert show time, and check if it executed correctly
          $statement = $con->prepare(
            "INSERT INTO show_time (s_date, s_time, movie_name) SELECT ?, ?, ?
                  WHERE NOT EXISTS
                  (SELECT * FROM show_time WHERE s_date = ? AND s_time = ? AND movie_name = ?)");
          $statement->bind_param("ssssss", $d, $t, $movie_name, $d, $t, $movie_name);
           $exec = $statement->execute();
            if (!$exec)
              {
              die('Error: ' . mysqli_error());
              }
        }
        break;
      case "threeH1PM":
        $time_array = array('13:00:00','16:00:00','19:00:00','22:00:00');
        foreach($time_array as $t){
          $statement = $con->prepare(
            // Prepare SQL Injection protected statement to insert show time, and check if it executed correctly
            "INSERT INTO show_time (s_date, s_time, movie_name) SELECT ?, ?, ?
                  WHERE NOT EXISTS
                  (SELECT * FROM show_time WHERE s_date = ? AND s_time = ? AND movie_name = ?)");
          $statement->bind_param("ssssss", $d, $t, $movie_name, $d, $t, $movie_name);
           $exec = $statement->execute();
            if (!$exec)
              {
              die('Error: ' . mysqli_error());
              }
        }
        break;
      case "threeH130PM":
        $time_array = array('13:30:00','16:30:00','19:30:00','22:30:00');
        foreach($time_array as $t){
          // Prepare SQL Injection protected statement to insert show time, and check if it executed correctly
          $statement = $con->prepare(
            "INSERT INTO show_time (s_date, s_time, movie_name) SELECT ?, ?, ?
                  WHERE NOT EXISTS
                  (SELECT * FROM show_time WHERE s_date = ? AND s_time = ? AND movie_name = ?)");
          $statement->bind_param("ssssss", $d, $t, $movie_name, $d, $t, $movie_name);
           $exec = $statement->execute();
            if (!$exec)
              {
              die('Error: ' . mysqli_error());
              }
        }
        break;
    }
  
  
}

$theatre_no;
$cinema;
// Prepare SQL Injection protected statement to get list of theatre halls, and check if it executed correctly
$statement = $con->prepare(
  "SELECT * FROM theatre_hall");
  $exec = $statement->execute();
  $result = $statement->get_result();

 if (!$exec)
  {
  die('Error: ' . mysqli_error());
  }
  $check = mysqli_fetch_array($result);
  // Check that it contains values
  if ($check >0){
    $exec = $statement->execute();
    $result = $statement->get_result();
   ?>
   <h1> Assign theatre halls for <?php echo $movie_name?> </h1>
      <h3> Theatre Hall and Cinema Location </h3>
   <?php
   // Loop through each row to populate check boxes
  while($row = mysqli_fetch_array($result))
  {
  $theatre_no = $row[0];
  $cinema = $row[1];
  ?>
  <input type="checkbox" name="shown_in[]" value='<?php echo $theatre_no ?>'>
  <?php echo $cinema?> <?php echo $theatre_no?><br> 
  <?php
  }
  ?> <br>
  <input type = "hidden" name="movie_name" value = '<?php echo $movie_name?>'>
  <input type = "hidden" name="start_date" value = '<?php echo $start_date?>'>
  <input type = "hidden" name="end_date" value = '<?php echo $end_date?>'>
  <?php foreach ($time_array as $t){
    echo '<input type = "hidden" name = "times[]" value="'. $t .'">';
  }
  ?>
   <input type="submit" value="Assign theatre halls" name="submit"> <br> <br>
   <input type="submit" formaction="adminmovie.php" value="Back to Movie Menu">
</form>
   <?php


}

else{
   ?>
   <h1> No theatre halls in database! </h1>

   <input type="submit" formaction="adminmovie.php" value="Back to Movie Menu"> <br> <br>
   <input type="submit" formaction="../adminindex.php" value="Back to Admin Menu">
</form>

<?php
}


mysqli_close($con);
}
else{
  ?>
   <h1> Start date must be before end date! </h1>

   <input type = "hidden" name="movie_name" value = '<?php echo $movie_name?>'>
   <input type="submit" formaction="addshowtimes.php" value="Back to Add Show Time Menu"> <br> <br>
   <input type="submit" formaction="adminmovie.php" value="Back to Movie Menu"> <br> <br>
   <input type="submit" formaction="../adminindex.php" value="Back to Admin Menu">
</form>
<?php 

}
  ?>

</body>
</html>