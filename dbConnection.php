<?php
$servername = "localhost";
$username = "user";
$password = "textbook";
$db_name = "textbook";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";


//you dont really want everyone connecting to the database as root, 
//there is too much ast risk. You want to limit the websites ability to delete tables, 
//and ruin database. Therefore, if you are logging in throughthe website, 
//you will be user to the database and there are database restrictions. 
//This will not affect a user's site expirience it's a security precaution. 
//after taking a db security class, I cannot leave this as root.
?>