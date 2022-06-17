<?php
  require 'includes/dbh.inc.php';
  $sql = "SELECT * FROM registered_simusers_db ORDER BY lastname ASC";
  $result = mysqli_query($conn, $sql);
?>
<?php
  session_start();
  if (empty($_SESSION['SellerFirstName'])){
    header("Location: index.php");
    exit();
  }
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
                <a class='nav-link' href='data-privacy-act.php'>Register User</a>
              </li>

              <li class='nav-item'>
                <a class='nav-link selected' href='seller-home.php'>Home</a>
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

    <div class="row" style="padding-bottom: 15px;">
      <div class="col-md-12">
      <p class="header row-head" style="margin-bottom: 0px; display: flex; justify-content: center;">SIMs registered by your shop</p>
      </div>
    </div>

    <div class="row" style="margin-bottom: 2px; margin-top: 1rem;">

            <form class="form-inline" action="seller-SIM-list-search.php" method="POST">
              <input class="form-control search-input" type="search" placeholder="Search" aria-label="Search" name="input-search" style="width: 375px;">
              <button class="log-buttons search-btn" type="submit" name="submit-search">Search</button>
            </form>


      <form action="#">
      <div class="form-row align-items-center" style="justify-content:center;">
        <div class="">
          <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
          <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
            <option selected>All</option>
            <option value="1">No offense</option>
            <option value="2">With offense</option>
            <option value="3">First offense</option>
            <option value="4">Second offense</option>
            <option value="5">Third offense</option>
          </select>
        </div>
        <div class="col-auto my-1">
          <button type="submit" class="log-buttons search-btn" name="filter-search" style="margin-top:0px;">Go</button>
        </div>
      </div>
    </form>

            </div>
    <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="f-column text-truncate" scope="col" >SIM Card #</th>
          <th class="f-column text-truncate" scope="col" >SIM status</th>
          <th class="f-column text-truncate" scope="col" >Penalty</th>
          <th class="f-column text-truncate" scope="col" >Date blocked</th>
          <th class="f-column text-truncate" scope="col" >End of block period</th>
          <th class="f-column text-truncate" scope="col" >Last Name</th>
          <th class="f-column text-truncate" scope="col" >First Name</th>
          <th class="f-column text-truncate" scope="col" >Middle Name</th>
          <th class="f-column text-truncate" scope="col" >Suffix</th>
          <th class="f-column text-truncate" scope="col" >Birthdate</th>
          <th class="f-column text-truncate" scope="col" >Gender</th>
          <th class="f-column text-truncate" scope="col" >NSO or Passport #</th>
          <th class="f-column text-truncate" scope="col" >Address</th>
          <th class="f-column text-truncate" scope="col" >Nationality</th>
          <th class="f-column text-truncate" scope="col" >SIM User Type</th>
          <th class="f-column text-truncate" scope="col" >SIM retailer</th>
          <th class="f-column text-truncate" scope="col" >Registration Date</th>
          <th class="f-column text-truncate" scope="col" >Registration Time</th>


        </tr>
      </thead>
      <tbody>

        <?php
              while($row = mysqli_fetch_assoc($result)):
        ?>

        <!-- <tr class="canHov" onclick="window.location='<?php echo "reported-message-content.php?id=".$row['passnum_nsonum']."&sent=".$row['lastname']."";?>';"> -->
        <tr>
          <td class="text-truncate"><?php echo $row['simnum']; ?></td>
          <th class="text-truncate"><?php echo 'first offense'?></th>
          <td class="text-truncate"><?php echo '1' ?></td>
          <td class="text-truncate"><?php echo '2022-11-04' ?></td>
          <td class="text-truncate"><?php echo '2023-01-04' ?></td>
          <td class="text-truncate"><?php echo $row['lastname']; ?></th>
          <td class="text-truncate"><?php echo $row['firstname']; ?></td>
          <td class="text-truncate"><?php echo $row['midname']; ?></td>
          <td class="text-truncate"><?php echo $row['suffix']; ?></td>
          <td class="text-truncate"><?php echo $row['dateofbirth']; ?></td>
          <td class="text-truncate"><?php echo $row['gender']; ?></td>
          <td class="text-truncate"><?php echo $row['passnum_nsonum']; ?></td>
          <td class="text-truncate"><?php echo $row['address']; ?></td>
          <td class="text-truncate"><?php echo $row['nationality']; ?></td>
          <td class="text-truncate"><?php echo $row['simcard']; ?></td>
          <td class="text-truncate"><?php echo 'Jennie Kim'; ?></td>
          <td class="text-truncate"><?php echo $row['dateofregis']; ?></td>
          <td class="text-truncate"><?php echo $row['time']; ?></td>

        </tr>

      <?php endwhile; ?>


      </tbody>
    </table>

  </div>

    <?php
    // UPDATE ID INCREMENT
  	$update = "SET @num :=0;";
    $resultup = mysqli_query($conn, $update);
    $update = "UPDATE report_messages_db SET report_id = @num := (@num+1);";
    $resultup = mysqli_query($conn, $update);
    $update = "ALTER TABLE report_messages_db AUTO_INCREMENT = 1;";
    $resultup = mysqli_query($conn, $update);


     ?>


</body>

</html>
