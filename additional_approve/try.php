<?php 
include_once "../includes/dbh.inc.php";
$SQL = "SELECT * FROM registered_simusers_db
WHERE simnum = '+639175587332';";
$result = mysqli_query($conn, $SQL);
foreach($result as $row){
    $ban_start = $row['ban_start'];
    $ban_end   = $row['ban_end'];
}
$today = date("Y-m-d"). "<br>";
echo "today is: ".$today."<br>";
echo "ban end is: ".$ban_end."<br>";
if($today > $ban_end){
    echo "unban now";
}


$


75  =        65       +        10
add = requested_stock + Simcard_Limit


    75         70
if add < max_limit_assign{
    query(simcardLimit, add);

}else if( add > max_limit_assign){
     resupply =   max_limit_assign - simcard_limit 
        60    =           70       -      10
Simcard_Limit =   Simcard_Limit + resupply
     70       =        10       + 60
}



?>