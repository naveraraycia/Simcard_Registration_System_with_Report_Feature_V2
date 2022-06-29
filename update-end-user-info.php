<?php

  require 'includes/dbh.inc.php';
  $nation = mysqli_real_escape_string($conn, $_GET['nationality']);
  $id = mysqli_real_escape_string($conn, $_GET['id']);

  if($nation == 'filipino'){
              $sql = "SELECT q.user_id as user_id, n.lastname as lastname, n.firstname as firstname, n.midname as midname, q.dates as dates,
                         l.simnum as simnum, q.update_req as update_req, q.message as message, q.link_id_pic as nso_link
                      FROM update_user_db AS q LEFT JOIN local_registered_simusers_db AS l ON q.simnum = l.simnum
                      LEFT JOIN nso_dummy_db AS n ON l.nsonum = n.nsonum
                      WHERE l.simnum IS NOT NULL AND q.user_id ='$id';";

              $result = mysqli_query($conn,$sql);
              $resultCheck = mysqli_num_rows($result);
              while($row = mysqli_fetch_assoc($result)):
                            $id = $row['user_id'];
                            $name    = $row['firstname']." ". $row['midname']." ". $row['lastname'];
                            $simnum  = $row['simnum'];
                            $update  = $row['update_req'];
                            $message = $row['message'];
                            $nso_link= $row['nso_link'];
                            $nation  = "filipino";
            endwhile;  


    }elseif($nation == 'notfilipino' ){

              $sql ="SELECT q.user_id as user_id, n.lastname as lastname, n.firstname as firstname, n.midname as midname, q.dates as dates, l.passnum,
                            l.simnum as simnum, q.update_req as update_req, q.message as message, q.link_id_pic as nso_link
                     FROM update_user_db AS q LEFT JOIN foreign_registered_simusers_db AS l ON q.simnum = l.simnum
                     LEFT JOIN foreign_passport_db AS n ON l.passnum = n.passnum
                     WHERE l.simnum IS NOT NULL AND q.user_id ='$id';";
            
            $result = mysqli_query($conn,$sql);
            $resultCheck = mysqli_num_rows($result);
            while($row = mysqli_fetch_assoc($result)):
                          $user_id = $row['user_id'];
                          $name    = $row['firstname']." ". $row['midname']." ". $row['lastname'];
                          $simnum  = $row['simnum'];
                          $update  = $row['update_req'];
                          $message = $row['message'];
                          $nso_link= $row['nso_link'];
                          $nation  = "notfilipino";
       endwhile;  
    }
    session_start();
    $Adminfullname = $_SESSION['AdminFirstName']." ". $_SESSION['AdminLastName'];

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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

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
            <span class="brandname">Administrator:<?php echo $Adminfullname; ?></span>
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


        <!-- BODY PART -->
        <div class="container" style="background-color: #f3f3f3;">
          <div class="row header">
                <h2 style="color: #b40032;">UPDATE SIM USER ADDRESS</h2>

              </div>

              <form class="" action="" method="GET">
    <?php
            $fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            if(strpos($fulUrl, "signup=success") == true){
              echo "<p class= 'regsuccess'>USER SUCCESSFULLY REGISTERED</p>";
            }
            elseif(strpos($fulUrl, "error=nsomnum-already-exist") == true){
              echo "<p class= 'nsoexist'>REGISTRATION FAILED: THIS NSO NUMBER ALREADY EXISTS</p>";
            }
            elseif(strpos($fulUrl, "signup=EMPTY") == true){
              echo "<p class= 'regsuccess'FILL UP ALL FIELDS</p>";
            }
            elseif(strpos($fulUrl, "error=imagelarge") == true){
              echo "<p class= 'nsoexist'>IMAGE IS TOO LARGE</p>";
            }
            elseif(strpos($fulUrl, "error=nsomnum-already-exist") == true){
              echo "<p class= 'nsoexist'>REGISTRATION FAILED: THIS NSO NUMBER ALREADY EXISTS</p>";
            }
            elseif(strpos($fulUrl, "error=imageerror") == true){
              echo "<p class= 'regsuccess'>THERE WAS A PROBLEM IN YOUR IMAGE</p>";
            }
            elseif(strpos($fulUrl, "error=imageformaterror") == true){
              echo "<p class= 'nsoexist'>ENTER JPG, PNG, OR BMP ONLY</p>";
            }
            elseif(strpos($fulUrl, "error=ban") == true){
              echo "<p class= 'nsoexist'>THIS USER IS UNDER BAN AND CANNOT CHANGE UNTIL BAN IS LIFTED</p>";
            }
    ?>
  </form>

              <form class="" action="Admin_Table_Backend/update_change_local.php?id=<?php echo $id?>&nation=<?php echo $nation?>" method="POST" enctype="multipart/form-data">


             <!-- SECOND ROW -->


              <div class="row">
                <div class="col-md-12 infodiv">
                  <label class="labelings">Address</label>
                  <input id="lastname" type="text" name="newaddress" class="form-control" value="<?php echo $update ?>" required></input>
                </div>
              </div>

              <!-- UPDATE BUTTON -->

              <div class="row srow">
              <div class="col-md-12">
                <button type="submit" name="update" class="send-btn">Update</button>
              </div>
            </div>

         </form>

       </div>

    </body>

    </html>
