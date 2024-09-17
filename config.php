<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "cric";

// Create connection
$conn = mysqli_connect($hostname, $username, $password, $dbname);

$conn->set_charset("utf8");
mysqli_query($conn,'SET CHARACTER SET utf8'); 
mysqli_query($conn,"SET SESSION collation_connection ='utf8_general_ci'");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

