<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
</head>
<body>
<form action="admindb_login.php" method="post">

    <form>
        <h1>Welcome Admin!</h1>
        <?php if(isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <label>Email</label>
        <input type="text" name="adminUser" placeholder="Email"><br>

        <label>Password</label>
        <input type="password" name="adminPass" placeholder="Password"><br>
        
        <button type="Login">Login</button>

    </form>

</body>
</html>