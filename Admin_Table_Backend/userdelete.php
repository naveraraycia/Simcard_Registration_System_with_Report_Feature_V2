<?php 
include_once '../includes/dbh.inc.php';
$fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

function delete_message($conn){
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "DELETE FROM report_messages_db
           WHERE report_id = '$id' ";
     mysqli_query($conn, $sql);
     header("Location:../admin-report-list.php?deleted");
     exit();
}
  //  if(strpos($fulUrl, "click=deletereport")==true){
  //      delete_message($conn);
  //  }



//
    if(strpos($fulUrl, "click=delete")){
        $simnum = $_GET['simnum'];
        $nation = mysqli_real_escape_string($conn,$_GET['nation']);
        $simnum = '+'.$simnum;
        if($nation == 'filipino'){
            $sql = "DELETE FROM local_registered_simusers_db 
            WHERE  simnum ='$simnum'";
            echo $simnum;
            mysqli_query($conn, $sql);
            header("Location: ../list-local-user-admin.php?success");
        }else if($nation == 'notfilipino'){
            $sql = "DELETE FROM foreign_registered_simusers_db 
            WHERE  simnum ='$simnum'";
            echo $simnum;
            mysqli_query($conn, $sql);
            echo 'done';
            header("Location: ../list-foreign-user-admin.php?success");
        }
    }

    if(strpos($fulUrl, "click=userdelete")){
      $simnum = $_GET['simnum'];
      $nation = mysqli_real_escape_string($conn,$_GET['nation']);
          $sql = "DELETE FROM update_user_db
          WHERE  user_id ='$simnum'";
          mysqli_query($conn, $sql);
          if($nation == 'filipino'){
            header("Location: ../info-upd-localfor.php?success");
            exit();
          }else{
            header("Location: ../info-upd-foreign.php?success");
            exit();
          }
      }



  //  if(strpos($fulUrl, "click=deleteuser")==true){
  //      delete_message($conn);
  //  }


?>