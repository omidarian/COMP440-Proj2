<?php

    //mysqli_select_db($con,"user");
	$host = 'localhost';
	$user = 'root1';
	$pass = '1234';
	$db = 'login';
	
	/* $connn = mysqli_connect($host, $user, $pass, $db);  
	
	$sql = "CREATE TABLE `login`.`user` ( `username` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `password` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ) ENGINE = InnoDB" ;
	mysqli_close($connn);   */
	
	$con = mysqli_connect($host, $user, $pass, $db);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  
?>
