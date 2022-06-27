<?php
  require 'includes/dbh.inc.php';
  $simnum = mysqli_real_escape_string($conn, $_GET['simnum']);
  $throw  = $simnum;
  $simnum = '+'.$simnum;
?>
<?php
session_start();
if (empty($_SESSION['AdminEmail'])){
  header("Location: index.php");
  exit();


}
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

        <form class="form-btnn" action="#" method="POST">
          <button type="submit" name="btn-primary" class="log-button">Logout</button>
        </form>
      </div>
    </nav>
  </header>

  <!-- BODY PART -->
  <div class="container" style="background-color:#f3f3f3;">
    <div class="row header">
          <h2 style="color:#b40032;">Edit Local SIM User Information</h2>
        </div>

          <!-- <form class="" action="register-users-local.php" method="GET"> -->
<?php
        $fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if(strpos($fulUrl, "signup=success") == true){
          echo "<p class= 'regsuccess'>USER SUCCESSFULLY REGISTERED</p>";
        }
        elseif(strpos($fulUrl, "error=notemail") == true){
          echo "<p class= 'nsoexist'>ENTER A VALID EMAIL FORMAT</p>";
        }
        elseif(strpos($fulUrl, "error=incorrectNum") == true){
          echo "<p class= 'nsoexist'>ENTER CORRECT PHONE NUMBER DIGIT</p>";
        }
        elseif(strpos($fulUrl, "email-already-exist") == true){
          echo "<p class= 'nsoexist'>THIS EMAIL HAS BEEN ALREADY TAKEN</p>";
        }
        elseif(strpos($fulUrl, "imageempty") == true){
          echo "<p class= 'nsoexist'>YOU HAVE SUBMITTED INSUFFICIENT DOCUMENTS</p>";
        }
        elseif(strpos($fulUrl, "imageformaterror") == true){
          echo "<p class= 'nsoexist'>INCORRECT IMAGE FORMAT. ENTER JPG, PNG, OR BMP ONLY</p>";
        }
        elseif(strpos($fulUrl, "imagelarge") == true){
          echo "<p class= 'nsoexist'>IMAGE IS TOO LARGE. PLEASE DECOMPRESS IT</p>";
        }
        elseif(strpos($fulUrl, "imageerror") == true){
          echo "<p class= 'nsoexist'>THERE IS A PROBLEM IN YOUR IMAGE. ENTER AGAIN</p>";
        }
        elseif(strpos($fulUrl, "error=wrongchars") == true){
          echo "<p class= 'nsoexist'>ENTER NUMBERS ONLY IN MOBILE INPUT</p>";
        }
        elseif(strpos($fulUrl, "error=notmatchpass") == true){
          echo "<p class= 'nsoexist'>THE PASSWORD YOU SET DID NOT MATCH</p>";
        }
        elseif(strpos($fulUrl, "error=notmatchowner") == true){
          echo "<p class= 'nsoexist'>THE OWNER KEY YOU SET DID NOT MATCH</p>";
        }
        elseif(strpos($fulUrl, "passworderror") == true){
          echo "<p class= 'nsoexist'>ENTER ATLEAST 6 CHAR FOR PASSWORD</p>";
        }
        elseif(strpos($fulUrl, "error=notmatchowner") == true){
          echo "<p class= 'nsoexist'>ENTER ATLEAST 8 CHAR FOR OWNER KEY</p>";
        }
        elseif(strpos($fulUrl, "error=simnum-not-regis") == true){
          echo "<p class= 'nsoexist'>THE SIM NUMBER YOU ENTER IS NOT REGISTERED</p>";
        }
        elseif(strpos($fulUrl, "error=seller-already-register") == true){
          echo "<p class= 'nsoexist'>THIS SELLER IS ALREADY REGISTER UNDER DIFFERENT ACCOUNT</p>";
        }
        elseif(strpos($fulUrl, "ownerkey-already-exist") == true){
          echo "<p class= 'nsoexist'>OWNER-KEY ALREADY TAKEN</p>";
        }
        elseif(strpos($fulUrl, "keyerror") == true){
          echo "<p class= 'nsoexist'>ENTER 8 OR MORE CHARACTERS FOR OWNER KEY</p>";
        }
        elseif(strpos($fulUrl, "error=simlimitinvalid") == true){
          echo "<p class= 'nsoexist'>ENTER NUMBERS ON SIM LIMIT ONLY</p>";
        }



