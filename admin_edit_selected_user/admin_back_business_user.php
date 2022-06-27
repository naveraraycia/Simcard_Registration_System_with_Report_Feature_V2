<?php

    include_once "../includes/dbh.inc.php";
    session_start();


    if(isset($_POST['register'])){
            $simnum   = mysqli_real_escape_string($conn, $_GET['simnum']);
            $simnum = '+'.$simnum;
     $query = "SELECT n.lastname as lastname, n.firstname as firstname, n.midname as midname, n.suffix as suffix, n.dateofbirth as dateofbirth,
                      n.gender as gender, n.nsonum as nsonum, l.sim_status as sim_status, l.offense_count as offense_count, l.ban_start as ban_start,
                      l.ban_end as ban_end, l.address as address, l.simcard as simcard, l.simnum as simnum, l.services as servies,
                      l.dateofreg as dateofreg, l.sim_retailer as sim_retailer, l.sim_shop as sim_shop , l.regisite as regisite,
                      l.link_nso_pic as nso_pic, l.link_id_pic as id_pic, l.link_business_permit as permit_pic, l.link_authletter as letter_pic,
                      l.business_name as business_name, l.num_permit as num_permit, l.business_address as business_address
               FROM business_entity_registered_simusers_db AS l LEFT JOIN nso_dummy_db as n ON  l.nsonum = n.nsonum
               WHERE simnum = '$simnum'; ";

            $result = mysqli_query($conn,$query);
            if (mysqli_num_rows($result) > 0) {
                  //  GET DATA OF USER FROM NSO
                  foreach ($result as $row) {
                        $finger_old = $row['finger'];
                        $id_old     = $row['id_pic'];
                        $nso_old    = $row['nso_pic'];
                        $letter_old    = $row['letter_pic'];
                        $permit_old     = $row['permit_pic'];

                        $bussiness_name_old = $row['business_name'];
                        $ban_end_old    = $row['ban_end'];
                        $ban_start_old  = $row['ban_start'];
                        $lastN          = $row['lastname'];
                        $passnum_nsonum = $row['nsonum'];

                   }
            // ADDED DATA
            date_default_timezone_set('Asia/Manila');
            $time  = date('G').":".date('i').":".date('s');
            $timeImg  = date('G')."_".date('i')."_".date('s')."_".date('Y-m-d');
            echo $timeImg;
            
            $sim_status    = $_POST['sim_status'];
            $offense_count = $_POST['offense_count'];
            $ban_start     = $_POST['ban_start'];
            
            echo $ban_start;
            exit();
            if(empty($ban_start)){
                $ban_start = $ban_start_old;
            }
            $ban_end       = $_POST['ban_end'];
            if(empty($ban_end)){
                $ban_end = $ban_end_old;
            }
            $address       = $_POST['address'];
            $business_name = $_POST['business_name'];
            $business_address = $_POST['business_address'];
            $num_permit       = $_POST['num_permit'];






                      //FUNCTION ERROR HANDLERS FOR IMAGE                         //Keanu_NSO_01234_3-43
                              function ImageCheck($allowed,$fileActualExt,$fileExt,$FullName,$fileError,$fileSize,$type){
                                        if($fileSize == 0){
                                            $ImageFullName = $type;
                                            return $ImageFullName;
                                        }else if (!in_array($fileActualExt,$allowed)){
                                          header("Location: ../register-users-local.php?imageformaterror");
                                          exit();
                                        }else if ($fileSize>20000000000){
                                          header("Location: ../register-users-local.php?imagelarge");
                                          exit();
                                        }else if($fileError !== 0){
                                          header("Location: ../register-users-local.php?imageerror");
                                        }else{
                                          $ImageFullName = $FullName.".".$fileActualExt; //Keanu_NSO_01234_3-43.jpg
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
                            //conversion          jpg
                            $fileExt           = explode(".",$fileName); //JPG
                            $fileActualExt     = strtolower(end($fileExt)); //jpg
                            $NSOName       = $lastN."_NSO_".$passnum_nsonum."_".$timeImg;  //Keanu_NSO_01234_3-43
                      $NSOExt = ImageCheck($allowed,$fileActualExt,$fileExt,$NSOName,$fileError,$fileSize, $nso_old );
                      //$NSOExt = Keanu_NSO_01234_3-43.jpg;

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
                            $IDName = $lastN."_ID_".$passnum_nsonum."_".$timeImg;
                      $IDExt = ImageCheck($allowed,$fileActualExt,$fileExt,$IDName,$fileError,$fileSize, $id_old );
                      //$IDExt = Keanu_ID_01234_3-43.jpg
                    /// IMAGE FINGERPRINT
                    $Fingerfile                 = $_FILES['Fingerfile'];
                          $fileName             = $Fingerfile["name"];
                          $fileType             = $Fingerfile["type"];
                          $FingerfileTempName   = $Fingerfile["tmp_name"];
                          $fileError            = $Fingerfile["error"];
                          $fileSize             = $Fingerfile["size"];
                          $allowed              = array("jpg","jpeg","png","bmp");
                          //conversion
                          $fileExt        = explode(".",$fileName);
                          $fileActualExt  = strtolower(end($fileExt));
                          $FingerName     = $lastN."_Finger_".$passnum_nsonum."_".$timeImg;
                    $FingerExt = ImageCheck($allowed,$fileActualExt,$fileExt,$FingerName,$fileError,$fileSize,  $finger_old);
                              //$FingerExt = Keanu_Finger_01234_3-43.jpg
                    //GETTING SHOP DATA AND SETTING FIXED DATA
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
                    $PermitName     = $lastN."_Permit_".$passnum_nsonum.$timeImg;
                $PermitExt = ImageCheck($allowed,$fileActualExt,$fileExt,$PermitName,$fileError,$fileSize,  $permit_old);

                $Authorfile               = $_FILES['Authorfile'];
                        $fileName                 = $Authorfile["name"];
                        $fileType                 = $Authorfile["type"];
                        $AuthorfileTempName       = $Authorfile["tmp_name"];
                        $fileError                = $Authorfile["error"];
                        $fileSize                 = $Authorfile["size"];
                        $allowed                  = array("jpg","jpeg","png","bmp");
                        //conversion
                        $fileExt        = explode(".",$fileName);
                        $fileActualExt  = strtolower(end($fileExt));
                        $AuthorName = $lastN."_Author_".$passnum_nsonum.$timeImg;
                  $AuthorExt = ImageCheck($allowed,$fileActualExt,$fileExt,$AuthorName,$fileError,$fileSize,  $letter_old);

                    echo     $sim_status;
                    echo   "<br>";
                    echo     $offense_count;
                    echo   "<br>";
                    echo     $ban_start;
                    echo   "<br>";
                    echo     $ban_end;
                    echo   "<br>";
                    echo     $address;
                    echo   "<br>";
                    echo     $FingerExt;
                    echo   "<br>";
                    echo     $IDExt;
                    echo   "<br>";
                    echo     $NSOExt;

                    //update local
                    $sql = "UPDATE local_registered_simusers_db
                            SET sim_status = '$sim_status', offense_count = '$offense_count', ban_start = '$ban_start', ban_end = '$ban_end',
                                address = '$address', fingerprint_File_Format = '$FingerExt', link_nsopass_pic= '$NSOExt',
                                link_id_pic = '$IDExt'
                            WHERE nsonum = '$passnum_nsonum';";
                    mysqli_query($conn,$sql);

                    //update related business sims
                    $sql = "UPDATE business_entity_registered_simusers_db
                            SET sim_status = '$sim_status', offense_count = '$offense_count', ban_start = '$ban_start', ban_end = '$ban_end',
                                link_nso_pic= '$NSOExt', link_id_pic = '$IDExt', link_business_permit='$PermitExt' , link_authletter ='$AuthorExt',
                                address = '$address', business_name = '$business_name', num_permit = '$num_permit', business_address = '$business_address',
                                fingerprint_File_Format = '$FingerExt'
                            WHERE nsonum = '$passnum_nsonum';";
                    mysqli_query($conn,$sql);


                    $FingerfileDestination = '../Fingerprint_Registered_User_Database/'.$FingerExt; //kung saan move yung fingerprint sa folder. dapat same yung folder name. ikaw na bahala
                    $NSOfileDestination    = '../NSO_User_Database/'.$NSOExt;
                    $IDfileDestination     = '../ID_User_Database/'. $IDExt;
                    $AuthfileDestination    = '../Endoresement_Database/'.$AuthorExt;
                    $PermitfileDestination     = '../Permit_Database/'. $PermitExt;

                    move_uploaded_file($FingerfileTempName,$FingerfileDestination);  //imomove na yung file to that folder
                    move_uploaded_file($NSOfileTempName,$NSOfileDestination);
                    move_uploaded_file($IDfileTempName,$IDfileDestination);
                    move_uploaded_file($AuthorfileTempName,$AuthfileDestination);
                    move_uploaded_file($PermitTempName,$PermitfileDestination);


                    header("Location: ../list-busent-user-admin.php?updated");
              }

        }





?>
