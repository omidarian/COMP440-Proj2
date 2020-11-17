<?php
    session_start();
    require 'config.php';
    if(!$_SESSION["username"]){
        header('location:index.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title> Welcome Page</title>
<link rel="stylesheet" href="style.css">
</head>
<body style="background-color:#95a5a6">
    <div id="main-wrapper" align="center">
        <p>Login successful</p>
        <p>Welcome Page</p>
        <h3>Welcome: 
            <?php echo $_SESSION['username']?>
        </h3>
        <!-- Form of Hobbies page-->
        <form action="hobbies.php" method="post">
            <input type="submit" name="hobbiesButton" id="hobbyButton" value="Hobbies"/></br></br>
            
        </form>
        <!-- Form of New Blog page-->
        <form action="Blog.php" method="post">
            <input type="submit" name="blogButton" id="blgButton" value="Blog"/></br></br>
            
        </form>
        <!-- Form of Initialize Database-->
        <form action="welcome.php" method="post">
            <input type="submit" name="iniButton" id="iniDataButton" value="Initialize Database"/></br></br>
            
        </form>
        <!-- Form of input data-->
        <form action="welcome.php" method="post">
            <input type="submit" name="logOutButton" id="logOutButton" value="Log Out"/>
        </form>
        
    </div>
    <div id="resultDiv" align="center"></div>

    <?php
        if(isset($_POST['iniButton']))
        {
            $query = '';
            $sqlScript = file('create.sql');
            foreach ($sqlScript as $line)	{
                
                $startWith = substr(trim($line), 0 ,2);
                $endWith = substr(trim($line), -1 ,1);
                
                if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                    continue;
                }
                    
                $query = $query . $line;
                if ($endWith == ';') {
                    mysqli_query($con,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
                    $query= '';		
                }
            }
            echo '<center>Initialize Database Successfull!</center>';
        }

        if(isset($_POST['logOutButton'])){
            unset($_SESSION['username']);
            header('location:index.php');
        }

    ?>

</body>
</html>
