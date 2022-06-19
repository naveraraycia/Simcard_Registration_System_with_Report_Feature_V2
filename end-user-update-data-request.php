<?php
  require "navbar.php";
  include_once 'dbh/EndUser.inc.php';

  ?>

  <div class="container">

    <div class='row header'>
    <h2>Request for personal information update</h2>
    </div>

    <?php
      //INSERT ERROR HANDLERS HERE
     ?>

     <br><br>
         <form class='' id='form' action='UserprofileBackEnd/BackEnd_Report.php' method='post' enctype='multipart/form-data'>
         <div class='row'>
           <div class='col-md-6 iconn'>
             <!-- COLUMN 1 -->

               <div class='infodiv1'>
                 <p class='labelings'>Name</p>
                 <input type='text' name='VictName' value='<?php //$FirstName $LastName $MiddleName $Suffix ?> 'id='usernamee' class='form-control' required disabled>

               </div>

               <div class='infodiv1'>
                 <p class='labelings'>Your Mobile Number</p>
                 <input type='tel' name='VictimNumber' value='<?php //$SimCardNumber ?>' id='yourNumber' class='form-control' placeholder='' required disabled>

               </div>

               <div class="infodiv1">
                 <form method="GET" action="">

                   <select class='custom-select mr-sm-2' id='nlineFormCustomSelect' name ='operator'>
                     <option selected >Name</option>
                     <option >Address</option>
                   </select>
                 </form>
               </div>

               <form method="GET">
               <div class="infodiv1">

                   <button type="submit" name="generate" class="btn btn-secondary">Click to input new data</button>

               </div>
                </form>


               <?php

               if (isset($_GET['generate'])){
                 // include 'Joiningtable.inc.php';

                 $_GET['operator'] = 'Name';


                  switch($_GET['operator']){
                      case "Name":
                      $presentfield = 'A';
                          break;
                      case "Address":
                      $presentfield = 'B';
                      echo '<div class="row">
                        <div class="col-12 infodiv">
                          <label class="Bday">Address</label>
                          <input id="address" type="text" name="address" class="form-control" required>
                        </div>
                      </div>';
                          break;
                  };
                  if($presentfield == 'A'){
                    echo '<div class="row">
                      <div class="col-md-3">
                        <label class="labelings">Last Name</label>
                        <input type="text" name="lastname" class="form-control" required>
                      </div>
                      <div class="col-md-3">
                        <label class="labelings">First Name</label>
                        <input type="text" name="firstname" class="form-control" required>
                      </div>
                      <div class="col-md-3">
                        <label class="labelings">Middle Name</label>
                        <input type="text" name="midname" class="form-control" required>
                      </div>
                      <div class="col-md-3">
                        <label class="labelings">Suffix</label>
                        <input type="text" name="suffix" class="form-control">
                      </div>
                    </div>';

                  } else if ($presentfield == 'B') {
                    echo 'nope!';
                  }
                };


                ?>


           </div>
           <div class='col-md-6 textclass'>
             <!-- TEXTAREA COLUMN 2 -->

               <div class='infodiv1'>
                 <p class='labelings'>Please provide reason why you need to change your information</p>
                 <textarea id='textArea' class='form-control' name='Remarks' rows='9' cols='80'></textarea>
               </div>

             </div>

         </div>
         <div class='row'>

         <div class='col-md-6'>
         <div class='form-group'>
           <label for='exampleFormControlFile1' class='labelings'>Submit Screenshot of Message</label>
             <input type='file' name='file' class='form-control-file' id='exampleFormControlFile1'>
         </div>
         </div>

         <div class='col-md-6'>
           <button type='submit' name='reportbutton' class='send-btn submit_btn' style='display: flex; justify-content: center; align-items: center;'>Send</button>
         </div>
         </div>
           </form>


           </div>

           <script>
             const submit_btn = document.querySelector('.submit_btn');
             submit_btn.onclick = function () {
               this.innerHTML = "<div class='loader'></div>";
             }
           </script>

             </body>
           </html>
