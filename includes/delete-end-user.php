<?php

include_once "dbh.inc.php";

	if(isset($_GET['del_id'])) {

  $businessPermit = $_GET['del_id'];

  //USE THE $id as the variable for WHERE CLAUSE
  // THIS SHOULD BE THE QUERY: 	"DELETE FROM tasks WHERE businessPermitColumn = $businessPermit"

  // HEAD THE USER BACK TO list-sim-retailer-admin.php
  header("location: ../list-end-user-admin.php");

} else {

  //
}
