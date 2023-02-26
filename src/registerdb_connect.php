<?php
//this website was used entirely for writing this code:
//https://codewithawa.com/posts/complete-user-registration-system-using-php-and-mysql-database
//apa citation: Complete user registration system using PHP and MySQL Database. CodeWithAwa. (n.d.). Retrieved November 28, 2022, from https://codewithawa.com/posts/complete-user-registration-system-using-php-and-mysql-database 
session_start();

$email = "";
$pass = "";
$errors = array();

// Create connection
include "logindb_connect.php";

if(isset($_POST['submit']))
{
    $email = mysqli_real_escape_string($con, $_POST['user_name']);
    $pass = mysqli_real_escape_string($con, $_POST['password']);
    $fname = mysqli_real_escape_string($con, $_POST['cust_fname']);
    $lname = mysqli_real_escape_string($con, $_POST['cust_lname']);

    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($pass)) { array_push($errors, "Password is required"); }
    if (empty($fname)) { array_push($errors, "First name is required"); }
    if (empty($lname)) { array_push($errors, "Last name is required"); }

    //checking if database already has account or not
    $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($con, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    //if email exists:
    if($user)
    {
        if ($user['email'] === $email) 
        {
            echo "email already exists ";
            header("Location: login.php");
            array_push($errors, "email already exists");
        }
    }

    //if everything is good
    if (count($errors) == 0) {
        
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
        
        //sql injection prevention
        $que1 = $con->prepare("INSERT INTO users (email, password) VALUES (?,?)");
        $que1->bind_param("ss", $email, $hashed_password);
        $exec = $que1->execute();
        if (!$exec)
        {
            die('Error2: ' . mysqli_error($con));
        }
        
        $que2 = $con->prepare("INSERT INTO customer (customer_email, password, fname, lname) VALUES (?,?,?,?)");
        $que2->bind_param("ssss", $email, $hashed_password, $fname, $lname);
        $exec2 = $que2->execute();
        if (!$exec2)
        {
            die('Error2: ' . mysqli_error($con));
        }

        $_SESSION['user_name'] = $email;
        header('Location: cu_dashboard.php');
    }
}

mysqli_close($con);

?>