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
          $sql = "SELECT n.firstname as firstname, n.lastname as lastname, n.midname as midname, n.suffix as suffix, 
                         n.gender as gender, n.dateofbirth as dateofbirth, r.address as address, r.simnum as simnum, 
                         r.dateofreg as dateofregis, r.regisite as regisite, r.services as services, r.simcard as simcard, 
                         r.sim_status as sim_status, r.offense_count as offense_count, r.ban_start as ban_start, 
                         r.ban_end as ban_end, r.sim_retailer as sim_retailer
                  FROM local_registered_simusers_db as r LEFT JOIN nso_dummy_db as n ON r.nsonum = n.nsonum
                  WHERE r.simnum = ?;";
          $stmt              = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"s",$BUserLoginNumberPHP);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $_SESSION['UserLast']        = $row['lastname'];
                $_SESSION['UserFirst']       = $row['firstname'];
                $_SESSION['UserMiddleName']  = $row['midname'];
                $_SESSION['UserSuffix']      = $row['suffix'];
                $_SESSION['UserBirthdate']   = $row['dateofbirth'];
                $_SESSION['UserGender']      = $row['gender'];
                $_SESSION['UserAddress']     = $row['address'];
                $_SESSION['UserNationality'] = 'Filipino';
                $_SESSION['UserType']      = 'Filipino';
                $_SESSION['UserSimCard']     = $row['simcard'];
                $_SESSION['UserNumber']      = $row['simnum'];
                $_SESSION['UserRegSite']     = $row['regisite'];
                $_SESSION['UserDatReg']      = $row['dateofregis'];
                $_SESSION['services']        = $row['services'];
                $_SESSION['retailer']        = $row['sim_retailer'];
                $_SESSION['Banstart']        = $row['ban_start'];
                $_SESSION['Banend']          = $row['ban_end'];
                $_SESSION['sim_status']      = $row['sim_status'];
                $_SESSION['offense_count']   = $row['offense_count'];
                header("location:../profile-user.php");
                exit();
            }
            $sql = "SELECT n.firstname as firstname, n.lastname as lastname, n.midname as midname, n.suffix as suffix, n.gender as gender, 
                           n.dateofbirth as dateofbirth, r.address as address, r.simnum as simnum, r.dateofreg as dateofregis, r.regisite as regisite ,
                           r.services as services, r.simcard as simcard, r.sim_status as sim_status, r.offense_count as offense_count, r.ban_start as ban_start, 
                           r.ban_end as ban_end, r.sim_retailer as sim_retailer, n.nationality as nationality
                    FROM foreign_registered_simusers_db as r LEFT JOIN foreign_passport_db as n ON r.passnum = n.passnum
                  WHERE r.simnum = ?;";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"s",$BUserLoginNumberPHP);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $_SESSION['UserLast']        = $row['lastname'];
                $_SESSION['UserFirst']       = $row['firstname'];
                $_SESSION['UserMiddleName']  = $row['midname'];
                $_SESSION['UserSuffix']      = $row['suffix'];
                $_SESSION['UserBirthdate']   = $row['dateofbirth'];
                $_SESSION['UserGender']      = $row['gender'];
                $_SESSION['UserAddress']     = $row['address'];
                $_SESSION['UserNationality'] = $row['nationality'];
                $_SESSION['UserType']      = 'Filipino';
                $_SESSION['UserSimCard']     = $row['simcard'];
                $_SESSION['UserNumber']      = $row['simnum'];
                $_SESSION['UserRegSite']     = $row['regisite'];
                $_SESSION['UserDatReg']      = $row['dateofregis'];
                $_SESSION['services']        = $row['services'];
                $_SESSION['retailer']        = $row['sim_retailer'];
                $_SESSION['Banstart']        = $row['ban_start'];
                $_SESSION['Banend']          = $row['ban_end'];
                $_SESSION['sim_status']      = $row['sim_status'];
                $_SESSION['offense_count']   = $row['offense_count'];
                header("location:../profile-user.php");
                exit();
          }

          header("location:../login_sections.php?errornumber=notexist ");

           

  }
?>
