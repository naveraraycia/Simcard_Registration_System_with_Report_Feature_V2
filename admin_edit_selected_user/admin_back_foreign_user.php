<?php

    include_once "../includes/dbh.inc.php";
    session_start();
    
    
    if(isset($_POST['register'])){
            $simnum   = mysqli_real_escape_string($conn, $_GET['simnum']);
            $simnum = '+'.$simnum;
  $query = "SELECT n.lastname as lastname, n.firstname as firstname, n.midname as midname, n.suffix as suffix, n.dateofbirth as dateofbirth, 
                      n.gender as gender, n.passnum as passnum, l.sim_status as sim_status, l.offense_count as offense_count, l.ban_start as ban_start, 
                      l.ban_end as ban_end, l.address as address, l.simcard as simcard, l.simnum as simnum, l.services as servies, 
                      l.dateofreg as dateofreg, l.sim_retailer as sim_retailer, l.sim_shop as sim_shop , l.regisite as regisite, 
                      l.fingerprint_File_Format as finger_pic, l.link_passport_pic as passport_pic, n.nationality as nationality
               FROM foreign_registered_simusers_db AS l LEFT JOIN foreign_passport_db as n ON  l.passnum = n.passnum
              WHERE l.simnum = '$simnum'; ";

            $result = mysqli_query($conn,$query);
            if (mysqli_num_rows($result) > 0) {
                  //  GET DATA OF USER FROM NSO
                  foreach ($result as $row) {
                        $finger_old = $row['finger_pic'];
                        $nso_old    = $row['passport_pic'];
                        $ban_end_old    = $row['ban_end'];
                        $ban_start_old  = $row['ban_start'];
                        $lastN          = $row['lastname'];
                        $passnum = $row['passnum'];
                        
                   }
            // ADDED DATA
            date_default_timezone_set('Asia/Manila');
            $time  = date('G').":".date('i').":".date('s');
            $timeImg  = date('G')."_".date('i')."_".date('s')."_".date('Y-m-d');
            echo $timeImg;
            $sim_status    = $_POST['sim_status'];
            $offense_count = $_POST['offense_count'];
            $ban_start     = $_POST['ban_start'];
            if(empty($ban_start)){
                $ban_start = $ban_start_old;
            }
            $ban_end       = $_POST['ban_end'];
            if(empty($ban_end)){
                $ban_end = $ban_end_old;
            }
            $address       = $_POST['address'];
            if ($sim_status == 'Active Status' || $sim_status == 'Permanent ban' ){
              $ban_start = "0000-00-00";
              $ban_end   = "0000-00-00";
            }

    
                      //FUNCTION ERROR HANDLERS FOR IMAGE                         //Keanu_NSO_01234_3-43
                              function ImageCheck($allowed,$fileActualExt,$fileExt,$FullName,$fileError,$fileSize,$type){
                                        if($fileSize == 0){
                                            $ImageFullName = $type;
                                            return $ImageFullName;
                                        }else if (!in_array($fileActualExt,$allowed)){
                                          header("Location: ../admin-edit-foreign.php?imageformaterror");
                                          exit();
                                        }else if ($fileSize>20000000000){
                                          header("Location: ../admin-edit-foreign.php?imagelarge");
                                          exit();
                                        }else if($fileError !== 0){
                                          header("Location: ../admin-edit-foreign.php?imageerror"); 
                                        }else{
                                          $ImageFullName = $FullName.".".$fileActualExt; //Keanu_NSO_01234_3-43.jpg
                                          return $ImageFullName;
                                        }
                              }
                    /// NSO Image Process
                      $NSOfile              = $_FILES['Passportfile'];
                            $fileName       = $NSOfile["name"];
                            $fileType       = $NSOfile["type"];
                            $NSOfileTempName   = $NSOfile["tmp_name"];
                            $fileError         = $NSOfile["error"];
                            $fileSize          = $NSOfile["size"];
                            $allowed           = array("jpg","jpeg","png","bmp");
                            //conversion          jpg
                            $fileExt           = explode(".",$fileName); //JPG
                            $fileActualExt     = strtolower(end($fileExt)); //jpg
                            $NSOName       = $lastN."_NSO_".$passnum."_".$timeImg;  //Keanu_NSO_01234_3-43
                      $NSOExt = ImageCheck($allowed,$fileActualExt,$fileExt,$NSOName,$fileError,$fileSize, $nso_old ); 
                      //$NSOExt = Keanu_NSO_01234_3-43.jpg;
        
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
                          $FingerName     = $lastN."_Finger_".$passnum."_".$timeImg;
                    $FingerExt = ImageCheck($allowed,$fileActualExt,$fileExt,$FingerName,$fileError,$fileSize,  $finger_old);
                              //$FingerExt = Keanu_Finger_01234_3-43.jpg
                    //GETTING SHOP DATA AND SETTING FIXED DATA


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
                    $sql = "UPDATE foreign_registered_simusers_db
                    SET sim_status = '$sim_status', offense_count = '$offense_count', ban_start = '$ban_start', ban_end = '$ban_end',
                        address = '$address', fingerprint_File_Format = '$FingerExt', link_passport_pic= '$NSOExt'
                    WHERE passnum = '$passnum';";
                    mysqli_query($conn,$sql);

                    //update related business sims
                    $FingerfileDestination = '../Fingerprint_Registered_User_Database/'.$FingerExt; //kung saan move yung fingerprint sa folder. dapat same yung folder name. ikaw na bahala
                    $NSOfileDestination    = '../NSO_User_Database/'.$NSOExt;
                    $IDfileDestination     = '../ID_User_Database/'. $IDExt;
                    
                    move_uploaded_file($FingerfileTempName,$FingerfileDestination);  //imomove na yung file to that folder
                    move_uploaded_file($NSOfileTempName,$NSOfileDestination);
                    move_uploaded_file($IDfileTempName,$IDfileDestination);


                    header("Location: ../list-foreign-user-admin.php?updated");
              }  
          
        }
      
    



?>