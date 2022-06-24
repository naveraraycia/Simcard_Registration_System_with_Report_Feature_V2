<?php
  require 'includes/dbh.inc.php';

  $id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT r.reported_number as reported_number, COALESCE(p.lastname,NULL, n.lastname ) AS Reported_Last_Name , 
  COALESCE(p.firstname,NULL, n.firstname ) AS Reported_First_Name, 
              COALESCE(a.simnum, NULL , b.simnum) AS Complainant_sim_num, 
              COALESCE(d.lastname,NULL,e.lastname) AS Complainant_first_name,
              COALESCE(d.firstname,NULL,e.firstname) AS Complainant_last_name,
              COALESCE(n.nsonum,NULL, f.passnum) AS num_serial,
              r.reported_number as reported_number, r.report_id as report_id,
              r.remarks as remarks, r.sent_at as sent_at, r.Report_Screenshot as Report_Screenshot
   FROM report_messages_db as r LEFT JOIN local_registered_simusers_db as l ON r.reported_number = l.simnum 
   LEFT JOIN foreign_registered_simusers_db as f ON r.reported_number = f.simnum 
                 LEFT JOIN nso_dummy_db as n ON l.nsonum = n.nsonum 
                 LEFT JOIN foreign_passport_db as p ON f.passnum = p.passnum 
                 LEFT JOIN local_registered_simusers_db as a ON r.user_mobile_num = a.simnum 
                 LEFT JOIN foreign_registered_simusers_db as b ON r.user_mobile_num = b.simnum
                 LEFT JOIN nso_dummy_db as d ON a.nsonum = d.nsonum 
                 LEFT JOIN foreign_passport_db as e ON b.passnum = e.passnum 
   WHERE r.report_id = '$id';";
       $result = mysqli_query($conn,$sql);

       while($row = mysqli_fetch_assoc($result)):
        $report_id = $row['report_id'];
        $data = $row['sent_at'];
        $username = $row['Complainant_first_name']." ".$row['Complainant_last_name'];
        $simnum = $row['Complainant_sim_num'];
        $reportednum = $row['reported_number'];
        $reportedname =  $row['Reported_First_Name']." ".$row['Reported_Last_Name'];
        $remarks = $row['remarks'];
        $sent_at = $row['sent_at'];
        $viewscreenshot = $row['Report_Screenshot'];
        $serial = $row['num_serial'];
        $picture = $row['Report_Screenshot'];
       endwhile;
      if (empty($serial)|| $serial == ''){
        $reportedname = 'THIS NUMBER IS NOT REGISTERED';
        $reportedtrue = 'notexist';
        
      }else{
        $reportedtrue = 'exist';
      }
      
?>
<!-- <?php


?> -->

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />

  <title>SimCardRegistrationSystem</title>
  <!-- LOGO ON TAB -->
  <link rel="icon" href="images/logo.png">
  <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;700&display=swap" rel="stylesheet">
  <!-- CDN CSS FILE BOOTSTRAP VER 4.6 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

  <!-- CUSTOM CSS FILE  -->
  <link rel="stylesheet" href="styles/admin-tables-style.css">
  <!-- FONT AWESOME -->
  <script src="https://kit.fontawesome.com/207a28b81e.js" crossorigin="anonymous"></script>


<style>

/* BUTTONS */
.send-btn {
  background-color: #b40032;
  color: white;
  font-weight: bold;
  width: 100%;
  height: 40px;
  border-radius: 6px 6px 6px 6px;
  position: relative;
  margin-top: 1rem;
  margin-bottom: 2rem;
  border-width: 0;
}

.send-btn:hover {
  background-color:#dc3664;
  cursor: pointer;
  color: white;
}

p{
  line-height: 200%;
}

.nameLabel{
  font-weight: bold;
  color:  #b40032;
}

.nameLabel span{
  font-weight: normal;
  color: black;
}


