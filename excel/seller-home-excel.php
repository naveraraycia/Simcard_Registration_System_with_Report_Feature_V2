<?php
  require '../includes/dbh.inc.php';

  header('Content-type: application/vnd-ms-excel');
  $filename="seller_home.xls";
  header("Content-Disposition:attachment;filename=\"$filename\"");
?>

<table class="table table-striped">
  <thead>
    <tr>
      <th class="f-column text-truncate" scope="col" >SIM Card #</th>
      <th class="f-column text-truncate" scope="col" >SIM status</th>
      <th class="f-column text-truncate" scope="col" >Penalty</th>
      <th class="f-column text-truncate" scope="col" >Date blocked</th>
      <th class="f-column text-truncate" scope="col" >End of block period</th>
      <th class="f-column text-truncate" scope="col" >Last Name</th>
      <th class="f-column text-truncate" scope="col" >First Name</th>
      <th class="f-column text-truncate" scope="col" >Middle Name</th>
      <th class="f-column text-truncate" scope="col" >Suffix</th>
      <th class="f-column text-truncate" scope="col" >Birthdate</th>
      <th class="f-column text-truncate" scope="col" >Gender</th>
      <th class="f-column text-truncate" scope="col" >NSO or Passport #</th>
      <th class="f-column text-truncate" scope="col" >Address</th>
      <th class="f-column text-truncate" scope="col" >Nationality</th>
      <th class="f-column text-truncate" scope="col" >SIM User Type</th>
      <th class="f-column text-truncate" scope="col" >SIM retailer</th>
      <th class="f-column text-truncate" scope="col" >Registration Date</th>
      <th class="f-column text-truncate" scope="col" >Registration Time</th>


    </tr>
  </thead>
  <tbody>

    <?php
    if (isset($_GET['filters'])){
      // include 'Joiningtable.inc.php';

       switch($_GET['operator']){
           case "No offense at present":
               $data = 'first offense';
               $querytype = 'A';
               break;
           case "With offense":
               $data = 'offense';
               $querytype = 'A';
               break;
           case "First offense":
               $data = 'first offense';
               $querytype = 'A';
               break;
           case "Second offense":
               $data = 'second offense';
               $querytype = 'A';
               break;
           case "Third offense":
               $data = 'third offense';
               $querytype = 'A';
               break;
            case "All":
               $querytype = 'B';
               break;

       };
       if ($querytype=='A'){
         $searchInput = mysqli_real_escape_string($conn, $_GET['input-search']);
         $_SESSION['searchbox'] = $searchInput;
          // first offense
         $FirstOff = "SELECT * FROM registered_simusers_db WHERE sim_status = N'$data' AND (lastname LIKE '%$searchInput%' OR firstname LIKE '%$searchInput%' OR midname LIKE '%$searchInput%' OR suffix LIKE '%$searchInput%' OR dateofbirth LIKE '%$searchInput%' OR gender LIKE '%$searchInput%' OR passnum_nsonum LIKE '%$searchInput%' OR address LIKE '%$searchInput%' OR nationality LIKE '%$searchInput%'
         OR simcard LIKE '%$searchInput%'  OR simnum LIKE '%$searchInput%' OR regisite LIKE '%$searchInput%' OR dateofregis LIKE '%$searchInput%' OR time LIKE '%$searchInput%')  ORDER BY lastname ASC;";
       }else if($querytype=='B'){
        $searchInput = mysqli_real_escape_string($conn, $_GET['input-search']);
        $FirstOff = "SELECT * FROM registered_simusers_db WHERE lastname LIKE '%$searchInput%' OR firstname LIKE '%$searchInput%' OR midname LIKE '%$searchInput%' OR suffix LIKE '%$searchInput%' OR dateofbirth LIKE '%$searchInput%' OR gender LIKE '%$searchInput%' OR passnum_nsonum LIKE '%$searchInput%' OR address LIKE '%$searchInput%' OR nationality LIKE '%$searchInput%' OR simcard LIKE '%$searchInput%' OR simnum LIKE '%$searchInput%' OR regisite LIKE '%$searchInput%' OR dateofregis LIKE '%$searchInput%' OR time LIKE '%$searchInput%' ORDER BY lastname ASC; ";
       }

       // $FirstOff = "SELECT * FROM registered_simusers_db "

       $result = mysqli_query($conn,$FirstOff);
       $_SESSION['result-seller-home'] = $result;
       $resultCheck = mysqli_num_rows($result);
      }
          while($row = mysqli_fetch_assoc($result)):

    ?>

    <!-- <tr class="canHov" onclick="window.location='<?php echo "reported-message-content.php?id=".$row['passnum_nsonum']."&sent=".$row['lastname']."";?>';"> -->
    <tr>
      <td class="text-truncate"><?php echo $row['simnum']; ?></td>
      <th class="text-truncate"><?php echo $row['sim_status']?></th>
      <td class="text-truncate"><?php echo $row['offense_count'] ?></td>
      <td class="text-truncate"><?php echo $row['ban_start']?></td>
      <td class="text-truncate"><?php echo $row['ban_end']?></td>
      <td class="text-truncate"><?php echo $row['lastname']; ?></th>
      <td class="text-truncate"><?php echo $row['firstname']; ?></td>
      <td class="text-truncate"><?php echo $row['midname']; ?></td>
      <td class="text-truncate"><?php echo $row['suffix']; ?></td>
      <td class="text-truncate"><?php echo $row['dateofbirth']; ?></td>
      <td class="text-truncate"><?php echo $row['gender']; ?></td>
      <td class="text-truncate"><?php echo $row['passnum_nsonum']; ?></td>
      <td class="text-truncate"><?php echo $row['address']; ?></td>
      <td class="text-truncate"><?php echo $row['nationality']; ?></td>
      <td class="text-truncate"><?php echo $row['simcard']; ?></td>
      <td class="text-truncate"><?php echo $row['sim_retailer']?></td>
      <td class="text-truncate"><?php echo $row['dateofregis']; ?></td>
      <td class="text-truncate"><?php echo $row['time']; ?></td>

    </tr>

  <?php endwhile; ?>



  </tbody>
</table>
