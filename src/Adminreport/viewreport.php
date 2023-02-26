<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/adminreportcss.css">
</head>
<body>
<form action="adminreport.php" method="post">
<?php

// Get variables from previous page form
$movie_name = $_POST["movie_name"];

// Create connection
include "../logindb_connect.php";

  // Prepare SQL Injection protected statement to select movie reports for selected movie, and check if it executed correctly
  $statement = $con->prepare(
   "SELECT * FROM movie_report WHERE movie_name = ?");
   $statement->bind_param("s", $movie_name);
   $exec = $statement->execute();
   $result = $statement->get_result();
   
 if (!$exec)
  {
  die('Error: ' . mysqli_error());
  }
  // Confirm that reports to be viewed is in database, and if so populate the table with all such reports
  $count = 0;
  while($row = mysqli_fetch_array($result))
  {
  $count = 1;
  $report_no = $row[0];
  $sales_date = $row[1];
  $admin_email = $row[3];
  $run_date = $row[4];
  }

  // If not, let user know there are no movie reports for the selected movie
  if ($count == 0){
   
   ?>
   <h1> No movie reports have been generated for <?php echo $movie_name ?> </h1>
      <input type="submit" value="Back to Report Menu"> <br> <br>
      <input type="submit" formaction="../adminindex.php" value="Back to Admin Menu">
   </form>

<?php
  }
  // If reports exist, build the table
  else{
   ?>
   <h1> Reports for <?php echo $movie_name ?> </h1>
   <table>
  <tr>
    <th>Report Number</th>
    <th>Sales Date</th>
    <th>Sales Time</th>
    <th>Theatre</th>
    <th>Sales Value ($)</th>
    <th>Report Creator</th>
    <th>Report Run Date</th>
  </tr>
  <?php 
$exec = $statement->execute();
$result = $statement->get_result();

if (!$exec)
  {
  die('Error: ' . mysqli_error());
  }
  while($row = mysqli_fetch_array($result))
  {
  $report_no = $row[0];
  $sales_date = $row[1];
  $sales_time = $row[2];
  $theatre = $row[3];
  $sales_value = $row[4];
  $admin_email = $row[6];
  $run_date = $row[7];
  ?>
  <tr>
    <td><?php echo $report_no?></td>
    <td><?php echo $sales_date?></td>
    <td><?php echo $sales_time?></td>
    <td><?php echo $theatre?></td>
    <td><?php echo $sales_value?></td>
    <td><?php echo $admin_email?></td>
    <td><?php echo $run_date?></td>
  </tr>
  <?php
  }
  ?>
</table> <br>

<input type="submit" value="Back to Report Menu"> <br> <br>
      <input type="submit" formaction="../adminindex.php" value="Back to Admin Menu">
   </form>

<?php
  
}
   
mysqli_close($con);

?>

</body>
</html>
