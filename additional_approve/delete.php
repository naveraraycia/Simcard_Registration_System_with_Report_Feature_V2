<?php

include_once "../includes/dbh.inc.php";

	if(isset($_GET['request'])) {

  $simnum = $_GET['request'];
  $simnum = '+'.$simnum;
    $sql = "DELETE FROM request_reg_db WHERE simnum='$simnum';";  
    $result = mysqli_query($conn,$sql);
  //USE THE $id as the variable for WHERE CLAUSE
  // THIS SHOULD BE THE QUERY: 	"DELETE FROM registered_simusers_db WHERE simnumColumn = $simcardnum"

  // HEAD THE USER BACK TO list-sim-retailer-admin.php
  header("Location: ../additional-local-request.php?denied");

} else {

  //
}