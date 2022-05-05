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


 function Noplus($UserLoginNumberPHP){
   $result;
   if(!preg_match('/^[+]/',$UserLoginNumberPHP)){
     $result = true;  // CAUSE ERRROR
   }else{
     if (!preg_match("/[a-zA-Z +-]/", $UserLoginNumberPHP)){
       $result = true; //CAUSE ERROR
     }else{
       $result = false; //NO ERROR
     }
   }
   return $result;
 };

 function InvalidCharIndex($UserLoginNumberPHP){ //ERROR FOR INVALID CHARACTERS
  $result;
  if (!preg_match("/^[a-zA-Z]*$/", $UserLoginNumberPHP)){
    $result = false; //NO ERROR
  }else{
    $result = true; //CAUSE ERROR
  }
  return $result;
};

//CHECK IF THERE IF THE NUMBER EXIST
 function CheckNumber($conn, $UserLoginNumberPHP){
      $sql = "SELECT*FROM registered_simusers_db WHERE simnum = ?;";
      $stmt = mysqli_stmt_init($conn);

      //CHECK CONNECTION IF WORKING
      if(!mysqli_stmt_prepare($stmt,$sql)){
          header("Location: ../login_sections.php?errornumber=stmtfailed");
          exit();
      }

      mysqli_stmt_bind_param($stmt,"i", $UserLoginNumberPHP);
      mysqli_stmt_execute($stmt);
      $resultData = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($resultData)){

        //SESSION START FOR USER LOGIN;
          $sql = "SELECT * FROM registered_simusers_db WHERE simnum=?;";
          $stmt              = mysqli_stmt_init($conn);
          if (mysqli_stmt_prepare($stmt,$sql)){
            mysqli_stmt_bind_param($stmt,"s",$UserLoginNumberPHP);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            session_start();
            if($row = mysqli_fetch_assoc($result)){

                $_SESSION['UserLast']        = $row['lastname'];
                $_SESSION['UserFirst']       = $row['firstname'];
                $_SESSION['UserMiddleName']  = $row['midname'];
                $_SESSION['UserSuffix']      = $row['suffix'];
                $_SESSION['UserBirthdate']   = $row['dateofbirth'];
                $_SESSION['UserGender']      = $row['gender'];
                $_SESSION['UserAddress']     = $row['address'];
                $_SESSION['UserNationality'] = $row['nationality'];
                if(($row['nationality']) == 'Filipino'||($row['nationality']) == 'filipino'){
                  $_SESSION['UserType']      = 'Local';
                }else{
                  $_SESSION['UserType']      = 'Foreign';
                }
                $_SESSION['UserSimCard']     = $row['simcard'];
                $_SESSION['UserNumber']      = $row['simnum'];
                $_SESSION['UserRegSite']     = $row['regisite'];
                $_SESSION['UserDatReg']      = $row['dateofregis'];
                $_SESSION['UserTimeReg']     = $row['time'];

            }
            header("location:../profile-user.php");
          }
      }else{
          header("location:../login_sections.php?errornumber=notexist");
      }
  }
?>
