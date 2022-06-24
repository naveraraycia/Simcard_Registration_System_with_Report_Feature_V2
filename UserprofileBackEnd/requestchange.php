<?php
include_once "../includes/dbh.inc.php";

if(isset($_POST['reportbutton'])){

  $update         = mysqli_real_escape_string($conn, $_POST['update']);
  $Message        = mysqli_real_escape_string($conn, $_POST['Remarks']);
  $operator       = $_POST['operator'];

  ///////////////////////////////// GETTING END USER INFORMATION USING SESSION /////////////////////////////////
  session_start();
  $SimCardNumber = $_SESSION['UserNumber'] ;
  $LastName      = $_SESSION['UserLast']  ;
  $FirstName     = $_SESSION['UserFirst']  ;
  $UserMiddlename    = $_SESSION['UserMiddleName'];
  $UserSuffix        = $_SESSION['UserSuffix'];
  $UserSuffix_B      = ", ".$UserSuffix;
  $Middle            = substr($UserMiddlename,0,1);
  $User_Name       = $LastName.", ".$FirstName." ".$Middle." ".$UserSuffix_B;
  $Name     = $LastName.", ".$FirstName." ".$Middle." ".$UserSuffix;
  $Document = $LastName."-".$FirstName."_".$Middle;
  $SimCardNumber        = $SimCardNumber;
   ///////////////////////////////// GETTING IMAGE DETAILS  /////////////////////////////////
  //getting the file information into $file Array
  $file = $_FILES['file'];
  //getting file details
  $fileName =$file["name"];
  $fileType =$file["type"];
  $fileTempName =$file["tmp_name"]; //temporary name = current name of the file when uploaded to a website
  $fileError =$file["error"]; //if the file is working or not
  $fileSize =$file["size"];

  $allowed = array("jpg","jpeg","png","bmp");
  $fileExt = explode(".",$fileName); //getting file Extension and saving to $fileExt Array. file extension name is at the end of array
  $fileActualExt = strtolower(end($fileExt)); ////changing file extension name at the end of array, to lower case


            if(!empty($update) && !empty($Message)){  //ERROR HANDLERS FOR INCORRECT DIGITS/CHARACTERS LENGTH
                  //enter image error handlers
                  //////////////////////  IMAGE ERRORS  /////////////////////
                  if($fileSize==0){   //ERROR 404 for no file added
                    header("Location:../profile-user.php?reportPage&ReportStatus=imageempty");
                    exit();
                  }else{
                    if(in_array($fileActualExt,$allowed)){   //IF FILE IS JPG,PNG,JPEG
                          if($fileError === 0){                  //IF FILE HAS A PROBLEM
                              if($fileSize<20000000){              // IF FILE SIZE IS NOT LARGE
                  //////////////////////////////////////// INITIALIZING THE INPUTS TO DATABASE  ////////////////////////////////////////
                  //Check how many items are there in Database
                              $sql  = "SELECT * FROM update_user_db;";
                              $stmt = mysqli_stmt_init($conn);
                              if(!mysqli_stmt_prepare($stmt,$sql)){  //ERROR 404 for connection database error
                                  header("Location:../end-user-update-data-request.php?error=failed");
                              }else{
                                  mysqli_stmt_execute($stmt); //execute
                                  $result   = mysqli_stmt_get_result($stmt);

                                    //Getting Database Row Information
                                  $rowCount = mysqli_num_rows($result);
                                  $setImageOrder   = $rowCount + 1;  //getting how many rows and adding +1. that would be the for the image report

                                  //////Reconfiguring Image File and Format////////
                                  $DocumentName = $Document.$setImageOrder; //New File Name of the Image - example of format: TanishaBrown.ReportNumber_1
                                  $ImageFullName    = $DocumentName.".".$fileActualExt;                  //Complete Fille Name of the Image - example of format: TanishaBrown.ReportNumber_1.jpg
                                  $fileDestination  = "../Request_Change_Database/".$ImageFullName;            //Build up file destination
                                  date_default_timezone_set('Asia/Manila');
                                  $dates = date("Y")."-".date("m")."-".date("j");
                                  $time = date('G').":".date('i').":".date('s');
                                  $DateTime = $dates." ".$time;
                                  //Preparing Query for Inserting Data in the Database
                                  $sql = "INSERT INTO update_user_db(update_type, update_req, simnum, message, nsopass_pic, link_nsopass_pic, clock, dates)
                                          VALUES(?,?,?,?,?,?,?,?);";

                                  if(!mysqli_stmt_prepare($stmt,$sql)){ //ERROR 404 for unable to upload
                                      header("Location:../end-user-update-data-request.php?error=connection");
                                  }else{

                                      mysqli_stmt_bind_param($stmt,"ssssssss", $operator, $update, $SimCardNumber, $Message, $ImageFullName, $DocumentName, $time, $dates);
                                      mysqli_stmt_execute($stmt); //FILE SENT
                                      move_uploaded_file($fileTempName,$fileDestination); //moving the file
                                      // UPDATE ID INCREMENT
                                      $update = "SET @num :=0;";
                                      $resultup = mysqli_query($conn, $update);
                                      $update = "UPDATE update_user_db SET user_id = @num := (@num+1);";
                                      $resultup = mysqli_query($conn, $update);
                                      $update = "ALTER TABLE update_user_db AUTO_INCREMENT = 1;";
                                      $resultup = mysqli_query($conn, $update);
                                      header("Location:../end-user-update-data-request.php?error=success");
                                    }
                                  }
                                }else{
                                  header("Location:../end-user-update-data-request.php?error=imagelarge");
                                  exit();
                                }
                              }else{
                                header("Location:../end-user-update-data-request.php?error=imageerror");
                                exit();
                              }
                            }else{
                              header("Location:../end-user-update-data-request.php?error=imageformaterror");
                              exit();
                            }
                          }
                        }else{
                          header("Location:../end-user-update-data-request.php?error=EMPTY");
                          exit();
                        } //line 123 end
                     }
?>
