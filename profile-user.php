<?php
  require "navbar.php";
  include_once 'includes/dbh.inc.php';
  date_default_timezone_set('Asia/Manila');
  $today = date("Y-m-d");
$SimCardNumber = $_SESSION['UserNumber'] ;
$Type          = $_SESSION['Type'];

          if($Type == 'Filipino'){
            $sql = " SELECT n.firstname as firstname, n.lastname as lastname, n.midname as midname, n.suffix as suffix,
                            n.gender as gender, n.dateofbirth as dateofbirth, r.address as address, r.simnum as simnum,
                            r.dateofreg as dateofregis, r.regisite as regisite, r.services as services, r.simcard as simcard,
                            r.sim_status as sim_status, r.offense_count as offense_count, r.ban_start as ban_start,
                            r.ban_end as ban_end, r.sim_retailer as sim_retailer, r.nsonum as nsopass_num
                    FROM local_registered_simusers_db as r LEFT JOIN nso_dummy_db as n ON r.nsonum = n.nsonum
                    WHERE r.simnum = ?;";
          }else if($Type == 'NotFilipino'){
            $sql = "SELECT n.firstname as firstname, n.lastname as lastname, n.midname as midname, n.suffix as suffix,
                            n.gender as gender, n.dateofbirth as dateofbirth, r.address as address, r.simnum as simnum,
                            r.dateofreg as dateofregis, r.regisite as regisite, r.services as services, r.simcard as simcard,
                            r.sim_status as sim_status, r.offense_count as offense_count, r.ban_start as ban_start,
                            r.ban_end as ban_end, r.sim_retailer as sim_retailer, n.nationality as nationality, r.passnum as nsopass_num
                    FROM foreign_registered_simusers_db as r LEFT JOIN foreign_passport_db as n ON r.passnum = n.passnum
                    WHERE r.simnum = ?;";
          }
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
            $_SESSION['nsopass_num']     = $row['nsopass_num'];
            if($Type == 'NotFilipino'){
              $_SESSION['UserNationality']= $row['nationality'];
              $usertype                   = 'NotFilipino';
            }else{
              $_SESSION['UserNationality']= 'Filipino';
              $usertype                   = 'Filipino';
            }
            $_SESSION['UserType']      = 'Filipino';
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
$num           = $_SESSION['nsopass_num'];
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
$BanEnd      = $_SESSION['Banend'];

if ($usertype == 'Filipino'){
  if($SimStatus <> 'Permanent ban'){
      if($today > $BanEnd){
          $localsql = "UPDATE local_registered_simusers_db
                  SET ban_end = '0000-00-00', ban_start = '0000-00-00', sim_status = 'Active Status'
                  WHERE nsonum = '$num';";
          mysqli_query($conn, $localsql);

          $businesssql = "UPDATE business_entity_registered_simusers_db
                  SET ban_end = '0000-00-00', ban_start = '0000-00-00', sim_status = 'Active Status'
                  WHERE nsonum = '$num';";
          mysqli_query($conn, $businesssql);

          $BanStart = '---';
          $BanEnd   = '---';
        }
      }
}else if($usertype == 'NotFilipino'){
  if($SimStatus <> 'Permanent ban'){
    if($today > $BanEnd){
      $foreignsql = "UPDATE foreign_registered_simusers_db
            SET ban_end = '0000-00-00', ban_start = '0000-00-00', sim_status = 'Active Status'
            WHERE passnum = '$num';";
      mysqli_query($conn, $foreignsql);
      $BanStart = '---';
      $BanEnd   = '---';
  }
}
}


$Sim_Ret       = $_SESSION['retailer'];
$MiddleName    = substr($_SESSION['UserMiddleName'],0,1);
$Suffix        = " ".$_SESSION['UserSuffix']." ";
$MiddleName    = $MiddleName.".";
$FullName      = $FirstName." ".$MiddleName." ".$LastName." ".$Suffix;
$service       = $_SESSION['services'];
?>


<!-- BODY PART -->
<div class="container">
  <?php
    if (isset($_GET['reportPage'])) {
      echo " <div class='row header'>
      <h2>Report a malicious number</h2>
      </div>";

      $fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      if (strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=InvalidFormat") == true){
          echo "<p class= 'errormessage'> Invalid characters detected. input digits only</p>";
      }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=InvalidInput") == true){
          echo "<p class= 'errormessage'> Invalid characters detected. Please enter numbers only</p>";
      }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=imageempty") == true){
          echo "<p class= 'errormessage'> No image uploaded. Please submit a screenshot of your reported conversation</p>";
      }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=imagedatabaseerror") == true){
          echo "<p class= 'errormessage'> There was a problem encountered while trying to communicate with the server. Please try again later </p>";
      }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=uploaderror") == true){
          echo "<p class= 'errormessage'> Unable to send the report to the server. Please try again later</p>";
      }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=imagelarge") == true){
          echo "<p class= 'errormessage'> Image size is too large</p>";
      }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=imageerror") == true){
          echo "<p class= 'errormessage'> There was an error that occurred while processing your image. Please re-upload the screenshot</p>";
      }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=imageformaterror") == true){
          echo "<p class= 'errormessage'> Please upload your screenshot in .jpg, .jpeg, or .png only</p>";
      }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=numberlength") == true){
          echo "<p class= 'errormessage'> Incorrect digit length. Please make sure the digit length is correct </p>";
      }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=success") == true){
          echo "<p class= 'successmsg'>Your report has been successfully sent</p>";
      }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=empty") == true){
          echo "<p class= 'errormessage'>Please input the number you want to report</p>";
      }elseif(strpos($fulUrl,"profile-user.php?reportPage&ReportStatus=NoMessage") == true){
          echo "<p class= 'errormessage'>Please add details regarding your report</p>";
      };

      echo "
<br><br>
    <form class='' id='form' action='UserprofileBackEnd/BackEnd_Report.php' method='post' enctype='multipart/form-data'>
    <div class='row'>
      <div class='col-md-6 iconn'>
        <!-- COLUMN 1 -->

          <div class='infodiv1'>
            <p class='labelings'>Name</p>
            <input type='text' name='VictName' value='$FullName 'id='usernamee' class='form-control' required disabled>

          </div>

          <div class='infodiv1'>
            <p class='labelings'>Your Mobile Number</p>
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
        <input type='file' name='file' class='form-control-file' id='exampleFormControlFile1' required>
    </div>
    </div>

    <div class='col-md-6'>
      <button type='submit' name='reportbutton' class='send-btn submit_btn' style='display: flex; justify-content: center; align-items: center;'>Send</button>
    </div>

    <div class='row srow'>
      <div class='col-md-12'>
        <div class='row'style='display: flex!important; justify-content:center!important; margin-top:5px;font-size: 18px;'>
          <p class='' style='text-align:center!important;'>By submitting this form, you agree to our <a href='privacy-policy-enduser.php' style='font-weight:bold;'>Privacy Policy</a> and <a href='terms-condition.php' style='font-weight:bold;'>Terms and Conditions</a> with accordance to the Data Privacy Act of 2012</p>
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
          <p class='labelings'>Name</p>
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



        <div class='infodiv'>
          <p class='labelings'>Nationality</p>
          <p class='information'>$Nationality</p>
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
          <p class='information'>$Type </p>
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

    <div class='row'>
      <div class='col-md-3'>
      <p class='' style='margin-bottom: 0px; align-self: flex-start; color: black;'><a href='edit-pass-user.php'
        >Change Acc Password<a href='edit-pass-user.php'</a></p>
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
