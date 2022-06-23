<?php

include_once "dbh.inc.php";

	if(isset($_GET['sellemail'])) {

  $sellemail = $_GET['sellemail'];
    $sql = "DELETE FROM seller WHERE selleremail='$sellemail';";
    echo $sellemail;
    $result = mysqli_query($conn,$sql);
  //USE THE $id as the variable for WHERE CLAUSE
  // THIS SHOULD BE THE QUERY: 	"DELETE FROM registered_simusers_db WHERE simnumColumn = $simcardnum"

  // HEAD THE USER BACK TO list-sim-retailer-admin.php
  header("Location: ../list-sim-retailer-admin.php");

} else {

  //
}
