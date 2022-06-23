<?php
$servername = "localhost";
$dbUsername = "root";
$dbpassword = "";
// name of database
$dbName= "hello";

// CREATE CONNECTION (DATABASE)
$conn = mysqli_connect($servername, $dbUsername,$dbpassword,$dbName);

if(!$conn){
  die("Connection failed:" . mysqli_connect_error());
}
?>
