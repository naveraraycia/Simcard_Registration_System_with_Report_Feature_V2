<?php

    function checkPenalty($conn,$nso_pass){
        $sql ="SELECT * FROM registered_simusers_db
         WHERE passnum_nsonum = '$nso_pass';";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_num_rows($result);
        if($row>5){
            $exceed = true;
        }else{
            $exceed = false;
        }
        return $exceed;
    }

?>
