<?php

include_once "dbh.inc.php";
session_start();


if(isset($_POST['register'])){
        $simnum   = mysqli_real_escape_string($conn, $_POST['simnum']);
        $passportnumber = $_SESSION['passportnumber'];
        $query = "SELECT * FROM foreign_passport_db WHERE passnum =  '$passportnumber';";
        $result = mysqli_query($conn,$query);

        if (mysqli_num_rows($result) > 0) {
              //  GET DATA OF USER FROM NSO
              foreach ($result as $row) {
                    $lastN = $row['lastname'];
                    $firstN = $row['firstname'];
                    $midN = $row['midname'];
                    $sfx = $row['suffix'];
                    $dob = $row['dateofbirth'];
                    $gndr = $row['gender'];
                    $passnum_nsonum = $row['passnum'];
                    // $address = $row['address'];
                    $nationality = $row['nationality'];
               }
        // ADDED DATA
        $address = $_POST['address'];
        $simcard = $_POST['simcard'];
        $simnum = $_POST['simnum'];
        $regisite = $_POST['retailer'];
        $dateofregis = date('Y-m-d', strtotime($_POST['dateofregis']));
        date_default_timezone_set('Asia/Manila');
        $time  = date('G').":".date('i').":".date('s');
        $timeImg  = date('G')."_".date('i')."_".date('s');
        $services = $_POST['services'];
        $sim_retailer =$_POST['retailer'];
        //CHECK IF DATA EXIST AND SIMTYPE IS ALREADY EXIST)
        $simnumber = "+63".$simnum;
        $sqlnso = "SELECT simnum FROM registered_simusers_db WHERE simnum = '$simnumber';";
        $result = mysqli_query($conn, $sqlnso);
        $resultsCheck = mysqli_num_rows($result);
        if($resultsCheck == 1){ //check
                header("Location: ../register-users-foreign.php?error=simnum-already-exist");
        }else{
                $sql = "INSERT INTO registered_simusers_db (lastname, firstname, midname, suffix, dateofbirth, gender, passnum_nsonum,address,nationality,simcard,simnum,services, regisite,dateofregis,time,fingerprint_File_Format,fingerprint_File_Name,sim_retailer,sim_shop,sim_status,ban_start,ban_end,offense_count,nsopass_pic,link_nsopass_pic,id_pic,link_id_pic)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
                $sqlservice = "SELECT passnum_nsonum, services FROM registered_simusers_db WHERE services = '$services' AND passnum_nsonum = '$passportnumber';";
                $result = mysqli_query($conn,$sqlservice);
                $resultsCheck = mysqli_num_rows($result);

                if($simcard == "new prepaid user"){
                  if($_SESSION['Simcard_Limit'] <= 0){
                  header("Location: ../register-users-foreign.php?error=maxlimit");
                  exit();
                  }
                }
                //CHECK IF USER HAS ALREADY SIMILAR SERVICE
                if($resultsCheck > 0){
                    header("Location: ../register-users-foreign.php?error=simservice");
                    exit();
                }

                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                  echo "SQL statement failed";
                }else{

                  //CHECKING FOR NON-INT
                  if(!preg_match("/^[0-9]*$/", $simnum)){
                        header("Location: ../register-users-foreign.php?error=wrongchars");
                        exit();
                  }
                  //COUNTING NUMBER LENGTH
                  $countnumber = strlen($simnum);
                  if($countnumber != 10){
                        header("Location: ../register-users-foreign.php?error=incorrectNum"); //error for wrong count
                        exit();
                  }

                  //FUNCTION ERROR HANDLERS FOR IMAGE
                          function ImageCheck($allowed,$fileActualExt,$fileExt,$FullName,$fileError,$fileSize){
                                    if($fileSize == 0){
                                      header("Location: ../register-users-foreign.php?imageempty");
                                      exit();
                                    }else if (!in_array($fileActualExt,$allowed)){
                                      header("Location: ../register-users-foreign.php?imageformaterror");
                                      exit();
                                    }else if ($fileSize>20000000000){
                                      header("Location: ../register-users-foreign.php?imagelarge");
                                      exit();
                                    }else if($fileError !== 0){
                                      header("Location: ../register-users-foreign.php?imageerror");
                                    }else{
                                      $ImageFullName = $FullName.".".$fileActualExt;
                                      return $ImageFullName;
                                    }
                          }



                /// NSO Image Process
                  $Passportfile                 = $_FILES['Passportfile'];
                        $fileName               = $Passportfile["name"];
                        $fileType               = $Passportfile["type"];
                        $PassportfileTempName   = $Passportfile["tmp_name"];
                        $fileError              = $Passportfile["error"];
                        $fileSize               = $Passportfile["size"];
                        $allowed                = array("jpg","jpeg","png","bmp");
                        //conversion
                        $fileExt                = explode(".",$fileName);
                        $fileActualExt          = strtolower(end($fileExt));
                        $Passportname           = $lastN."_Passport_".$passnum_nsonum.$timeImg;
                  $PassportExt = ImageCheck($allowed,$fileActualExt,$fileExt,$Passportname,$fileError,$fileSize);


                //SET -- to ID since Foreigner has no ID
                $IDName = "--";
                $IDExt  = "--";
                /// IMAGE FINGERPRINT
                $Fingerfile                 = $_FILES['Fingerfile'];
                      $fileName             = $Fingerfile["name"];
                      $fileType             = $Fingerfile["type"];
                      $FingerfileTempName   = $Fingerfile["tmp_name"];
                      $fileError            = $Fingerfile["error"];
                      $fileSize             = $Fingerfile["size"];
                      $allowed              = array("jpg","jpeg","png","bmp");
                      //conversion
                      $fileExt              = explode(".",$fileName);
                      $fileActualExt        = strtolower(end($fileExt));
                      $FingerName           = $lastN."_Finger_".$passnum_nsonum.$timeImg;
                $FingerExt = ImageCheck($allowed,$fileActualExt,$fileExt,$FingerName,$fileError,$fileSize);

                //GETTING SHOP DATA AND SETTING FIXED DATA
                $sim_shop = $_SESSION['Shop_Name'];
                $sim_status = "Active Status";
                $regisite  = $_SESSION['Business_Address'];
                $ban_start = "--";
                $ban_end = "--";
                $offense_count ="0";
                $simnum = "+63". $simnum;

                //SETTING BINDING VARIABLEAYS/DATA


                mysqli_stmt_bind_param($stmt,"sssssssssssssssssssssssssss",  $lastN, $firstN, $midN, $sfx, $dob, $gndr, $passnum_nsonum,$address,$nationality,$simcard, $simnum, $services, $regisite, $dateofregis,$time, $FingerExt , $FingerName,$sim_retailer,$sim_shop,$sim_status,$ban_start,$ban_end,$offense_count,$Passportname,$PassportExt,$IDName,$IDExt);
                mysqli_stmt_execute($stmt);                                   //      //      //      //    //    //          //          //        //            //     //        //            //          //     //            //          //          //       //         //         //          //           //     //       //     //
                $result = mysqli_stmt_get_result($stmt);

                //MOVING FILES
                $FingerfileDestination = '../Fingerprint_Registered_User_Database/'.$FingerExt; //kung saan move yung fingerprint sa folder. dapat same yung folder name. ikaw na bahala
                $NSOfileDestination    = '../NSO_User_Database/'.$PassportExt;
                move_uploaded_file($FingerfileTempName,$FingerfileDestination);  //imomove na yung file to that folder
                move_uploaded_file($PassportfileTempName,$NSOfileDestination);


                //IF NEW PREPAID, DECREASE SIM RETAILER STOCK
                if($simcard == "new prepaid user"){
                      $Reduce = $_SESSION['Simcard_Limit'];
                      $Reduce = (int)$Reduce;
                      $Reduce =  $Reduce - 1;
                      $_SESSION['Simcard_Limit']=$Reduce;
                      $Reduce = (string) $Reduce;
                      $selleremail = $_SESSION['SellerEmail'];
                      $limitdown ="UPDATE seller SET Simcard_Limit='$Reduce' WHERE selleremail='$selleremail';";
                      include '../dbh/Updating_SellerAdmin.inc.php';
                      mysqli_query($TRY,$limitdown);
                }
                //UNSET NSO
                unset($_SESSION['passportnumber']);
                header("Location: ../verify-passport.php?signup=success");
          }
      }
    }
  }
