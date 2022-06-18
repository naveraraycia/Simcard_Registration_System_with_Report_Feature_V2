<?php
  require 'includes/dbh.inc.php';

?>
<?php
session_start();
if (empty($_SESSION['AdminEmail'])){
  header("Location: index.php");
  exit();
}
?>
<!-- register-users-local.php?nsonum=3864&button= -->
<!-- onclick="resetForm()" -->
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
    <!-- BODY PART -->
    <div class="container" style="background-color:#f3f3f3;">
      <div class="row header">
            <h2 style="color:#b40032;">Verify NSO Document for SIM Retailer Registration</h2>
          </div>

          <form class="" action="verify-seller-nso.php" method="GET">
<?php
        $fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if(strpos($fulUrl, "signup=success") == true){
          echo "<p class= 'regsuccess'>USER SUCCESSFULLY REGISTERED</p>";
        }
        elseif(strpos($fulUrl, "error=simnum-already-exist") == true){
          echo "<p class= 'nsoexist'>REGISTRATION FAILED: THIS SIM CARD NUMBER ALREADY EXISTS</p>";
        }
        elseif(strpos($fulUrl, "no-result") == true){
          echo "<p class= 'nsoexist'>USER NOT FOUND ON NSO DATABASE</p>";
        }
        elseif(strpos($fulUrl, "nsoempty")==true){
          echo "<p class= 'nsoexist'>NSO BARCODE NUMBER IS EMPTY</p>";
        }
        elseif(strpos($fulUrl, "exceed")==true){
          echo "<p class= 'nsoexist'>YOU HAVE ALREADY REGISTERED 3 SIM CARDS</p>";
        }
        // error message for mobile number
        elseif(strpos($fulUrl, "incorrectNum")==true){
        echo "<p class= 'nsoexist'>Incorrect mobile number input format. Please make sure the digit length is correct</p>";
        }
      elseif(strpos($fulUrl, "missplus")==true){
        echo "<p class= 'nsoexist'>Incorrect mobile number input format. Please use the +63 format and input digits only</p>";
        }
      elseif(strpos($fulUrl, "wrongchars")==true){
        echo "<p class= 'nsoexist'>Invalid characters detected. Please enter numbers only</p>";
        }

        // error message for fingerprint image
        elseif(strpos($fulUrl, "imageempty") == true){
          echo "<p class= 'nsoexist'>NO FINGERPRINT IMAGE UPLOADED</p>";
        }
        elseif(strpos($fulUrl, "imagelarge") == true){
          echo "<p class= 'nsoexist'>FINGERPRINT IMAGE SIZE IS TOO LARGE</p>";
        }
        elseif(strpos($fulUrl, "imageerror") == true){
          echo "<p class= 'nsoexist'>There was an error that occurred while processing the fingerprint image. Please re-upload the fingerprint image</p>";
        }
        elseif(strpos($fulUrl, "imageformaterror") == true){
          echo "<p class= 'nsoexist'>Please upload the fingerprint image in .jpg, .jpeg, .png, or .bmp only</p>";
        }




