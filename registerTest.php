<?php
    require 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title> Registration Page</title>
<link rel="stylesheet" href="style.css">
</head>
<body style="background-color:#95a5a6">
    <div id="main-wrapper" align="center">
        <p>Welcome to Registration Form</p>
        <!-- Form of input data-->
        <form action="register.php" method="post">
            <label>Username:</label>
            <input name="username" type="text" class="inputvalues" placeholder="Type your username" size="30" required> <br><br>
            <label> Password:</label>
            <input name="password" type="password" class="inputvalues" placeholder="Type your password" size="30" required><br><br>
            <label> Confirm Password:</label>
            <input name="conPassword" type="password" class="inputvalues" placeholder="Confirm password"size="22" required><br><br>
            <input name="subButton" type="submit" id="signUpButton" value="Sign Up"/>
            <input type="button" id="backButton" value="Back to Login"/>
        </form>
        
    </div>
    <div id="resultDiv" align="center"></div>

    <?php
        if(isset($_POST['subButton']))
        {
            //echo '<script type="text/javascript"> alert("Sign Up button clicked") </script>';
            $username = $_POST['username'];
            $password = $_POST['password'];
            $conPassword = $_POST['conPassword'];

            if($password==$conPassword)
            {
                $query= "select * from user WHERE username='$username'";
                $query_run= mysqli_query($con,$query);

                if(mysqli_num_rows($query_run)>0)
                {
                    //This user is already exist.
                    echo '<script type="text/javascript"> alert("This User already exist... please try another useername") </script>';
                }
                {
                    $query = "insert into user values('$username','$password')";
                    $query_run = mysqli_query($con,$query);

                    if($query_run)
                    {
                        echo '<script type="text/javascript"> alert("User registered successfuly... You can go back to login page to login") </script>';
                    }
                    else
                    {
                        echo '<script type="text/javascript"> alert("Error!") </script>';
                    }
                }
            }
        }
    ?>

</body>
</html>