?>


   <form class="" action="admin_edit_selected_user/admin_back_local_user.php?simnum=<?php echo $throw ?>" method="POST" enctype="multipart/form-data">
     <!-- INITIAL = NOT YET PRESSING BUTTON SEARCH DATABASE : EMPTY FIELD -->
     <?php
     $query = "SELECT n.lastname as lastname, n.firstname as firstname, n.midname as midname, n.suffix as suffix, n.dateofbirth as dateofbirth,
                      n.gender as gender, n.nsonum as nsonum, l.sim_status as sim_status, l.offense_count as offense_count, l.ban_start as ban_start,
                      l.ban_end as ban_end, l.address as address, l.simcard as simcard, l.simnum as simnum, l.services as servies,
                      l.dateofreg as dateofreg, l.sim_retailer as sim_retailer, l.sim_shop as sim_shop , l.regisite as regisite
               FROM local_registered_simusers_db AS l LEFT JOIN nso_dummy_db as n ON  l.nsonum = n.nsonum
               WHERE l.simnum = '$simnum';";
     $result = mysqli_query($conn,$query);

       if (mysqli_num_rows($result) > 0) {
         // if there is a result
         foreach ($result as $row) {
          if($row['ban_start'] == '--'){
                $ban_start = '2000-00-00';
          }else{
            $ban_start = $row['ban_start'];
          }
          if($row['ban_end'] =='--'){
            $ban_end = '2050-12-25';
          }else{
            $ban_end = $row['ban_end'];
          }
           ?>
         <!-- FIRST ROW -->
         <div class="row">

           <div class="col-md-3 infodiv">
             <label class="labelings">Last Name</label>
             <input id="lastname" type="text" name="lastname" class="form-control" value="<?= $row['lastname'] ?>" disabled>
           </div>

           <div class="col-md-3 infodiv">
             <label class="labelings">First Name</label>
             <input id="firstname" type="text" name="firstname" class="form-control" value="<?= $row['firstname'] ?>" disabled>
           </div>

           <div class="col-md-3 infodiv">
             <label class="labelings">Middle Name</label>
             <input id="midname" type="text" name="midname" class="form-control" value="<?= $row['midname'] ?>" disabled>
           </div>

           <div class="col-md-3">
             <label class="labelings">Suffix</label>
             <input type="text" name="suffix" class="form-control" value="<?= $row['suffix'] ?>" disabled>
           </div>

         </div>

         <!-- SECOND ROW -->
         <div class="row" style="margin-bottom: 2rem; margin-top: 1rem;">
           <div class="col-md-3 infodiv">
             <label class="labelings">Date of Birth</label>
             <input id="dateofbirth" type="date" name="dateofbirth"  class="form-control" value="<?= $row['dateofbirth'] ?>" disabled>
           </div>
           <div class="col-md-3">
             <label class="labelings">Gender</label>
             <input  type="text" name="Gender"  class="Gender form-control" value="<?= $row['gender'] ?>" disabled>
           </div>
           <div class="col-md-6 infodiv">
             <label class="labelings">NSO Barcode Number</label>
             <input id="nsonum" type="text" name="nsonum" class="form-control"value="<?= $row['nsonum'] ?>" disabled >
           </div>

         </div>


         <?php

       }
     }


     ?>

     <div class="row srow">
       <div class="col-md-3 infodiv">
         <label class="Bday">SIM Status</label>
         <select class="custom-select mr-sm-2" id="name1" name ="operator">
           <option>Active Status</option>
          <option >First offense</option>
          <option>Second offense</option>
          <option>Third offense</option>
          <option>Permanent ban</option>

        </select>
        <script type="text/javascript">
          document.getElementById('name1').value = "<?php echo $row['sim_status'];?>";
        </script>

       </div>
       <div class="col-md-3 infodiv">
         <label class="Bday">Penalty</label>
         <input id="" type="text" name="offense_count" class="form-control" value="<?= $row['offense_count'] ?>" required>
       </div>
       <div class="col-md-3 infodiv">
         <label class="Bday">Date Blocked</label>
         <input id="" type="date" name="ban_start" class="form-control" value="<?= $row['ban_start']; ?>" >
       </div>
       <div class="col-md-3 infodiv">
         <label class="Bday">End of block Period</label>
         <input id="" type="date" name="ban_end" class="form-control" value="<?= $row['ban_end'] ?>">
       </div>
     </div>


       <div class="row srow">
         <div class="col-md-6">
           <div class="form-group">
             <label for="nso-attach">Attach NSO</label>
             <input type="file" name='NSOfile' class="form-control-file" id="nso-attach">
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             <label for="id-attach">Attach Valid ID</label>
             <input type="file" name='IDfile' class="form-control-file" id="id-attach">
           </div>
         </div>

       </div>

       <div class="row srow">
         <div class="col-12 infodiv">
           <label class="Bday">Address</label>
           <input id="address" type="text" name="address" value="<?= $row['address'] ?>" class="form-control" required>
         </div>
       </div>



       <div class="row srow">
         <div class="col-md-4">
           <label class="labelings">Type of Sim Card user</label>
           <select class="form-control" name="simcard" disabled>
             <option value="<?php echo 'EDIT COLUMN HERE'; ?>" selected><?php echo  $row['simcard']; ?></option>
           </select>
         </div>
         <div class="col-md-4 infodiv">
           <label class="labelings">Register SIM number</label>
           <div class="input-group mb-2">
           <div class="input-group-prepend">
             <div class="input-group-text">+63</div>
           </div>
           <input type="tel" class="form-control" id="simnum" name="simnum" value="<?= $row['simnum'] ?>" required disabled>
         </div>
         </div>
         <div class="col-md-4">
           <label class="labelings">SIM Telco</label>
           <select class="form-control" name="services" disabled>
             <option value="<?php echo $row['servies']; ?>"selected><?php echo $row['servies']; ?></option>
           </select>
         </div>
       </div>



       <!-- FIFTH ROW -->
       <div class="row srow">
         <div class="col-md-4 infodiv">
           <label class="labelings">Date of Registration</label>
           <input id="dateregis"type="date" name="dateofregis" class="form-control" value="<?php echo $row['dateofreg']; ?>" disabled required>
         </div>

         <div class="col-md-4 infodiv">
           <label class="labelings">Name of SIM retailer</label>
           <input id="regisite" type="text" name="retailer" class="form-control" value="<?php echo $row['sim_retailer']; ?>" disabled required>
         </div>

         <div class="col-md-4 infodiv">
           <label class="labelings">SIM Shop</label>
           <input id="regisite" type="text" name="sim_shop" class="form-control" value="<?php echo $row['sim_shop']; ?>" disabled required>
         </div>

       </div>

       <div class="row srow">

         <div class="col-md-12 infodiv">
           <label class="labelings">Registration Site</label>
           <input id=""type="text" name="regisite" class="form-control" value="<?php echo $row['regisite']; ?>" disabled required>
         </div>

       </div>


         <!-- PROCEED TO FINGERPRINT REGISTRATION BUTTON -->
         <div class="row srow">
           <div class="col-md-6">
             <div class="form-group">
               <label for="exampleFormControlFile1">Attach Fingerprint Image</label>
               <input type="file" name='Fingerfile' class="form-control-file" id="exampleFormControlFile1">
             </div>
           </div>

         <div class="col-md-6">
           <button type="submit" name="register" class="send-btn">Update</button>
     </div>
     </div>

   </div>

     </form>


      <?php


  ?>



</div>


<!-- end of body -->

 </body>
</html>
