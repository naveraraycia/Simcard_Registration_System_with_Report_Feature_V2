<?php
  require 'includes/dbh.inc.php';
  // $sql = "SELECT * FROM registered_simusers_db ORDER BY lastname ASC";
  // $result = mysqli_query($conn, $sql);
?>
<?php
  session_start();
  // if (empty($_SESSION['SellerFirstName'])){
  //   header("Location: index.php");
  //   exit();
  // }
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
  <link rel="stylesheet" href="styles/admin-tables-style.css">
  <!-- FONT AWESOME -->
<script src="https://kit.fontawesome.com/57070be855.js" crossorigin="anonymous"></script>


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

  <div class="row">
    <div class="col-md-12">
    <p class="header row-head" style="margin-bottom: 0px; display: flex; justify-content: center;color: #b40032;">LIST OF SIM RETAILERS REQUESTING FOR SIM RESUPPLY</p>
    </div>
  </div>



    <form action="" method="GET">



    </form>

  <div class="table-responsive" style="margin-top: 2rem!important;">
    <form class="" action="admin-resupply-request.php" method="GET">
      <?php
      $fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      if(strpos($fulUrl, "done=resupply") == true){
        echo "<p class= 'regsuccess'>SHOP HAS BEEN SUCCESSFULLY RESUPPLIED</p>";
      }
        ?>
      </form>
  <table class="table table-striped">
    <thead>
      <tr>
        <th class="f-column text-truncate" scope="col" ></th>
        <th class="f-column text-truncate" scope="col" >Shop Name</th>
        <th class="f-column text-truncate" scope="col" >Shop Owner</th>
        <th class="f-column text-truncate" scope="col" >Owner's Mobile #</th>
        <th class="f-column text-truncate" scope="col" >SIM Shop Address</th>
        <th class="f-column text-truncate" scope="col" >SIMs Left</th>
        <th class="f-column text-truncate" scope="col" ># of SIMs requested</th>

      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT s.Shop_Name as Shop_Name,n.firstname as firstname,n.lastname as lastname, n.midname as midname, s.owner_num as owner_num, s.Business_Address as Business_Address, s.Simcard_Limit as Simcard_Limit,
      r.sim_amount_requested as sim_amount_requested, r.request_id as request_id
      FROM resupply_requests AS r RIGHT JOIN seller as s ON r.selleremail = s.selleremail RIGHT JOIN nso_dummy_db as n ON n.nsonum = s.seller_nso
      WHERE r.sim_amount_requested AND n.nsonum;";
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)):
        // $thrownum = trim($simnum,"+");
        $sim_amount_requested = $row['sim_amount_requested'];
        ?>

      <!-- <tr class="canHov" onclick="window.location='<?php //echo "update-end-user-info.php?id=".$row['passnum_nsonum']."&sent=".$row['lastname']."";?>';"> -->
      <tr>
        <td class="text-truncate"><a href="Admin_Table_Backend/resupply_sim.php?resupply=<?php echo $row['request_id']; ?>" class="btn btn-success">Resupply</a></td>
        <td class="f-column text-truncate"><?php echo $row['Shop_Name'] ?></th>
        <td class="f-column text-truncate"><?php echo $row['firstname']." ". $row['midname']." ". $row['lastname'] ?></th>  <!-- pa-concat nalang ng $row['firstname'] and $row['lastname'] -->
        <td class="f-column text-truncate"><?php echo $row['owner_num'] ?></th>
        <td class="f-column text-truncate"><?php echo $row['Business_Address'] ?></th>
        <td class="text-truncate"><?php echo $row['Simcard_Limit'] ?></th>
        <td class="f-column text-truncate"><?php echo $row['sim_amount_requested'] ?></th>


      </tr>


    <?php endwhile; ?>




    </tbody>
  </table>

</div>

</body>

</html>
