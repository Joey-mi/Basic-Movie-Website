<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System - Admin</title>
    <link rel="stylesheet" type="text/css" href="../styles/customerhelpcss.css">
</head>
<body>

<?php

// Get variables from previous page form
$cus_email = $_POST["cus_email"];

?>

   
   <form action="newrequestdb.php" method="post">
      <h1> Please describe your request below: </h1>
   <textarea name="details"
      rows="10" cols="51" placeholder="Enter request details.."></textarea><br>

   <input type = "hidden" name="cus_email" value = '<?php echo $cus_email?>'>
      <input type="submit" value="Submit"> <br> <br>
      <input type="submit" formaction="customerhelp.php" value="Back to Help Menu">
   </form>
   
   </body>
   </html>


