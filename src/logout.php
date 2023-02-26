<?php
//https://www.studentstutorial.com/php/login-logout-with-session
//apa ciation: PHP login logout example with session. (n.d.). Retrieved December 1, 2022, from https://www.studentstutorial.com/php/login-logout-with-session 
session_start();
unset($_SESSION["id"]);
unset($_SESSION["name"]);
header("Location:login.php");
?>