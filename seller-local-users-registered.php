<?php
  require 'includes/dbh.inc.php';
?>
<?php
  session_start();
  if (empty($_SESSION['SellerFirstName'])){
    header("Location: index.php");
    exit();
  }
  $businessaddress = $_SESSION['Business_Address'];
  $sql = "SELECT l.sim_status, l.simnum, l.services, n.lastname, n.firstname, n.midname, n.suffix, l.nsonum,
  l.simcard, l.address, l.offense_count, l.dateofreg, l.sim_retailer
  FROM local_registered_simusers_db AS l LEFT JOIN nso_dummy_db as n ON l.nsonum = n.nsonum
  WHERE (dateofreg between'2000-01-01' and '2030-01-01') AND
              regisite='$businessaddress' ORDER BY lastname ASC;";
  $result = mysqli_query($conn, $sql);

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"> </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"> </script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

  <!-- <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"> </script> -->
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >

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
                <a class='nav-link selected' href='seller-home.php'>Home</a>
              </li>

              <li class='nav-item'>
                <a class='nav-link' href='seller-profile.php'>Profile</a>
              </li>

              <li class='nav-item'>
                <a class='nav-link' href='request-sim-resupply.php'>Request SIM</a>
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
      <p class="header row-head" style="margin-bottom: 0px; display: flex; justify-content: center;">LOCAL SIM USERS REGISTERED BY YOUR SHOP</p>
      </div>
    </div>



      <form action="" method="GET">
          <!-- INPUT FIELD ROW -->
        <div class="row" style="margin-bottom: 2px; margin-top: 2rem!important; padding-left:2rem!important;padding-right:2rem!important;">
        <div class="col-md-3">
          <label class="labelings">Offense</label>
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name ="operator">
              <option selected >All</option>
              <option >No offense at present</option>
              <option >With offense</option>
              <option >First offense</option>
              <option>Second offense</option>
              <option>Third offense</option>
            </select>
        </div>

        <div class="col-md-3">
          <label class="labelings">Start date</label>
          <input class="form-control" type="date" name="start_date" style="width:100%!important;" >
        </div>
        <div class="col-md-3">
          <label class="labelings">End date</label>
          <input class="form-control" type="date" name="end_date" style="width:100%!important;">
      </div>
        </div>

        <div class="row" style="display:flex;margin-top:1rem;">
            <button type="" class="btn btn-primary" name="filters" style="margin-right: 10px;">Filter</button>
        </div>

      </form>
    <div class="table-responsive" style="margin-top: 2rem!important;">
    <table class="table table-striped" id="example">
      <thead>
        <tr>
          <th class="f-column text-truncate" scope="col" >SIM status</th>
          <th class="f-column text-truncate" scope="col" >SIM Card #</th>
          <th class="f-column text-truncate" scope="col" >Provider</th>
          <th class="f-column text-truncate" scope="col" >Last Name</th>
          <th class="f-column text-truncate" scope="col" >First Name</th>
          <th class="f-column text-truncate" scope="col" >Middle Name</th>
          <th class="f-column text-truncate" scope="col" >Suffix</th>
          <th class="f-column text-truncate" scope="col" >NSO #</th>
          <th class="f-column text-truncate" scope="col" >SIM User Type</th>
          <th class="f-column text-truncate" scope="col" >Address</th>
          <th class="f-column text-truncate" scope="col" >Penalty</th>
          <th class="f-column text-truncate" scope="col" >Registration Date</th>
          <th class="f-column text-truncate" scope="col" >Registered by</th>

        </tr>
      </thead>
      <tbody>

        <?php
        if (isset($_GET['filters'])){
          // include 'Joiningtable.inc.php';
          $start_date = $_GET['start_date'];
          $end_date   = $_GET['end_date'];
          if (empty($start_date)){
            $start_date = '2000-11-11';
          }
          if (empty($end_date)){
            $end_date = '9999-12-30';
          }
         // echo $start_date;
         // echo "<br>";
         // echo $end_date;
          //exit();
           switch($_GET['operator']){
               case "No offense at present":
                   $data = 'Active Status';
                   $querytype = 'A';
                   break;
               case "With offense":
                   $data = 'offense';
                   $querytype = 'C';
                   break;
               case "First offense":
                   $data = 'First offense';
                   $querytype = 'D';
                   break;
               case "Second offense":
                   $data = 'Second offense';
                   $querytype = 'D';
                   break;
               case "Third offense":
                   $data = 'Permanent ban';
                   $querytype = 'D';
                   break;
                case "All":
                   $querytype = 'B';
                   break;

           };

           if ($querytype=='A'){

              // first offense NO ISSUE. NO CHANGES NEEED
             $FirstOff = "SELECT l.sim_status, l.simnum, l.services, n.lastname, n.firstname, n.midname, n.suffix, l.nsonum,
             l.simcard, l.address, l.offense_count, l.dateofreg, l.sim_retailer
             FROM local_registered_simusers_db AS l LEFT JOIN nso_dummy_db as n ON l.nsonum = n.nsonum
             WHERE ((dateofreg between'$start_date' and '$end_date') AND
                          (sim_status = 'Active Status')) AND regisite='$businessaddress' ORDER BY lastname ASC;";
            //NO ISSUE
           }else if($querytype=='B'){
            $FirstOff = "SELECT l.sim_status, l.simnum, l.services, n.lastname, n.firstname, n.midname, n.suffix, l.nsonum,
            l.simcard, l.address, l.offense_count, l.dateofreg, l.sim_retailer
            FROM local_registered_simusers_db AS l LEFT JOIN nso_dummy_db as n ON l.nsonum = n.nsonum
            WHERE (dateofreg between'$start_date' and '$end_date') AND
                   regisite='$businessaddress' ORDER BY lastname ASC; ";

          }else if($querytype=='C'){
            $searchInput = mysqli_real_escape_string($conn, $_GET['input-search']);
            //((ban_start between'$start_date' and '$end_date') and (ban_end between '$start_date'AND '$end_date') AND (sim_status = N'First offense' OR sim_status = N'Second offense' OR sim_status = N'Permanent ban'))
            //THIS QUERY IS FOR BAN DATES
            $FirstOff ="SELECT l.sim_status, l.simnum, l.services, n.lastname, n.firstname, n.midname, n.suffix, l.nsonum,
            l.simcard, l.address, l.offense_count, l.dateofreg, l.sim_retailer
            FROM local_registered_simusers_db AS l LEFT JOIN nso_dummy_db as n ON l.nsonum = n.nsonum
            WHERE ((dateofreg between'$start_date' and '$end_date') AND
            (l.sim_status = N'First offense' OR l.sim_status = N'Second offense' OR l.sim_status = N'Permanent ban')) AND regisite='$businessaddress'  ORDER BY lastname ASC;";
           }else if($querytype=='D'){
              // first offense NO ISSUE. NO CHANGES NEEED
             $FirstOff = "SELECT l.sim_status, l.simnum, l.services, n.lastname, n.firstname, n.midname, n.suffix, l.nsonum,
             l.simcard, l.address, l.offense_count, l.dateofreg, l.sim_retailer
             FROM local_registered_simusers_db AS l LEFT JOIN nso_dummy_db as n ON l.nsonum = n.nsonum
             WHERE ((dateofreg between'$start_date' and '$end_date')AND
             (sim_status = N'$data')) AND regisite='$businessaddress'  ORDER BY lastname ASC;";


           }

           $result = mysqli_query($conn,$FirstOff);

           $resultCheck = mysqli_num_rows($result);
          }
              while($row = mysqli_fetch_assoc($result)):

        ?>

        <!-- <tr class="canHov" onclick="window.location='<?php echo "reported-message-content.php?id=".$row['passnum_nsonum']."&sent=".$row['lastname']."";?>';"> -->
        <tr>
          <th class="text-truncate"><?php echo $row['sim_status']?></th>
          <td class="text-truncate"><?php echo $row['simnum']; ?></td>
          <td class="text-truncate"><?php echo $row['services']; ?></td>
          <td class="text-truncate"><?php echo $row['lastname']; ?></th>
          <td class="text-truncate"><?php echo $row['firstname']; ?></td>
          <td class="text-truncate"><?php echo $row['midname']; ?></td>
          <td class="text-truncate"><?php echo $row['suffix']; ?></td>
          <td class="text-truncate"><?php echo $row['nsonum']; ?></td>
          <td class="text-truncate"><?php echo $row['simcard']; ?></td>
          <td class="text-truncate"><?php echo $row['address']; ?></td>
          <td class="text-truncate"><?php echo $row['offense_count'] ?></td>
          <td class="text-truncate"><?php echo $row['dateofreg']; ?></td>
          <td class="text-truncate"><?php echo $row['sim_retailer']; ?></td>

        </tr>

      <?php endwhile; ?>



      </tbody>
    </table>

  </div>

  <!--Import jQuery -->

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

  <script>
$(document).ready(function() {
  $("#example").DataTable({
    aaSorting: [],
    searching: true,
    responsive: true,
    "bLengthChange": true,
    lengthMenu: [[5,10,25,50,-1], [5,10,25,50,"All"]],
    columnDefs: [
      {
        responsivePriority: 1,
        targets: 0
      },
      {
        responsivePriority: 2,
        targets: -1
      },
    ],
    dom: 'Bfrtip',
    buttons: [
      'pageLength','csv', 'excel',
      {
      extend: "print",
      customize: function(win)
      {

          var last = null;
          var current = null;
          var bod = [];

          var css = '@page { size: landscape; }',
              head = win.document.head || win.document.getElementsByTagName('head')[0],
              style = win.document.createElement('style');

          style.type = 'text/css';
          style.media = 'print';

          if (style.styleSheet)
          {
            style.styleSheet.cssText = css;
          }
          else
          {
            style.appendChild(win.document.createTextNode(css));
          }

          head.appendChild(style);
   }
}
      ]
  });

});
</script>


</body>

</html>
