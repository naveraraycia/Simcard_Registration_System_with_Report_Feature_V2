<?php

  require 'includes/dbh.inc.php';
  // $sql = "SELECT * FROM nso_dummy_db ORDER BY lastname ASC";
  // $result = mysqli_query($conn, $sql);
  // session_start();
  // if (empty($_SESSION['AdminEmail'])){
  //   header("Location: index.php");
  //   exit();
  // }

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
<script src="https://kit.fontawesome.com/57070be855.js" crossorigin="anonymous"></script>


<style>

/* BUTTONS */
.send-btn {
  background-color: #b40032;
  color: white;
  font-weight: bold;
  width: 100%;
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


.col-md-3 {
  margin-bottom: 2rem;
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
        <div class="container" style="background-color: #f3f3f3;">
          <div class="row header">
                <h2 style="color: #b40032;">UPDATE SIM RETAILER DATA</h2>

              </div>

              <form class="" action="#" method="GET">
    <?php
            $fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            if(strpos($fulUrl, "signup=success") == true){
              echo "<p class= 'regsuccess'>USER SUCCESSFULLY REGISTERED</p>";
            }
            elseif(strpos($fulUrl, "error=nsomnum-already-exist") == true){
              echo "<p class= 'nsoexist'>REGISTRATION FAILED: THIS NSO NUMBER ALREADY EXISTS</p>";
            }
            elseif(strpos($fulUrl, "signup=EMPTY") == true){
              echo "<p class= 'regsuccess'FILL UP ALL FIELDS</p>";
            }
            elseif(strpos($fulUrl, "error=imagelarge") == true){
              echo "<p class= 'nsoexist'>IMAGE IS TOO LARGE</p>";
            }
            elseif(strpos($fulUrl, "error=nsomnum-already-exist") == true){
              echo "<p class= 'nsoexist'>REGISTRATION FAILED: THIS NSO NUMBER ALREADY EXISTS</p>";
            }
            elseif(strpos($fulUrl, "error=imageerror") == true){
              echo "<p class= 'regsuccess'>THERE WAS A PROBLEM IN YOUR IMAGE</p>";
            }
            elseif(strpos($fulUrl, "error=imageformaterror") == true){
              echo "<p class= 'nsoexist'>ENTER JPG, PNG, OR BMP ONLY</p>";
            }
    ?>
  </form>

              <form class="" action="#" method="POST" enctype="multipart/form-data">


             <!-- SECOND ROW -->
             <div class="row srow" style="margin-bottom: 2rem; margin-top: 1rem;">
               <div class="col-md-3 infodiv">
                 <label class="labelings">Last Name</label>
                <input  type="text" name=""  class="Gender form-control" value="Talde" required>
               </div>
               <div class="col-md-3 infodive">
                 <label class="labelings">First Name</label>
                 <input  type="text" name="Gender"  class="Gender form-control" value="Vincent Mao" required>
               </div>
               <div class="col-md-3 infodiv">
                 <label class="labelings">Middle Name</label>
                 <input id="nsonum" type="text" name="nsonum" class="form-control" value="Berches" required>
               </div>

               <div class="col-md-3 infodiv">
                 <label class="labelings">Suffix</label>
                 <input id="nsonum" type="text" name="nsonum" class="form-control" value="">
               </div>

             </div>

             <div class="row srow">
               <div class="col-md-6 infodiv">
                 <label class="labelings">Owner's Address</label>
                 <input id="lastname" type="text" name="lastname" class="form-control" value="Philippines,Earth" required>
               </div>

               <div class="col-md-6 infodiv">
                 <label class="labelings">Owner's SIM #</label>
                 <div class="input-group mb-2">
                 <div class="input-group-prepend">
                   <div class="input-group-text">+63</div>
                 </div>
                 <input type="tel" class="form-control" id="simnum" name="simnum" required>
               </div>
               </div>
             </div>

              <div class="row srow">
                <div class="col-md-6 infodiv">
                  <label class="labelings">SIM Shop Name</label>
                  <input id="lastname" type="text" name="lastname" class="form-control" value="Imus SIMs" required>
                </div>

                <div class="col-md-6 infodiv">
                  <label class="labelings">Business Permit #</label>
                  <input id="lastname" type="text" name="lastname" class="form-control" value="123-PERMIT-#" required>
                </div>
              </div>

              <div class="row srow">
                <div class="col-md-12 infodiv">
                  <label class="labelings">SIM Shop's Address</label>
                  <input id="lastname" type="text" name="lastname" class="form-control" value="Philippines,Earth" required>
                </div>
              </div>


              <!-- UPDATE BUTTON -->

              <div class="row srow">
              <div class="col-md-12">
                <button type="submit" name="register" class="send-btn">Update</button>
              </div>
            </div>

         </form>

       </div>

    </body>

    </html>
