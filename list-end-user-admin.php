<?php
  require 'includes/dbh.inc.php';
  // $sql = "SELECT * FROM registered_simusers_db ORDER BY lastname ASC";
  // $result = mysqli_query($conn, $sql);
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
      <p class="header row-head" style="margin-bottom: 0px; display: flex; justify-content: center;color: #b40032;">LIST OF REGISTERED SIM USERS</p>
      </div>
    </div>



      <form action="" method="GET">
          <!-- INPUT FIELD ROW -->
        <div class="row" style="margin-bottom: 2px; margin-top: 2rem!important; padding-left:2rem!important;padding-right:2rem!important;">
        <div class="col-md-3">
          <label class="labelings">Search</label>
          <input class="form-control search-input" type="search" placeholder="Search" aria-label="Search" name="input-search" style="width:100%!important;">
        </div>
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
          <label class="labelings">Marked as Malicious SIMs from</label>
          <input class="form-control" type="date" name="start_date" style="width:100%!important;" >
        </div>
        <div class="col-md-3">
          <label class="labelings">End range</label>
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
          <th class="f-column text-truncate" scope="col" ></th>
          <th class="f-column text-truncate" scope="col" >SIM Status</th>
          <th class="f-column text-truncate" scope="col" >Penalty</th>
          <th class="f-column text-truncate" scope="col" >Date blocked</th>
          <th class="f-column text-truncate" scope="col" >End of block period</th>
          <th class="f-column text-truncate" scope="col" >SIM Card #</th>
          <th class="f-column text-truncate" scope="col" >SIM Type</th>
          <th class="f-column text-truncate" scope="col" >Provider</th>
          <th class="f-column text-truncate" scope="col" >Last Name</th>
          <th class="f-column text-truncate" scope="col" >First Name</th>
          <th class="f-column text-truncate" scope="col" >Middle Name</th>
          <th class="f-column text-truncate" scope="col" >Suffix</th>
          <th class="f-column text-truncate" scope="col" >Gender</th>
          <th class="f-column text-truncate" scope="col" >Birthdate</th>
          <th class="f-column text-truncate" scope="col" >Address</th>
          <th class="f-column text-truncate" scope="col" >Nationality</th>
          <th class="f-column text-truncate" scope="col" >NSO / Passport #</th>
          <th class="f-column text-truncate" scope="col" >SIM Shop</th>
          <th class="f-column text-truncate" scope="col" >Registration Site</th>
          <th class="f-column text-truncate" scope="col" >SIM Retailer</th>
          <th class="f-column text-truncate" scope="col" >Registration Date</th>
          <th class="f-column text-truncate" scope="col" >Registration Time</th>
          <th class="f-column text-truncate" scope="col" >Fingerprint</th>
          <th class="f-column text-truncate" scope="col" >NSO / PASSPORT</th>
          <th class="f-column text-truncate" scope="col" >Valid ID</th>
          <th class="f-column text-truncate" scope="col" >Company Name</th>
          <th class="f-column text-truncate" scope="col" >Company Address</th>
          <th class="f-column text-truncate" scope="col" >Employee ID</th>
          <th class="f-column text-truncate" scope="col" >Company Endorsement</th>



        </tr>
      </thead>
      <tbody>

        <?php
        // if (isset($_GET['filters'])){
          // include 'Joiningtable.inc.php';

           // switch($_GET['operator']){
           //     case "No offense at present":
           //         $data = 'Active Status';
           //         $querytype = 'A';
           //         break;
           //     case "With offense":
           //         $data = 'offense';
           //         $querytype = 'C';
           //         break;
           //     case "First offense":
           //         $data = 'First offense';
           //         $querytype = 'A';
           //         break;
           //     case "Second offense":
           //         $data = 'Second offense';
           //         $querytype = 'A';
           //         break;
           //     case "Third offense":
           //         $data = 'Permanent ban';
           //         $querytype = 'A';
           //         break;
           //      case "All":
           //         $querytype = 'B';
           //         break;
           //
           // };
           // if ($querytype=='A'){
           //   $searchInput = mysqli_real_escape_string($conn, $_GET['input-search']);

              // first offense
        //      $FirstOff = "SELECT * FROM registered_simusers_db WHERE sim_status = N'$data' AND (lastname LIKE '%$searchInput%' OR firstname LIKE '%$searchInput%' OR midname LIKE '%$searchInput%' OR suffix LIKE '%$searchInput%' OR dateofbirth LIKE '%$searchInput%' OR gender LIKE '%$searchInput%' OR passnum_nsonum LIKE '%$searchInput%' OR address LIKE '%$searchInput%' OR nationality LIKE '%$searchInput%'
        //      OR simcard LIKE '%$searchInput%'  OR simnum LIKE '%$searchInput%' OR regisite LIKE '%$searchInput%' OR dateofregis LIKE '%$searchInput%' OR time LIKE '%$searchInput%')  ORDER BY lastname ASC;";
        //    }else if($querytype=='B'){
        //     $searchInput = mysqli_real_escape_string($conn, $_GET['input-search']);
        //     $FirstOff = "SELECT * FROM registered_simusers_db WHERE lastname LIKE '%$searchInput%' OR firstname LIKE '%$searchInput%' OR midname LIKE '%$searchInput%' OR suffix LIKE '%$searchInput%' OR dateofbirth LIKE '%$searchInput%' OR gender LIKE '%$searchInput%' OR passnum_nsonum LIKE '%$searchInput%' OR address LIKE '%$searchInput%' OR nationality LIKE '%$searchInput%' OR simcard LIKE '%$searchInput%' OR simnum LIKE '%$searchInput%' OR regisite LIKE '%$searchInput%' OR dateofregis LIKE '%$searchInput%' OR time LIKE '%$searchInput%' ORDER BY lastname ASC; ";
        //    }else if($querytype=='C'){
        //     $searchInput = mysqli_real_escape_string($conn, $_GET['input-search']);
        //     $FirstOff ="SELECT * FROM registered_simusers_db WHERE (sim_status = N'First offense' OR sim_status = N'Second offense' OR sim_status = N'Permanent ban') AND (lastname LIKE '%$searchInput%' OR firstname LIKE '%$searchInput%' OR midname LIKE '%$searchInput%' OR suffix LIKE '%$searchInput%' OR dateofbirth LIKE '%$searchInput%' OR gender LIKE '%$searchInput%' OR passnum_nsonum LIKE '%$searchInput%' OR address LIKE '%$searchInput%' OR nationality LIKE '%$searchInput%'
        //     OR simcard LIKE '%$searchInput%'  OR simnum LIKE '%$searchInput%' OR regisite LIKE '%$searchInput%' OR dateofregis LIKE '%$searchInput%' OR time LIKE '%$searchInput%')  ORDER BY lastname ASC;";
        //    }
        //
        //    $result = mysqli_query($conn,$FirstOff);
        //
        //    $resultCheck = mysqli_num_rows($result);
        //   }
        //       while($row = mysqli_fetch_assoc($result)):
        //
        // ?>

        <!-- <tr class="canHov" onclick="window.location='<?php echo "update-end-user-info.php?id=".$row['passnum_nsonum']."&sent=".$row['lastname']."";?>';"> -->
        <tr>
          <td class="text-truncate"><a href="includes/delete-end-user.php?del_id=<?php echo ''; ?>" class="btn btn-danger">Delete</a></td>
          <td class="f-column text-truncate">Active</th>
          <td class="f-column text-truncate">0</th>
          <td class="f-column text-truncate">--</th>
          <td class="f-column text-truncate">--</th>
          <td class="f-column text-truncate">+639127680000</th>
          <td class="f-column text-truncate">existing prepaid user</th>
          <td class="f-column text-truncate">Globe</th>
          <td class="f-column text-truncate">Araneta</th>
          <td class="f-column text-truncate">Paolo</th>
          <td class="f-column text-truncate">Cruz</th>
          <td class="f-column text-truncate">III</th>
          <td class="f-column text-truncate">M</th>
          <td class="f-column text-truncate">1999-01-01</th>
          <td class="f-column text-truncate">Blk 5, Lot 16, Pluto</th>
          <td class="f-column text-truncate">Filipino</th>
          <td class="f-column text-truncate">02122-TEST-3</th>
          <td class="f-column text-truncate">Cavite SIM shop</th>
          <td class="f-column text-truncate">Aguinaldo Highway, Dasmarinas, Cavite</th>
          <td class="f-column text-truncate">Karen Reyes</th>
          <td class="f-column text-truncate">2021-09-11</th>
          <td class="f-column text-truncate">time here</th>
          <td class="f-column text-truncate">fingerprintlink.com</th>
          <td class="f-column text-truncate">nso-passlink.com</th>
          <td class="f-column text-truncate">idlink.com</th>
          <td class="f-column text-truncate">Electronics Inc.</th>
          <td class="f-column text-truncate">Aguinaldo Highway, Pluto</th>
          <td class="f-column text-truncate">BPphoto.com</th>
          <td class="f-column text-truncate">Endorsepic.com</th>



        </tr>


      <!-- <?php //endwhile; ?> -->



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
            'pageLength','copy', 'csv', 'excel', 'pdf',
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
