<?php
//.inc.php. .inc has nothing to do. just naming purpose
$dbServername = "localhost";
$dbUsername = "root"; //this will be ONLY change if using server not local
$dbPassword = ""; //i set a password to nothing . you can put one
$dbName = "admin_seller_database"; //this is where we will put our database name


//1.  GINAGAMIT TOH PARA SA SELLER_REGISTRATION. PARA MABAWASAN YUNG SIM_LIMIT VALUE EVERY
//REGISTRATION


$TRY = mysqli_connect($dbServername, $dbUsername, $dbPassword,$dbName); //stands for CONNection
 ?>
