<?php

include_once "dbh.inc.php";
session_start();


if(isset($_POST['register'])){

        date_default_timezone_set('Asia/Manila');
        $timeImg  = date('G')."_".date('i')."_".date('s');

        $simnum   = mysqli_real_escape_string($conn, $_POST['simnum']);
        $nso = $_SESSION['nsonumber'];
        $query = "SELECT * FROM nso_dummy_db WHERE nsonum =  '$nso';";
        $result = mysqli_query($conn,$query);        
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
        $offense_count ="0";                                            // offense_count
        
        
        //CHECK IF DATA EXIST AND SIMTYPE IS ALREADY EXIST)
        $simnumber = "+63".$simnum;                                     
        $sqlnso = "SELECT simnum FROM foreign_registered_simusers_db WHERE simnum = '$simnumber';";
        $result = mysqli_query($conn, $sqlnso);
        $resultsCheck = mysqli_num_rows($result);
        if($resultsCheck >= 1){ //check
            header("Location: ../register-users-local.php?error=simnum-already-exist");
            exit();
        }
        //CHECKING IF NUM EXIST IN LOCAL DB

        $sqlnso = "SELECT simnum FROM local_registered_simusers_db WHERE simnum = '$simnumber';";
        $result = mysqli_query($conn, $sqlnso);
        $resultsCheck = mysqli_num_rows($result);
        
        if($resultsCheck == 1){ //check
                header("Location: ../register-duplicate-sim-local.php?error=simnum-already-exist");
        }else{ 
          //PANG SEND NG DATA , ETO YUNG QUER
                $sql = "INSERT INTO request_reg_db (lastname, firstname, midname, suffix, dateofbirth, gender, passnum_nsonum,address,nationality,simcard,simnum,services, remarks, regisite, dateofregis, time,fingerprint_File_Format,fingerprint_File_Name,sim_retailer,sim_shop,sim_status,ban_start,ban_end,offense_count,nsopass_pic,link_nsopass_pic,id_pic,link_id_pic) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        
        //ERROR HANDLERS: maxlimit
                if($simcard == "new prepaid user"){
                  if($_SESSION['Simcard_Limit'] <= 0){
                    header("Location: ../register-users-local.php?error=maxlimit");
                    exit();
                  }
                }
            
           $stmt = mysqli_stmt_init($conn);
         
           if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "SQL statement failed";
            }else{
                  //CHECKING FOR NON-INT
                  if(!preg_match("/^[0-9]*$/", $simnum)){ 
                        header("Location: ../register-duplicate-sim-local.php?error=wrongchars");
                        exit();
                  }
                  //COUNTING NUMBER LENGTH
                  $countnumber = strlen($simnum);
                  if($countnumber != 10){
                        header("Location: ../register-duplicate-sim-local.phpp?error=incorrectNum"); //error for wrong count
                        exit();
                  }

                  //FUNCTION ERROR HANDLERS FOR IMAGE                         //Keanu_NSO_01234_3-43
                          function ImageCheck($allowed,$fileActualExt,$fileExt,$FullName,$fileError,$fileSize){
                                    if($fileSize == 0){
                                      header("Location: ../register-duplicate-sim-local.php?imageempty");
                                      exit();
                                    }else if (!in_array($fileActualExt,$allowed)){
                                      header("Location: ../register-duplicate-sim-local.php?imageformaterror");
                                      exit();
                                    }else if ($fileSize>20000000000){
                                      header("Location: ../register-duplicate-sim-local.php?imagelarge");
                                      exit();
                                    }else if($fileError !== 0){
                                      header("Location: ../register-duplicate-sim-local.phpimageerror"); 
                                    }else{
                                      $ImageFullName = $FullName.".".$fileActualExt; //Keanu_NSO_01234_3-43.jpg
                                      return $ImageFullName;
                                    }
                            }
                
                          

                /// NSO Image Process
                  $NSOfile              = $_FILES['NSOfile'];
                        $fileName       = $NSOfile["name"];
                        $fileType       = $NSOfile["type"];
                        $NSOfileTempName   = $NSOfile["tmp_name"];              //IMPORTANT
                        $fileError         = $NSOfile["error"];
                        $fileSize          = $NSOfile["size"];
                        $allowed           = array("jpg","jpeg","png","bmp");
                        //conversion          jpg
                        $fileExt           = explode(".",$fileName); //JPG
                        $fileActualExt     = strtolower(end($fileExt)); //jpg
                        $NSOName       = $lastN."_NSO_".$passnum_nsonum.$timeImg;                           //nsopass_pic
                  $NSOExt = ImageCheck($allowed,$fileActualExt,$fileExt,$NSOName,$fileError,$fileSize);     //link_nsopass_pic

                    /// IMAGE FINGERPRINT
                $Fingerfile                 = $_FILES['Fingerfile'];
                      $fileName             = $Fingerfile["name"];
                      $fileType             = $Fingerfile["type"];
                      $FingerfileTempName   = $Fingerfile["tmp_name"];          //IMPORTANT
                      $fileError            = $Fingerfile["error"];
                      $fileSize             = $Fingerfile["size"];
                      $allowed              = array("jpg","jpeg","png","bmp");
                      //conversion
                      $fileExt        = explode(".",$fileName);
                      $fileActualExt  = strtolower(end($fileExt));
                      $FingerName     = $lastN."_Finger_".$passnum_nsonum.$timeImg;                         //fingerprint_File_Name
                $FingerExt = ImageCheck($allowed,$fileActualExt,$fileExt,$FingerName,$fileError,$fileSize); //fingerprint_File_Format


                /// VALID ID
                  $IDfile               = $_FILES['IDfile'];                //file mismo
                        $fileName       = $IDfile["name"];                  //fileNAME
                        $fileType       = $IDfile["type"];                  //Type
                        $IDfileTempName   = $IDfile["tmp_name"];            //tempname    IMPORTANT
                        $fileError      = $IDfile["error"];                 //error
                        $fileSize       = $IDfile["size"];                  //size
                        $allowed        = array("jpg","jpeg","png","bmp");  
                        //conversion
                        $fileExt        = explode(".",$fileName);       
                        $fileActualExt  = strtolower(end($fileExt));
                        $IDName = $lastN."_ID_".$passnum_nsonum.$timeImg;                              // id_pic
                  $IDExt = ImageCheck($allowed,$fileActualExt,$fileExt,$IDName,$fileError,$fileSize);  // link_id_pic
                  //$IDExt = Keanu_ID_01234_3-43.jpg



                $simnum = "+63". $simnum;   //DAPAT ANDITO LANG TONG SIMNUM+63 PARA DI MAGERROR HANDLER                                   
                mysqli_stmt_bind_param($stmt,"ssssssssssssssssssssssssssss",  $lastN, $firstN, $midN, $sfx, $dob, $gndr, $passnum_nsonum,$address,$nationality,$simcard, $simnum, $remarks, $services, $regisite, $dateofregis,$time, $FingerExt , $FingerName,$sim_retailer,$sim_shop,$sim_status,$ban_start,$ban_end,$offense_count,$NSOName,$NSOExt,$IDName,$IDExt);
                mysqli_stmt_execute($stmt);                                   //      //      //      //    //    //          //          //        //            //     //        //            //          //     //            //          //          //       //         //         //          //           //     //       //     //
                $result = mysqli_stmt_get_result($stmt);

                //MOVING FILES
                $FingerfileDestination = '../Fingerprint_Registered_User_Database/'.$FingerExt; //kung saan move yung fingerprint sa folder. dapat same yung folder name. ikaw na bahala
                $NSOfileDestination    = '../NSO_User_Database/'.$NSOExt;
                $IDfileDestination     = '../ID_User_Database/'. $IDExt;
                
                move_uploaded_file($FingerfileTempName,$FingerfileDestination);  //imomove na yung file to that folder
                move_uploaded_file($NSOfileTempName,$NSOfileDestination);
                move_uploaded_file($IDfileTempName,$IDfileDestination);

                //IF NEW PREPAID, DECREASE SIM RETAILER STOCK
                if($simcard == "new prepaid user"){
                      $Reduce = $_SESSION['Simcard_Limit']; //9
                      $Reduce = (int)$Reduce;  //9 inter
                      $Reduce =  $Reduce - 1;  //9-1; 
                      $_SESSION['Simcard_Limit']=$Reduce;
                      $Reduce = (string) $Reduce;
                      $selleremail = $_SESSION['SellerEmail'];
                      $limitdown ="UPDATE seller SET Simcard_Limit='$Reduce' WHERE selleremail='$selleremail';";
                      include '../dbh/Updating_SellerAdmin.inc.php';
                      mysqli_query($TRY,$limitdown);  
                }
                //UNSET NSO
                unset($_SESSION['nsonumber']);
                header("Location: ../duplicate-nso-verify.php?signup=success");
          }  
      }
    }
}
