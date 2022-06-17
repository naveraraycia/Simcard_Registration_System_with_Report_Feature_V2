<?php
  require 'includes/dbh.inc.php';

?>
<?php
  session_start();
  if (empty($_SESSION['SellerFirstName'])){
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
  height: 100px;
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


.col-md-3 {
  margin-bottom: 2rem;
}



</style>
</head>
  <body style="background-color: white;">
    <!-- NAVBAR PART -->
    <header>

      <nav class="navbar navbar-expand-lg">
        <a class="div1 navbar-brand" href="register-users-local.php">
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

              </ul>




          <form class="form-btnn" action="Logout/logoutprocess_SimRetailer.php" method="POST">
            <button type="submit" name="btn-primary" class="log-button">Logout</button>
          </form>
        </div>
      </nav>
    </header>

    <!-- BODY PART -->
    <div class="container" style="background-color: #c8ece4; padding-bottom: 2rem;">
      <div class="row header">
            <h2>Select Registration Type</h2>
          </div>

          <form class="" action="verify-document.php" method="GET">
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

<div class="row">
  <div class="col-md-3">
    <a href="verify-document.php"><button type="button" name="button" class="send-btn">Local user</button></a>
  </div>

  <div class="col-md-3">
    <a href="#"><button type="button" name="button" class="send-btn">Foreign user</button></a>
  </div>

  <div class="col-md-3">
    <a href="#"><button type="button" name="button" class="send-btn">Business SIM</button></a>
  </div>

  <div class="col-md-3">
    <a href="#"><button type="button" name="button" class="send-btn">Employee SIM</button></a>
  </div>

</div>





</div>


<!-- end of body -->

 </body>
</html>
