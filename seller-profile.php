<?php
  include_once 'dbh/EndUser.inc.php';
  session_start();
  if (empty($_SESSION['SellerFirstName'])){
    header("Location: index.php");
    exit();
  }
  // if (empty($_SESSION['UserNumber'])){
  //   header("Location: index.php");
  //   exit();
  // }
  // $SimCardNumber = $_SESSION['UserNumber'] ;
  // $LastName      = $_SESSION['UserLast']  ;
  // $FirstName     = $_SESSION['UserFirst']  ;
  // $Gender        = $_SESSION['UserGender']  ;
  // $Birthdate     = $_SESSION['UserBirthdate'];
  // $Address       = $_SESSION['UserAddress']  ;
  // $Nationality   = $_SESSION['UserNationality'];
  // $TypeofUser    = $_SESSION['UserType'] ;
  // $DateofRegist  = $_SESSION['UserDatReg'];
  // $TimeofReg     = $_SESSION['UserTimeReg'];
  // $RegSite       = $_SESSION['UserRegSite'] ;
  // $SimCard       = $_SESSION['UserSimCard']  ;
  // $MiddleName    = substr($_SESSION['UserMiddleName'],0,1);
  // $Suffix        = " ".$_SESSION['UserSuffix']." ";
  // $MiddleName    = $MiddleName.".";

    // $sql = "SELECT * FROM registered_simusers_db ORDER BY lastname ASC";
    // $result = mysqli_query($conn, $sql);

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
  <link rel="stylesheet" href="styles/seller-home-style.css">
  <!-- FONT AWESOME -->
  <script src="https://kit.fontawesome.com/207a28b81e.js" crossorigin="anonymous"></script>


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
                <a class='nav-link' href='data-privacy-act.php'>Register User</a>
              </li>

              <li class='nav-item'>
                <a class='nav-link' href='seller-home.php'>Home</a>
              </li>

              <li class='nav-item'>
                <a class='nav-link selected' href='seller-profile.php'>Profile</a>
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
    <div class='row'>

      <div class='col-md-4 infocol1'>
        <!-- INFO COLUMN 1 -->

        <div class='infodiv'>
          <p class='labelings'>Shop Name</p>
          <p class='information'><?php echo $_SESSION['Shop_Name']; ?></p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Shop Email</p>
          <p class='information'>cavite_shop@gmail.com</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Business Owner</p>
          <p class='information'><?php echo $_SESSION['SellerFirstName'] ?></p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Business Address</p>
          <p class='information'><?php echo $_SESSION['Business_Address']; ?></p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Business Permit Number</p>
          <p class='information'><?php echo $_SESSION['Business_Permit']; ?></p>
        </div>

      </div>

      <div class='col-md-4 infocol2'>
        <!-- INFO COLUMN 2 -->
        <div class='infodiv'>
          <p class='labelings'>SIM Limit</p>
          <p class='information'><?php echo $_SESSION['Simcard_Limit']; ?></p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Shop Registration Date</p>
          <p class='information'>2021-05-18</p>
        </div>


        <div class='infodiv'>
          <p class='labelings'>Owner's SIM #</p>
          <p class='information'>+639178569874</p>
        </div>

        <div class='infodiv'>
          <p class='labelings'>Registered by</p>
          <p class='information'>Globe Telecomms Admin</p>
        </div>


    </div>
    </div>
</div>

<script>
  const submit_btn = document.querySelector('.submit_btn');
  submit_btn.onclick = function () {
    this.innerHTML = "<div class='loader'></div>";
  }
</script>

  </body>
</html>
