<?php

include_once "../includes/dbh.inc.php";

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
        $sim_shop =    $row['sim_shop']; 
        $sim_retailer= $row['sim_retailer']; 
        $dateofregis = $row['dateofregis']; 
        $time =        $row['time']; 
        $FingerName  =             $row['fingerprint_File_Name'];
        $FingerExt   =             $row['fingerprint_File_Format']; 
        $NSOName          =        $row['nsopass_pic'];
        $NSOExt           =        $row['link_nsopass_pic']; 
        $IDName           =        $row['id_pic'];
        $IDExt            =        $row['link_id_pic'];
    endwhile;

    $sim_status = "Active Status";
    $ban_start = "--";
    $ban_end = "--";
    $offense_count ="0";
    $stmt = mysqli_stmt_init($conn);
    $sql = "INSERT INTO local_registered_simusers_db (
        sim_status, simnum, simcard, services, dateofreg, address,
        sim_retailer, sim_shop, regisite, fingerprint_File_Format, fingerprint_File_Name,
        nsonum, nsopass_pic, link_nsopass_pic, id_pic, link_id_pic, 
        offense_count, ban_start,  ban_end)
    VALUES ('$sim_status', '$simnum', ' $simcard', '$services', '$dateofregis', '$address', 
            '$sim_retailer', '$sim_shop', '$regisite', '$FingerExt', '$FingerName', 
            '$nsonum', '$NSOName', '$NSOExt', '$IDName', '$IDExt', 
            '$offense_count', '$ban_start', '$ban_end');";
    mysqli_query($conn, $sql);

    //DELETE THAT  REQUEST
    $sql = "DELETE FROM request_reg_db
    WHERE simnum = '$simnum';";
    mysqli_query($conn, $sql);
    header("Location: ../additional-local-request.php?localapproved");

} else {

  //
}
?>  