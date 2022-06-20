<?php
  require 'includes/dbh.inc.php';

?>
<?php
  session_start();
  if (empty($_SESSION['SellerFirstName'])){
    header("Location: index.php");
    exit();
  }
  if(empty($_SESSION['nsonumber'])){
    header("Location: register_fingerprint.php?EnterNSO");
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
  <link rel="stylesheet" href="styles/register.css">
  <!-- FONT AWESOME -->
  <script src="https://kit.fontawesome.com/207a28b81e.js" crossorigin="anonymous"></script>

    <style>

    /* BUTTONS */
    .send-btn {
      background-color: #2f5a62;
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
      background-color:#4b8f9c;
      cursor: pointer;
      color: white;
    }


    </style>
</head>
<body style="background-color: white;">
  <!-- NAVBAR PART -->
  <header>

    <nav class="navbar navbar-expand-lg">
      <a class="div1 navbar-brand" href="seller-home.php">
          <img src="images/logo.png" width="30" height="32" class="d-inline-block align-top" alt="">
          <span class="brandname">SIM shop: Cavite SIM Shop</span>
        </a>

      <button class="custom-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">


        <ul class='navbar-nav'>
              <li class='nav-item'>
                <a class='nav-link selected' href='data-privacy-act.php'>Register User</a>
              </li>


              <li class='nav-item'>
                <a class='nav-link' href='seller-home.php'>Home</a>
              </li>

              <li class='nav-item'>
                <a class='nav-link' href='seller-profile.php'>Profile</a>
              </li>

              <li class='nav-item'>
                <a class='nav-link' href='request-sim-resupply.php'>Update info / Request SIM</a>
              </li>

            </ul>




        <form class="form-btnn" action="Logout/logoutprocess_SimRetailer.php" method="POST">
          <button type="submit" name="btn-primary" class="log-button">Logout</button>
        </form>
      </div>
    </nav>
  </header>

    <!-- BODY PART -->
    <div class="container" style="background-color: #f3f3f3;">
      <div class="row header">
            <h2>Work SIM Card Registration Form</h2>
          </div>

          <!-- <form class="" action="register-users-local.php" method="GET"> -->
<?php
        $fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if(strpos($fulUrl, "signup=success") == true){
          echo "<p class= 'regsuccess'>USER SUCCESSFULLY REGISTERED</p>";
        }
        elseif(strpos($fulUrl, "error=simnum-already-exist") == true){
          echo "<p class= 'nsoexist'>REGISTRATION FAILED: THIS SIM CARD NUMBER ALREADY EXISTS</p>";
        }
        elseif(strpos($fulUrl, "error=maxlimit") == true){
          echo "<p class= 'nsoexist'>YOU HAVE RAN OUT OF SIM STOCK</p>";
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
        elseif(strpos($fulUrl, "simservice") == true){
          echo "<p class= 'nsoexist'>THIS USER ALREADY HAS A REGISTERED SIM CARD IN THIS SERVICE</p>";
        }




?>


   <form class="" action="includes/register_fingerprint.php" method="post" enctype="multipart/form-data">
     <!-- INITIAL = NOT YET PRESSING BUTTON SEARCH DATABASE : EMPTY FIELD -->
     <?php
     $nso = $_SESSION['nsonumber'];
     $query = "SELECT * FROM nso_dummy_db WHERE nsonum =  '$nso'; ";
     $result = mysqli_query($conn,$query);

       if (mysqli_num_rows($result) > 0) {
         // if there is a result
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
         <div class="row srow" style="margin-bottom: 2rem; margin-top: 1rem;">
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
             <input id="nsonum" type="text" name="nsonum" class="form-control"value="<?= $row['nsonum'] ?>" disabled >
           </div>

         </div>


         <?php

       }
     }


     ?>


       <div class="row">
         <div class="col-md-6">
           <div class="form-group">
             <label for="nso-attach">Attach NSO</label>
             <input type="file" name='NSOfile' class="form-control-file" id="nso-attach" required>
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             <label for="id-attach">Attach Valid ID</label>
             <input type="file" name='IDfile' class="form-control-file" id="id-attach" required>
           </div>
         </div>

       </div>

       <div class="row">
         <div class="col-md-6">
           <div class="form-group">
             <label for="id-attach">Attach Endorsement Letter for SIM Registration</label>
             <input type="file" name='' class="form-control-file" id="id-attach" required>
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             <label for="id-attach">Attach Business Permit</label>
             <input type="file" name='' class="form-control-file" id="id-attach" required>
           </div>
         </div>
       </div>

       <!-- <div class="row">
         <div class="col-md-4">
           <div class="form-group">
             <label for="nso-attach">Attach SIM Registration Endorsement Form from the Company</label>
             <input type="file" name='NSOfile' class="form-control-file" id="nso-attach" required>
           </div>
         </div>

         <div class="col-md-4">
           <div class="form-group">
             <label for="id-attach">Attach Certificate </label>
             <input type="file" name='IDfile' class="form-control-file" id="id-attach" required>
           </div>
         </div>

         <div class="col-md-4">
           <div class="form-group">
             <label for="id-attach">Attach Business Permit</label>
             <input type="file" name='' class="form-control-file" id="id-attach" required>
           </div>
         </div>

       </div> -->

       <div class="row srow">
         <div class="col-md-4 infodiv">
           <label class="Bday">Applicant's Address</label>
           <input id="address" type="text" name="address" class="form-control" required>
         </div>

         <div class="col-md-4 infodiv">
           <label class="Bday">Company / Business Address</label>
           <input id="" type="text" name="address" class="form-control" required>
         </div>

         <div class="col-md-4 infodiv">
           <label class="Bday">Business Permit #</label>
           <input id="" type="text" name="address" class="form-control" required>
         </div>
       </div>

       <div class="row">
         <div class="col-md-4">
           <label class="labelings">Type of Sim Card user</label>
           <select class="form-control" name="simcard">
             <option value="new prepaid user">New prepaid user</option>
             <option value="existing prepaid user">Existing prepaid user (Unregistered)</option>
             <option value="postpaid user">Postpaid user</option>
           </select>
         </div>
         <div class="col-md-4 infodiv">
           <label class="labelings">Register SIM number</label>
           <div class="input-group mb-2">
           <div class="input-group-prepend">
             <div class="input-group-text">+63</div>
           </div>
           <input type="tel" class="form-control" id="simnum" name="simnum" required>
         </div>
         </div>
         <div class="col-md-4">
           <label class="labelings">SIM Telco</label>
           <select class="form-control" name="services">
             <option value="Globe/TM">Globe/TM</option>
             <option value="Smart">Smart</option>
             <option value="DITO">DITO</option>
             <option value="Sun">Sun</option>
             <option value="TNT">TNT</option>
           </select>
         </div>
       </div>

       <!-- FIFTH ROW -->
       <div class="row srow">
         <div class="col-md-6 infodiv">
           <label class="labelings">Date of Registration</label>
           <input id="dateregis"type="date" name="dateofregis" class="form-control" required>
         </div>

         <div class="col-md-6 infodiv">
           <label class="labelings">Name of SIM retailer</label>
           <input id="regisite" type="text" name="retailer" class="form-control" placeholder="ex: Cavite" required>
         </div>

       </div>

       <!-- PROCEED TO FINGERPRINT REGISTRATION BUTTON -->
       <div class="row srow">
         <div class="col-md-6">
           <div class="form-group">
             <label for="exampleFormControlFile1">Attach Fingerprint Image</label>
             <input type="file" name='Fingerfile' class="form-control-file" id="exampleFormControlFile1" required>
           </div>
         </div>

         <div class="col-md-6">
           <button type="submit" name="register" class="send-btn">Register User</button>
     </div>
     </div>


     </form>

</div>

 </body>
</html>
