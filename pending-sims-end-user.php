<?php
  // require "navbar.php";
  include_once 'dbh/EndUser.inc.php';
  // $sql = "SELECT * FROM nso_dummy_db ORDER BY lastname ASC";
  // $result = mysqli_query($conn, $sql);
  ?>

  <?php

    session_start();

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
                  <a class='nav-link selected' href='pending-sims-end-user.php'>SIM requests</a>
                </li>

                <li class='nav-item'>
                  <a class='nav-link' href='end-user-update-data-request.php'>Update Info</a>
                </li>

              </ul>



            <form class="form-btnn" action="Logout/logoutprocess_EndUser.php" method="POST">
              <button type="submit" name="btn-primary" class="log-button">Logout</button>
            </form>
          </div>
        </nav>
      </header>



    <div class="table-responsive" style="background-color: white;">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="f-column text-truncate" scope="col" >Provider</th>
          <th class="f-column text-truncate" scope="col" >SIM #</th>
          <th class="f-column text-truncate" scope="col" >Status</th>
          <th class="f-column text-truncate" scope="col" >Remark</th>
          <th class="f-column text-truncate" scope="col" >Pick up SIM shop Location</th>
          <th class="f-column text-truncate" scope="col" >Date Approved</th>

        </tr>
      </thead>
      <tbody>

        <?php
              // while($row = mysqli_fetch_assoc($result)):
        ?>

        <tr>

          <th scope="row" class="text-truncate"><?php echo 'Globe' ?></th>
          <td class="text-truncate"><?php echo '+639175647890'?></td>
          <td class="text-truncate"><?php echo 'Approved' ?></td>
          <td class="text-truncate"><?php echo 'You can now pick up your SIM' ?></td>
          <td class="text-truncate"><?php echo 'Cavite SIM Shop' ?></td>
          <td class="text-truncate"><?php echo '2022-01-31' ?></td>

        </tr>

      <!-- <?php //endwhile; ?> -->


      </tbody>
    </table>

  </div>



             </body>
           </html>