</style>
</head>
  <body style="background-color: white;">
    <!-- NAVBAR PART -->
    <header>

            <nav class="navbar navbar-expand-lg">
              <a class="div1 navbar-brand" href="admin-home.php">
                  <img src="images/logo.png" width="30" height="32" class="d-inline-block align-top" alt="">
                  <span class="brandname">Administrator: Globe Telecomms</span>
                </a>

              <button class="custom-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarNav">


                <ul class='navbar-nav'>
                  <li class='nav-item'>
                    <a class='nav-link selected' href='admin-home.php'>Home</a>
                  </li>


                    </ul>

                <form class="form-btnn" action="Logout/logoutprocess_SimRetailer.php" method="POST">
                  <button type="submit" name="btn-primary" class="log-button">Logout</button>
                </form>
              </div>
            </nav>
    </header>


      <!-- MESSAGE PART -->

        <div class="container" style="background-color:#f3f3f3;">
          <div class="row" style="margin-bottom:1rem;">
            <?php
            // require 'includes/dbh.inc.php';
            //
            // $repId = $title = mysqli_real_escape_string($conn, $_GET['id']);
            // $sentAt = mysqli_real_escape_string($conn, $_GET['sent']);
            // $user = mysqli_real_escape_string($conn, $_GET['user']);

          //
            
            // SELECT STATEMENT
            // $sql = "SELECT * FROM report_messages_db WHERE report_id = '$repId' AND sent_at = '$sentAt' AND user_name = '$user';";
            // $result = mysqli_query($conn, $sql);
            // $queryResults = mysqli_num_rows($result);  //checks how many rows are the results
            //
            //
            // if($queryResults > 0 ):
            //   while($row = mysqli_fetch_assoc($result)):
            //     $repNum = $row['reported_number'];
            //     $_GET['reportt'] = $repNum;

                // SELECT STATEMENT
                // $varReport = $_GET['reportt'];
                // echo $varReport;
                // $sqlfind = "SELECT * FROM registered_simusers_db WHERE simnum = '$varReport';";
                // $resultfind = mysqli_query($conn, $sqlfind);
              //  $queryResultsfind = mysqli_num_rows($resultfind);  //checks how many rows are the results

                // if($queryResultsfind > 0 ){
                //   while($rowfind = mysqli_fetch_assoc($resultfind)){
                //     $repName = $rowfind['lastname'];
                //     $_GET['repLastname'] = $repName;
                //     $repFName = $rowfind['firstname'];
                //     $_GET['repFname'] = $repFName;
                //     $repgetNum = $rowfind['simnum'];
                //     $_GET['repNMBR'] = $repgetNum;
                //
                //     $_GET['repLname'] = $repName.' '.$repFName;
                //
                //
                //   }
                // }else {
                //   $_GET['repLname']='Nobody. This number is either not registered or does not exist.';
                //
                // }


            ?>



            <!-- COLUMN 1 NAME AND USER'S CELLPHONE NUMBER -->

            <div class="col-12">
              <div class="infolabels">
                <p class="nameLabel">From: <span> <?php echo $username ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">User's Mobile number: <span><?php echo $simnum ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">Reported Number: <span style="color:#ff5f56;"><?php echo $reportednum ?></span></p>
              </div>
              <div class="infolabels mb-5">
                <p class="nameLabel">According to the database, this reported number belongs to: <span style="color:#ff5f56;"><?php echo $reportedname ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">User Remarks</p>
              </div>
              <div class="infolabels mb-5">
                <p class="lighFontOnly"><?php echo $remarks ?></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">Sent: <span class="lightColFont">2022-05-06<?php //echo $row['sent_at'] ?></span></p>
              </div>

              <div class="row" style="margin-bottom:1rem;display:flex;justify-content:flex-start;">
                <div class="col-12"style="padding-left:0px;margin-right:0px;">
                  <a href='<?php echo 'Admin_Table_Backend/confirmordelete.php?click=confirm&id='.$id.'&serial='.$serial.'&number='.$reportednum.'&reported='.$reportedtrue?>' class="btn btn-success" style="margin-right:10px;margin-bottom:10px;">Confirm</a>
                  <a href='<?php echo 'Admin_Table_Backend/confirmordelete.php?click=deletereport&id='.$id ?>'  class="btn btn-danger" style="margin-bottom:10px;">Delete Message</a>
                </div>
              </div>
              <tr class="canHov" onclick="window.location='report-content.php?id=<?php echo $row['report_id'];?>';">
            </div>

    <?php
    // endwhile;
    // else :
    //   header("Location: report-content.php?error=noUser");
      // header("Location: Sim_Card_Registration_System_Final_Version/reported-message-content.php?error=noUser");
     // endif;
            ?>
          </div>


          <div class="row">
            <div class="col-12">
              <button type="button" name="button" class="send-btn replybtn" data-toggle="modal" data-target="#screenshotModal">View Screenshot</button>
            </div>
        </div>

        <!-- MODAL PART FOR SCREENSHOT -->
        <div class="modal fade" id="screenshotModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reported Message Screenshot</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- ATTACH THE IMAGE LINK HERE -->
                <img class="screenshot-img" src="<?php echo 'Image_Report_Database/'.$viewscreenshot;    ?>" alt="Reported-Screenshot-Place-Here">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        </div>



    </body>

    </html>
