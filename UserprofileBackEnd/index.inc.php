<?php

  if(isset($_POST['indexButton'])){

    $UserLoginNumberPHP = $_POST['IndexNumber']; //Get input
    require_once '../dbh/EndUser.inc.php';
    require_once 'indexFunction.php';

    //ERROR FOR EMPTY BOX
    if(EmptyInputIndex($UserLoginNumberPHP)!==false){ //IF TRUE
      header("location: ../login_sections.php?errornumber=empty");
      echo "error1";
      exit();
    }
    //NO PLUS SIGN
    if(InvalidCharIndex($UserLoginNumberPHP)!==false){ //IF TRUE
      header("location: ../login_sections.php?errornumber=invalid");
      echo "error2";
      exit();
    }

    if(Noplus($UserLoginNumberPHP)!==false){ //IF TRUE
      header("location: ../login_sections.php?errornumber=noplus");
      exit();
    }



    //ERROR FOR INVALID CHARACTERS
    //CHECKING THE DATABASE
    if(CheckNumber($conn,$UserLoginNumberPHP)!== false){ //IF TRUE
      exit();
    }
  echo"stuck";
  };
    //NEED SESSION AND REDIRECT TO OTP-LOGIN
?>
