<?php

include_once "dbh.inc.php";
session_start();


if(isset($_POST['register'])){

       date_default_timezone_set('Asia/Manila');
        $timeImg  = date('G')."_".date('i')."_".date('s');
        $timeImg = $timeImg.date('Y-m-d');

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
                    $nationality = $row['nationality'];
               }
        // ADDED DATA
        $address = $_POST['address'];                                   // address
        $simcard = $_POST['simcard'];                                   // simcard
        $simnum = $_POST['simnum'];                                     // register number
        $services = $_POST['services'];                                 // services
        $remarks  = $_POST['remarks'];                                  // remarks
        $regisite  = $_SESSION['Business_Address'];                     // regisite
        $dateofregis = date('Y-m-d', strtotime($_POST['dateofregis'])); // dateofregis
        $time  = date('G').":".date('i').":".date('s');                 // time
        $sim_retailer =$_POST['retailer'];                              // sim_retailer
        $sim_shop = $_SESSION['Shop_Name'];                             // sim_shop
        $sim_status = "Active Status";                                  // sim_status
        $ban_start = "0000-00-00";                                              // ban_start
        $ban_end = "0000-00-00";                                                // ban_end
        $offense_count ="0";

        $simnumber = "+63".$simnum;
        $pwd = substr($passportnumber, -5);
        //CHECK IF DATA EXIST AND SIMTYPE IS ALREADY EXIST)
        $sqlnso = "SELECT simnum FROM foreign_registered_simusers_db WHERE simnum = '$simnumber';";
        $result = mysqli_query($conn, $sqlnso);
        $resultsCheck = mysqli_num_rows($result);
        if($resultsCheck >= 1){ //check
                header("Location: ../register-duplicate-sim-foreign.php?error=simnum-already-exist");
                exit();
        }
        $sqlnso = "SELECT simnum FROM local_registered_simusers_db WHERE simnum = '$simnumber';";
        $result = mysqli_query($conn, $sqlnso);
        $resultsCheck = mysqli_num_rows($result);
        if($resultsCheck >= 1){ //check
                header("Location: ../register-duplicate-sim-foreign.php?error=simnum-already-exist");
                exit();
        }
        $sqlnso = "SELECT simnum FROM working_registered_simusers_db WHERE simnum = '$simnumber';";
        $result = mysqli_query($conn, $sqlnso);
        $resultsCheck = mysqli_num_rows($result);
        if($resultsCheck >= 1){ //check
                header("Location: ../register-duplicate-sim-foreign.php?error=simnum-already-exist");
        }else{
            //PANG SEND NG DATA, ETO YUNG QUERY
            $sql = "INSERT INTO request_reg_db (userpwd, lastname, firstname, midname, suffix, dateofbirth, gender, passnum_nsonum,address,nationality,simcard,simnum,services, remarks, regisite, dateofregis, time,fingerprint_File_Format,fingerprint_File_Name,sim_retailer,sim_shop,sim_status,ban_start,ban_end,offense_count,nsopass_pic,link_nsopass_pic,id_pic,link_id_pic)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

            if($simcard == "new prepaid user"){
              $simcardlimit = $_SESSION['Simcard_Limit'];
              if($simcardlimit <= 0){
                header("Location: ../register-duplicate-sim-foreign.php?error=maxlimit");
                exit();
              }
            }

                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                  echo "SQL statement failed";
                }else{

                  //CHECKING FOR NON-INT
                  if(!preg_match("/^[0-9]*$/", $simnum)){
                        header("Location: ../register-duplicate-sim-foreign.php?error=wrongchars");
                        exit();
                  }
                  //COUNTING NUMBER LENGTH
                  $countnumber = strlen($simnum);
                  if($countnumber != 10){
                        header("Location: ../register-duplicate-sim-foreign.php?error=incorrectNum"); //error for wrong count
                        exit();
                  }

                  //FUNCTION ERROR HANDLERS FOR IMAGE
                          function ImageCheck($allowed,$fileActualExt,$fileExt,$FullName,$fileError,$fileSize){
                                    if($fileSize == 0){
                                      header("Location: ../register-duplicate-sim-foreign.php?imageempty");
                                      exit();
                                    }else if (!in_array($fileActualExt,$allowed)){
                                      header("Location: ../register-duplicate-sim-foreign.php?imageformaterror");
                                      exit();
                                    }else if ($fileSize>20000000000){
                                      header("Location: ../register-duplicate-sim-foreign.php?imagelarge");
                                      exit();
                                    }else if($fileError !== 0){
                                      header("Location: ../register-duplicate-sim-foreign.php?imageerror");
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
                        $IDName = $lastN."_ID_".$passnum_nsonum.$timeImg;
                  $IDExt = ImageCheck($allowed,$fileActualExt,$fileExt,$IDName,$fileError,$fileSize);

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
                $simnum = "+63". $simnum;   //DAPAT ANDITO LANG TONG SIMNUM+63 PARA DI MAGERROR HANDLER



                mysqli_stmt_bind_param($stmt,"sssssssssssssssssssssssssssss", $pwd, $lastN, $firstN, $midN, $sfx, $dob, $gndr, $passnum_nsonum,$address,$nationality,$simcard, $simnum, $services, $remarks, $regisite, $dateofregis,$time, $FingerExt , $FingerName,$sim_retailer,$sim_shop,$sim_status,$ban_start,$ban_end,$offense_count,$Passportname,$PassportExt,$IDName,$IDExt);
                mysqli_stmt_execute($stmt);                                   //      //      //      //    //    //          //          //        //            //     //        //            //          //     //            //          //          //       //         //         //          //           //     //       //     //
                $result = mysqli_stmt_get_result($stmt);

                //MOVING FILES
                $FingerfileDestination = '../Fingerprint_Registered_User_Database/'.$FingerExt; //kung saan move yung fingerprint sa folder. dapat same yung folder name. ikaw na bahala
                $NSOfileDestination    = '../NSO_User_Database/'.$PassportExt;
                $IDfileDestination     = '../ID_User_Database/'. $IDExt;
                move_uploaded_file($FingerfileTempName,$FingerfileDestination);  //imomove na yung file to that folder
                move_uploaded_file($PassportfileTempName,$NSOfileDestination);
                move_uploaded_file($IDfileTempName,$IDfileDestination);

                //IF NEW PREPAID, DECREASE SIM RETAILER STOCK
                if($simcard == "new prepaid user"){
                      $Reduce = $_SESSION['Simcard_Limit'];
                      $Reduce = (int)$Reduce;
                      $Reduce =  $Reduce - 1;
                      $_SESSION['Simcard_Limit']=$Reduce;
                      $Reduce = (string) $Reduce;
                      $selleremail = $_SESSION['SellerEmail'];
                      $limitdown ="UPDATE seller SET Simcard_Limit='$Reduce' WHERE selleremail='$selleremail';";
                      mysqli_query($conn,$limitdown);
                }
                //UNSET NSO
                unset($_SESSION['passportnumber']);
                header("Location: ../duplicate-sim-passport-verify.php?signup=success");
          }
      }
    }
  }
