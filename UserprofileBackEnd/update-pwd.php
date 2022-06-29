<?php

include_once "../includes/dbh.inc.php";
session_start();

if(isset($_POST['updbtn'])){
  $currentpwd = $_POST['curpass'];
  $updpass = $_POST['newpass'];
  $confirmpass = $_POST['confpass'];
  $SimCard = $_SESSION['UserNumber'];
$Nationality = $_SESSION['UserNationality'];
echo $Nationality;
// QUERY AND CHECK IF THE PASSWORD MATCHES WITH THE PERSON'S PASS WHO IS CURRENTLY ON SESSION
// CHECK ON LOCAL TABLE
if($Nationality == 'Filipino'){
      $localsql = "SELECT userpwd FROM local_registered_simusers_db WHERE simnum = $SimCard AND userpwd = ?;";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$localsql);
      mysqli_stmt_bind_param($stmt,"s",$currentpwd);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($row = mysqli_fetch_assoc($result)){
      //if there is a match then move on to the comparing of new pass and confirm pass
      if($updpass == $confirmpass){
        mysqli_query($conn,"UPDATE local_registered_simusers_db SET userpwd= '$updpass' WHERE simnum = $SimCard");
        header("Location:../edit-pass-user.php?success=pwdupdated");
        exit();
      }else{
        header("Location:../edit-pass-user.php?error=newpassDontMatch");
        exit();
      }

      } else {
        header("Location:../edit-pass-user.php?error=currentPwdIsWrong");
        exit();
      }
}else{
      // CHECK ON FOREIGN TABLE
      $forsql = "SELECT userpwd FROM foreign_registered_simusers_db WHERE simnum = $SimCard AND userpwd = ?;";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$forsql);
      mysqli_stmt_bind_param($stmt,"s",$currentpwd);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($row = mysqli_fetch_assoc($result)){
      //if there is a match then move on to the comparing of new pass and confirm pass
      if($updpass == $confirmpass){
        mysqli_query($conn,"UPDATE foreign_registered_simusers_db SET userpwd= '$updpass' WHERE simnum = $SimCard");
        header("Location:../edit-pass-user.php?success=pwdupdated");
        exit();
        }else{
        header("Location:../edit-pass-user.php?error=newpassDontMatch");
        exit();
        }

      } else {
        header("Location:../edit-pass-user.php?error=currentPwdIsWrong");
        exit();
      }
}
}
