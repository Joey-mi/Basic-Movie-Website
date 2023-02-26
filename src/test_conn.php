<?php
    
    // Create connection
    include "logindb_connect.php";
    
    // Check connection
    if (!$conn)
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {
        echo "Connected successfully";
    }
?>