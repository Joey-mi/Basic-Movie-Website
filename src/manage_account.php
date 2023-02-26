<?php
//this code was written by looking following:
//https://www.youtube.com/watch?v=GVwRDehnXjA

session_start();
if(!isset($_SESSION["user_name"]))
{
    header("Location: login.php");
}

include "logindb_connect.php";              
$cus_email = $_SESSION["user_name"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Account</title>
</head>
<body>
<form action="manage_accountdb.php" method="post">
        <h1>Manage your Account</h1>
            
                <?php
                    $sql = "SELECT * FROM customer WHERE customer_email='{$_SESSION["user_name"]}'";
                    $result = mysqli_query($con, $sql);
                    if(mysqli_num_rows($result))
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                ?>
                         
                            <label for="customer_email"> Email</label>
                            <input type = "text" name= "customer_email" value="<?php echo $row['customer_email'];?>" disabled required> <br> <br>


                            <label for="fname"> First Name</label>
                            <input type = "text" name= "fname" value="<?php echo $row['fname'];?>" > <br> <br>


                            <label for="lname"> Last Name</label>
                            <input type = "text" name= "lname" value="<?php echo $row['lname'];?>" > <br> <br>
                            
                <?php
                        }
                    }

                ?>
    
                    <input type="submit" name="submit" value="Update Profile"> <br> <br>
                    <input type = "hidden" name="cus_email" value = '<?php echo $cus_email?>'>
                    <input type="submit" formaction="viewtickets.php" value="View purchased tickets">
                    <br>
                    <input type="submit" formaction="cu_dashboard.php" value="Back to Customer Homepage">
       
    </form> 
    
</body>
</html>



