<?php
  require 'includes/dbh.inc.php';
   $sql = "SELECT b.sim_status as sim_status, b.offense_count as offense_count , b.ban_start as ban_start, b.ban_end as ban_end, b.simnum as simnum,
                  b.simcard as simcard, b.services as services, b.business_name as business_name, b.business_permit as business_permit, n.lastname as lastname,
                  n.firstname as firstname, n.midname as midname, n.suffix as suffix, n.gender as gender, n.dateofbirth as dateofbirth,
                  b.business_address as business_address, b.address as address, n.nsonum as nsonum, b.sim_shop as sim_shop, b.regisite as regisite,
                  b.sim_retailer as sim_retailer, b.dateofreg as dateofreg, b.fingerprint_File_Format as fingerprint_File_Format, b.business_permit as business_permit, b.num_permit as num_permit,
                  b.link_id_pic as link_id_pic,b.link_authletter as link_authletter,b.link_nso_pic as link_nso_pic
FROM business_entity_registered_simusers_db as b LEFT JOIN nso_dummy_db as n ON b.nsonum = n.nsonum ORDER BY lastname ASC";
   $result = mysqli_query($conn, $sql);
?>
<?php
   session_start();
   if (empty($_SESSION['AdminEmail'])){
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
      <p class="header row-head" style="margin-bottom: 0px; display: flex; justify-content: center;color: #b40032;">LIST OF REGISTERED BUSINESS ENTITY SIM USERS</p>
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
        <?php
        if (isset($_GET['start_date']) OR isset($_GET['end_date'])){
          ?>
          <div class="col-md-3">
            <label class="labelings">Marked as Malicious SIMs from</label>
            <input class="form-control" value="<?php echo $_GET['start_date'] ?>" type="date" name="start_date" style="width:100%!important;" >
          </div>
          <div class="col-md-3">
            <label class="labelings">End range</label>
            <input class="form-control" value="<?php echo $_GET['end_date'] ?>" type="date" name="end_date" style="width:100%!important;">
        </div>
          <?php
        } else {
          ?>
          <div class="col-md-3">
            <label class="labelings">Marked as Malicious SIMs from</label>
            <input class="form-control" type="date" name="start_date" style="width:100%!important;" >
          </div>
          <div class="col-md-3">
            <label class="labelings">End range</label>
            <input class="form-control" type="date" name="end_date" style="width:100%!important;">
        </div>
           <?php
        }
         ?>
        </div>

        <div class="row" style="display:flex;margin-top:1rem;">
            <button type="" class="btn btn-primary" name="filters" style="margin-right: 10px;">Filter</button>
        </div>

      </form>
    <div class="table-responsive" style="margin-top: 2rem!important;">
    <table class="table table-striped" id="example">
      <thead>
        <tr>
          <th class="f-column text-truncate notexport" scope="col" ></th>
          <th class="f-column text-truncate notexport" scope="col" ></th>
          <th class="f-column text-truncate notexport" scope="col" ></th>
          <th class="f-column text-truncate" scope="col" >User Status</th>
          <th class="f-column text-truncate" scope="col" >Penalty</th>
          <th class="f-column text-truncate" scope="col" >Date blocked</th>
          <th class="f-column text-truncate" scope="col" >End of block period</th>
          <th class="f-column text-truncate" scope="col" >SIM Card #</th>
          <th class="f-column text-truncate" scope="col" >SIM Type</th>
          <th class="f-column text-truncate" scope="col" >Provider</th>
          <th class="f-column text-truncate" scope="col" >Business Name</th>
          <th class="f-column text-truncate" scope="col" >Business Permit #</th>
          <th class="f-column text-truncate" scope="col" >Representative's Last Name</th>
          <th class="f-column text-truncate" scope="col" >First Name</th>
          <th class="f-column text-truncate" scope="col" >Middle Name</th>
          <th class="f-column text-truncate" scope="col" >Suffix</th>
          <th class="f-column text-truncate" scope="col" >Gender</th>
          <th class="f-column text-truncate" scope="col" >Birthdate</th>
          <th class="f-column text-truncate" scope="col" >Business Address</th>
          <th class="f-column text-truncate" scope="col" >Representative's Address</th>
          <th class="f-column text-truncate" scope="col" >Representative's NSO #</th>
          <th class="f-column text-truncate" scope="col" >SIM Shop</th>
          <th class="f-column text-truncate" scope="col" >Registration Site</th>
          <th class="f-column text-truncate" scope="col" >SIM Retailer</th>
          <th class="f-column text-truncate" scope="col" >Registration Date</th>



        </tr>
      </thead>
      <tbody>

      <?php
         if (isset($_GET['filters'])){
           $start_date = $_GET['start_date'];
           $end_date   = $_GET['end_date'];
           if (empty($start_date)){
             $start_date = '0000-00-00';
           }
           if (empty($end_date)){
             $end_date = '9999-12-30';
           }


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
                    $querytype = 'E';
                    break;
                 case "All":
                    $querytype = 'B';
                    break;

            };
            if ($querytype=='A'){


              // first offense
              $FirstOff = "SELECT b.sim_status as sim_status, b.offense_count as offense_count , b.ban_start as ban_start, b.ban_end as ban_end, b.simnum as simnum,
                                  b.simcard as simcard, b.services as services, b.business_name as business_name, b.business_permit as business_permit, n.lastname as lastname,
                                  n.firstname as firstname, n.midname as midname, n.suffix as suffix, n.gender as gender, n.dateofbirth as dateofbirth,
                                  b.business_address as business_address, b.address as address, n.nsonum as nsonum, b.sim_shop as sim_shop, b.regisite as regisite,
                                  b.sim_retailer as sim_retailer, b.dateofreg as dateofreg, b.fingerprint_File_Format as fingerprint_File_Format, b.business_permit as business_permit, b.num_permit as num_permit,
                                  b.link_id_pic as link_id_pic, b.link_authletter as link_authletter, b.link_nso_pic as link_nso_pic
                          FROM business_entity_registered_simusers_db as b LEFT JOIN nso_dummy_db as n ON b.nsonum = n.nsonum
                          WHERE sim_status = 'Active Status'
                          ORDER BY n.lastname ASC;";


            }else if($querytype=='B'){

             $FirstOff = "SELECT b.sim_status as sim_status, b.offense_count as offense_count , b.ban_start as ban_start, b.ban_end as ban_end, b.simnum as simnum,
                                  b.simcard as simcard, b.services as services, b.business_name as business_name, b.business_permit as business_permit, n.lastname as lastname,
                                  n.firstname as firstname, n.midname as midname, n.suffix as suffix, n.gender as gender, n.dateofbirth as dateofbirth,
                                  b.business_address as business_address, b.address as address, n.nsonum as nsonum, b.sim_shop as sim_shop, b.regisite as regisite,
                                  b.sim_retailer as sim_retailer, b.dateofreg as dateofreg, b.fingerprint_File_Format as fingerprint_File_Format, b.business_permit as business_permit, b.num_permit as num_permit,
                                  b.link_id_pic as link_id_pic, b.link_authletter as link_authletter, b.link_nso_pic as link_nso_pic
                            FROM business_entity_registered_simusers_db as b LEFT JOIN nso_dummy_db as n ON b.nsonum = n.nsonum
                            ORDER BY n.lastname ASC;";


            }else if($querytype=='C'){

             $FirstOff = "SELECT b.sim_status as sim_status, b.offense_count as offense_count , b.ban_start as ban_start, b.ban_end as ban_end, b.simnum as simnum,
                                  b.simcard as simcard, b.services as services, b.business_name as business_name, b.business_permit as business_permit, n.lastname as lastname,
                                  n.firstname as firstname, n.midname as midname, n.suffix as suffix, n.gender as gender, n.dateofbirth as dateofbirth,
                                  b.business_address as business_address, b.address as address, n.nsonum as nsonum, b.sim_shop as sim_shop, b.regisite as regisite,
                                  b.sim_retailer as sim_retailer, b.dateofreg as dateofreg, b.fingerprint_File_Format as fingerprint_File_Format, b.business_permit as business_permit, b.num_permit as num_permit,
                                  b.link_id_pic as link_id_pic, b.link_authletter as link_authletter, b.link_nso_pic as link_nso_pic
                          FROM business_entity_registered_simusers_db as b LEFT JOIN nso_dummy_db as n ON b.nsonum = n.nsonum
                          WHERE ((b.ban_start between'$start_date' and '$end_date') AND
                                (b.sim_status = N'First offense' OR b.sim_status = N'Second offense' OR b.sim_status = N'Permanent ban')) or b.sim_status = 'Permanent ban'
                          ORDER BY n.lastname ASC;";
            }else if($querytype=='D'){

              $FirstOff = "SELECT b.sim_status as sim_status, b.offense_count as offense_count , b.ban_start as ban_start, b.ban_end as ban_end, b.simnum as simnum,
                                  b.simcard as simcard, b.services as services, b.business_name as business_name, b.business_permit as business_permit, n.lastname as lastname,
                                  n.firstname as firstname, n.midname as midname, n.suffix as suffix, n.gender as gender, n.dateofbirth as dateofbirth,
                                  b.business_address as business_address, b.address as address, n.nsonum as nsonum, b.sim_shop as sim_shop, b.regisite as regisite,
                                  b.sim_retailer as sim_retailer, b.dateofreg as dateofreg, b.fingerprint_File_Format as fingerprint_File_Format, b.business_permit as business_permit, b.num_permit as num_permit,
                                  b.link_id_pic as link_id_pic, b.link_authletter as link_authletter, b.link_nso_pic as link_nso_pic
                          FROM business_entity_registered_simusers_db as b LEFT JOIN nso_dummy_db as n ON b.nsonum = n.nsonum
                           WHERE ((b.ban_start between'$start_date' and '$end_date') AND
                                 (b.sim_status = N'$data'))
                           ORDER BY n.lastname ASC;";
             }else if($querytype=='E'){

              $FirstOff = "SELECT b.sim_status as sim_status, b.offense_count as offense_count , b.ban_start as ban_start, b.ban_end as ban_end, b.simnum as simnum,
                                  b.simcard as simcard, b.services as services, b.business_name as business_name, b.business_permit as business_permit, n.lastname as lastname,
                                  n.firstname as firstname, n.midname as midname, n.suffix as suffix, n.gender as gender, n.dateofbirth as dateofbirth,
                                  b.business_address as business_address, b.address as address, n.nsonum as nsonum, b.sim_shop as sim_shop, b.regisite as regisite,
                                  b.sim_retailer as sim_retailer, b.dateofreg as dateofreg, b.fingerprint_File_Format as fingerprint_File_Format, b.business_permit as business_permit, b.num_permit as num_permit,
                                  b.link_id_pic as link_id_pic, b.link_authletter as link_authletter,b.link_nso_pic as link_nso_pic
                          FROM business_entity_registered_simusers_db as b LEFT JOIN nso_dummy_db as n ON b.nsonum = n.nsonum
                           WHERE ((b.ban_start between'$start_date' and '$end_date') AND
                                 (b.sim_status = N'Permanent ban'))
                           ORDER BY n.lastname ASC;";
             }

            $result = mysqli_query($conn,$FirstOff);

            $resultCheck = mysqli_num_rows($result);
           }
               while($row = mysqli_fetch_assoc($result)):
                $simnum = $row['simnum'];
                $thrownum = trim($simnum,"+");
                $ban_start = $row['ban_start'];
                $ban_end   = $row['ban_end'];
                if($ban_start = '0000-00-00'){
                  $ban_start = '---';
                }
                if($ban_end == '9999-12-30'){
                  $ban_end = '---';
                }
         ?>

        <!-- <tr class="canHov" onclick="window.location='<?php echo "update-end-user-info.php?id=".$row['passnum_nsonum']."&sent=".$row['lastname']."";?>';"> -->
        <tr>
          <td class="text-truncate"><a href="Admin_Table_Backend/userdelete.php?click=delete&simnum=<?php echo $thrownum ."&nation=business"; ?>" class="btn btn-danger">Delete</a></td>
            <td class="text-truncate"><a href="admin-edit-busent.php?simnum=<?php echo $thrownum; ?>" class="btn btn-success">Update</a></td>
            <td class="text-truncate"><a href="busent-content.php?simnum=<?php //echo  $throw; ?>" class="btn btn-primary">View</a></td>
            <td class="f-column text-truncate"><?php echo $row['sim_status'] ?></th>
            <td class="f-column text-truncate"><?php echo $row['offense_count'] ?></th>
            <td class="f-column text-truncate"><?php echo $ban_start ?></th>
            <td class="f-column text-truncate"><?php echo $ban_end ?></th>
            <td class="f-column text-truncate"><?php echo $simnum ?></th>
            <td class="f-column text-truncate"><?php echo $row['simcard'] ?></th>
            <td class="f-column text-truncate"><?php echo $row['services'] ?></th>
            <td class="f-column text-truncate"><?php echo $row['business_name'] ?></th>
            <td class="f-column text-truncate"><?php echo $row['num_permit'] ?></th>
            <td class="f-column text-truncate"><?php echo $row['lastname'] ?></th>
            <td class="f-column text-truncate"><?php echo $row['firstname'] ?></th>
            <td class="f-column text-truncate"><?php echo $row['midname'] ?></th>
            <td class="f-column text-truncate"><?php echo $row['suffix'] ?></th>
            <td class="f-column text-truncate"><?php echo $row['gender'] ?></th>
            <td class="f-column text-truncate"><?php echo $row['dateofbirth'] ?></th>
            <td class="f-column text-truncate"><?php echo $row['business_address'] ?></th>
            <td class="f-column text-truncate"><?php echo $row['address'] ?></th>
            <td class="f-column text-truncate"><?php echo $row['nsonum'] ?></th>
            <td class="f-column text-truncate"><?php echo $row['sim_shop'] ?></th>
            <td class="f-column text-truncate"><?php echo $row['regisite'] ?></th>
            <td class="f-column text-truncate"><?php echo $row['sim_retailer'] ?></th>
            <td class="f-column text-truncate"><?php echo $row['dateofreg'] ?></th>


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
                'pageLength',
                {
                  extend: 'excel',
                  exportOptions: {
                    columns: ':not(.notexport)'
                  }
                },
                {
                  extend: 'csv',
                  exportOptions: {
                    columns: ':not(.notexport)'
                  }
                },
                {
                  extend: 'pdf',
                  exportOptions: {
                    columns: ':not(.notexport)'
                  }
                },
                {
                  extend: 'print',
                  exportOptions: {
                    columns: ':not(.notexport)'
                  }
                }
            ]
        });

      });
      </script>


</body>

</html>
