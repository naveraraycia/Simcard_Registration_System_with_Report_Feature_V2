<?php

include_once "dbh.inc.php";

    $id = mysqli_real_escape_string($conn, $_GET['del_id']);
    $sql = "DELETE FROM nso_dummy_db
           WHERE nsonum = '$id' ";
     mysqli_query($conn, $sql);
     header("Location:../admin-nso-list.php?deleted");
     exit();
