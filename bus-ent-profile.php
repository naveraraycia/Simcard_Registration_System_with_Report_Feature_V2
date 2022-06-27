<?php
  include_once 'includes/dbh.inc.php';
   if (empty($_SESSION['UserNumber'])){
     header("Location: index.php");
     exit();
    }
?>

  <?php

    session_start();
    date_default_timezone_set('Asia/Manila');
    $today = date("Y-m-d");
    $SimCardNumber  = $_SESSION['UserNumber'];
    $sql = "SELECT  n.firstname as firstname, n.lastname as lastname, n.midname as midname, n.suffix as suffix, 
                    n.gender as gender, n.dateofbirth as dateofbirth, r.address as address, r.simnum as simnum, 
                    r.dateofreg as dateofregis, r.regisite as regisite, r.services as services, r.simcard as simcard, 
                    r.sim_status as sim_status, r.offense_count as offense_count, r.ban_start as ban_start, 
                    r.ban_end as ban_end, r.sim_retailer as sim_retailer, r.business_name as business_name, 
                    r.business_address as business_address, r.num_permit as num_permit, r.nsonum as nsopass_num
            FROM business_entity_registered_simusers_db as r LEFT JOIN nso_dummy_db as n ON r.nsonum = n.nsonum
            WHERE r.simnum = ?;";
       $stmt = mysqli_stmt_init($conn);
       mysqli_stmt_prepare($stmt,$sql);
       mysqli_stmt_bind_param($stmt,"s",$SimCardNumber);
       mysqli_stmt_execute($stmt);
       $result = mysqli_stmt_get_result($stmt);
       if($row = mysqli_fetch_assoc($result)){
         $_SESSION['UserLast']        = $row['lastname'];
         $_SESSION['UserFirst']       = $row['firstname'];
         $_SESSION['UserMiddleName']  = $row['midname'];
         $_SESSION['UserSuffix']      = $row['suffix'];
         $_SESSION['UserBirthdate']   = $row['dateofbirth'];
         $_SESSION['UserGender']      = $row['gender'];
         $_SESSION['UserAddress']     = $row['address'];
         $_SESSION['UserNationality'] = 'Filipino';
         $usertype                    = 'Filipino';
         $_SESSION['UserType']        = 'Filipino';
         $_SESSION['UserSimCard']     = $row['simcard'];
         $_SESSION['UserNumber']      = $row['simnum'];
         $_SESSION['UserRegSite']     = $row['regisite'];
         $_SESSION['UserDatReg']      = $row['dateofregis'];
         $_SESSION['services']        = $row['services'];
         $_SESSION['retailer']        = $row['sim_retailer'];
         $_SESSION['Banstart']        = $row['ban_start'];
         $_SESSION['Banend']          = $row['ban_end'];
         $_SESSION['sim_status']      = $row['sim_status'];
         $_SESSION['offense_count']   = $row['offense_count'];
         $_SESSION['business_name']   = $row['business_name'];
         $_SESSION['business_address']= $row['business_address'];
         $_SESSION['num_permit']      = $row['num_permit'];
         $_SESSION['nsonum']          = $row['nsopass_num'];
   }
















$LastName      = $_SESSION['UserLast']  ;
$FirstName     = $_SESSION['UserFirst']  ;
$Gender        = $_SESSION['UserGender']  ;
$Birthdate     = $_SESSION['UserBirthdate'];
$Address       = $_SESSION['UserAddress']  ;
$Nationality   = $_SESSION['UserNationality'];
if ($Nationality == "Filipino" || $Nationality == "filipino"){
$Type = "Local";
}else{
$Type = "Foreign";
};
$TypeofUser    = $_SESSION['UserType'] ;
$DateofRegist  = $_SESSION['UserDatReg'];
$RegSite       = $_SESSION['UserRegSite'] ;
$SimCard       = $_SESSION['UserSimCard']  ;
$SimStatus     = $_SESSION['sim_status'];
$SimPenality   = $_SESSION['offense_count'];
switch($SimPenality){
case "0":
 $penalty = 'None';
 break;
case "1":
 $penalty = '1st offense';
 break;
case "2":
 $penalty = '2nd offense';
 break;
case "3":
 $penalty = 'Permanently Ban';
 break;
};
$BanStart      = $_SESSION['Banstart'];
$BanEnd        = $_SESSION['Banend'];
$num           = $_SESSION['nsonum'];
if($today > $BanEnd){
  $localsql = "UPDATE local_registered_simusers_db
          SET ban_end = '9999-12-30', ban_start = '0000-00-00', sim_status = 'Active Status'
          WHERE nsonum = '$num';";
   mysqli_query($conn, $localsql);

   $businesssql = "UPDATE business_entity_registered_simusers_db
          SET ban_end = '9999-12-30', ban_start = '0000-00-00', sim_status = 'Active Status'
          WHERE nsonum = '$num';";
   mysqli_query($conn, $businesssql);

   $BanStart = '0000-00-00';
   $BanEnd   = '9999-12-30';
}


