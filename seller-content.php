<?php
  require 'includes/dbh.inc.php';
  session_start();
  if (empty($_SESSION['AdminEmail'])){
    header("Location: index.php");
    exit();
  }
  $simnum = mysqli_real_escape_string($conn, $_GET['simnum']);
  $throw  = $simnum;
  $simnum = '+'.$simnum;

  $sql = "SELECT s.Shop_Name AS Shop_Name,
  s.selleremail AS selleremail,
  rg.lastname as lastname, rg.firstname as firstname, rg.midname as midname,
  rg.suffix as suffix,
  s.Business_Permit as Business_Permit,
  s.Business_Address as Business_Address,
  s.Simcard_Limit AS simcard_limit,
  s.link_permit_pic AS link_permit_pic,
  s.link_nsopass_pic as link_nsopass_pic, s.address as address,
  s.link_id_pic as link_id_pic, s.owner_num as owner_num,
  s.dateofreg as dateofreg,
  s.Shop_Name as Shop_Name,
  s.selleremail as selleremail
  FROM seller as s LEFT JOIN local_registered_simusers_db as n ON s.owner_num = n.simnum
            LEFT JOIN nso_dummy_db as rg ON n.nsonum = rg.nsonum
  WHERE s.owner_num = '$simnum'";
 $result = mysqli_query($conn, $sql);
   $resultCheck = mysqli_num_rows($result);
   while($row = mysqli_fetch_assoc($result)):
    $fullname = $row['firstname']. " ". $row['midname']." ".$row['lastname']." ".$row['suffix'];
    $address =$row['address'];
    $owner_num      = $row['owner_num'];
    $selleremail    = $row['selleremail'];
    $shop_name      = $row['Shop_Name'];
    $Business_Permit = $row['Business_Permit'];
    $Business_Address = $row['Business_Address'];
    $Simcard_Limit    = $row['simcard_limit'];
    $permit_link = $row['link_permit_pic'];
    $nso_link = $row['link_nsopass_pic'];
    $id_link     = $row['link_id_pic'];
  
    $nso_link = $row['link_nsopass_pic'];
    $nationality = 'Filipino';
    $id_link = $row['link_id_pic'];
    $dateofreg = $row['dateofreg'];
    $owner_num = $row['owner_num'];
  

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
                <p class="nameLabel">Shop Name: <span><?php echo $shop_name ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">Shop Email: <span><?php echo $selleremail ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">Owner's Full Name: <span><?php echo $fullname ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">Owner's SIM #: <span><?php echo $simnum ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">Owner's Address: <span><?php echo $address?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">Registration Date: <span><?php echo $dateofreg ?></span></p>
              </div>
            </div>

            <div class="col-md-6">
              <div class="infolabels">
                <p class="nameLabel">Business Permit #: <span><?php echo $Business_Permit?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">Shop Address: <span><?php echo $Business_Address?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">SIM Limit: <span><?php echo $Simcard_Limit?></span></p>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-4">
              <button type="button" name="bpbutton" class="send-btn replybtn" data-toggle="modal" data-target="#businesspermitmodal">View Business Permit</button>
            </div>
            <div class="col-md-4">
              <button type="button" name="nsobutton" class="send-btn replybtn" data-toggle="modal" data-target="#nsomodal">View NSO</button>
            </div>
            <div class="col-md-4">
              <button type="button" name="valididbutton" class="send-btn replybtn" data-toggle="modal" data-target="#valididmodal">View Valid ID</button>
            </div>
        </div>

        <!-- BUSINESS PERMIT MODAL -->
        <div class="modal fade" id="businesspermitmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <img class="screenshot-img" src="<?php  echo 'Permit_Database/'.$permit_link;   ?>" alt="Business-permit-img">
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
                <img class="screenshot-img" src="<?php echo 'NSO_User_Database/'.$nso_link;    ?>" alt="NSO-img">
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
                <img class="screenshot-img" src="<?php echo 'ID_User_Database/'.$id_link;    ?>" alt="valid-id-img">
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
