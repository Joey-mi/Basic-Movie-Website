<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/adminmoviecss.css">
</head>
<body>

<form action="adminmovie.php" method="post">
  <h1> Ticket generation status <br> </h1>

<?php
// Get variables from previous page form
$movie_name = $_POST["movie_name"];
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];

// Create connection
include "../logindb_connect.php";

  // Check that boxes were checked
if(isset($_POST['submit'])){
  if(!empty($_POST['shown_in'])){
    $shown_in = $_POST['shown_in'];

    // Loop through each checked box
    foreach($shown_in as $checked){

      // Prepare SQL Injection protected statement to see if shown in already exists for this movie and theatre, and check if it executed correctly
      $statement = $con->prepare(
        "SELECT * FROM shown_in WHERE m_name = ? AND theatre_num = ?");
        $exec = $statement->bind_param("ss", $movie_name, $checked);
        $exec = $statement->execute();
        $result = $statement->get_result();

      if (!$exec)
        {
        die('Error: ' . mysqli_error($con));
        }

      $check = mysqli_fetch_array($result);
      // If so, go to next value in array
      if ($check >0){
        continue;
        }
        // Otherwise, insert a new entry
      else{
        // Prepare SQL Injection protected statement to insert into shown_in table, and check if it executed correctly
        $statement2 = $con->prepare(
          "INSERT INTO shown_in (m_name, theatre_num) VALUES 
        (?, ?)");
          $statement2->bind_param("ss", $movie_name, $checked);
          $exec = $statement2->execute();

        if (!$exec)
          {
          die('Error: ' . mysqli_error());
          }
      }
    }
  }

// Get variables from previous page form
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];
$times_array = $_POST['times'];
$shown_in = $_POST['shown_in'];

// Create a period of every day in the range to loop through
$start = new DateTime($start_date);
$end = new DateTime($end_date);
$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($start, $interval, $end);

// Create counter to see if tickets were able to be generated, or if the theatres are already full on the selected dates
$count = 0;

// Loop through each date and each theatre hall to see if occupied
foreach($period as $date){
  $d = $date->format('Y-m-d');
  foreach($shown_in as $hall){

    // Prepare SQL Injection protected statement to check if theatre hall occupied on date, and check if it executed correctly
    $statement3 = $con->prepare(
      "SELECT * FROM ticket WHERE theatre_no = ? AND sdate = ?");
      $exec = $statement3->bind_param("ss", $hall, $d);
      $exec = $statement3->execute();
      $result = $statement3->get_result();

      if (!$exec)
        {
        die('Error: ' . mysqli_error($con));
        }

      $check = mysqli_fetch_array($result);
      // If occupied, alert user of date that is occupied
      if ($check >0){
        ?> <h3> Theatre number <?php echo $hall ?> is already occupied on <?php echo $d?><br> </h3> <?php
        continue;
        }
        // Otherwise, create tickets
      else{
        $count += 1;
        // Loop through each showtime on the date, and each seat in the hall
        // There are 10 seats in each hall, with the first 5 being premium seats for $15
        // and the last 5 being normal seats for $10
        foreach($times_array as $t){
          for($i = 1; $i <= 10; $i++){
            // Generate a unique bar code based on date, time, theatre number, and seat number
            $barcode = $d[2].$d[3].$d[5].$d[6].$d[8].$d[9].$t[0].$t[1].$t[3].$hall.$i;
            // Seats 1-5 are premium
            if ($i < 6){
              // Prepare SQL Injection protected statement to insert each ticket, and check if it executed correctly
              $statement4 = $con->prepare(
                "INSERT INTO `ticket` 
              (`ticket_no`, `bookid`, `sdate`, `price`, `stime`, `barcode`, 
              `sold_flag`, `movie_name`, `seat_no`, `theatre_no`) VALUES 
              (NULL,NULL, ?, '15', ?, ?, 'N', ?, ?, ?)");
                $statement4->bind_param("ssssss", $d, $t, $barcode, $movie_name, $i, $hall);
                
            }
            // Seats 6-10 are normal
            else{
              // Prepare SQL Injection protected statement to insert each ticket, and check if it executed correctly
              $statement4 = $con->prepare(
                "INSERT INTO `ticket` 
              (`ticket_no`, `bookid`, `sdate`, `price`, `stime`, `barcode`, 
              `sold_flag`, `movie_name`, `seat_no`, `theatre_no`) VALUES 
              (NULL,NULL, ?, '10', ?, ?, 'N', ?, ?, ?)");
                $statement4->bind_param("ssssss", $d, $t, $barcode, $movie_name, $i, $hall);
            }
            $exec = $statement4->execute();

            if (!$exec)
              {
              die('Error: ' . mysqli_error($con));
              }
          }
        }
    }
  }
}

mysqli_close($con);
// Print message based on success of adding tickets
if ($count > 0){

  ?> <h3> Movie assigned to available theatre halls and tickets generated! <br> </h3> <?php
}else{
  ?> <h3> Theatres are full for all selected dates! <br> </h3> <?php
}
?>

 <input type="submit" value="Back to Movie Menu"> <br> <br>
 <input type="submit" formaction="../adminindex.php" value="Back to Admin Menu">
</form>

<?php
}
else{
  ?>
  <h3> No theatre halls selected! </h3>

   <input type="submit" value="Back to Movie Menu"> <br> <br>
   <input type="submit" formaction="../adminindex.php" value="Back to Admin Menu">
</form>

<?php
}

?>
</body>
</html>

