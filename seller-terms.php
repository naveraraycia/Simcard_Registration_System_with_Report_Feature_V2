<?php
  require 'includes/dbh.inc.php';

?>
<?php
  session_start();
  if (empty( $_SESSION['SellerEmail'] )){
    header("Location: index.php");
    exit();
  }
  $shopname = " ".$_SESSION['Shop_Name'];

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
  <link rel="stylesheet" href="styles/register.css">
  <!-- FONT AWESOME -->
  <script src="https://kit.fontawesome.com/207a28b81e.js" crossorigin="anonymous"></script>


<style>

/* BUTTONS */
.send-btn {
  background-color: #2f5a62;
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
  background-color:#4b8f9c;
  cursor: pointer;
  color: white;
}

p{
  line-height: 200%;
}


</style>
</head>
  <body style="background-color: white;">
    <!-- NAVBAR PART -->
    <header>

      <nav class="navbar navbar-expand-lg">
        <a class="div1 navbar-brand" href="seller-home.php">
            <img src="images/logo.png" width="30" height="32" class="d-inline-block align-top" alt="">
            <span class="brandname">SIM shop: <?php echo $shopname ?></span>
          </a>

        <button class="custom-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">


          <ul class='navbar-nav'>
                <li class='nav-item'>
                  <a class='nav-link selected' href='data-privacy-act.php'>Register User</a>
                </li>

                <li class='nav-item'>
                  <a class='nav-link' href='seller-home.php'>Home</a>
                </li>

                <li class='nav-item'>
                  <a class='nav-link' href='seller-profile.php'>Profile</a>
                </li>

                <li class='nav-item'>
                  <a class='nav-link' href='request-sim-resupply.php'>Request SIM</a>
                </li>

              </ul>




          <form class="form-btnn" action="Logout/logoutprocess_SimRetailer.php" method="POST">
            <button type="submit" name="btn-primary" class="log-button">Logout</button>
          </form>
        </div>
      </nav>
    </header>


    <div class="container" style="background-color:#f3f3f3;">
      <div class="row">
        <div class="" style="display:flex;flex-direction:column;">
        <h2>Terms and Conditions</h2>
        <p class='information' style="line-height: 200%;color:black!important;">This notice is specific to the contents of the SimCardRegistrationSystem Website, which is owned and operated by the SimCardRegistrationSystem of the Republic of the Philippines. It is provided as a service to both Filipino and foreign persons that will register their SIM card under their name. By using the whole SimCardRegistrationSystem website or parts of it through accessing information, materials, and data contained within the SimCardRegistrationSystem website, you hereby agree to comply with and be legally bound by the following Terms of Use.
        </p>
        <p class='information' style="line-height: 200%;color:black!important;">SimCardRegistrationSystem, values the confidentiality of personal data. This section describes how it uses and protects personal data in order to obtain data subjects' consent, in accordance with the Data Privacy Act of 2012 (DPA), its Implementing Rules and Regulations (IRR), other National Privacy Commission (NPC) issuances, and other relevant Philippine laws.
        </p>
      </div>
        <br>
        <div class="" style="display:flex;flex-direction:column;">
        <h2>1. Acceptance of Agreement</h2>
        <p class="information" style="line-height: 200%;color:black!important;">You agree to the terms and conditions outlined in the Terms of Use Agreement (“Agreement”). This Agreement constitutes the entire and only agreement between the SimCardRegistrationSystem and you, and supersedes all prior or contemporaneous agreements, representations, warranties and understandings with respect to the SimCardRegistrationSystem website, the content, products or services provided by or through the SimCardRegistrationSystem website, and the subject matter of this Agreement. In general rule, the SimCardRegistrationSystem does not and will not share personal data with third parties unless it is reasonably necessary, needed, or authorized by or under law for the proper execution of processes related to a specified purpose. This Agreement may be amended at any time by SimCardRegistrationSystem from time to time without prior notice to you.
        </p>
      </div>

        <br>
        <div class="" style="display:flex;flex-direction:column;">
        <h2>2. Copyright</h2>
        <p class="information" style="line-height: 200%;color:black!important;">The contents, organization, graphics, design, compilation, digital conversion and other matters related to the SimCardRegistrationSystem website are protected under applicable copyrights, trademarks and other proprietary (including but not limited to intellectual property) rights. The copying, redistribution, use, or publication by you of any such matters or any part of the SimCardRegistrationSystem website, except as allowed by Section 4 below, is strictly prohibited. You do not acquire ownership rights to any content, document or other materials viewed through the SimCardRegistrationSystem website. The posting of information or materials on the SimCardRegistrationSystem website does not constitute a waiver of any right of SimCardRegistrationSystem in such information and materials. Some of the contents on the site are the copyrighted work of member government agencies of SimCardRegistrationSystem and SimCardRegistrationSystem’s third party providers.
        </p>
      </div>

        <br>
        <div class="" style="display:flex;flex-direction:column;">
        <h2>3. Service Marks</h2>
        <p class="information" style="line-height: 200%;color:black!important;">The SimCardRegistrationSystem or SimCardRegistrationSystem logo is a registered trademark or service marks of the SimCardRegistrationSystem. All other trademarks, trade names, service marks and logos used on the website are property of their respective owners.
        </p>
      </div>

        <br>
        <div class="" style="display:flex;flex-direction:column;">
        <h2>4. Limited License or Permitted Use</h2>
        <p class="information" style="line-height: 200%;color:black!important;">You are granted a non-exclusive, non-transferable, revocable license (a) to access and use the SimCardRegistrationSystem website strictly in accordance with this Agreement; (b) to use the SimCardRegistrationSystem website solely for internal, personal, non-commercial purposes; and (c) to print out discrete information from the SIMCARDREGISTRATIONSYSTEM Website solely for internal, personal, non-commercial purposes and provided that you maintain all copyright and other policies contained therein. You may NOT COPY, STORE, EITHER IN HARD COPY OR IN ELECTRONIC RETRIEVAL SYSTEM, TRANSMIT, TRANSFER, PERFORM, BROADCAST, PUBLISH, REPRODUCE, CREATE A DERIVATIVE WORK FROM, DISPLAY, DISTRIBUTE, SELL, LICENSE, RENT, LEASE OR OTHERWISE TRANSFER any of the Contents to any third person, including others in your company or organization, whether for direct commercial or monetary gain or otherwise without prior written consent of SimCardRegistrationSystem website or its third party provider.
        </p>
      </div>

        <br>
        <div class="" style="display:flex;flex-direction:column;">
        <h2>5. Forms, Agreements, and Documents</h2>
        <p class="information" style="line-height: 200%;color:black!important;">SimCardRegistrationSystem may make available through the SimCardRegistrationSystem website forms, and legal documents (collectively, “Documents”) that can be used in your transactions with the SimCardRegistrationSystem. All Documents are provided on a non-exclusive license basis only for your personal one-time use for non-commercial purposes, without any right to re-license, sublicense, distribute, assign or transfer such license. Documents are provided for free and without any representations or warranties, express or implied, as to their suitability, legal effect, completeness, modernity, accuracy, and/or appropriateness.
    If the Documents on SimCardRegistrationSystem’s official printed documents differs from the information contained on the SimCardRegistrationSystem website, the information on SimCardRegistrationSystem's official printed documents will take precedence.We aim to follow the Data Privacy Act of 2012 (DPA) and fully cooperate with the National Privacy Commission (NPC). Your privacy is important to us. SimCardRegistrationSystem is committed to protecting your personal privacy as well as our genuine and legitimate interests and our ability to fully and effectively carry out our responsibilities as such are met.
    </p>
    </div>

        <br>
        <div class="" style="display:flex;flex-direction:column;">
        <h2>6. Registration</h2>
        <p class="information" style="line-height: 200%;color:black!important;">Certain portions of the SimCardRegistrationSystem website are limited to registered users and/or allow a user to request support or services online by entering personal information. You agree that any information provided to us in these areas will be complete and accurate, that you will not register under the name of, nor attempt to enter the SimCardRegistrationSystem website under the name of, another person.</p>

        <p class="information" style="line-height: 200%;color:black!important;">Each business owner shall take reasonable steps to ensure the reliability of any of its officers, employees, agents, or representatives who have access to Personal Data, including ensuring that they all understand the confidential nature of the Personal Data; that they have received appropriate data protection training prior to their access or Processing of Personal Data; and that they have signed a written undertaking that they understand and will act in accordance with their responsibilities for confidentiality under this Data Processing Agreement.</p>
        </div>
        <p class="information" style="line-height: 200%;color:black!important;">You agree to notify SimCardRegistrationSystem immediately of any unauthorized use of your account or any other breach of security. SimCardRegistrationSystem will not be liable for any loss that you may incur as a result of someone else using your OTP or account, either with or without your knowledge. However, you could be held liable for losses incurred by SimCardRegistrationSystem or another party due to someone else using your account or OTP. You may not use anyone else’s account at any time, without the permission of the account holder.</p>
        </div><br>

        <br>
        <div class="" style="display:flex;flex-direction:column;">
        <h2>7. Errors, Corrections, and Changes</h2>
        <p class="information" style="line-height: 200%;color:black!important;">SimCardRegistrationSystem does not represent or warrant that the SimCardRegistrationSystem website will be error-free, free of viruses or other harmful components, or that defects will be corrected. We may make changes to the features, functionality or content of the SimCardRegistrationSystem website at any time without any notification in advance. SimCardRegistrationSystem reserves the right in its sole discretion to edit or delete any documents, information or other content appearing on the SimCardRegistrationSystem Website. Also, the SimCardRegistrationSystem's authorized to give access, consider requests for correction or erasure, and respond to objections to process personal data as it appears in the system’s official records are always governed by applicable and relevant laws, as well as the DPA, its IRR, and other NPC issuances.
        </p>
      </div>

        <br>
        <div class="" style="display:flex;flex-direction:column;">
        <h2>8. Unlawful Activity</h2>
        <p class="information" style="line-height: 200%;color:black!important;">SimCardRegistrationSystem reserves the right to investigate complaints or reported violations of this Agreement and to take any action we deem appropriate, including but not limited to reporting any suspected unlawful activity to law enforcement officials, regulators, or other third parties and disclosing any information necessary or appropriate to such persons or entities relating to your profile, email addresses, usage history, posted materials, IP addresses and traffic information. </p>
      </div>

        <br>
        <div class="" style="display:flex;flex-direction:column;">
        <h2>9. Non-transferable Owner Key</h2>
        <p class="information" style="line-height: 200%;color:black!important;">Your right to use the SimCardRegistrationSystem website is not transferable or assignable. Any personal documentation given to you is not transferable or assignable.</p>
      </div>

        <br>
        <div class="" style="display:flex;flex-direction:column;">
        <h2>10. Disclaimer</h2>
        <p class="information" style="line-height: 200%;color:black!important;">Due to the number of sources from which the Contents are obtained, and inherent hazards of electronic distribution, there may be delays, omissions, or inaccuracies in the Contents and although the Contents have been obtained from reliable sources, they are provided to you as presented, without warranties of any kind.
    <br>All responsibility or liability for any damages caused by viruses contained within the electronic file containing the form or document is disclaimed. SimCardRegistrationSystem will not be liable to you for any incidental, special or consequential damages of any kind that may result from use of or inability to use the SimCardRegistrationSystem Website.
    </p>
    </div>

      <br>
      <div class="" style="display:flex;flex-direction:column;">
      <h2>11. Use of Information</h2>
      <p class="information" style="line-height: 200%;color:black!important;">SimCardRegistrationSystem reserves the right, and you authorize it, to the use and assignment of all information regarding SimCardRegistrationSystem website used by you and all information provided by you in any manner consistent with the Privacy Policy.</p>
    </div>

      <br>
      <div class="" style="display:flex;flex-direction:column;">
      <h2>12. Use and Disclosure of Personal Information</h2>
      <p class="information" style="line-height: 200%;color:black!important;">
        SimCardRegistrationSystem may use, combine and process your Personal Data for the following purposes:
        <ul style="display:block;">
          <li style="list-style:none; margin-bottom:10px; line-height: 200%;">a. To create, administer and update your account;</li>
          <li style="list-style:none; margin-bottom:10px; line-height: 200%;">b. To verify your identity;</li>
          <li style="list-style:none; margin-bottom:10px; line-height: 200%;">c.	To fill up a user profile or registration forms;</li>
          <li style="list-style:none; margin-bottom:10px; line-height: 200%;">d.	To perform internal operations necessary to provide SimCardRegistrationSystem services, including troubleshooting software bugs and operational problems, conducting data analysis, testing and research, monitoring and analyzing usage and activity trends;</li>
          <li style="list-style:none; margin-bottom:10px; line-height: 200%;">e.	To protect the security or integrity of the SimCardRegistrationSystem website and any facilities or equipment used to make the services available;</li>
          <li style="list-style:none; margin-bottom:10px; line-height: 200%;">f.	To comply with court orders or other legal, governmental or regulatory requirements;</li>
          <li style="list-style:none; margin-bottom:10px; line-height: 200%;">g.	To enforce this Terms of Service or other agreements; and,</li>
          <li style="list-style:none; margin-bottom:10px; line-height: 200%;">h.	To protect SimCardRegistrationSystem’s rights or property in the event of a claim or dispute.</li>
        </ul>
        If you have questions relating to SimCardRegistrationSystem’s collection, use, and disclosure of your personal data, please contact the Data Protection Officer.
      </p>
    </div>

    <br><br>
    <div class="" style="display:flex;flex-direction:column;">
    <h2>13. Age Requirement</h2>
    <p class="information" style="line-height: 200%;color:black!important;">You hereby confirm and warrant that you are 16 or above and you are capable of understanding and accepting this Terms of Use Agreement.
    </p>
    </div>

    <br><br>
    <div class="" style="display:flex;flex-direction:column;">
      <h2>14. Privacy Policy</h2>
      <p class="information" style="line-height: 200%;color:black!important;">The SimCardRegistrationSystem’s Privacy Policy,  as it may change from time to time, is a part of this Agreement.
      </p>
    </div>


    <br>
    <div class="" style="display:flex;flex-direction:column;">
    <h2>15. Miscellaneous</h2>
    <p class="information" style="line-height: 200%;color:black!important;">This Agreement shall be treated as though it were executed and performed in Bacoor City, Philippines, and shall be governed by and construed in accordance with the laws of the Republic of the Philippines. Any cause of action by you with respect to the SimCardRegistrationSystem website (and/or any information, Documents, products or services related thereto) must be instituted within one (1) year after the cause of action arose or be forever waived and barred. The language in this Agreement shall be interpreted as to its fair meaning and not strictly for or against any party. Any rule of construction to the effect that ambiguities are to be resolved against the drafting party shall not apply in interpreting this Agreement. If any provision of this agreement is held illegal, invalid or unenforceable for any reason, that provision shall be enforced to the maximum extent permissible, and the other provisions of this Agreement shall remain in full force and effect. If any provision of this Agreement is held illegal, invalid or unenforceable, it shall be replaced, to the extent possible, with a legal, valid, and enforceable provision that is similar in tenor to the illegal, invalid, or unenforceable provision as is legally possible. To the extent that anything in or associated with the SimCardRegistrationSystem website is in conflict or inconsistent with this Agreement, this Agreement shall take precedence. SimCardRegistrationSystem’s failure to enforce any provision of this Agreement shall not be deemed a waiver of such provision nor of the right to enforce such provision. SimCardRegistrationSystem’s rights under this Agreement shall survive any termination of this Agreement. The title, headings and captions of this Agreement are provided for convenience only and shall have no effect on the construction of the terms of this agreement.
    </p>
    </div>

    <br>
    <div class="" style="display:flex;flex-direction:column;">
    <h2>16. Termination</h2>
    <p class="information" style="line-height: 200%;color:black!important;">You agree that SimCardRegistrationSystem, in its sole discretion, may remove and discard any content associated to you on the SimCardRegistrationSystem website, for any reason, including, without limitation, if SimCardRegistrationSystem, in its sole opinion, believes that you have violated or acted inconsistently with the letter or spirit of this Agreement or that you are a repeat infringer of intellectual property rights. You agree that any termination of your access to the SimCardRegistrationSystem website under any provision of this Agreement may take effect without prior notice, and acknowledge and agree that SimCardRegistrationSystem may immediately deactivate or delete your account and all related information in your account and/or bar any further access to the SimCardRegistrationSystem website. Furthermore, you agree that SimCardRegistrationSystem shall not be liable to you or any third-party for any termination of your access to the SimCardRegistrationSystem website.
    </p>
    </div>

    <br>
    <div class="" style="display:flex;flex-direction:column;">
    <h2>SimCardRegistrationSystem is committed to ensure that your privacy is protected</h2>
    <p class="information" style="line-height: 200%;color:black!important;">Should we ask you to provide certain information by which you can be identified when using the SimCardRegistrationSystem website, you can be assured that it will only be used in accordance with this Agreement and the Privacy Policy.
    </p>
    </div>



      </div>

    </div>
