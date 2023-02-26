
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
</head>
<body>
<form action="registerdb_connect.php" method="post">

    <form>
        <h1>Welcome to our Registration Site!</h1>
        <h2>Registration</h2>
        <?php if(isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        
        <p>  
            Please enter your first name:
            <label>First Name: </label>
            <input type="text" name="cust_fname" placeholder="First name"><br>

        <p>  

        <p>  
            Please enter your last name:    
            <label>Last Name</label>
            <input type="text" name="cust_lname" placeholder="Last name"><br>

        <p>  


        <p>  
            Please enter an email:
            <label>Email</label>
            <input type="text" name="user_name" placeholder="Email"><br>

        <p>  

        <p>  
            Please enter a password:    
            <label>Password</label>
            <input type="text" name="password" placeholder="Password"><br>

        <p>  

        <button type="submit" name="submit" value="add">Sign up</button>

       
    </form>
    
</body>
</html>


