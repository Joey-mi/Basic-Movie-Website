<?php
//https://www.youtube.com/watch?v=JDn6OAMnJwQ
//https://www.simplilearn.com/tutorials/php-tutorial/php-login-form#step_1_create_a_html_php_login_form
//apa citation:S, R. A. (2022, October 28). Login form in php: How to create login form using php?: Simplilearn. Simplilearn.com. Retrieved November 28, 2022, from https://www.simplilearn.com/tutorials/php-tutorial/php-login-form#step_1_create_a_html_php_login_form 


session_start();

if(isset($_SESSION["user_name"]))
{
    header("Location: cu_dashboard.php");
}
    
   
//checking for validation of the users
include "logindb_connect.php";
include "login.php";

if(isset($_POST["user_name"]) && isset($_POST["password"]))
{
    function validation($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $user_name = validation($_POST["user_name"]);
    $password = validation($_POST["password"]);
    // $adminUser = "admin@email.com";
    // $adminPass = "test";

    if(empty($user_name))
    {
        header("Location: login.php?error=email is required");
        exit();
    }
    else if(empty($password))
    {
        header("Location: login.php?error=password is required");
        exit();
    }
    else
    {
        $statement = $con->prepare("SELECT * FROM users WHERE email = ?");
        $statement->bind_param("s", $user_name);
        $exec = $statement->execute();
        $result = $statement->get_result();
    
        if (!$exec)
        {
            die('Error: ' . mysqli_error($con));
        }
        
        //to ensure valid user and pass
        if(mysqli_num_rows($result) === 1)
        {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['password'];

            if(password_verify($password, $stored_password))
            {
                
                $_SESSION["user_name"] = $row['email'];
                header("Location: cu_dashboard.php");
                
            }
            else{
                header("Location: login.php?error=Incorrect email or password");
                exit();
            }
        }
        else
        {
            header("Location: login.php?error=Incorrect email or password");
            exit();
        }
    }
}
else{
    header("Location: login.php");
    exit();
}

?>