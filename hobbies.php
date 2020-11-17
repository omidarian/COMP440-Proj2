<?php
    session_start();
    require 'config.php';
    if(!$_SESSION["username"]){
        header('location:index.php');
    }

    $username = $_SESSION["username"];
    $sql = "select * from hobbies where username = '$username'";
    $result = mysqli_query($con, $sql);
    $new_array[] = null;
    while($row = mysqli_fetch_array($result)){
         $new_array[] = $row['hobby'];
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
        <p>Hobbies Page</p>
        <h3>User: 
            <?php echo $_SESSION['username']?>
        </h3>
        
        <form action="hobbiesAction.php" class=newspaper method='post' align ="left">
            <input type="checkbox" id="hiking" name="data[]" value="hiking" <?php if (in_array("hiking", $new_array)) {
        echo "checked";}?> >
            <label for="hiking"> Hiking</label><br>
            <input type="checkbox" id="swimming" name="data[]" value="swimming" <?php if (in_array("swimming", $new_array)) {
        echo "checked";}?>>
            <label for="swimming"> Swimming</label><br>
            <input type="checkbox" id="calligraphy" name="data[]" value="calligraphy" <?php if (in_array("calligraphy", $new_array)) {
        echo "checked";}?>>
            <label for="calligraphy"> Calligraphy</label><br>
            <input type="checkbox" id="bowling" name="data[]" value="bowling" <?php if (in_array("bowling", $new_array)) {
        echo "checked";}?>>
            <label for="bowling"> Bowling</label><br>
            <input type="checkbox" id="movie" name="data[]" value="movie" <?php if (in_array("movie", $new_array)) {
        echo "checked";}?>>
            <label for="movie"> Movie</label><br>
            <input type="checkbox" id="cooking" name="data[]" value="cooking" <?php if (in_array("cooking", $new_array)) {
        echo "checked";}?>>
            <label for="cooking"> Cooking</label><br>
            <input type="checkbox" id="dancing" name="data[]" value="dancing" <?php if (in_array("dancing", $new_array)) {
        echo "checked";}?>>
            <label for="dancing"> Dancing</label><br><br><br>
            <input type="submit" value="Submit" name="submit">
            <input class="btn" type="submit" name="back" value="Back"/>
        </form>
    </div>
</body>
</html>