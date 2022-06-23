<?php
  function CheckAccount($conn,$SellerLogin,$SellerPass){

    //INITIALIZE COMMANDS
    //$sql = "SELECT * FROM seller WHERE selleremail = ? AND sellerpassword = ?;";
    $sql = "SELECT 
    s.selleremail AS selleremail, s.sellerpassword AS sellerpassword, s.Shop_Name AS shop_name, 
    rg.lastname AS lastname, rg.firstname as firstname, rg.midname as midname, 
    s.Business_Permit as business_permit, s.Business_Address as business_address, s.owner_key as owner_key, 
    s.owner_num as owners_num, s.Shop_Name as shop_name, s.Simcard_Limit AS simcard_limit, 
    s.dateofreg as date_reg, s.admin_reg as reg_by
    FROM registered_simusers_db as rg INNER JOIN seller as s 
    WHERE selleremail = ? AND sellerpassword = ? AND (s.seller_nso = rg.passnum_nsonum) ;";
    
    $stmt = mysqli_stmt_init($conn);
   // $sql = "SELECT s.selleremail, s.sellerpassword, s.Shop_Name , s.Business_Permit, rg.lastname, rg.firstname, rg.midname
   // FROM registered_simusers_db as rg INNER JOIN seller as s 
   // WHERE selleremail=? AND sellerpassword =? AND (s.seller_nso = rg.passnum_nsonum) ;";
    //CHECK CONNECTION IF WORKING
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../login_sections.php?simRetailer=Error");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss",$SellerLogin,$SellerPass);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
      $email           = $row['selleremail'];
      $password        = $row['sellerpassword'];
      $shop_name       = $row['shop_name'];
      $business_permit = $row['business_permit'];
      $SellerFirstName = $row['firstname'];
      $SellerLastName  = $row['lastname'];
      $SellerMidName   = $row['midname'];
      $business_address = $row['business_address'];
      $owner_key        = $row['owner_key'];
      $owners_num       =  $row['owners_num'];
      $simcard_limit    =  $row['simcard_limit'];
      $date_reg         =  $row['date_reg'];
      $reg_by           = $row['reg_by']; 
      //CASE SENSITIVE CHECKING
      if (($SellerPass === $password && $SellerLogin === $email)){
          session_start();

          $_SESSION['SellerFirstName'] = $SellerFirstName;
          $_SESSION['SellerLastName']  = $SellerLastName;
          $_SESSION['SellerEmail']     = $email;
          $_SESSION['SellerPassword']  = $password;
          $_SESSION['Shop_Name'] = $shop_name;
          $_SESSION['business_permit'] =$business_permit;
          $_SESSION['Simcard_Limit'] =$simcard_limit;
          $_SESSION['Business_Address'] =$business_address;
          $_SESSION['business_owner']   = $SellerFirstName." ".$SellerMidName." ".$SellerLastName;
          $_SESSION['owner_key']       = $owner_key;
          $_SESSION['owners_num']      = $owners_num;
          $_SESSION['date_reg']        = $date_reg;
          $_SESSION['reg_by']          = $reg_by;

          header("location:../seller-home.php");
      }else{
        header("location:../login_sections.php?simRetailer=invalidpassoremail");
      }
    }else{
      header("location:../login_sections.php?simRetailer=invalidpassoremail");
    }

  }


?>
