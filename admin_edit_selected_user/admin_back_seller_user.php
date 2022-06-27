<?php

    include_once "../includes/dbh.inc.php";
    session_start();
    
    
    if(isset($_POST['register'])){
            $simnum   = mysqli_real_escape_string($conn, $_GET['simnum']);
            $simnum = '+'.$simnum;
            $query = "SELECT s.Shop_Name AS shop_name,
                            s.selleremail AS selleremail,
                            rg.lastname as lastname, rg.firstname as firstname, rg.midname as midname,
                            rg.suffix as suffix,
                            s.Business_Permit as business_permit,
                            s.Business_Address as business_address,
                            s.Simcard_Limit AS simcard_limit,
                            s.link_permit_pic AS link_permit_pic,
                            s.link_nsopass_pic as link_nsopass_pic, s.address as address,
                            s.link_id_pic as link_id_pic, s.owner_num as owner_num,
                            s.dateofreg as dateofreg,    n.nsonum as nsonum, s.seller_nso as seller_nso
                    FROM seller as s LEFT JOIN local_registered_simusers_db as n ON s.owner_num = n.simnum
   					LEFT JOIN nso_dummy_db as rg ON n.nsonum = rg.nsonum
                     WHERE simnum = '$simnum';";

            $result = mysqli_query($conn,$query);
            if (mysqli_num_rows($result) > 0) {
                  //  GET DATA OF USER FROM NSO
                  foreach ($result as $row) {
                        $id_old     = $row['link_id_pic'];
                        $nso_old    = $row['link_nsopass_pic'];
                        $permit_old = $row['link_permit_pic'];
                        $ban_end_old    = $row['ban_end'];
                        $ban_start_old  = $row['ban_start'];
                        $lastN          = $row['lastname'];
                        $passnum_nsonum = $row['seller_nso'];
                        
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
            $shop_name     = $_POST['shop_name'];
            $selleremail   = $_POST['selleremail'];
            $shop_address  = $_POST['shop_address'];
            $sim_limit     = $_POST['Sim_Limit'];
            $num_permit    = $_POST['num_permit'];


                    


    
                      //FUNCTION ERROR HANDLERS FOR IMAGE                         //Keanu_NSO_01234_3-43
                              function ImageCheck($allowed,$fileActualExt,$fileExt,$FullName,$fileError,$fileSize,$type){
                                        if($fileSize == 0){
                                            $ImageFullName = $type;
                                            return $ImageFullName;
                                        }else if (!in_array($fileActualExt,$allowed)){
                                          header("Location: ../admin-edit-seller.php?imageformaterror");
                                          exit();
                                        }else if ($fileSize>20000000000){
                                          header("Location: ../admin-edit-seller.php?imagelarge");
                                          exit();
                                        }else if($fileError !== 0){
                                          header("Location: ../admin-edit-seller.php?imageerror"); 
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
                    $PermitExt = ImageCheck($allowed,$fileActualExt,$fileExt,$PermitName,$fileError,$fileSize, $permit_old);

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
                    
                    


                    $sql = "UPDATE seller 
                    SET Shop_Name = '$shop_name', selleremail = '$selleremail', Business_Permit = '$num_permit', Business_Address = '$shop_address',
                        Simcard_Limit = '$sim_limit', address = '$address', link_nsopass_pic = '$NSOExt', link_id_pic = '$IDExt', link_permit_pic = '$PermitExt'
                    WHERE seller_nso = '$passnum_nsonum';";

                    mysqli_query($conn, $sql);

                    $NSOfileDestination    = '../NSO_User_Database/'.$NSOExt;
                    $IDfileDestination     = '../ID_User_Database/'. $IDExt;
                    $PermitfileDestination     = '../Permit_Database/'. $PermitExt;
                    
                      //imomove na yung file to that folder
                    move_uploaded_file($NSOfileTempName,$NSOfileDestination);
                    move_uploaded_file($IDfileTempName,$IDfileDestination);
                    move_uploaded_file($PermitTempName,$PermitfileDestination);

                    header("Location: ../list-sim-retailer-admin.php?updated");
              }  
          
        }
      
    



?>