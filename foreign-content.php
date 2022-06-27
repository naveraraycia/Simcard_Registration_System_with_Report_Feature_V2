<?php
  require 'includes/dbh.inc.php';

  session_start();
  if (empty($_SESSION['AdminEmail'])){
    header("Location: index.php");
    exit();
  }
  $simnum = mysqli_real_escape_string($conn, $_GET['simnum']);
  $user = mysqli_real_escape_string($conn, $_GET['user']);
  $throw  = $simnum;
  $simnum = '+'.$simnum;

  if($user=='notfilipino'){
    $query = "SELECT rg.sim_status as sim_status, rg.offense_count as offense_count, rg.ban_start as ban_start, rg.ban_end as ban_end,
                  rg.simnum as simnum, rg.simcard as simcard, rg.services as services, n.lastname as lastname, n.firstname as firstname,
                  n.midname as midname, n.suffix as suffix, n.gender as gender, n.dateofbirth as dateofbirth, rg.address as address,
                  n.passnum as passnum, n.nationality as nationality, rg.sim_shop as sim_shop, rg.regisite as regisite, rg.sim_retailer as sim_retailer, rg.dateofreg as dateofreg,
                  rg.fingerprint_File_Format as finger_link, rg.link_passport_pic as pass_link
          FROM foreign_registered_simusers_db AS rg LEFT JOIN foreign_passport_db as n ON rg.passnum = n.passnum
          WHERE rg.simnum = '$simnum';";
           $result = mysqli_query($conn, $query);
  }else if($user=='request'){
      $query = "SELECT * FROM request_reg_db WHERE NOT nationality = N'Filipino' AND simnum = '$simnum';";
      $result = mysqli_query($conn, $query);
  }

  $result = mysqli_query($conn, $query);
  $resultCheck = mysqli_num_rows($result);

  while($row = mysqli_fetch_assoc($result)):
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
  $sim_retailer = $row['sim_retailer'];

  if($user == 'request'){
    $remark = $row['remarks'];
    $finger_link = $row['fingerprint_File_Format'];
    $nso_link = $row['link_nsopass_pic'];
    $passnso_num = $row['passnum_nsonum'];
    $dateofreg = $row['dateofregis'];
  }else{
    $finger_link = $row['finger_link'];
    $nso_link = $row['pass_link'];
    $nationality = $row['nationality'];
    $dateofreg = $row['dateofreg'];
    $passnso_num = $row['passnum'];
  }
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

            <div class="col-md-6">
              <div class="infolabels">
                <p class="nameLabel">User's Full Name: <span><?php echo $fullname ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">Birthdate: <span><?php echo $dateofbirth ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">Gender: <span><?php echo $gender ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">Address: <span><?php echo $address ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">NSO #: <span><?php echo $passnso_num ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">Registration Date: <span><?php echo $dateofreg ?></span></p>
              </div>
            </div>

            <div class="col-md-6">
              <div class="infolabels">
                <p class="nameLabel">SIM Card #: <span><?php echo $simnum ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">SIM Type: <span><?php echo $simcard ?></span></p>
              </div>

              <?php
            if ($user == 'request') {
              ?>
              <div class="infolabels">
                <p class="nameLabel">Provider Requested: <span><?php echo $services ?></span></p>
              </div>
              <?php
            } else {
              ?>
              <div class="infolabels">
                <p class="nameLabel">Provider: <span><?php echo $services ?></span></p>
              </div>
              <?php
            }
               ?>
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

          <?php
        if ($user == 'request') {
          ?>
          <div class="row">
            <div class="col-md-12">
              <div class="infolabels">
                <br>
                <p class="nameLabel">Reason for acquiring additional SIM to similar provider: <span style="display:block;"><?php echo $remark?></span></p>
              </div>
            </div>
          </div>
          <?php
        }
           ?>


          <div class="row">
            <div class="col-md-6">
              <button type="button" name="fpbutton" class="send-btn replybtn" data-toggle="modal" data-target="#fingerprintmodal">View Fingerprint</button>
            </div>
            <div class="col-md-6">
              <button type="button" name="passbutton" class="send-btn replybtn" data-toggle="modal" data-target="#passportmodal">View Passport</button>
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

        <!-- PASSPORT MODAL -->
        <div class="modal fade" id="passportmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Submitted Passport</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- ATTACH THE IMAGE LINK HERE -->
                <img class="screenshot-img img-fluid" src="<?php echo 'NSO_User_Database/'.$nso_link;     ?>" alt="passport-img">
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