$Sim_Ret       = $_SESSION['retailer'];
$MiddleName    = substr($_SESSION['UserMiddleName'],0,1);
$Suffix        = " ".$_SESSION['UserSuffix']." ";
$MiddleName    = $MiddleName.".";
$FullName      = $FirstName." ".$MiddleName." ".$LastName." ".$Suffix;
$service       = $_SESSION['services'];
$business_name = $_SESSION['business_name'];
$business_address = $_SESSION['business_address'];
$num_permit       = $_SESSION['num_permit'];
  ?>
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
    <link rel="stylesheet" href="styles/userprof.css">
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/207a28b81e.js" crossorigin="anonymous"></script>

  </head>
    <body>
      <!-- NAVBAR PART -->
      <header>

        <nav class="navbar navbar-expand-lg">
          <a class="div1 navbar-brand" href="bus-ent-profile.php">
              <img src="images/logo.png" width="30" height="32" class="d-inline-block align-top" alt="">
              <span class="brandname">SimCardRegistrationSystem</span>
            </a>

          <button class="custom-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNav">
            <?php

            if (isset($_GET['reportPage'])) {
              echo "<ul class='navbar-nav'>
                <li class='nav-item'>
                  <a class='nav-link' href='bus-ent-profile.php'>Profile</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link selected' href='bus-ent-profile.php?reportPage'>Report</a>
                </li>

              </ul>";
            } else {
              echo "<ul class='navbar-nav'>
                <li class='nav-item'>
                  <a class='nav-link selected' href='bus-ent-profile.php'>Profile</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='bus-ent-profile.php?reportPage'>Report</a>
                </li>

              </ul>";
            }

            ?>

            <form class="form-btnn" action="Logout/logoutprocess_EndUser.php" method="POST">
              <button type="submit" name="btn-primary" class="log-button">Logout</button>
            </form>
          </div>
        </nav>
      </header>



