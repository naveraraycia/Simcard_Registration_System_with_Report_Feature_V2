<?php
  require 'includes/dbh.inc.php';

?>
<!-- <?php
  // session_start();
  // if (empty($_SESSION['SellerFirstName'])){
  //   header("Location: index.php");
  //   exit();
  // }
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
                <p class="nameLabel">SIM Shop Owner: <span>Vincent Mao Talde<?php // echo $row['user_name'] ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">Business Permit #: <span>123-PERMIT-#<?php //echo $row['user_mobile_num'] ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">Data to update: <span>Shop Name<?php //echo $row['reported_number'] ?></span></p>
              </div>
              <div class="infolabels mb-5">
                <p class="nameLabel">Requested update value: <span class="text-primary">SIM Nation<?php // echo $_GET['repLname'];?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">User's Reason for Updating</p>
              </div>
              <div class="infolabels mb-5">
                <p class="lighFontOnly">I changed the name of the shop to SIM Nation earlier in the barangay. Please Update my data<?php// echo $row['remarks'] ?></p>
              </div>

              <div class="row" style="margin-bottom:1rem;display:flex;justify-content:flex-start;">
                <div class="col-12"style="padding-left:0px;margin-right:0px;">
                  <a href="update-retailer-info.php" class="btn btn-success" style="margin-bottom:10px;">Update</a>
                  <a href="#DeleteSpecificReportMessageBackEndHere" class="btn btn-danger" style="margin-bottom:10px;">Delete Message</a>
                </div>
              </div>

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
              <button type="button" name="button" class="send-btn replybtn" data-toggle="modal" data-target="#screenshotModal">View Submitted Proof</button>
            </div>
        </div>

        <!-- MODAL PART FOR SCREENSHOT -->
        <div class="modal fade" id="screenshotModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Submitted Proof</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- ATTACH THE IMAGE LINK HERE -->
                <img class="screenshot-img" src="<?php //echo "Image_Report_Database/".$row['Report_Screenshot'].""    ?>" alt="Proof-for-update-place-URL-here">
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
