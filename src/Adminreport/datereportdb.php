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

// Check that boxes were checked
if(isset($_POST['submit'])){
  if(!empty($_POST['show_date'])){
    $show_date = $_POST['show_date'];

  include "../logindb_connect.php";
  // Extract the date and theatre from the string passed in
      $d = substr($show_date,0,10);
      $theatre = substr($show_date,10,1);

      // Prepare SQL Injection protected statement to select tickets for the selected movie by theatre on the selected date, and check if it executed correctly
      $statement = $con->prepare(
        "SELECT ticket_no FROM ticket WHERE movie_name = ? AND 
      sdate = ? AND theatre_no = ?");
        $statement->bind_param("sss", $movie_name, $d, $theatre);
        $exec = $statement->execute();
        $result = $statement->get_result();

 if (!$exec)
  {
  die('Error: ' . mysqli_error());
  }
  // Check if there are any such tickets in database, and add them to report if so
  $count = 0;
  while($row = mysqli_fetch_array($result))
  {
  $count = 1;
  }

  // If none, let user know that there are no tickets
  if ($count == 0){
   
   ?>

   <form action="adminreport.php" method="post">
   <h1> <?php echo "No tickets exist on ".$d." for ".$movie_name."<br>" ?> </h1>
      <input type="submit" value="Back to Report Menu">
   </form>

   <form action="../adminindex.php" method="post">
      <input type="submit" value="Back to Admin Menu">
   </form>

<?php
  }
  // If any tickets found, begin steps to generate report and update database
  else{
    // Update the default time zone to MST, to ensure run date is reflective of today's date
    date_default_timezone_set('America/Edmonton');
    $run_date = date('Y-m-d');

    // Prepare SQL Injection protected statement to create movie report with initial sales value of 0, and check if it executed correctly
    $statement2 = $con->prepare(
      "INSERT INTO movie_report (report_no, sales_date, sales_time, theatre_no, 
    sales_value, movie_name, admin_email, run_date) VALUES
    (NULL, ?, NULL, ?, 0, ?, 'admin@email.com', ?)");
      $statement2->bind_param("ssss", $d, $theatre, $movie_name, $run_date);
      $exec2 = $statement2->execute();
     
    if (!$exec2)
    {
    die('Error: ' . mysqli_error());
    }

    // Prepare SQL Injection protected statement to get the report number, and check if it executed correctly
    $statement3 = $con->prepare(
      "SELECT count(report_no) FROM movie_report");
      $exec3 = $statement3->execute();
      $result3 = $statement3->get_result();

    if (!$exec3)
    {
    die('Error: ' . mysqli_error());
    }
    $report_no = mysqli_fetch_array($result3)[0];


    // Execute previous SQL injection prevention statement again to select tickets for the selected movie by theatre on the selected date, and check if it executed correctly
    $exec = $statement->execute();
    $result = $statement->get_result();

if (!$exec)
{
die('Error: ' . mysqli_error());
}
// Loop through each ticket
while($row = mysqli_fetch_array($result))
{
  $ticket_no = $row[0];

  // Prepare SQL Injection protected statement to insert the ticket and report number into contains report ticket table, and check if it executed correctly
  $statement4 = $con->prepare(
    "INSERT INTO contains_report_ticket (report_no, ticket_no)
  VALUES (?, ?)");
    $statement4->bind_param("ss", $report_no, $ticket_no);
    $exec4 = $statement4->execute();

if (!$exec4)
{
die('Error: ' . mysqli_error());
}
}

// Prepare SQL Injection protected statement to calculate total ticket sales for the reported tickets, and check if it executed correctly
$statement5 = $con->prepare(
  "SELECT sum(price) FROM ticket INNER JOIN 
contains_report_ticket ON ticket.ticket_no = contains_report_ticket.ticket_no WHERE 
contains_report_ticket.report_no = ? AND ticket.sold_flag = 'Y'");
  $statement5->bind_param("s", $report_no);
  $exec5 = $statement5->execute();
  $result5 = $statement5->get_result();

if (!$exec5)
{
die('Error: ' . mysqli_error());
}

// Retrieve the sales value
$sales_value = mysqli_fetch_array($result5)[0];

// Check if null, and if so, set to zero.
if (empty($sales_value)){
  $sales_value = 0;
}

// Prepare SQL Injection protected statement to update the movie report that was created for the sales value calculated, and check if it executed correctly
$statement6 = $con->prepare(
  "UPDATE movie_report SET
sales_value = ? WHERE
report_no = ?");
  $statement6->bind_param("ss", $sales_value, $report_no);
  $exec6 = $statement6->execute();

if (!$exec6)
{
die('Error: ' . mysqli_error());
}


    }
    mysqli_close($con);
  

  ?>

<form action="adminreport.php" method="post">
<h1> <?php echo "Report successfully generated! <br><br>There were $".$sales_value." in sales for <br>".$movie_name."
 on <br>".$d." for all showtimes <br>in Theatre ".$theatre."!<br>" ?> </h1>
 <input type="submit" value="Back to Report Menu"> <br> <br>
 <input type="submit" formaction="../adminindex.php" value="Back to Admin Menu">
</form>
 
<?php
  }
  // If no dates selected, let user know
else{
  ?>
  <form action="adminreport.php" method="post">
  <h1> No show times for selected movie! <br> </h1>
   <input type="submit" value="Back to Report Menu"> <br> <br>
   <input type="submit" formaction="../adminindex.php" value="Back to Admin Menu">
</form>

<?php
}
}
// Let user know if no option was selected
else {
  ?>
  <form action="adminreport.php" method="post">
  <h1> No option selected! <br> </h1>
   <input type="submit" value="Back to Report Menu"> <br> <br>
   <input type="submit" formaction="../adminindex.php" value="Back to Admin Menu">
</form>
<?php

}

?>

</body>
</html>

