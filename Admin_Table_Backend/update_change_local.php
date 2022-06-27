<?php 

require '../includes/dbh.inc.php';


  $id = mysqli_real_escape_string($conn, $_GET['id']);
  $type_address = mysqli_real_escape_string($conn, $_POST['newaddress']);
  $nation  = mysqli_real_escape_string($conn, $_GET['nation']);

    if($nation == 'filipino'){
  //UPDATE LOCAL DATABASE
                $sql = " SELECT  q.user_id as user_id, n.lastname as lastname, n.firstname as firstname, n.midname as midname, q.dates as dates,
                                l.simnum as simnum, q.update_req as update_req, q.message as message, q.nsopass_pic as nso_link, l.nsonum as nsonum
                        FROM update_user_db AS q LEFT JOIN local_registered_simusers_db AS l ON q.simnum = l.simnum
                        LEFT JOIN nso_dummy_db AS n ON l.nsonum = n.nsonum
                        WHERE l.simnum IS NOT NULL AND q.user_id ='$id';";
                            $result = mysqli_query($conn,$sql);
                            $resultCheck = mysqli_num_rows($result);
                            while($row = mysqli_fetch_assoc($result)):
                                        $id = $row['user_id'];
                                        $name    = $row['firstname']." ". $row['midname']." ". $row['lastname'];
                                        $simnum  = $row['simnum'];
                                        $update  = $row['update_req'];
                                        $message = $row['message'];
                                        $nso_link= $row['nso_link'];
                                        $nsonum = $row['nsonum'];
                            endwhile;  

                            $sql = "UPDATE local_registered_simusers_db
                            SET address = '$type_address',  link_nsopass_pic = '$nso_link'
                            WHERE nsonum = '$nsonum'";
                            mysqli_query($conn, $sql);


                            //UPDATE BUSINESS ENTITY DATABASE            
                            $sql = "UPDATE business_entity_registered_simusers_db
                            SET address = '$type_address',  link_nso_pic = '$nso_link'
                            WHERE nsonum = '$nsonum'";
                            mysqli_query($conn, $sql);
                            $delete_request = "DELETE FROM update_user_db WHERE  user_id ='$id'";
                            mysqli_query($conn, $delete_request);
                            header("Location: ../info-upd-localfor.php?successlocal");
                            exit();
    
    //IF NOT FILIPINO
    }elseif($nation=='notfilipino'){
            //UPDATE FOREIGN
            $FirstOff ="SELECT q.user_id as user_id, n.lastname as lastname, n.firstname as firstname, n.midname as midname, q.dates as dates, l.passnum as passnum,
                               l.simnum as simnum, q.update_req as update_req, q.message as message, q.nsopass_pic as nso_link
                        FROM update_user_db AS q LEFT JOIN foreign_registered_simusers_db AS l ON q.simnum = l.simnum
                        LEFT JOIN foreign_passport_db AS n ON l.passnum = n.passnum
                        WHERE l.simnum IS NOT NULL AND q.user_id ='$id';";
            $result = mysqli_query($conn,$FirstOff);
            $resultCheck = mysqli_num_rows($result);
            while($row = mysqli_fetch_assoc($result)):
                      $user_id = $row['user_id'];
                      $name    = $row['firstname']." ". $row['midname']." ". $row['lastname'];
                      $simnum  = $row['simnum'];
                      $update  = $row['update_req'];
                      $message = $row['message'];
                      $nso_link= $row['nso_link'];
                      $passnum = $row['passnum'];
            endwhile;  
            $sql = "UPDATE foreign_registered_simusers_db
            SET address = '$type_address',  link_passport_pic = '$nso_link', passport_pic = '$nso_link'
            WHERE passnum = '$passnum'";
            mysqli_query($conn, $sql);
            $delete_request = "DELETE FROM update_user_db WHERE  user_id ='$user_id'";
             mysqli_query($conn, $delete_request);
            header("Location: ../info-upd-foreign.php?successforeign");
            exit();
    }

?>