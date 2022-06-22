<?php

  require 'includes/dbh.inc.php';
  $sql = "SELECT * FROM foreign_passport_db ORDER BY lastname ASC";
  $result = mysqli_query($conn, $sql);
  session_start();
  // if (empty($_SESSION['AdminEmail'])){
  //   header("Location: index.php");
  //   exit();
  // }

?>

<!-- register-users-local.php?nsonum=3864&button= -->
<!-- onclick="resetForm()" -->
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


<style>

/* BUTTONS */
.send-btn {
  background-color: #b40032;
  color: white;
  font-weight: bold;
  width: 100%;
  height: 100px;
  border-radius: 6px 6px 6px 6px;
  position: relative;
  margin-top: 1rem;
  margin-bottom: 2rem;
  border-width: 0;
}

.send-btn:hover {
  background-color:#dc3664;
  cursor: pointer;
  color: white;
}


.col-md-3 {
  margin-bottom: 2rem;
}



</style>
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

        <div class="row row-table-head" style="padding-bottom: 15px;">
          <div class="col-md-3">
          <p class="header row-head" style="margin-bottom: 0px; align-self: center; color: black;">Passport Database <a href="add-passport-record.php"
            ><i class="fa-solid fa-circle-plus icon-plus" style="color:#b40032;"></i></a></p>
          </div>

          <div class="col-md-9">

          </div>

        </div>


        <div class="table-responsive">
        <table class="table table-striped" id="example">
          <thead>
            <tr>
              <th class="f-column text-truncate" scope="col" >ID</th>
              <th class="f-column text-truncate" scope="col" >Last Name</th>
              <th class="f-column text-truncate" scope="col" >First Name</th>
              <th class="f-column text-truncate" scope="col" >Middle Name</th>
              <th class="f-column text-truncate" scope="col" >Suffix</th>
              <th class="f-column text-truncate" scope="col" >Date of Birth</th>
              <th class="f-column text-truncate" scope="col" >Gender</th>
              <th class="f-column text-truncate" scope="col" >Passport #</th>
              <th class="f-column text-truncate" scope="col" >Nationality</th>

            </tr>
          </thead>
          <tbody>

            <?php
                  while($row = mysqli_fetch_assoc($result)):
            ?>

            <tr>

              <th scope="row" class="text-truncate"><?php echo 'ex: 1' ?></th>
              <td class="text-truncate"><?php echo $row['lastname']; ?></td>
              <td class="text-truncate"><?php echo $row['firstname']; ?></td>
              <td class="text-truncate"><?php echo $row['midname']; ?></td>
              <td class="text-truncate"><?php echo $row['suffix']; ?></td>
              <td class="text-truncate"><?php echo $row['dateofbirth']; ?></td>
              <td class="text-truncate"><?php echo $row['gender']; ?></td>
              <td class="text-truncate"><?php echo $row['passnum']; ?></td>
              <td class="text-truncate"><?php echo $row['nationality']; ?></td>

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
              'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
          ]
      });

    });
    </script>


    </body>

    </html>