<!-- BODY PART -->
<div class="container">
  <?php
    if (isset($_GET['reportPage'])) {
      echo " <div class='row header'>
      <h2>Report a malicious number</h2>
      </div>";

      $fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      if (strpos($fulUrl,"bus-ent-profile.php?reportPage&ReportStatus=InvalidFormat") == true){
          echo "<p class= 'errormessage'> Invalid characters detected. input digits only</p>";
      }elseif(strpos($fulUrl,"bus-ent-profile.php?reportPage&ReportStatus=InvalidInput") == true){
          echo "<p class= 'errormessage'> Invalid characters detected. Please enter numbers only</p>";
      }elseif(strpos($fulUrl,"bus-ent-profile.php?reportPage&ReportStatus=imageempty") == true){
          echo "<p class= 'errormessage'> No image uploaded. Please submit a screenshot of your reported conversation</p>";
      }elseif(strpos($fulUrl,"bus-ent-profile.php?reportPage&ReportStatus=imagedatabaseerror") == true){
          echo "<p class= 'errormessage'> There was a problem encountered while trying to communicate with the server. Please try again later </p>";
      }elseif(strpos($fulUrl,"bus-ent-profile.php?reportPage&ReportStatus=uploaderror") == true){
          echo "<p class= 'errormessage'> Unable to send the report to the server. Please try again later</p>";
      }elseif(strpos($fulUrl,"bus-ent-profile.php?reportPage&ReportStatus=imagelarge") == true){
          echo "<p class= 'errormessage'> Image size is too large</p>";
      }elseif(strpos($fulUrl,"bus-ent-profile.php?reportPage&ReportStatus=imageerror") == true){
          echo "<p class= 'errormessage'> There was an error that occurred while processing your image. Please re-upload the screenshot</p>";
      }elseif(strpos($fulUrl,"bus-ent-profile.php?reportPage&ReportStatus=imageformaterror") == true){
          echo "<p class= 'errormessage'> Please upload your screenshot in .jpg, .jpeg, or .png only</p>";
      }elseif(strpos($fulUrl,"bus-ent-profile.php?reportPage&ReportStatus=numberlength") == true){
          echo "<p class= 'errormessage'> Incorrect digit length. Please make sure the digit length is correct </p>";
      }elseif(strpos($fulUrl,"bus-ent-profile.php?reportPage&ReportStatus=success") == true){
          echo "<p class= 'successmsg'>Your report has been successfully sent</p>";
      }elseif(strpos($fulUrl,"bus-ent-profile.php?reportPage&ReportStatus=empty") == true){
          echo "<p class= 'errormessage'>Please input the number you want to report</p>";
      }elseif(strpos($fulUrl,"bus-ent-profile.php?reportPage&ReportStatus=NoMessage") == true){
          echo "<p class= 'errormessage'>Please add details regarding your report</p>";
      };

      echo "
<br><br>
    <form class='' id='form' action='UserprofileBackEnd/BackEnd_Report.php' method='post' enctype='multipart/form-data'>
    <div class='row'>
      <div class='col-md-6 iconn'>
        <!-- COLUMN 1 -->

          <div class='infodiv1'>
            <p class='labelings'>Authorized Representative's Name</p>
            <input type='text' name='VictName' value='$FirstName $LastName $MiddleName $Suffix 'id='usernamee' class='form-control' required disabled>

          </div>

          <div class='infodiv1'>
            <p class='labelings'>Entity's Mobile Number</p>
            <input type='tel' name='VictimNumber' value='$SimCardNumber' id='yourNumber' class='form-control' placeholder='' required disabled>

          </div>

          <div class='infodiv1'>
            <p class='labelings'>Mobile Number to be reported</p>
          <div class='input-group mb-2'>
            <div class='input-group-prepend'>
              <div class='input-group-text'>+63</div>
            </div>
            <input type='tel' class='form-control' id='reportedMobilenumber' name='ReportedNumber'>
          </div>
          </div>

        <!-- </form> -->


      </div>
      <div class='col-md-6 textclass'>
        <!-- TEXTAREA COLUMN 2 -->

          <div class='infodiv1'>
            <p class='labelings'>Remarks</p>
            <textarea id='textArea' class='form-control' name='Remarks' rows='9' cols='80'></textarea>
          </div>

        </div>

    </div>
    <div class='row'>

    <div class='col-md-6'>
    <div class='form-group'>
      <label for='exampleFormControlFile1' class='labelings'>Submit Screenshot of Message</label>
        <input type='file' name='file' class='form-control-file' id='exampleFormControlFile1'>
    </div>
    </div>

    <div class='col-md-6'>
      <button type='submit' name='reportbutton' class='send-btn submit_btn' style='display: flex; justify-content: center; align-items: center;'>Send</button>
    </div>

    <div class='row srow'>
      <div class='col-md-12'>
        <div class='row'style='display: flex!important; justify-content:center!important; margin-top:5px;font-size: 18px;'>
          <p class='' style='text-align:center!important;'>By submitting this form, you agree to our <a href='privacy-policy.php' style='font-weight:bold;'>Privacy Policy</a> and <a href='terms-condition.php' style='font-weight:bold;'>Terms and Conditions</a> with accordance to the Data Privacy Act of 2012</p>
        </div>
      </div>

    </div>
    </div>
      </form>
    ";



  } else {

//REPORT PAGE
    echo "
    <form class='' id='form' action='UserprofileBackEnd/Back_End_User_Profile.php' method='POST'>
    <div class='row'>

      <div class='col-md-4 infocol1'>
        <!-- INFO COLUMN 1 -->

        <div class='infodiv'>
          <p class='labelings'>Business Name</p>
          <p class='information'>$business_name</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Business Address</p>
          <p class='information'>$business_address</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Business Permit Number</p>
          <p class='information'>$num_permit</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Authorized Representative's Name</p>
          <p class='information'>$FullName </p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Gender</p>
          <p class='information'>$Gender</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Birthdate</p>
          <p class='information'>$Birthdate</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Address</p>
          <p class='information'>$Address</p>
        </div>

      </div>

      <div class='col-md-4 infocol2'>
        <!-- INFO COLUMN 2 -->
        <div class='infodiv'>
          <p class='labelings'>Sim Card Number</p>
          <p class='information'>$SimCardNumber</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Type of User</p>
          <p class='information'>$TypeofUser </p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Date of Registration</p>
          <p class='information'>$DateofRegist</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Registration Shop Site</p>
          <p class='information'>$RegSite</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>SIM Service Provider</p>
          <p class='information'>$service</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Sim Card Type</p>
          <p class='information'>$SimCard</p>
        </div>


      </div>

      <div class='col-md-4 infocol3'>

        <div class='infodiv'>
          <p class='labelings'>User status</p>
          <p class='information'>$SimStatus</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Penalty</p>
          <p class='information'>$penalty</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Date you have been blocked from Registration</p>
          <p class='information'>$BanStart</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>End of Registration Block period</p>
          <p class='information'>$BanEnd</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Registered by SIM retailer</p>
          <p class='information'>$Sim_Ret</p>
        </div>
      </div>
    </div>
    </form>";

  }
  ?>

</div>

<script>
  const submit_btn = document.querySelector('.submit_btn');
  submit_btn.onclick = function () {
    this.innerHTML = "<div class='loader'></div>";
  }
</script>

  </body>
</html>
