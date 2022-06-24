<?php
  require 'includes/dbh.inc.php';

?>
<!-- <?php
$id = mysqli_real_escape_string($conn, $_GET['id']);
            $FirstOff ="SELECT  q.user_id as user_id, n.lastname as lastname, n.firstname as firstname, n.midname as midname, q.dates as dates,
                                l.simnum as simnum, q.update_req as update_req, q.message as message, q.nsopass_pic as nso_link
                        FROM update_user_db AS q LEFT JOIN local_registered_simusers_db AS l ON q.simnum = l.simnum
                        LEFT JOIN nso_dummy_db AS n ON l.nsonum = n.nsonum
                        WHERE l.simnum IS NOT NULL AND q.user_id ='$id'; ";
            $result = mysqli_query($conn,$FirstOff);
       $resultCheck = mysqli_num_rows($result);
       while($row = mysqli_fetch_assoc($result)):
                      $user_id = $row['user_id'];
                      $name    = $row['firstname']." ". $row['midname']." ". $row['lastname'];
                      $simnum  = $row['simnum'];
                      $update  = $row['update_req'];
                      $message = $row['message'];
                      $nso_link= $row['nso_link'];
       endwhile;  
       $thrownum = trim($simnum,"+");
?> -->

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
  <script src="https://kit.fontawesome.com/207a28b81e.js" crossorigin="anonymous"></script>


<style>

/* BUTTONS */
.send-btn {
  background-color: #b40032;
  color: white;
  font-weight: bold;
  width: 100%;
  height: 40px;
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

p{
  line-height: 200%;
}

.nameLabel{
  font-weight: bold;
  color:  #b40032;
}

.nameLabel span{
  font-weight: normal;
  color: black;
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


      <!-- MESSAGE PART -->

        <div class="container" style="background-color:#f3f3f3;">
          <div class="row" style="margin-bottom:1rem;">
            <?php
            ?>



            <!-- COLUMN 1 NAME AND USER'S CELLPHONE NUMBER -->

            <div class="col-12">
              <div class="infolabels">
                <p class="nameLabel">Name: <span><?php echo $name ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">User's Mobile number: <span><?php echo $simnum ?></span></p>
              </div>
              <div class="infolabels mb-5">
                <p class="nameLabel">Requested new address: <span class="text-primary"><?php echo $update ?></span></p>
              </div>
              <div class="infolabels">
                <p class="nameLabel">User's Reason for Updating</p>
              </div>
              <div class="infolabels mb-5">
                <p class="lighFontOnly"><?php echo $message ?></p>
              </div>

              <div class="row" style="margin-bottom:1rem;display:flex;justify-content:flex-start;">
                <div class="col-12"style="padding-left:0px;margin-right:0px;">
                  <!-- DITO PAKI LAGYAN NG PARAMETER YUNG update-end-user-info.php . pwedeng update-end-user-indo.php?nationality=foreign-->
                  <!-- tapos pagdating mo sa update-end-user-info.php mag get ka nalang . if nationality = foreign then mag select ka from foreign_registered , kapag nationality=local , select sa local_registered. -->
                  <!-- Hindi ko na kasi dinoble dito ung web page ng pageedit ng address ng local and foreign since same na same lang -->
                  <a href="update-end-user-info.php?click=confirm&id=<?php echo$user_id."&nationality=filipino";?>" class="btn btn-success" style="margin-right:10px;margin-bottom:10px;">Update</a>
                  <a href="Admin_Table_Backend/userdelete.php?click=userdelete&simnum=<?php echo $user_id ."&nation=filipino"; ?>" class="btn btn-danger"style="margin-right:10px;margin-bottom:10px;">Delete</a>

                </div>
              </div>

            </div>

    <?php
    // endwhile;
    // else :
    //   header("Location: report-content.php?error=noUser");
      // header("Location: Sim_Card_Registration_System_Final_Version/reported-message-content.php?error=noUser");
     // endif;
            ?>
          </div>


          <div class="row">
            <div class="col-12">
              <button type="button" name="button" class="send-btn replybtn" data-toggle="modal" data-target="#screenshotModal">View Submitted Proof</button>
            </div>
        </div>

        <!-- MODAL PART FOR SCREENSHOT -->
        <div class="modal fade" id="screenshotModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Submitted Proof</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- ATTACH THE IMAGE LINK HERE -->
                <img class="screenshot-img" src="<?php echo 'Request_Change_Database/'.$nso_link;    ?>" alt="Proof-for-update-place-URL-here">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        </div>



    </body>

    </html>
