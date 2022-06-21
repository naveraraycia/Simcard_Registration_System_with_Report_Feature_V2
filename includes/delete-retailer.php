<?php

include_once "dbh.inc.php";

	if(isset($_GET['simnum'])) {

  $simcardnum = $_GET['simnum'];

  //USE THE $id as the variable for WHERE CLAUSE
  // THIS SHOULD BE THE QUERY: 	"DELETE FROM registered_simusers_db WHERE simnumColumn = $simcardnum"

  // HEAD THE USER BACK TO list-sim-retailer-admin.php
  header("Location: ../list-sim-retailer-admin.php");

} else {

  //
}
