
<?php
    session_start();
    include('config.php');


// delete comment 
if(isset($_POST['delete']))
{
    
    $commentid = $_POST['commentid'];
  
    //to prevent from mysqli injection  
    $commentid = stripcslashes($commentid);

    $$commentid = mysqli_real_escape_string($con, $$commentid);

    $blogid = $_POST['blogid'];

    $sql = "delete from comments where commentid =  '$commentid'";

    if (mysqli_query($con, $sql)) {
        header("location:post.php?blogid=" . $blogid);
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

// edit comment
if(isset($_POST['edit']))
{
    $commentid = $_POST['commentid'];
    $blogid = $_POST['blogid'];

    // $sql = "select * from comments where commentid =  '$commentid'";
    // $result = mysqli_fetch_array(mysqli_query($con, $sql),MYSQLI_ASSOC);
    // $date = date("Y-m-d");

    header("location:post.php?blogid=" . $blogid . "&commentid=" . $commentid);
    
}


// add new comment
if(isset($_POST['add']))
{
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

}


// update comment
if(isset($_POST['update']))
{
    
    $sentiment = $_POST['sentiment'];  
    $description = $_POST['description'];
    $commentid = $_POST['commentid'];

    //to prevent from mysqli injection  
    $sentiment = stripcslashes($sentiment);
    $description = stripcslashes($description);  
    $commentid = stripcslashes($commentid);

    $sentiment = mysqli_real_escape_string($con, $sentiment);  
    $description = mysqli_real_escape_string($con, $description);
    $commentid = mysqli_real_escape_string($con, $commentid);

    $date = date("Y-m-d");
    $author = $_SESSION["username"];
    $blogid = $_POST['blogid'];
    
    $sql = "update comments set commentid='$commentid', sentiment='$sentiment', description='$description' , cdate='$date', blogid='$blogid', author='$author' where commentid='$commentid'";

    if (mysqli_query($con, $sql)) {
        header("location:post.php?blogid=" . $blogid);
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
  }

}

?>