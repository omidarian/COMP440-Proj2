<?php
session_start();
include('config.php');
if(isset($_POST['submit'])){

    //if(!empty($_POST['data'])) {
        $username = $_SESSION['username'];

        $sql = "delete from hobbies where username = '$username';";
        foreach($_POST['data'] as $selected) {
            $sql .= "insert into hobbies values('$username', '$selected');";
            //echo "<p>".$selected ."</p>";
        }
        if (!mysqli_multi_query($con, $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }else {
            echo "<h1>'succesful'<h1>";
            header('location:welcome.php');
        }
    //}else{
    //    header("location:welcome.php");
    //}
}
if(isset($_POST['back']))
{
    header("location:welcome.php");
}
?>