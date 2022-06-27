<?php
  // require "navbar.php";
  include_once 'includes/dbh.inc.php';
  session_start();
  // $selleremail = $_SESSION['SellerEmail'];
 //
 //  $sql = "SELECT s.Shop_Name AS Shop_Name,
 //  s.selleremail AS selleremail
 //  FROM seller as s LEFT JOIN resupply_requests as n ON s.selleremail = n.sim_amount_requested
 //  WHERE n.selleremail = s.sim_amount_requested";
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
    <link rel="stylesheet" href="styles/userprof.css">
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
                  <a class='nav-link' href='seller-profile.php'>Profile</a>
                </li>

                <li class='nav-item'>
                  <a class='nav-link selected' href='request-sim-resupply.php'>Request SIM</a>
                </li>

              </ul>

          <form class="form-btnn" action="Logout/logoutprocess_SimRetailer.php" method="POST">
            <button type="submit" name="btn-primary" class="log-button">Logout</button>
          </form>
        </div>
      </nav>
    </header>


  <div class="container" style="background-color: #f3f3f3;">

    <div class='row header'>
    <h2>Request for Resupply of SIM card</h2>
    </div>

    <form class="" action="request-sim-resupply.php" method="GET">
<?php
  $fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  if(strpos($fulUrl, "signup=success") == true){
    echo "<p class= 'regsuccess'>REQUEST SUCCESSFUL</p>";
  }
  elseif(strpos($fulUrl, "error=already-requested") == true){
    echo "<p class= 'nsoexist'>YOU ALREADY REQUESTED, PLEASE WAIT UNTIL YOUR PREVIOUS REQUEST IS APPROVED BY ADMIN</p>";
  }
?>
</form>

     <br><br>
         <form class='' id='form' action='request-sim-resupply-backend.php' method='post' enctype='multipart/form-data'>
         <div class='row'>
           <div class='col-md-2 iconn'>
             <!-- COLUMN 1 -->
             <?php
             // $first = "SELECT s.Shop_Name AS Shop_Name,
             // s.selleremail AS selleremail
             // FROM seller as s LEFT JOIN resupply_requests as n ON s.selleremail = n.sim_amount_requested
             // WHERE n.selleremail = s.sim_amount_requested";
             //
             // $result = mysqli_query($conn,$first);
             //
             // // $resultCheck = mysqli_num_rows($result);
             // //
             // //    while($_SESSION = mysqli_fetch_assoc($result)):
             // //      $selleremail = $_SESSION['selleremail'];
             //

              ?>


               <div class='infodiv1'>
                 <p class='labelings'>Amount of SIM</p>
                 <input type='number' name='sim_amount_requested' value='<?php //$FirstName $LastName $MiddleName $Suffix ?> 'id='usernamee' class='form-control' required>

               </div>
           </div>


         </div>
         <div class='row'>
         <div class='col-md-12'>
           <button type='submit' name='sendbutton' class='send-btn submit_btn' style='display: flex; justify-content: center; align-items: center;'>Send</button>
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
