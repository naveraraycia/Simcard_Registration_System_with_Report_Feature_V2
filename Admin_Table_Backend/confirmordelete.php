<?php
    include_once '../includes/dbh.inc.php';
    date_default_timezone_set('Asia/Manila');
    $today = date('Y-m-d');
    function ban_adjust($offense_count, $ban_end){
        if ($offense_count >= 3){
            $return = '0000-00-00';
        }else{
            switch ($offense_count){
                case '0':     // FIRST OFFENSE
                    if($ban_end == '0000-00-00'){
                        $return = date('Y-m-d',(strtotime("+3 months")));
                    }else{
                        $return = date('Y-m-d',strtotime("+3 months", strtotime($ban_end)));

                    }
                    break;

                case '1':
                    if($ban_end == '0000-00-00'){
                        $return = date('Y-m-d',(strtotime("+6 months")));
                    }else{
                        $return = date('Y-m-d',strtotime("+6 months", strtotime($ban_end)));

                    }
                    break;

                case '2':
                    $return = '0000-00-00';
                    exit();
                    echo $return."herse";
                    break;
            }
        }
        return $return;
    }

    function status_adjust($offense_count){
        $status = $offense_count;
        switch ($status){
            case '0':
                $status = 'First offense';
                break;
            case '1':
                $status = 'Second offense';
                break;
            case '3':
                $status = 'Permanent ban';
                break;
        }
        return $status;
    }

    function delete_message($conn){
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "DELETE FROM report_messages_db
               WHERE report_id = '$id' ";
         mysqli_query($conn, $sql);
    }



    $fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if(strpos($fulUrl, "click=confirm") == true){
        $serial = mysqli_real_escape_string($conn, $_GET['serial']);
        $num    = $_GET['number'];
        $report = mysqli_real_escape_string($conn, $_GET['reported']);
        $num = '+'.$num;

        if ($report == 'notexist'){
            header("Location:../admin-report-list.php?notexist");
            exit();
        }

        //CHECK IF EXISTING IN LOCAL IF EXISTING, UPDATE BOTH LOCAL AND WORKING DB
        $sqlnso = "SELECT nsonum FROM nso_dummy_db WHERE nsonum = '$serial';";
        $result = mysqli_query($conn, $sqlnso);
        $resultsCheck = mysqli_num_rows($result);
        if($resultsCheck > 0){

                //UPDATE LOCAL REGISTERED
                $sqlnso = "SELECT nsonum FROM local_registered_simusers_db WHERE nsonum = '$serial';";
                $result = mysqli_query($conn, $sqlnso);
                $resultsCheck = mysqli_num_rows($result);
                if($resultsCheck > 0){ //check
                            $checkcount = "SELECT offense_count, ban_start, ban_end, sim_status FROM local_registered_simusers_db
                                            WHERE simnum = $num;";
                            $result = mysqli_query($conn, $checkcount);
                            $row = mysqli_num_rows($result);
                            foreach($result as $row){
                                $offense_count = $row['offense_count'];
                                $ban_start    = $row['ban_start'];
                                $ban_end       = $row['ban_end'];
                                $sim_status    = $row['sim_status'];
                            }
                            $ban_end   = ban_adjust($offense_count, $ban_end);
                            if($ban_end <> '0000-00-00'){$ban_start = date('Y-m-d');
                            }else{$ban_start = '0000-00-00';}
                            $sim_status = status_adjust($offense_count);
                            if($offense_count >= 3){ $offense_count = 3;
                            }else{$offense_count = $offense_count + 1;}

                            $sql = "UPDATE local_registered_simusers_db
                                    SET sim_status = '$sim_status', ban_start = '$ban_start', ban_end = '$ban_end', offense_count = '$offense_count'
                                    WHERE nsonum = '$serial';";
                            mysqli_query($conn, $sql);
                }

                //UPDATE BUSINESS ENTITY
                $sqlnso = "SELECT nsonum FROM business_entity_registered_simusers_db WHERE nsonum = '$serial';";
                $result = mysqli_query($conn, $sqlnso);
                $resultsCheck = mysqli_num_rows($result);
                if($resultsCheck > 0){ //check
                            $checkcount = "SELECT offense_count, ban_start, ban_end, sim_status FROM business_entity_registered_simusers_db
                                            WHERE simnum = $num;";
                            $result = mysqli_query($conn, $checkcount);
                            $row = mysqli_num_rows($result);
                            foreach($result as $row){
                                $offense_count = $row['offense_count'];
                                $ban_start    = $row['ban_start'];
                                $ban_end       = $row['ban_end'];
                                $sim_status    = $row['sim_status'];
                            }
                            $ban_end   = ban_adjust($offense_count, $ban_end);
                            if($ban_end <> '0000-00-00'){$ban_start = date('Y-m-d');
                            }else{$ban_start = '0000-00-00';}
                            $sim_status = status_adjust($offense_count);
                            if($offense_count >= 3){ $offense_count = 3;
                            }else{$offense_count = $offense_count + 1;}

                            $sql = "UPDATE business_entity_registered_simusers_db
                                    SET sim_status = '$sim_status', ban_start = '$ban_start', ban_end = '$ban_end', offense_count = '$offense_count'
                                    WHERE nsonum = '$serial';";
                            mysqli_query($conn, $sql);
                }
                delete_message($conn);
                header("Location:../admin-report-list.php?success");
                exit();
        }


        //CHECK FOREIGN
        $sqlnso = "SELECT passnum FROM foreign_registered_simusers_db WHERE passnum = '$serial';";
        $result = mysqli_query($conn, $sqlnso);
        $resultsCheck = mysqli_num_rows($result);
        if($resultsCheck > 0){ //check
                $checkcount = "SELECT offense_count, ban_start, ban_end, sim_status FROM foreign_registered_simusers_db
                                WHERE simnum = $num;";
                $result = mysqli_query($conn, $checkcount);
                $row = mysqli_num_rows($result);
                foreach($result as $row){
                    $offense_count = $row['offense_count'];
                    $ban_start    = $row['ban_start'];
                    $ban_end       = $row['ban_end'];
                    $sim_status    = $row['sim_status'];
                }
                $ban_end   = ban_adjust($offense_count, $ban_end);
                if($ban_end <> '0000-00-00'){$ban_start = date('Y-m-d');
                }else{$ban_start = '0000-00-00';}
                $sim_status = status_adjust($offense_count);
                if($offense_count >= 3){ $offense_count = 3;
                }else{$offense_count = $offense_count + 1;}
                $sql = "UPDATE foreign_registered_simusers_db
                        SET sim_status = '$sim_status', ban_start = '$ban_start', ban_end = '$ban_end', offense_count = '$offense_count'
                        WHERE passnum = '$serial';";
                mysqli_query($conn, $sql);
                delete_message($conn);
                header("Location:../admin-report-list.php?success2");
                exit();
        }



    }



    // ADMIN, DELETING REPORT MESSAGES
    if(strpos($fulUrl, "click=deletereport")==true){
        delete_message($conn);
          header("Location:../admin-report-list.php?deleted");
    }

?>
