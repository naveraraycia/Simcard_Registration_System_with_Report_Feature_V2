<?php
session_start();
 function EmptyInputIndex($UserLoginNumberPHP){ //ERROR IF NO INPUT
   $result;
   if(empty($UserLoginNumberPHP)){
     $result = true;  //CAUSE ERROR
   }else{
     $result = false; //NO ERROR
   }
   return $result;
 };

 function StringEx($UserLoginNumberPHP){  // ERROR HANDLERS FOR NOT NUMBERS/INTEGERS
   $result;
   if (!preg_match('/^[0-9]*$/',$UserLoginNumberPHP)){
     $result = true;
   }else{
     $result = false;
   }
   return $result;
 }

 function WrongLen($UserLoginNumberPHP){ //ERROR HANDLERS FOR WRONG LENGTH OF NPUTS
   $result;
   $length = strlen($UserLoginNumberPHP);
   if(($length)==10){
     $result = false;
   }else{
     $result = true;
   }
   return $result;
 };

//CHECK IF THERE IF THE NUMBER EXIST
 function CheckNumber($conn, $UserLoginNumberPHP){
      include_once "../includes/dbh.inc.php";
      $BUserLoginNumberPHP = '+63'. $UserLoginNumberPHP;

      //LOGIN CHECK TO KNOW IF LOCAL
      $localsql = "SELECT  simnum FROM local_registered_simusers_db WHERE simnum = ?;";
      $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$localsql);
        mysqli_stmt_bind_param($stmt,"s",$BUserLoginNumberPHP);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)){
            $_SESSION['UserNumber']      = $row['simnum'];
            $_SESSION['Type']     = "Filipino";
            header("location:../profile-user.php");
            exit();
        }
        
        //LOGIN CHECK TO KNOW IF FOREIGN
        $foreignsql = "SELECT simnum FROM foreign_registered_simusers_db WHERE simnum = ?;";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$foreignsql);
        mysqli_stmt_bind_param($stmt,"s",$BUserLoginNumberPHP);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)){
            $_SESSION['UserNumber']      = $row['simnum'];
            $_SESSION['Type']     = "NotFilipino";
            header("location:../profile-user.php");
            exit();
        }
   
        //LOGIN CHECK TO KNOW IF BUSINESS 
        $business_sql = "SELECT simnum FROM business_entity_registered_simusers_db WHERE simnum = ?;";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$business_sql);
        mysqli_stmt_bind_param($stmt,"s",$BUserLoginNumberPHP);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)){
            $_SESSION['UserNumber']      = $row['simnum'];
            $_SESSION['Type']     = "Business";
            header("location:../bus-ent-profile.php");
            exit();
        }

          header("location:../login_sections.php?errornumber=notexist ");

           

  }
?>
