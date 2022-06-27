<?php

include_once "../includes/dbh.inc.php";
$id = mysqli_real_escape_string($conn, $_GET['resupply']);
// echo "$id";
// $sim_amount_requested  = mysqli_real_escape_string($conn, $_GET['sim_amount_requested']);
// $Simcard_Limit = mysqli_real_escape_string($conn, $_GET['Simcard_Limit']);
// $Max_Limit_Assign = mysqli_real_escape_string($conn, $_GET['Simcard_Limit']);
// $Simcard_Limit = $_SESSION['Simcard_Limit'];
// $Max_Limit_Assign = $_SESSION['Max_Limit_Assign'];
// $sim_amount_requested = $_SESSION['sim_amount_requested'];
//s.Simcard_Limit AND r.sim_amount_requested
$sql = "SELECT s.Max_Limit_Assign as Max_Limit_Assign, s.Simcard_Limit as Simcard_Limit, r.sim_amount_requested as sim_amount_requested
        FROM seller AS s LEFT JOIN resupply_requests as r ON s.selleremail = r.selleremail
        WHERE r.request_id = '$id'
        ";

        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)):
          $sim_amount_requested = $row['sim_amount_requested'];
          $Max_Limit_Assign = $row['Max_Limit_Assign'];
          $Simcard_Limit = $row['Simcard_Limit'];
endwhile;
$sim_amount = $sim_amount_requested + $Simcard_Limit;
echo "$sim_amount";
echo "$sim_amount_requested";
echo "$Simcard_Limit";


if($sim_amount < $Max_Limit_Assign){
  // mysqli_query($conn, $sim_amount_requested);
  echo "$sim_amount";
  exit();
  //DELETE
  // $sql = "DELETE FROM resupply_requests
  //        WHERE sim_amount_requested = '$id' ";
  //  mysqli_query($conn, $sql);
   header("Location: ../admin-resupply-request.php?done=resupply");
   exit();

}else if ($sim_amount > $Max_Limit_Assign){
  $resupply = $sim_amount - $Max_Limit_Assign;
  $simtotal = $Simcard_Limit + $resupply;
  // mysqli_query($conn, $sim_amount);
  echo "$simtotal";
  exit();
  //DELETE
  // $sql = "DELETE FROM resupply_requests
  //        WHERE sim_amount_requested = '$id' ";
  //  mysqli_query($conn, $sql);
   header("Location: ../admin-resupply-request.php?done=resupply");
   exit();
}

//DELETE
// $sql = "DELETE FROM resupply_requests
//        WHERE sim_amount_requested = '$id' ";
//  mysqli_query($conn, $sql);
//  header("Location: ../admin-resupply-request.php?done=resupply");
//  exit();

 // //UPDATE seller
 // $sql = "UPDATE resupply_requests, seller
 // SET sim_amount_requested = '$sim_amount_requested'
 //    Simcard_Limit = '$Simcard_Limit'
 // WHERE resupply_requests.
 // mysqli_query($conn, $sql);