?>
<?php
// BUTTON CLICKED : WITH RESULTS
// ========================================================== NAG PRESS NA =========================================================
  if(isset($_GET['nsonum1'])){
    $nso = $_GET['nsonum1'];
    $query = "SELECT * FROM nso_dummy_db WHERE nsonum =  '$nso'; ";
    $result = mysqli_query($conn,$query);

      if (mysqli_num_rows($result) > 0) {
        include 'SellerError.php';
        $exceed= checkPenalty($conn,$nso);
        if($exceed == true){
          header("Location: ../Simcard_Registration_System_with_Report_Feature_V2/verify-seller-nso.php?exceed");
        }
        foreach ($result as $row) {
          ?>
        <!-- FIRST ROW -->
        <div class="row">

          <div class="col-md-3 infodiv">
            <label class="labelings">Last Name</label>
            <input id="lastname" type="text" name="lastname" class="form-control" value="<?= $row['lastname'] ?>" disabled>
          </div>

          <div class="col-md-3 infodiv">
            <label class="labelings">First Name</label>
            <input id="firstname" type="text" name="firstname" class="form-control" value="<?= $row['firstname'] ?>" disabled>
          </div>

          <div class="col-md-3 infodiv">
            <label class="labelings">Middle Name</label>
            <input id="midname" type="text" name="midname" class="form-control" value="<?= $row['midname'] ?>" disabled>
          </div>

          <div class="col-md-3">
            <label class="labelings">Suffix</label>
            <input type="text" name="suffix" class="form-control" value="<?= $row['suffix'] ?>" disabled>
          </div>

        </div>

        <!-- SECOND ROW -->
        <div class="row srow">
          <div class="col-md-3 infodiv">
            <label class="labelings">Date of Birth</label>
            <input id="dateofbirth" type="date" name="dateofbirth"  class="form-control" value="<?= $row['dateofbirth'] ?>" disabled>
          </div>
          <div class="col-md-3">
            <label class="labelings">Gender</label>
            <input  type="text" name="Gender"  class="Gender form-control" value="<?= $row['gender'] ?>" disabled>
          </div>
          <div class="col-md-6 infodiv">
            <label class="labelings">NSO Barcode Number</label>
            <input id="nsonum" type="text" name="nsonum1" class="form-control"value="<?php
            if (isset($_GET['nsonum1'])) {
              echo $_GET['nsonum1'];
              $_SESSION['nsonumber1'] = $_GET['nsonum1'];
            }
           ?>" disabled>
          </div>

        </div>


        <!-- BUTTON ROW -->
        <div class="row srow nsobutton" style="display:none;">
          <div class="col-12 infodiv">
          <button type="submit" name="button" class="send-btn db" onclick="verify-document.php">Search Database</button>
        </div>

        </div>
        </form>

<div class="row" style="margin-top: 2rem;">
  <div class="col-6 infodiv" style="padding-left: 0px;">
    <a href="verify-seller-nso.php">
    <button type="submit" name="button" class="send-btn db" onclick="terms-admin-regis-retailer.php" >Go back</button></a>
</div>

  <div class="col-6 infodiv" style="padding-left: 0px;">
    <a href="admin-register-retailer.php">
    <button type="submit" name="button" class="send-btn db" onclick="admin-register-retailer.php" >Proceed to registration</button></a>
</div>

</div>


       <?php
   }
  } else {
    // header("http://localhost/Sim-Registration-Final-UI-main/register-users-local.php?nsonum=.$nso.&button=no-result");
    header("Location: ../Simcard_Registration_System_with_Report_Feature_V2/verify-seller-nso.php?no-result=nsonum='.$nso.'&button");
    // echo "NO RESULT";

  }
} else {
  // INITIAL = NOT YET PRESSING BUTTON SEARCH DATABASE : EMPTY FIELD
?>
<form class="" action="admin-register-retailer.php" method="GET">
 <div class="row">
  <div class="col-md-3">
     <label class="labelings">Last Name</label>
     <input type="text" name="lastname" class="form-control" disabled>

     </div>

     <div class="col-md-3">
     <label class="labelings">First Name</label>
     <input type="text" name="firstname" class="form-control" disabled>
     </div>

     <div class="col-md-3">
     <label class="labelings">Middle Name</label>
     <input type="text" name="midname" class="form-control" disabled>
     </div>

     <div class="col-md-3">
     <label class="labelings">Suffix</label>
     <input type="text" name="suffix" class="form-control" disabled>
     </div>

     </div>

     <!-- SECOND ROW -->
     <div class="row srow">
       <div class="col-md-3 infodiv">
         <label class="labelings">Date of Birth</label>
         <input id="dateofbirth" type="date" name="dateofbirth"  class="form-control" disabled>
       </div>
       <div class="col-md-3">
         <label class="labelings">Gender</label>
         <input  type="text" name="Gender"  class="Gender form-control" disabled>
       </div>
       <div class="col-md-6 infodiv">
         <label class="labelings">NSO Barcode Number</label>
         <input id="nsonum" type="text" name="nsonum1" class="form-control"value="<?php
         if (isset($_GET['nsonum1'])) {
           echo $_GET['nsonum1'];
           $_SESSION['nsonumber1'] = $_GET['nsonum1'];

         }
          ?>" required>
       </div>

     </div>



     <!-- BUTTON ROW -->
     <div class="row srow nsobutton">
       <div class="col-12 infodiv">
       <button type="submit" name="button" class="send-btn db" onclick="verify-seller-nso.php">Search Database</button>
     </div>
     </div>

     </form>



     <?php


 }
 ?>



</div>


<!-- end of body -->

 </body>
</html>
