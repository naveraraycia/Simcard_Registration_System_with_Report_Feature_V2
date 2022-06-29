<?php

include_once "../includes/dbh.inc.php";
//
	if(isset($_GET['request'])) {

  $simnum = $_GET['request'];
  $simnum = '+'.$simnum;
    $sql = "SELECT * FROM request_reg_db
    WHERE simnum = '$simnum';";
    $result = mysqli_query($conn,$sql);
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    while($row = mysqli_fetch_assoc($result)):
        $simnum =      $row['simnum'];
        $lastname =    $row['lastname'];
        $firstname =   $row['firstname'];
        $midname =     $row['midname'];
        $suffix =      $row['suffix'];
        $simcard =     $row['simcard'];
        $services =    $row['services'];
        $nsonum =      $row['passnum_nsonum'];
        $address =     $row['address'];
        $gender =      $row['gender'];
        $dateofbirth = $row['dateofbirth'];
        $regisite =    $row['regisite'];
        $sim_shop =      $row['sim_shop'];
				$pwd = $row['userpwd'];
        $sim_retailer=             $row['sim_retailer'];
        $dateofregis =             $row['dateofregis'];
        $time =                    $row['time'];
        $FingerName  =             $row['fingerprint_File_Name'];
        $FingerExt   =             $row['fingerprint_File_Format'];
        $NSOName          =        $row['nsopass_pic'];
        $NSOExt           =        $row['link_nsopass_pic'];
        $IDName           =        $row['id_pic'];
        $IDExt            =        $row['link_id_pic'];
    endwhile;


    $sql ="SELECT COUNT(nsonum) as cout FROM local_registered_simusers_db WHERE nsonum = '$nsonum';";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_num_rows($result);
    foreach($result as $row){
           $counts = $row['cout'];
    }
    if(($counts)>=5){
       header("Location: ../additional-local-request.php?alreadyexceed");
       exit();
    }
    $offense_count = "0";
    $sim_status    = "Active Status";
    $ban_start     = "0000-00-00";
    $ban_end       = "0000-00-00";


   $checkstatus = "SELECT sim_status, ban_start, ban_end, offense_count, nsonum
           FROM local_registered_simusers_db
           WHERE nsonum = '$nsonum';";
    $result = mysqli_query($conn,$checkstatus);
    $resultCheck = mysqli_num_rows($result);
    while($row = mysqli_fetch_assoc($result)):
           $nsonum =      $row['nsonum'];
           $ban_end =   $row['ban_end'];
           $ban_start   =   $row['ban_start'];
           $offense_count = $row['offense_count'];
           $sim_status = $row['sim_status'];
    endwhile;

    $stmt = mysqli_stmt_init($conn);
    $sql = "INSERT INTO local_registered_simusers_db (
        sim_status, simnum, userpwd, simcard, services, dateofreg, address,
        sim_retailer, sim_shop, regisite, fingerprint_File_Format, fingerprint_File_Name,
        nsonum, nsopass_pic, link_nsopass_pic, id_pic, link_id_pic,
        offense_count, ban_start,  ban_end)
    VALUES ('$sim_status', '$simnum', '$pwd', ' $simcard', '$services', '$dateofregis', '$address',
            '$sim_retailer', '$sim_shop', '$regisite', '$FingerExt', '$FingerName',
            '$nsonum', '$NSOName', '$NSOExt', '$IDName', '$IDExt',
            '$offense_count', '$ban_start', '$ban_end');";
    mysqli_query($conn, $sql);

    $updatesql = "UPDATE local_registered_simusers_db
                  SET fingerprint_File_Format = '$FingerExt', link_nsopass_pic = '$NSOExt', link_id_pic = '$IDExt', address = '$address'
                  WHERE nsonum = '$nsonum';";
    mysqli_query($conn, $updatesql);
    //DELETE THAT  REQUEST
    $sql = "DELETE FROM request_reg_db
    WHERE simnum = '$simnum';";
    mysqli_query($conn, $sql);
    date_default_timezone_set('Asia/Manila');
    $today = date("Y-m-d");
    $remark = "The simcard you requested has been approved";
    $notificationsql = "INSERT INTO notification_db(
                        simnum, status, remark, shop_name, date_approve, nsonum, service)
                VALUES('$simnum','approved','$remark','$sim_shop','$today','$nsonum','$services');";
    mysqli_query($conn, $notificationsql);
    header("Location: ../additional-local-request.php?localapproved");

} else {


}
?>
