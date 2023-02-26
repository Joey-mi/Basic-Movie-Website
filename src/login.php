<!--https://www.simplilearn.com/tutorials/php-tutorial/php-login-form -->
<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking System</title>
    <link rel="stylesheet" type="text/css" href="./styles/logincss.css">
</head>
<body>
<form action="logging_in.php" method="post">

    <form>
        <h1>Welcome to Movie Booking System!</h1>
        <h2>LOGIN</h2>
        <?php if(isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label>Email</label>
        <input type="text" name="user_name" placeholder="Email"><br>

        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br> 

        <button type="Login">Login</button>

        <p>
            Want to sign up? <a href="register.php"> Click here</a>
        </p>
        
        <p>
           Are you an Admin? <a href="admin_login.php"> Click here</a>
        </p>

    </form>
    
</body>
</html>