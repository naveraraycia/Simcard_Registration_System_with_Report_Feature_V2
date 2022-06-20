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
  $nationality = $_POST ['nationality'];
  $passnum = $_POST ['passnum'];

  $sqlnso = "SELECT passnum FROM foreign_passport_db WHERE passnum = '$passnum';";
  $result = mysqli_query($conn, $sqlnso);
  $resultsCheck = mysqli_num_rows($result);
  if($resultsCheck == 1){
    header("Location: add-passport-record.php?error=passnum-already-exist");
  }

  else {
    $sql = "INSERT INTO foreign_passport_db(lastname, firstname, midname, suffix, dateofbirth, gender, nationality,passnum)
    VALUES (?,?,?,?,?,?,?,?);";

    // PREPARED STATEMENT
    $stmt = mysqli_stmt_init($conn);

    // PREPARE THE PREPARE STATEMENT
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "SQL statement failed";
    }
    else{
      // BIND PARAMETER TO THE PLACEHOLDER
      mysqli_stmt_bind_param($stmt,"ssssssss",  $lastname, $firstname, $midname, $suffix, $dateofbirth, $gender,$nationality, $passnum );

      // RUN PARAMETER INDSIDE DATABASE
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      header("Location: add-passport-record.php?signup=success");
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

}
