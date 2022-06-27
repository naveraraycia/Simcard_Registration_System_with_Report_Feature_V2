<?php
    function checkPenalty($conn,$passport){
        $sql ="SELECT * FROM foreign_registered_simusers_db
         WHERE passnum = '$passport';";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_num_rows($result);
        if($row>=5){
            $exceed = true;
        }else{
            $exceed = false;
        }
        return $exceed;
    }


    function checkban($conn,$passport){
        $sql ="SELECT sim_status, offense_count, ban_start, ban_end FROM foreign_registered_simusers_db
               WHERE passnum = '$passport';";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_num_rows($result);
        foreach($result as $row){

            $offense_count = $row['offense_count'];
            $sim_status    = $row['sim_status'];
            $ban_start     = $row['ban_start'];
            $ban_end       = $row['ban_end'];

            if($offense_count < 2){
                if($sim_status == "Active Status"){
                    return false;
                }else{
                    date_default_timezone_set('Asia/Manila');
                    $ban_end2 = substr($ban_end, 0,4); // 2022
                    $datetoday = (int)date('Y');
        
                    if($datetoday >= $ban_end2){
                        $datetoday = (int)date('m');
                        $ban_end3 = substr($ban_end, 5,2);

                        if($datetoday >= $ban_end3){
                            $datetoday = (int)date('d');
                            $ban_end4  = substr($ban_end, 8, 2);

                            if($datetoday > $ban_end4){
                              $updateban = "UPDATE foreign_registered_simusers_db SET ban_start='0000-00-00', ban_end='9999-12-30', sim_status='Active Status' WHERE passnum='$passport';"; 
                              mysqli_query($conn,$updateban); 
                              return "notban";
                            }else{

                                return "secban";
                            }
                        }else{
                            return "thban";
                        }
                    }else{
                        return "fsban";
                  }
                }
            }else{
                return "permanentban";
            }
        }
    }
?>
