<?php

include_once "dbh.inc.php";

    $id = mysqli_real_escape_string($conn, $_GET['del_id']);
    $sql = "DELETE FROM foreign_passport_db
           WHERE passnum = '$id' ";
     mysqli_query($conn, $sql);
     header("Location:../admin-pass-list.php?deleted");
     exit();
