<?php
  require "navbar.php";
  include_once 'dbh/EndUser.inc.php';
   //if (empty($_SESSION['UserNumber'])){
   //  header("Location: index.php");
   //  exit();
   // }

   $user = $_SESSION['UserNumber'];
   $sql  = "SELECT * FROM working_sim_db WHERE simnum=?;";
   $stmt = mysqli_stmt_init($conn);
   if (mysqli_stmt_prepare($stmt,$sql)){
     mysqli_stmt_bind_param($stmt,"s",$user);
     mysqli_stmt_execute($stmt);
     $result = mysqli_stmt_get_result($stmt);
     // session_start();
     if($row = mysqli_fetch_assoc($result)){
            $_SESSION['company_address'] = $row['company_address'];
       }else{
        $_SESSION['company_address'] = "--";
       }
      }
$SimCardNumber = $_SESSION['UserNumber'] ;
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
$TimeofReg     = $_SESSION['UserTimeReg'];
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
$Sim_Ret       = $_SESSION['retailer'];
$MiddleName    = substr($_SESSION['UserMiddleName'],0,1);
$Suffix        = " ".$_SESSION['UserSuffix']." ";
$MiddleName    = $MiddleName.".";
$FullName      = $FirstName." ".$MiddleName." ".$LastName." ".$Suffix;
$company_address = $_SESSION['company_address'];
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
            <input type='text' name='VictName' value='$FirstName $LastName $MiddleName $Suffix 'id='usernamee' class='form-control' required disabled>

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

        <div class='infodiv'>
          <p class='labelings'>Company Address </p>
          <p class='information'>$company_address</p>
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
          <p class='labelings'>Time of Registration</p>
          <p class='information'>$TimeofReg</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Registration Shop Site</p>
          <p class='information'>$RegSite</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>SIM Service Provider</p>
          <p class='information'>$service</p>
        </div>


      </div>

      <div class='col-md-4 infocol3'>
        <div class='infodiv'>
          <p class='labelings'>Sim Card Type</p>
          <p class='information'>$SimCard</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>SIM status</p>
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
