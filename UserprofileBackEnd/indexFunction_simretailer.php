<?php

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
      $sql = "SELECT*FROM seller WHERE Business_Permit = ?;";
      $stmt = mysqli_stmt_init($conn);
      include_once "../dbh/Admin_Seller.inc.php";
      //CHECK CONNECTION IF WORKING
      if(!mysqli_stmt_prepare($stmt,$sql)){
          header("Location: ../login_sections.php?errornumber=stmtfailed");
          exit();
      }
      $BUserLoginNumberPHP = "+63". $UserLoginNumberPHP;
      mysqli_stmt_bind_param($stmt,"i", $BUserLoginNumberPHP);
      mysqli_stmt_execute($stmt);
      $resultData = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($resultData)){

        //SESSION START FOR USER LOGIN;
          $sql  = "SELECT * FROM seller WHERE Business_Permit =?;";
          $stmt = mysqli_stmt_init($conn);
          if (mysqli_stmt_prepare($stmt,$sql)){
            mysqli_stmt_bind_param($stmt,"s",$BUserLoginNumberPHP);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            session_start();
            if($row = mysqli_fetch_assoc($result)){

              $_SESSION['UserShop_Name']              = $row['Shop_Name'];
              $_SESSION['UserShop_selleremail']       = $row['selleremail'];
              $_SESSION['UserShop_business_owner']    = $row['business_owner'];
              $_SESSION['UserShop_Business_Address']  = $row['Business_Address'];
              $_SESSION['UserShop_Business_Permit']   = $row['Business_Permit'];
              $_SESSION['UserShop_Simcard_Limit']     = $row['Simcard_Limit'];
              $_SESSION['UserShop_reg_date']          = $row['reg_date'];
              $_SESSION['UserShop_owner_num']         = $row['owner_num'];
              $_SESSION['UserShop_admin_reg']         = $row['admin_reg'];

            }
            header("location:../seller-profile.php");
          }
      }else{
          header("location:../login_sections.php?errornumber=notexist");
      }
  }
?>
