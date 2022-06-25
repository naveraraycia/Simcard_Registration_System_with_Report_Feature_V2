<?php
include_once "includes/dbh.inc.php";

session_start();


if(isset($_POST['sendbutton'])){

  // include_once 'includes/dbh.inc.php';
  // $nsonum   = mysqli_real_escape_string($conn, $_POST['nsonum']);
  //$query = mysqli_query("SELECT * FROM seller as s RIGHT JOIN resupply_requests as r ON s.selleremail = r.selleremail");
  $sim_amount_requested = $_POST ['sim_amount_requested'];
  $selleremail = $_SESSION['SellerEmail'];





  $sql = "SELECT SellerEmail FROM resupply_requests WHERE SellerEmail = '$selleremail';";
  $result = mysqli_query($conn, $sql);
  $resultsCheck = mysqli_num_rows($result);
  if($resultsCheck >= 1){
    header("Location: request-sim-resupply.php?error=already-requested");
    exit();
  }


  // else {
    $sql = "INSERT INTO resupply_requests(selleremail, sim_amount_requested)
    VALUES (?,?);";

    // PREPARED STATEMENT
    $stmt = mysqli_stmt_init($conn);

    // PREPARE THE PREPARE STATEMENT
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "SQL statement failed";
    }
    else{
      // BIND PARAMETER TO THE PLACEHOLDER
      mysqli_stmt_bind_param($stmt,"ss",  $selleremail, $sim_amount_requested);

      // RUN PARAMETER INDSIDE DATABASE
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      header("Location: request-sim-resupply.php?signup=success");
      exit();
    }
  // }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
