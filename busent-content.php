<?php
  require 'includes/dbh.inc.php';
  session_start();
  if (empty($_SESSION['AdminEmail'])){
   header("Location: index.php");
   exit();
 }
 $simnum = '639214425914';
 $simnum = mysqli_real_escape_string($conn, $_GET['simnum']);
 $throw  = $simnum;
 $simnum = '+'.$simnum;
 

   $sql = "SELECT b.sim_status as sim_status, b.offense_count as offense_count , b.ban_start as ban_start, b.ban_end as ban_end, b.simnum as simnum,
                  b.simcard as simcard, b.services as services, b.business_name as business_name, b.business_permit as business_permit, n.lastname as lastname,
                  n.firstname as firstname, n.midname as midname, n.suffix as suffix, n.gender as gender, n.dateofbirth as dateofbirth,
                  b.business_address as business_address, b.address as address, n.nsonum as nsonum, b.sim_shop as sim_shop, b.regisite as regisite,
                  b.sim_retailer as sim_retailer, b.dateofreg as dateofreg, b.fingerprint_File_Format as fingerprint_File_Format, b.link_business_permit as link_business_permit, b.num_permit as num_permit,
                  b.link_id_pic as link_id_pic,b.link_authletter as link_authletter,b.link_nso_pic as link_nso_pic
   FROM business_entity_registered_simusers_db as b LEFT JOIN nso_dummy_db as n ON b.nsonum = n.nsonum ORDER BY lastname ASC";


   $result = mysqli_query($conn, $sql);
   while($row = mysqli_fetch_assoc($result)):
    $business_name = $row['business_name'];
    $business_address = $row['business_address'];
    $num_permit = $row['num_permit'];
    $fullname = $row['firstname']. " ". $row['midname']." ".$row['lastname']." ".$row['suffix'];
    $dateofbirth = $row['dateofbirth'];
    $gender = $row['gender'];
    $address =$row['address'];
    $simcard = $row['simcard'];
    $sim_status = $row['sim_status'];
    $offense_count = $row['offense_count'];
    $ban_start = $row['ban_start'];
    $ban_end = $row['ban_end'];
    $simcard = $row['simcard'];
    $services = $row['services'];
    $sim_shop = $row['sim_shop'];
    $regisite = $row['regisite'];
    $dateofreg = $row['dateofreg'];
    $nationality = 'Filipino';
    $passnso_num = $row['nsonum'];
    $sim_retailer = $row['sim_retailer'];
    $finger_link = $row['fingerprint_File_Format'];
    $nso_link = $row['link_nso_pic'];
    $id_link     = $row['link_id_pic'];
    $authletter_link = $row['link_authletter'];
    $business_permit_link = $row['link_business_permit'];




endwhile;

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

            <!-- COLUMN 1 NAME AND USER'S CELLPHONE NUMBER -->

            <div class="col-md-4">
              <div class="infolabels">
                <p class="nameLabel">Representative's Full Name: <span><?php echo $fullname ?></span></p>
                </div>
              <div class="infolabels">
                <p class="nameLabel">Birthdate: <span><?php echo $dateofbirth ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">Gender: <span><?php echo $gender ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">Representative's Address: <span><?php echo $address ?></span></p>
                </div>
              <div class="infolabels">
                <p class="nameLabel">NSO #: <span><?php echo $passnso_num ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">Registration Date: <span><?php echo $dateofreg ?></span></p>
              </div>
            </div>

            <div class="col-md-4">
              <div class="infolabels">
                <p class="nameLabel">SIM Card #: <span><?php echo $simnum ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">SIM Type: <span><?php echo $simcard ?></span></p>
              </div>


              <div class="infolabels">
                <p class="nameLabel">Provider: <span><?php echo $services ?></span></p>
              </div>


              <div class="infolabels">
                <p class="nameLabel">SIM shop: <span><?php echo $sim_shop ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">SIM Retailer: <span><?php echo $sim_retailer ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">SIM shop's location: <span><?php echo $regisite ?></span></p>
              </div>
            </div>

            <div class="col-md-4">
              <div class="infolabels">
                <p class="nameLabel">Business Name: <span><?php echo $business_name ?></span></p>
              </div>

              <div class="infolabels">
                <p class="nameLabel">Business Permit #: <span><?php echo $num_permit ?></span></p>
              </div>

              <div class="infolabels">
                <p class="nameLabel">Business Address: <span><?php echo $business_address ?></span></p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4" style="text-align:left;">
              <div class="infolabels">
                <p class="nameLabel">User Status: <span><?php echo $sim_status ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">Penalty: <span><?php echo $offense_count ?></span></p>
              </div>
            </div>

            <div class="col-md-4" style="text-align:left;">
              <div class="infolabels">
                <p class="nameLabel">Date blocked: <span><?php echo $ban_start ?></span></p>
              </div>
            </div>

            <div class="col-md-4" style="text-align:left;">
              <div class="infolabels">
                <p class="nameLabel">End of block period: <span><?php echo $ban_end ?></span></p>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-4">
              <button type="button" name="fpbutton" class="send-btn replybtn" data-toggle="modal" data-target="#fingerprintmodal">View Fingerprint</button>
            </div>
            <div class="col-md-4">
              <button type="button" name="nsobutton" class="send-btn replybtn" data-toggle="modal" data-target="#nsomodal">View NSO</button>
            </div>
            <div class="col-md-4">
              <button type="button" name="valididbutton" class="send-btn replybtn" data-toggle="modal" data-target="#valididmodal">View Valid ID</button>
            </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <button type="button" name="bpbutton" class="send-btn replybtn" data-toggle="modal" data-target="#permitmodal">View Business Permit</button>
          </div>
          <div class="col-md-6">
            <button type="button" name="letterbutton" class="send-btn replybtn" data-toggle="modal" data-target="#lettermodal">View Authorization Letter</button>
          </div>
      </div>

        <!-- FINGERPRINT MODAL -->
        <div class="modal fade" id="fingerprintmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registered Fingerprint</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- ATTACH THE IMAGE LINK HERE -->
                <img class="screenshot-img img-fluid" src="<?php echo 'Fingerprint_Registered_User_Database/'.$finger_link;     ?>" alt="Fingerprint-img">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- NSO MODAL -->
        <div class="modal fade" id="nsomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Submitted NSO Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- ATTACH THE IMAGE LINK HERE -->
                <img class="screenshot-img img-fluid" src="<?php echo 'NSO_User_Database/'.$nso_link;     ?>" alt="NSO-img">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- VALID ID MODAL -->
        <div class="modal fade" id="valididmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Submitted Valid ID</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- ATTACH THE IMAGE LINK HERE -->
                <img class="screenshot-img img-fluid" src="<?php echo 'ID_User_Database/'.$id_link;    ?>" alt="valid-id-img">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- BUSINESS PERMIT MODAL -->
        <div class="modal fade" id="permitmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Submitted Business Permit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- ATTACH THE IMAGE LINK HERE -->
                <img class="screenshot-img img-fluid" src="<?php echo 'Permit_Database/'.$business_permit_link;    ?>" alt="business-permit-img">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- AUTHORIZATION LETTER MODAL -->
        <div class="modal fade" id="lettermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Submitted Authorization Letter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- ATTACH THE IMAGE LINK HERE -->
                <img class="screenshot-img img-fluid" src="<?php echo 'Endoresement_Database/'.$authletter_link;    ?>" alt="author-letter-img">
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
