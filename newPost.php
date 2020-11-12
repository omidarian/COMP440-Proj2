<?php
    session_start();
    require 'config.php';
    if(!$_SESSION["username"]){
        header('location:index.php');
    }
?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title> Blog Page</title>
<link rel="stylesheet" href="style.css">
</head>
<body style="background-color:#95a5a6">
    <div id="blog-wrapper" align="center">
        
  
        <h3>User: 
            <?php echo $_SESSION['username']?>
        </h3>

        <?php
            // check for limit 2 blogs a day
            $currentDate = date("Y-m-d");
            $postuser =  $_SESSION['username'];
            $sql = "select count(*) as total from blogs where postuser = '$postuser' and pdate='$currentDate'"; 
            $result = mysqli_query($con, $sql);
            $count = mysqli_fetch_assoc($result);
        if ($count['total'] > 1){
            echo "<h3>Sorry! User can only insert 2 blogs a day.</h3>";
            ?>
                <form method='post' class="form-horizontal">
                    <input class="btn" type="submit" name="cancel" value="Cancel"/>
                </form>
            <?php
        }else{        
        ?>
        <!-- if user allow to add new post--> 
        <!-- Form of input data-->
        <form method='post' class="form-horizontal">
            <label>Subject(max 150):</label><br>
            <input type="text" class="inputvalues" id="subject" name="subject" placeholder="Type your subject" size="50" maxlength = "150"><br><br>
            <label> Description(max 250):</label><br>
            <textarea class="inputvalues" id="description" name="description" placeholder="Type your description" rows="4" cols="50" maxlength = "250"></textarea><br><br>            
            <label> Tags(max 50):</label><br>
            <input type="text" class="inputvalues" name="tags" placeholder="Type your tags" size="50" maxlength = "50"><br>
            <div class="col-sm-20" >
                <input class="btn" type="submit"  name="save" value="Save"/>
                <input class="btn" type="submit" name="cancel" value="Cancel"/>
            </div>
        </form>
        <!--  ----------------------      -->
        <?php 
        }
        ?>

        
    </div>
    <div id="resultDiv" align="center"></div>

    <?php
        if(isset($_POST['save']))
        {
            $subject = $_POST['subject'];  
            $description = $_POST['description'];
            $tags = $_POST['tags'];
          
            //to prevent from mysqli injection  
            $subject = stripcslashes($subject);
            $description = stripcslashes($description);  
            $tags = stripcslashes($tags);

            $subject = mysqli_real_escape_string($con, $subject);  
            $description = mysqli_real_escape_string($con, $description);
            $tags = mysqli_real_escape_string($con, $tags);
            
            $date = date("Y-m-d");
            $postuser = $_SESSION['username'];

            $sql = "insert into blogs (subject, description, postuser, pdate) values('$subject', '$description','$postuser', '$date')";
           
            if (mysqli_query($con, $sql)) {
                $lastId = mysqli_insert_id($con);
                $tagSplit = explode(",", $tags);
                foreach($tagSplit as &$item){
                    $sqlTag = "insert into blogstags VALUES( '$lastId' ,'$item')";
                    mysqli_query($con,$sqlTag);
                }
                
          } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
          }
          header('location:blog.php');
        }

        if(isset($_POST['cancel'])){
            header('location:blog.php');
        }

    ?>

</body>
</html>