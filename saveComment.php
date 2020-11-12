<?php
    session_start();
    include('config.php');
    
    $sentiment = $_POST['sentiment'];  
    $description = $_POST['description'];
  
    //to prevent from mysqli injection  
    $sentiment = stripcslashes($sentiment);
    $description = stripcslashes($description);  

    $sentiment = mysqli_real_escape_string($con, $sentiment);  
    $description = mysqli_real_escape_string($con, $description);
    
    $date = date("Y-m-d");
    $author = $_SESSION["username"];
    $blogid = $_POST['blogid'];
    
    $sql = "insert into comments (sentiment, description, cdate, blogid, author) values( '$sentiment', '$description', '$date', '$blogid', '$author')";

    if (mysqli_query($con, $sql)) {
        header("location:post.php?blogid=" . $blogid);
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
  }

?>