<?php
    session_start();
    require 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title> Login Page</title>
<link rel="stylesheet" href="style.css">
</head>

<body style="background-color:#95a5a6">
    <div id="main-wrapper" align="center">
        <p>Welcome to Login Form</p>
        <!-- Form of input data-->
        <form action="index.php"  method="post">
            <label>Username:</label>
            <input type="text" class="inputvalues" id="user" name="user" placeholder="Type your username" size="30" required><br><br>
            <label> Password:</label>
            <input type="password" class="inputvalues" id="pass" name="pass" placeholder="Type your password" size="30" required><br><br>
            <input type="submit" id="logButton" name="login" value="Login"/>
			<!-- <input type="submit" id="regButton" name="register" value="Register"/> -->
            <a href="register.php"><input type="button" id="regButton" name="register" value="Register"/></a> 
        </form>
        
    </div>
    <div id="resultDiv" align="center"></div>
    
<?php
	if (isset($_POST['login'])){
		$username = $_POST['user'];  
		$password = $_POST['pass'];  
      
        //to prevent from mysql injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  

        $sql = "select *from users where username = '$username' and password = '$password'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
         
        if($count > 0){  
            echo "<h1><left> Login successful </center></h1>";
            $_SESSION['username']= $username;
            header('location:welcome.php');
            require 'welcome.php';  
        }  
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";
            die;
        }
	}
	elseif (isset($_POST['register'])){
		/* require 'register.php'; */
        echo "<h1> Login failed. Invalid username or password.</h1>";
        die;
	}
//}
?>	
	

</body>
</html>
