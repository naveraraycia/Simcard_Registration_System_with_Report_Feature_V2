<?php
  require 'includes/dbh.inc.php';
   $sql = "SELECT r.reported_number as reported_number, COALESCE(p.lastname,NULL, n.lastname ) AS Reported_Last_Name ,
   COALESCE(p.firstname,NULL, n.firstname ) AS Reported_First_Name,
               COALESCE(a.simnum, NULL , b.simnum) AS Complainant_sim_num,
               COALESCE(d.lastname,NULL,e.lastname) AS Complainant_first_name,
               COALESCE(d.firstname,NULL,e.firstname) AS Complainant_last_name,
               r.reported_number as reported_number, r.report_id as report_id,
                      r.remarks as remarks, r.sent_at as sent_at
    FROM report_messages_db as r LEFT JOIN local_registered_simusers_db as l ON r.reported_number = l.simnum
    LEFT JOIN foreign_registered_simusers_db as f ON r.reported_number = f.simnum
                  LEFT JOIN nso_dummy_db as n ON l.nsonum = n.nsonum
                  LEFT JOIN foreign_passport_db as p ON f.passnum = p.passnum
                  LEFT JOIN local_registered_simusers_db as a ON r.user_mobile_num = a.simnum
                  LEFT JOIN foreign_registered_simusers_db as b ON r.user_mobile_num = b.simnum
                  LEFT JOIN nso_dummy_db as d ON a.nsonum = d.nsonum
                  LEFT JOIN foreign_passport_db as e ON b.passnum = e.passnum;";
   $result = mysqli_query($conn, $sql);

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
    <p class="header row-head" style="margin-bottom: 0px; display: flex; justify-content: center;color: #b40032;">REPORT MESSAGE INBOX</p>
    </div>
  </div>



    <form action="" method="GET">
        <!-- INPUT FIELD ROW -->
      <div class="row" style="margin-bottom: 2px; margin-top: 2rem!important; padding-left:2rem!important;padding-right:2rem!important;">

        <?php
        if (isset($_GET['start_date']) OR isset($_GET['end_date'])){
          ?>
          <div class="col-md-4">
            <label class="labelings">Received from</label>
            <input class="form-control" value="<?php echo $_GET['start_date'] ?>" type="date" name="start_date" style="width:100%!important;" >
          </div>
          <div class="col-md-4">
            <label class="labelings">End range</label>
            <input class="form-control" value="<?php echo $_GET['end_date'] ?>" type="date" name="end_date" style="width:100%!important;">
        </div>
          <?php
        } else {
          ?>
          <div class="col-md-4">
            <label class="labelings">Received from</label>
            <input class="form-control" type="date" name="start_date" style="width:100%!important;" >
          </div>
          <div class="col-md-4">
            <label class="labelings">End range</label>
            <input class="form-control" type="date" name="end_date" style="width:100%!important;">
        </div>
           <?php
        }
         ?>

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
        <th class="f-column text-truncate" scope="col" >Complainant</th>
        <th class="f-column text-truncate" scope="col" >Complainant's #</th>
        <th class="f-column text-truncate" scope="col" >Reported #</th>
        <th class="f-column text-truncate" scope="col" >Owner of Reported #</th>
        <th class="f-column text-truncate" scope="col" >Message</th>
        <th class="f-column text-truncate" scope="col" >Date Submitted</th>

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
          $end_date = '0000-00-00';}

          $FirstOff = "SELECT r.reported_number as reported_number, COALESCE(p.lastname,NULL, n.lastname ) AS Reported_Last_Name ,
          COALESCE(p.firstname,NULL, n.firstname ) AS Reported_First_Name,
                      COALESCE(a.simnum, NULL , b.simnum) AS Complainant_sim_num,
                      COALESCE(d.lastname,NULL,e.lastname) AS Complainant_first_name,
                      COALESCE(d.firstname,NULL,e.firstname) AS Complainant_last_name,
                      r.reported_number as reported_number, r.report_id as report_id,
                      r.remarks as remarks, r.sent_at as sent_at
           FROM report_messages_db as r LEFT JOIN local_registered_simusers_db as l ON r.reported_number = l.simnum
           LEFT JOIN foreign_registered_simusers_db as f ON r.reported_number = f.simnum
                         LEFT JOIN nso_dummy_db as n ON l.nsonum = n.nsonum
                         LEFT JOIN foreign_passport_db as p ON f.passnum = p.passnum
                         LEFT JOIN local_registered_simusers_db as a ON r.user_mobile_num = a.simnum
                         LEFT JOIN foreign_registered_simusers_db as b ON r.user_mobile_num = b.simnum
                         LEFT JOIN nso_dummy_db as d ON a.nsonum = d.nsonum
                         LEFT JOIN foreign_passport_db as e ON b.passnum = e.passnum
       WHERE r.sent_at BETWEEN '$start_date' AND '$end_date'";
         $result = mysqli_query($conn,$FirstOff);
      //
          $resultCheck = mysqli_num_rows($result);
        }
             while($row = mysqli_fetch_assoc($result)):
              $report_id = $row['report_id'];
              $data =$row['sent_at'];
      //
      // ?>
        <!-- <tr class="canHov" onclick="window.location='<?php echo "update-end-user-info.php?id=".$row['report_id']."&sent=".$row['lastname']."";?>';"> -->
       <tr class="canHov" onclick="window.location='report-content.php?id=<?php echo $row['report_id'];?>';">
        <!-- <td class="text-truncate"><a href="includes/delete-end-user.php?del_id=<?php echo ''; ?>" class="btn btn-danger">Delete</a></td>  -->
        <td class="f-column text-truncate"><?php echo $row['Complainant_first_name']." ".$row['Complainant_last_name'] ?></th>  <!-- pa-concat nalang ng $row['firstname'] and $row['lastname'] -->
        <td class="f-column text-truncate"><?php echo $row['Complainant_sim_num']?></th>
        <td class="f-column text-truncate"><?php echo $row['reported_number']?></th>
        <td class="f-column text-truncate" style="color:#ff5f56;"><?php echo $row['Reported_First_Name']." ".$row['Reported_Last_Name']?></th>
        <td class="text-truncate"><?php echo $row['remarks']?></th>
        <td class="f-column text-truncate"><?php echo $data?></th>


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
    'pageLength','csv', 'excel', 'pdf',
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
