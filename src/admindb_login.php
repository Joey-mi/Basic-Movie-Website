<?php
//https://www.youtube.com/watch?v=JDn6OAMnJwQ
//https://www.simplilearn.com/tutorials/php-tutorial/php-login-form#step_1_create_a_html_php_login_form
//apa citation:S, R. A. (2022, October 28). Login form in php: How to create login form using php?: Simplilearn. Simplilearn.com. Retrieved November 28, 2022, from https://www.simplilearn.com/tutorials/php-tutorial/php-login-form#step_1_create_a_html_php_login_form 

include "admin_login.php";
include "logindb_connect.php";
////admin@email.com', 'test', 'Jane', 'Doe'
if(isset($_POST["adminUser"]) && isset($_POST["adminPass"]))
{
    function validation($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $adUser = validation($_POST["adminUser"]);
    $adPass = validation($_POST["adminPass"]);
    $fname = "Jane";
    $lname = "Doe";

    if(empty($adUser))
    {
        header("Location: admin_login.php?error=email is required");
        exit();
    }
    else if(empty($adPass))
    {
        header("Location: admin_login.php?error=password is required");
        exit();
    }
    else
    {

        //sql injections prevention
        $statement = $con->prepare(
            "SELECT * FROM admin WHERE admin_email = ?");
            $statement->bind_param("s", $adUser);
            $exec = $statement->execute();
            $result = $statement->get_result();
        
        if (!$exec)
        {
            die('Error: ' . mysqli_error($con));
        }

        //to ensure valid user and pass
        if(mysqli_num_rows($result) === 1)
        {
            //$row['admin_email'] === $adUser && $row['password'] === $adPass &&
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['password'];

            if(password_verify($adPass, $stored_password))
            {
                //sql injections prevention
            $statement2 = $con->prepare(
                "INSERT INTO users (email, password) SELECT ?, ?
                WHERE NOT EXISTS(
                    SELECT * FROM users WHERE email = ? AND password = ?)");
            $statement2->bind_param("ssss", $adUser, $stored_password, $adUser, $stored_password);
            $exec2 = $statement2->execute();
                echo "added!";
                header('Location: adminindex.php');                
            }
            else
            {
                header('Location: admin_login.php?error=Incorrect email or password');
                exit();
            }
        }
        else
        {
            header('Location: admin_login.php?error=Incorrect email or password');
            exit();
        }
    }
}
else
{
    header('Location: admin_login.php');
    exit();
}

?>