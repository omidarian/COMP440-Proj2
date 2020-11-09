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
            <input name="user" type="text" class="inputvalues" placeholder="Type your username" size="30" required> <br><br>
            <label> Password:</label>
            <input name="pass" type="password" class="inputvalues" placeholder="Type your password" size="30" required><br><br>
            <label> Confirm Password:</label>
            <input name="conPass" type="password" class="inputvalues" placeholder="Confirm password"size="22" required><br><br>
            <input name="subButton" type="submit" id="signUpButton" value="Sign Up"/>
            <a href="index.php"><input type="button" id="backButton" value="Back to Login"/></a>
        </form>
        
    </div>
    <div id="resultDiv" align="center"></div>

    <?php
        if(isset($_POST['subButton']))
        {
        //echo '<script type="text/javascript"> alert("Sign Up button clicked") </script>';
		$username = $_POST['user'];  
        $password = $_POST['pass'];  
        $conPassword = $_POST['conPass']; 
      
        //to prevent from mysqli injection  
        /* $username = stripcslashes($username);   */
        /* $password = stripcslashes($password);   */
        /* $username = $mysqli->escape_string($username);   */
		/* $password = mysqli_escape_string($password); */
        /* $password = mysqli_escape_string(password_hash($password, PASSWORD_BCRYPT));  */
		/* $hash = mysqli_escape_string(md5( rand(0,1000))); */
      
        
        if($password == $conPassword){
            $result = "select *from users where username = '$username'";  
            $count = mysqli_num_rows(mysqli_query($con, $result));
            
            if ( $count > 0){
                //this username already exist.
                $SESSION['message'] = 'Username already exists!';
                echo '<center>Username already exists! Try another username</center>';
                die;
            }
            {
                $sql = "INSERT INTO users "." VALUES ('$username', '$password')";
                if (mysqli_query($con, $sql)) {
                      echo "<center> New record created successfully </center>";
                      echo "<center>Go back to login page</center>";
                } else {
                      echo "Error: " . $sql . "<br>" . mysqli_error($con);
                }
            }
        
        }
        else{
            echo '<center>Password and confirm password does not match!</center>';
			die;
        }
        
        
		
		//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows(mysqli_query($con, $result));
		
        if($count == 1){  
            echo "<h1><center> Registration successful </center></h1>";  
        }  
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";  
			echo $count;
        }
        }   
    ?>

</body>
</html>