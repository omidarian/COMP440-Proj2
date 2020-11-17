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
            <?php echo $_GET['blogid']?>
        </h3>

        <?php
            $bId = $_GET['blogid'];
            $sql = "select * from blogs where blogid = $bId";
            $result = mysqli_fetch_array(mysqli_query($con, $sql),MYSQLI_ASSOC);
            $sqltags = "select * from blogstags where blogid = $bId";
            $resultTags = mysqli_query($con, $sqltags);
            $stringTags;
            while($row = mysqli_fetch_array($resultTags)){
                $stringTags .= $row['tag'];
                $stringTags .= ", ";
            }
            $stringTags = rtrim($stringTags, ", ");

        ?>

        <!-- Form of update data-->
        <form method='post' class="form-horizontal">
            <input type="hidden" name="blogid" value=<?php echo $bId?> >
            <label>Subject(max 150):</label><br>
            <input type="text" class="inputvalues" id="subject" name="subject" size="50" maxlength = "150" value="<?php echo $result['subject'] ?>"><br><br>
            <label> Description(max 250):</label><br>
            <textarea class="inputvalues" id="description" name="description" rows="4" cols="50" maxlength = "250"><?php echo $result['description'] ?></textarea><br><br>            
            <label> Tags(max 50):</label><br>
            <input type="text" class="inputvalues" name="tags" placeholder="Type your tags" size="50" maxlength = "50" value="<?php echo $stringTags ?>"><br>
            <div class="col-sm-20" >
                <input class="btn" type="submit"  name="update" value="Update"/>
                <input class="btn" type="submit" name="cancel" value="Cancel"/>
            </div>
        </form>
        <!--  ----------------------      -->

        
    </div>
    <div id="resultDiv" align="center"></div>

    <?php
        if(isset($_POST['update']))
        {
            $bId = $_POST['blogid'];
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

            $sql = "update blogs set subject='$subject' , description = '$description', postuser = '$postuser', pdate= '$date' where blogid = '$bId';";
            $sql .= "delete from blogstags where blogid= '$bId';";
            $tagSplit = explode(",", $tags);
            foreach($tagSplit as &$item){
                $sql .= "insert into blogstags VALUES( $bId ,'$item');";
            }
            if (!mysqli_multi_query($con, $sql)) {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }else {
                header('location:blog.php');
            }
            
                
        }

        if(isset($_POST['cancel'])){
            header('location:blog.php');
        }

    ?>

</body>
</html>