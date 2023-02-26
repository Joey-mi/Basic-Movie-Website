<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="./styles/viewticketscss.css">
</head>
<body>
<form action="cu_dashboard.php" method="post">
<?php

// Get variables from previous page form
$cus_email = $_POST["cus_email"];

// Create connection
include "logindb_connect.php";

  // Prepare SQL Injection protected statement to select booking references for customer, and check if it executed correctly
  $statement = $con->prepare(
   "SELECT * FROM booking_reference WHERE cus_email = ?");
   $statement->bind_param("s", $cus_email);
   $exec = $statement->execute();
   $result = $statement->get_result();
   
 if (!$exec)
  {
  die('Error: ' . mysqli_error());
  }
  // Confirm that the customer has bought tickets
  $count = 0;
  while($row = mysqli_fetch_array($result))
  {
  $count = 1;
  }

  // If none bought, let user know
  if ($count == 0){
   
   ?>
   <h1> No tickets have been purchased!</h1>
      <input type="submit" value="Back to Dashboard"> <br> <br>
   </form>

<?php
  }
  // If tickets have been purchased, build the table
  else{
   ?>
   <h1> Tickets purchased </h1>   
   <table>
  <tr>
    <th>Ticket Number</th>
    <th>Movie Name</th>
    <th>Theatre</th>
    <th>Seat Number</th>
    <th>Price</th>
    <th>Show Date</th>
    <th>Show Time</th>
    <th>Barcode</th>
    <th>Booking Ref</th>
  </tr>
  <?php 
  // Prepare SQL Injection protected statement to select booking references for customer, and check if it executed correctly
   $statement = $con->prepare(
    "SELECT * FROM booking_reference WHERE cus_email = ?");
    $statement->bind_param("s", $cus_email);
    $exec = $statement->execute();
    $result = $statement->get_result();
    
  if (!$exec)
   {
   die('Error: ' . mysqli_error());
   }
   $count = 0;
   while($row = mysqli_fetch_array($result))
   {
   $count = 1;
   // Prepare SQL Injection protected statement to get ticket information for each ticket, and check if it executed correctly
   $statement2 = $con->prepare(
     "SELECT * FROM ticket WHERE bookid = ?");
     $statement2->bind_param("s", $row[0]);
     $exec2 = $statement2->execute();
     $result2 = $statement2->get_result();
     if (!$exec2)
     {
     die('Error: ' . mysqli_error());
     }
     while($row2 = mysqli_fetch_array($result2))
     {
       $ticket_no = $row2[0];
       $book_id = $row2[1];
       $s_date = $row2[2];
       $price = $row2[3];
       $s_time = $row2[4];
       $barcode = $row2[5];
       $movie_name = $row2[7];
       $seat_no = $row2[8];
       $theatre_no = $row2[9];
       ?>
  <tr>
    <td><?php echo $ticket_no?></td>
    <td><?php echo $movie_name?></td>
    <td><?php echo $theatre_no?></td>
    <td><?php echo $seat_no?></td>
    <td><?php echo $price?></td>
    <td><?php echo $s_date?></td>
    <td><?php echo $s_time?></td>
    <td><?php echo $barcode?></td>
    <td><?php echo $book_id?></td>
  
  </tr>
  <?php
  
     }
   }
   ?>
   </table> <br>

<input type="submit" value="Back to Dashboard"> <br> <br>
   </form>
  <?php
  }
   
mysqli_close($con);

?>

</body>
</html>
