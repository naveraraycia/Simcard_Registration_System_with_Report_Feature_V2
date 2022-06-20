<?php
include_once "includes/dbh.inc.php";
session_start();

if(isset($_POST['register'])){

  // include_once 'includes/dbh.inc.php';
  // $nsonum   = mysqli_real_escape_string($conn, $_POST['nsonum']);

  $lastname = $_POST ['lastname'];
  $firstname = $_POST ['firstname'];
  $midname = $_POST ['midname'];
  $suffix = $_POST ['suffix'];
  $dateofbirth = $_POST ['dateofbirth'];
  $gender = $_POST ['Gender'];
  $nsonum = $_POST ['nsonum'];

  $sqlnso = "SELECT nsonum FROM nso_dummy_db WHERE nsonum = '$nsonum';";
  $result = mysqli_query($conn, $sqlnso);
  $resultsCheck = mysqli_num_rows($result);
  if($resultsCheck == 1){
    header("Location: add-nso-record.php?error=nsomnum-already-exist");
  }

  else {
    $sql = "INSERT INTO nso_dummy_db(lastname, firstname, midname, suffix, dateofbirth, gender, nsonum)
    VALUES (?,?,?,?,?,?,?);";

    // PREPARED STATEMENT
    $stmt = mysqli_stmt_init($conn);

    // PREPARE THE PREPARE STATEMENT
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "SQL statement failed";
    }
    else{
      // BIND PARAMETER TO THE PLACEHOLDER
      mysqli_stmt_bind_param($stmt,"sssssss",  $lastname, $firstname, $midname, $suffix, $dateofbirth, $gender, $nsonum);

      // RUN PARAMETER INDSIDE DATABASE
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      header("Location: add-nso-record.php?signup=success");
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

}
