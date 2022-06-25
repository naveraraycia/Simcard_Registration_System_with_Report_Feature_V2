<?php

include_once "../includes/dbh.inc.php";

session_start();
//NSOfile  - attach nso
//IDfile  - attach valid id
//Businessfile - attack permit
//selleremail - selleremail
//sellerpassword - seller password
//confirmpassword - confirm password
//

if(isset($_POST['register'])){
        $simnum   = mysqli_real_escape_string($conn, $_POST['simnum']);
        $nso = $_SESSION['nsonumber1'];
        $query = "SELECT * FROM nso_dummy_db WHERE nsonum =  '$nso';";
        $result = mysqli_query($conn,$query);
        date_default_timezone_set('Asia/Manila');
        $dateofregis = date('Y-m-d', strtotime($_POST['dateofregis'])); // dateofregis
        $time  = date('G').":".date('i').":".date('s');                 // time
        if (mysqli_num_rows($result) > 0) {
              //  GET DATA OF USER FROM NSO
              foreach ($result as $row) {
                    $lastN = $row['lastname'];                          // lastname
                    $firstN = $row['firstname'];                        // firstname
                    $midN = $row['midname'];                            // midname
                    $sfx = $row['suffix'];                              // suffix
                    $dob = $row['dateofbirth'];                         // dateofbirth
                    $gndr = $row['gender'];                             // gender
                    $passnum_nsonum = $row['nsonum'];                   // passnum_nsonum
                    $nationality = 'Filipino';                          // nationality
               }
        // ADDED DATA        
                                       // address
        $selleremail = mysqli_real_escape_string($conn, $_POST['selleremail']);                       //seller email
        $sellerpassword = $_POST['sellerpassword'];                     //sellerpassword
        $confirmpassword = $_POST['confirmpassword'];
        if($sellerpassword != $confirmpassword){
          echo header("Location: ../admin-register-retailer.php?error=notmatchpass");
          exit();
        }
        
        $owner_key = $_POST['owner_key'];
        $confirm_owner_key = $_POST['confirm_owner_key'];
        if($owner_key != $confirm_owner_key){
          echo header("Location: ../admin-register-retailer.php?error=notmatchowner");
          exit();
        }

        $shop_name = mysqli_real_escape_string($conn, $_POST['shop_name']);      
        $num_permit = $_POST['num_permit'];
        $sim_limit = (int)$_POST['Sim_Limit'];
        $company_address  = $_POST['company_address'];
        $owneraddress = $_POST['owneraddress'];    

        
        $simnum = $_POST['simnum'];                                     // register number
        $dateofregis = date('Y-m-d', strtotime($_POST['dateofregis'])); // dateofregis
        $time  = date('G')."_".date('i')."_".date('s')." ".date('Y-m-d');                 // time
        $timeImg = $time;
        $admin_reg = $_POST['admin_reg'];
        
                           // sim_shop
        $sim_status = "Active Status";                                  // sim_status
        $ban_start = "--";                                              // ban_start
        $ban_end = "--";                                                // ban_end
        $offense_count ="0";                                            // offense_count

        $simnumber = "+63".$simnum;
        $sqlnso = "SELECT * FROM local_registered_simusers_db WHERE simnum = '$simnumber' AND nsonum = '$passnum_nsonum';";
        $result = mysqli_query($conn, $sqlnso);
        $resultsCheck = mysqli_num_rows($result);
        if($resultsCheck == 0){ //check
                header("Location: ../admin-register-retailer.php?error=simnum-not-regis");
        }else{ 
             
                $sql = "INSERT INTO seller( seller_nso, selleremail, sellerpassword, Shop_Name, Business_Permit, 
                  Simcard_Limit, Business_Address, admin_reg, owner_num, 
                  owner_key, nsopass_pic, link_nsopass_pic, id_pic, 
                  link_id_pic, permit_pic, link_permit_pic, dateofregis) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

                
                  //CHECKING FOR NON-INT
                  if(!preg_match("/^[0-9]*$/", $simnum)){ 
                        header("Location: ../admin-register-retailer.php?error=wrongchars");
                        exit();
                  }
                  if(!preg_match("/^[0-9]*$/", $sim_limit)){ 
                    header("Location: ../admin-register-retailer.php?error=simlimitinvalid");
                    exit();
              }
                  //COUNTING NUMBER LENGTH
                  $countnumber = strlen($simnum);
                  if($countnumber != 10){
                        header("Location: ../admin-register-retailer.php?error=incorrectNum"); //error for wrong count
                        exit();
                  }

                  if(!filter_var($selleremail, FILTER_VALIDATE_EMAIL)){
                    header("Location: ../admin-register-retailer.php?notemail");
                    exit();
                  }
                  $sqlnso = "SELECT selleremail, owner_key FROM seller WHERE selleremail = '$selleremail';";
                  $result = mysqli_query($conn,$sqlnso);
                  $resultsCheck = mysqli_num_rows($result);
                  if($resultsCheck > 0){
                    header("Location: ../admin-register-retailer.php?email-already-exist");
                    exit();
                  }

                  if(strlen($sellerpassword) < 6){
                    header("Location: ../admin-register-retailer.php?passworderror"); //error for wrong count
                    exit();
                  }

                  if(strlen($owner_key) < 8){
                    header("Location: ../admin-register-retailer.php?keyerror"); //error for wrong count
                    exit();
                  }
                  $sqlnso = "SELECT selleremail, owner_key FROM seller WHERE owner_key = '$owner_key';";
                  $result = mysqli_query($conn,$sqlnso);
                  if($resultsCheck > 0){
                    header("Location: ../admin-register-retailer.php?ownerkey-already-exist");
                    exit();
                  }

                  //FUNCTION ERROR HANDLERS FOR IMAGE
                          function ImageCheck($allowed,$fileActualExt,$fileExt,$FullName,$fileError,$fileSize){
                                    if($fileSize == 0){
                                      header("Location: ../admin-register-retailer.php?imageempty");
                                      exit();
                                    }else if (!in_array($fileActualExt,$allowed)){
                                      header("Location: ../admin-register-retailer.php?imageformaterror");
                                      exit();
                                    }else if ($fileSize>2000000000000){
                                      header("Location: ../admin-register-retailer.php?imagelarge");
                                      exit();
                                    }else if($fileError !== 0){
                                      header("Location: ../admin-register-retailer.php?imageerror"); 
                                    }else{
                                      $ImageFullName = $FullName.".".$fileActualExt;
                                      return $ImageFullName;
                                    }
                          }
                
                    
                /// NSO Image Process
                  $NSOfile              = $_FILES['NSOfile'];
                        $fileName       = $NSOfile["name"];
                        $fileType       = $NSOfile["type"];
                        $NSOfileTempName   = $NSOfile["tmp_name"];
                        $fileError         = $NSOfile["error"];
                        $fileSize          = $NSOfile["size"];
                        $allowed           = array("jpg","jpeg","png","bmp");
                        //conversion
                        $fileExt           = explode(".",$fileName);
                        $fileActualExt     = strtolower(end($fileExt));
                        $NSOName       = $lastN."_SELLER_NSO_".$passnum_nsonum.$timeImg;
                  $NSOExt = ImageCheck($allowed,$fileActualExt,$fileExt,$NSOName,$fileError,$fileSize);
    
                /// VALID ID
                  $IDfile               = $_FILES['IDfile'];
                        $fileName       = $IDfile["name"];
                        $fileType       = $IDfile["type"];
                        $IDfileTempName   = $IDfile["tmp_name"];
                        $fileError      = $IDfile["error"];
                        $fileSize       = $IDfile["size"];
                        $allowed        = array("jpg","jpeg","png","bmp");
                        //conversion
                        $fileExt        = explode(".",$fileName);
                        $fileActualExt  = strtolower(end($fileExt));
                        $IDName = $lastN."_SELLER_ID_".$passnum_nsonum.$timeImg;
                  $IDExt = ImageCheck($allowed,$fileActualExt,$fileExt,$IDName,$fileError,$fileSize);
                  

                //PERMIT LETTER
                $Permitfile               = $_FILES['Permitfile'];
                    $fileName             = $Permitfile["name"];
                    $fileType             = $Permitfile["type"];
                    $PermitTempName       = $Permitfile["tmp_name"];
                    $fileError            = $Permitfile["error"];
                    $fileSize             = $Permitfile["size"];
                    $allowed              = array("jpg","jpeg","png","bmp");
                        //conversion
                    $fileExt        = explode(".",$fileName);
                    $fileActualExt  = strtolower(end($fileExt));
                    $PermitName     = $lastN."_SELLER_Permit_".$passnum_nsonum.$timeImg;
                $PermitExt = ImageCheck($allowed,$fileActualExt,$fileExt,$PermitName,$fileError,$fileSize);



                //sending to REGISTRATION DB

                $simnum = "+63". $simnum; 
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                $sql = "INSERT INTO seller( seller_nso, selleremail, sellerpassword, Shop_Name, Business_Permit, 
                Simcard_Limit, Business_Address, admin_reg, owner_num, 
                owner_key, nsopass_pic, link_nsopass_pic, id_pic, 
                link_id_pic, permit_pic, link_permit_pic, dateofreg) 
              VALUES ( '$passnum_nsonum','$selleremail', '$sellerpassword','$shop_name','$num_permit','$sim_limit','$company_address','$admin_reg','$simnum','$owner_key','$NSOName','$NSOExt','$PermitName','$PermitExt','$IDName','$IDExt','$dateofregis');";
                // mysqli_stmt_bind_param($stmt,'ssssisssssssssss', $selleremail, $sellerpassword, $shop_name, $num_permit, $sim_limit, $company_address, $admin_reg,$simnum, $owner_key, $NSOName, $NSOExt, $PermitName, $PermitExt, $IDName, $IDExt, $dateofregis);
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $sql);
               $result = mysqli_query($conn, $sql);
             //   mysqli_stmt_execute($stmt);                                   //      //      //      //    //    //          //          //        //            //     //        //            //          //     //            //          //          //       //         //         //          //           //     //       //     //
             //   $result = mysqli_stmt_get_result($stmt);

                //MOVING FILES
                $NSOfileDestination        = '../NSO_User_Database/'.$NSOExt;
                $IDfileDestination         = '../ID_User_Database/'. $IDExt;
                $PermitfileDestination     = '../Permit_Database/'. $PermitExt;
                move_uploaded_file($NSOfileTempName,$NSOfileDestination);
                move_uploaded_file($IDfileTempName,$IDfileDestination);
                move_uploaded_file($PermitTempName,$PermitfileDestination);
         
                //IF NEW PREPAID, DECREASE SIM RETAILER STOCK
                //UNSET NSO
                unset($_SESSION['nsonumber']);
                header("Location: ../verify-seller-nso.php?signup=success");
          }  
      }
    }
  