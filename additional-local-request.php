<?php
  require 'includes/dbh.inc.php';
   $sql = "SELECT * FROM request_reg_db
   WHERE nationality = N'Filipino'
   ORDER BY lastname ASC";
   $result = mysqli_query($conn, $sql);
?>
<?php
  // session_start();
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"> </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"> </script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

  <!-- <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"> </script> -->
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
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
    <p class="header row-head" style="margin-bottom: 0px; display: flex; justify-content: center;color: #b40032;">LIST OF LOCAL USERS REQUESTING FOR ADDITIONAL SIM WITH THE SAME PROVIDER</p>
    </div>
  </div>



    <form action="" method="GET">
        <!-- INPUT FIELD ROW -->
      <div class="row" style="margin-bottom: 2px; margin-top: 2rem!important; padding-left:2rem!important;padding-right:2rem!important;">
      <div class="col-md-4">
        <label class="labelings">Search</label>
        <input class="form-control search-input" type="search" placeholder="Search" aria-label="Search" name="input-search" style="width:100%!important;">
      </div>

      <div class="col-md-4">
        <label class="labelings">Received from</label>
        <input class="form-control" type="date" name="start_date" style="width:100%!important;" >
      </div>
      <div class="col-md-4">
        <label class="labelings">End range</label>
        <input class="form-control" type="date" name="end_date" style="width:100%!important;">
    </div>

      </div>

      <div class="row" style="display:flex;margin-top:1rem;">
          <button type="" class="btn btn-primary" name="filters">Filter</button>
          <!-- <a href="#" class="btn btn-primary">Export to Excel</a> -->
      </div>

    </form>
  <div class="table-responsive" style="margin-top: 2rem!important;">
  <table class="table table-striped" id="example">
    <thead>
      <tr>
        <th class="f-column text-truncate" scope="col" ></th>
        <th class="f-column text-truncate" scope="col" ></th>
        <th class="f-column text-truncate" scope="col" >Last Name</th>
        <th class="f-column text-truncate" scope="col" >First Name</th>
        <th class="f-column text-truncate" scope="col" >Middle Name</th>
        <th class="f-column text-truncate" scope="col" >Suffix</th>
        <th class="f-column text-truncate" scope="col" >Type of user</th>
        <th class="f-column text-truncate" scope="col" >SIM #</th>
        <th class="f-column text-truncate" scope="col" >Provider Requested</th>
        <th class="f-column text-truncate" scope="col" >Reason for requesting</th>
        <th class="f-column text-truncate" scope="col" >NSO #</th>
        <th class="f-column text-truncate" scope="col" >Address</th>
        <th class="f-column text-truncate" scope="col" >Gender</th>
        <th class="f-column text-truncate" scope="col" >Birthdate</th>
        <th class="f-column text-truncate" scope="col" >Registration Site</th>
        <th class="f-column text-truncate" scope="col" >SIM Shop</th>
        <th class="f-column text-truncate" scope="col" >Registered by</th>
        <th class="f-column text-truncate" scope="col" >Registration Date</th>
        <th class="f-column text-truncate" scope="col" >Registration Time</th>
        <th class="f-column text-truncate" scope="col" >Fingerprint</th>
        <th class="f-column text-truncate" scope="col" >NSO</th>
        <th class="f-column text-truncate" scope="col" >Valid ID</th>



      </tr>
    </thead>
    <tbody>

    <?php
       if (isset($_GET['filters'])){
        // include 'Joiningtable.inc.php';

        $start_date = $_GET['start_date'];
        $end_date   = $_GET['end_date'];
        if (empty($start_date)){
          $start_date = '0000-00-00';}
        if (empty($end_date)){
          $end_date = '9999-12-30';}

          $sql = "SELECT * FROM request_reg_db
          WHERE nationality = N'Filipino' AND dateofregis BETWEEN '$start_date' AND '$end_date'
          ORDER BY lastname ASC";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);
        }
             while($row = mysqli_fetch_assoc($result)):
                   $simnum = $row['simnum'];
                   $simnum = trim($simnum,"+");
      // ?>

      <!-- <tr class="canHov" onclick="window.location='<?php echo "update-end-user-info.php?id=".$row['passnum_nsonum']."&sent=".$row['lastname']."";?>';"> -->
      <tr>
        <td class="text-truncate"><a href="additional_approve/approve_local.php?request=<?php echo $simnum;?>" class="btn btn-success">Approve</a></td>
        <td class="text-truncate"><a href="additional_approve/delete.php?request=<?php echo  $simnum; ?>" class="btn btn-danger">Deny</a></td>
        <td class="f-column text-truncate"><?php echo $row['lastname'] ?></th>
        <td class="f-column text-truncate"><?php echo $row['firstname'] ?></th>
        <td class="f-column text-truncate"><?php echo $row['midname'] ?></th>
        <td class="f-column text-truncate"><?php echo $row['suffix'] ?></th>
        <td class="f-column text-truncate"><?php echo $row['simcard'] ?></th>
        <td class="f-column text-truncate"><?php echo $simnum ?></th>
        <td class="f-column text-truncate"><?php echo $row['services'] ?></th>
        <td class="f-column text-truncate"><?php echo $row['remarks'] ?></th>
        <td class="f-column text-truncate"><?php echo $row['passnum_nsonum'] ?></th>
        <td class="text-truncate"><?php echo $row['address'] ?></th>
        <td class="f-column text-truncate"><?php echo $row['gender'] ?></th>
        <td class="f-column text-truncate"><?php echo $row['dateofbirth'] ?></th>
        <td class="f-column text-truncate"><?php echo $row['regisite'] ?></th>
        <td class="f-column text-truncate"><?php echo $row['sim_shop'] ?></th>
        <td class="f-column text-truncate"><?php echo $row['sim_retailer'] ?></th>
        <td class="f-column text-truncate"><?php echo $row['dateofregis'] ?></th>
        <td class="f-column text-truncate"><?php echo $row['time'] ?></th>
        <td class="f-column text-truncate"><?php echo $row['fingerprint_File_Format'] ?></th>
        <td class="f-column text-truncate"><?php echo $row['link_nsopass_pic'] ?></th>
        <td class="f-column text-truncate"><?php echo $row['link_id_pic'] ?></th>


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
    'pageLength'
    ]
});

});
</script>
</body>

</html>
