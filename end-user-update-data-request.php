<?php
  // require "navbar.php";
  include_once 'includes/dbh.inc.php';

  ?>

  <?php

    session_start();
    $LastName      = $_SESSION['UserLast']  ;
    $FirstName     = $_SESSION['UserFirst']  ;
    $Suffix        = " ".$_SESSION['UserSuffix']." ";
    $MiddleName    = substr($_SESSION['UserMiddleName'],0,1);
    $SimCardNumber = $_SESSION['UserNumber'] ;
    $FullName      = $FirstName." ".$MiddleName." ".$LastName." ".$Suffix;
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
          <a class="div1 navbar-brand" href="profile-user.php">
              <img src="images/logo.png" width="30" height="32" class="d-inline-block align-top" alt="">
              <span class="brandname">SimCardRegistrationSystem</span>
            </a>

          <button class="custom-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class='navbar-nav'>
                <li class='nav-item'>
                  <a class='nav-link' href='profile-user.php'>Profile</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='profile-user.php?reportPage'>Report</a>
                </li>

                <li class='nav-item'>
                  <a class='nav-link' href='pending-sims-end-user.php'>SIM requests</a>
                </li>

                <!-- DITO MO ILAGAY YUNG HEADER NA MAGDEDETERMINE KUNG COMPANY ACC OR HINDE, BUONG LIST UNG ILAGAY MO SA IF ELSE, ICHANGE MO NALANG YUNG HREF.
                end-user-update-data-request.php = Update for Local / Foreign
                working-update-sim.php = form for update request for working / business SIM card
               -->
                <li class='nav-item'>
                  <a class='nav-link selected' href='end-user-update-data-request.php'>Update Info</a>
                </li>

              </ul>



            <form class="form-btnn" action="Logout/logoutprocess_EndUser.php" method="POST">
              <button type="submit" name="btn-primary" class="log-button">Logout</button>
            </form>
          </div>
        </nav>
      </header>


  <div class="container">

    <div class='row header'>
    <h2>Request for Update of Personal Information</h2>
    </div>
    <div class="row"style="display: flex!important; justify-content:center!important; margin-top:5px;font-size: 18px;color: grey;">
      <p class="">Your request for update of personal information may take a couple of days to process</p>

    </div>

<div>
    <?php

                $fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                  if(strpos($fulUrl, "error=success") == true){
                    echo "<p class= 'regsuccess'>YOUR REQUEST HAS BEEN SENT</p>";
                  }elseif(strpos($fulUrl, "error=nsomnum-already-exist") == true){
                    echo "<p class= 'nsoexist'>REGISTRATION FAILED: THIS NSO NUMBER ALREADY EXISTS</p>";
                  }elseif(strpos($fulUrl, "signup=EMPTY") == true){
                    echo "<p class= 'regsuccess'FILL UP ALL FIELDS</p>";
                  }elseif(strpos($fulUrl, "error=imagelarge") == true){
                    echo "<p class= 'nsoexist'>IMAGE IS TOO LARGE</p>";
                  }elseif(strpos($fulUrl, "error=nsomnum-already-exist") == true){
                    echo "<p class= 'nsoexist'>REGISTRATION FAILED: THIS NSO NUMBER ALREADY EXISTS</p>";
                  }elseif(strpos($fulUrl, "error=imageerror") == true){
                    echo "<p class= 'regsuccess'>THERE WAS A PROBLEM IN YOUR IMAGE</p>";
                  }elseif(strpos($fulUrl, "error=imageformaterror") == true){
                    echo "<p class= 'nsoexist'>ENTER JPG, PNG, OR BMP ONLY</p>";
                  }elseif(strpos($fulUrl, "error=ban") == true){
                    echo "<p class= 'nsoexist'>YOU ARE CURRENTLY BANNED. YOU CANNOT CHANGE YOUR INFO</p>";
                  };
     ?>
     <br><br>
         <form class='' id='form' action='UserprofileBackEnd/requestchange.php' method='post' enctype='multipart/form-data'>
         <div class='row'>
           <div class='col-md-6 iconn'>
             <!-- COLUMN 1 -->

               <div class='infodiv1'>
                 <p class='labelings'>Name</p>
                 <input type='text' name='VictName' value='<?php echo $FullName ;?> 'id='usernamee' class='form-control' required disabled>

               </div>

               <div class='infodiv1'>
                 <p class='labelings'>Your Mobile Number</p>
                 <input type='tel' name='VictimNumber' value='<?php echo $SimCardNumber; ?>' id='yourNumber' class='form-control' placeholder='' required disabled>

               </div>

               <div class="infodiv1">
                   <select class='custom-select mr-sm-2' id='nlineFormCustomSelect' name ='operator'>
                     <option value="Address">Address</option>
                   </select>
               </div>


           </div>
           <div class='col-md-6 textclass'>
             <!-- TEXTAREA COLUMN 2 -->

               <div class='infodiv1' style="margin-bottom: 0px;">
                 <p class='labelings'>Please provide reason why you need to change your Information</p>
                 <textarea id='textArea' class='form-control' name='Remarks' rows='6' cols='80'></textarea>
               </div>

               <div class="infodiv1">
                 <p class='labelings'>Enter Updated Information</p>
                 <input id="" type="text" name="update" class="form-control"  required>
             </div>

             </div>

         </div>
         <div class='row'>

         <div class='col-md-6'>
         <div class='form-group'>
           <label for='exampleFormControlFile1' class='labelings'>Submit Valid ID with address details</label>
             <input type='file' name='file' class='form-control-file' id='exampleFormControlFile1' required>
         </div>
         </div>

         <div class='col-md-6'>
           <button type='submit' name='reportbutton' class='send-btn submit_btn' style='display: flex; justify-content: center; align-items: center;'>Send</button>
         </div>
         </div>

         <div class="row srow">
           <div class="col-md-12">
             <div class="row"style="display: flex!important; justify-content:flex-start!important; margin-top:5px;font-size: 18px;">
               <p class="">By submitting this form, you agree to our <a href="privacy-policy-enduser.php" style="font-weight:bold;">Privacy Policy</a> and <a href='terms-condition.php' style="font-weight:bold;">Terms and Conditions</a> with accordance to the Data Privacy Act of 2012</p>
             </div>
           </div>

         </div>
           </form>


           </div>

           <script>
             const submit_btn = document.querySelector('.submit_btn');
             submit_btn.onclick = function () {
               this.innerHTML = "<div class='loader'></div>";
             }
           </script>

             </body>
           </html>
