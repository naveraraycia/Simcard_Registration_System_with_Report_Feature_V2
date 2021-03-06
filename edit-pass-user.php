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
    <h2>Change Password</h2>
    </div>
    <div class="row"style="display: flex!important; justify-content:center!important; margin-top:5px;font-size: 18px;color: grey;">
      <p class="">We encourage you to change the given password to you as soon as you have logged into your account the first time</p>

    </div>

<div>
    <?php

                $fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                  if(strpos($fulUrl, "error=success") == true){
                    echo "<p class= 'regsuccess'>USER SUCCESSFULLY REGISTERED</p>";
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
                  }elseif(strpos($fulUrl, "success=pwdupdated") == true){
                    echo "<p class= 'regsuccess'>YOU HAVE SUCCESFULLY UPDATED YOUR PASSWORD</p>";
                  }elseif(strpos($fulUrl, "error=newpassDontMatch") == true){
                    echo "<p class= 'nsoexist'>YOUR NEW PASSWORD DOES NOT MATCH WITH YOUR INPUT WITHIN THE CONFIRM PASSWORD FIELD</p>";
                  }elseif(strpos($fulUrl, "error=currentPwdIsWrong") == true){
                    echo "<p class= 'nsoexist'>YOUR INPUT WITHIN THE CURRENT PASSWORD FIELD DOES NOT MATCH WITH YOUR PASSWORD</p>";
                  }
                  ;
     ?>
     <br><br>
         <form class='' id='form' action='UserprofileBackEnd/update-pwd.php' method='post' enctype='multipart/form-data'>
         <div class='row' style="justify-content:center;">
           <div class='col-md-6 iconn'>
             <!-- COLUMN 1 -->

               <div class='infodiv1'>
                 <p class='labelings'>Current Password</p>
                 <input type='password' name='curpass' class='form-control' required>

               </div>

               <div class='infodiv1'>
                 <p class='labelings'>New Password</p>
                 <input type='password' name='newpass'  class='form-control' required>

               </div>

               <div class='infodiv1'>
                 <p class='labelings'>Confirm New Password</p>
                 <input type='password' name='confpass' class='form-control' required>

               </div>


           </div>

           </div>
           <div class='row' style="justify-content:center;">

           <div class='col-md-6'>
             <button type='submit' name='updbtn' class='send-btn submit_btn' style='display: flex; justify-content: center; align-items: center;'>Send</button>
           </div>
           </div>
      </form>


             </body>
           </html>
