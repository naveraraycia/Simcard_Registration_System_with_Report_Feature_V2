<?php
  include_once 'dbh/EndUser.inc.php';
  session_start();
  ?>
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
    <link rel="stylesheet" href="styles/userprof.css">
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/207a28b81e.js" crossorigin="anonymous"></script>


  </head>
  <body style="background-color: white;">
    <!-- NAVBAR PART -->
    <header>

      <nav class="navbar navbar-expand-lg">
        <a class="div1 navbar-brand" href="seller-home.php">
            <img src="images/logo.png" width="30" height="32" class="d-inline-block align-top" alt="">
            <span class="brandname">SIM shop: Cavite SIM Shop</span>
          </a>

        <button class="custom-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">


          <ul class='navbar-nav'>
                <li class='nav-item'>
                  <a class='nav-link' href='data-privacy-act.php'>Register User</a>
                </li>

                <li class='nav-item'>
                  <a class='nav-link' href='seller-home.php'>Home</a>
                </li>

                <li class='nav-item'>
                  <a class='nav-link' href='seller-profile.php'>Profile</a>
                </li>

                <li class='nav-item'>
                  <a class='nav-link' href='request-sim-resupply.php'>Update info / Request SIM</a>
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
          <h2>Privacy Policy</h2>
          <p class='information' style="line-height: 200%;color:black!important;">This SimCardRegistrationSystem Privacy Policy (the “Policy”) applies to Top One Ventures Limited and its subsidiaries and affiliates, all of which are doing business under the name of “SimCardRegistrationSystem” (collectively “Top One”, “SimCardRegistrationSystem”, “Company”, “we”, “our”, or “us”). It represents our commitment to treat information with care, transparency, and confidentiality in compliance with relevant and applicable data privacy laws and regulations, and with constantly changing commercially acceptable standards for data protection (collectively, the “law”). This Policy only covers the information that SimCardRegistrationSystem collects, uses, processes and shares. It does not explain what third parties do with any information they may collect about you separately from SimCardRegistrationSystem. It also does not cover any websites, platforms, products, or services provided by others, although these may reference or link to our Site or Services (as defined below). These third-party services are not controlled by us and we encourage you to review the privacy policies or notices of those third parties for information about their practices. We do not endorse, screen, or approve, and are not responsible for, the privacy practices or content of such other websites or applications.
          </p>

          <p class='information' style="line-height: 200%;color:black!important;">When you use our website at https://SimCardRegistrationSystem.gg as well as any other media form, media channel, mobile website or mobile application (collectively, the “Site”), or use any of our services (the “Services”), we appreciate that you trust us with your personal information. We take your privacy very seriously. In this Policy, we seek to explain to you in the clearest way possible what information we collect, how we use it and what rights you have in relation to it. We hope you take some time to read through it carefully. If there are any terms in this Policy that you do not agree with, please discontinue using our Site or Services immediately.
          </p>

          <p class='information' style="line-height: 200%;color:black!important;">With this Policy, we present transparently that we gather, process, store and use the data of persons fairly and in accordance with law. As part of our drive to serve you better, we need to obtain and process your information. We collect or process this information only with the full knowledge, cooperation and consent of interested parties.
          </p>

          <p class='information' style="line-height: 200%;color:black!important;">Your data will be kept up-to-date, collected or processed fairly and for lawful purposes only. The information you give us will be processed within legal boundaries and will be protected against any unauthorized or illegal access by internal or external parties. You are free to exercise your rights under the law as a data subject and we fully respect the same.
          </p>

          <p class='information' style="line-height: 200%;color:black!important;">Your data will not be distributed to any party other than the ones consented and agreed by you or the data’s owner (exempting those compellable to be disclosed by law and legitimate requests from courts of competent jurisdiction and law enforcement authorities). Without such express consent from you or the data owner, it will not be communicated or transferred, informally or in any manner, to any other person, entity, organization or country.
          </p>

          <p class='information' style="line-height: 200%;color:black!important;">We also allow people to modify, erase, reduce or correct data contained in our databases in line with their rights under the law. We will have provisions in cases of lost or corrupted data.
          </p>

          <p class='information' style="line-height: 200%;color:black!important;">For protection, our officers and employees will be trained in online privacy and data security and will establish data protection practices (secure locks, data encryption, access authorization, etc.). In addition, security measures will be built through a secure network to protect data from cyber attacks.
          </p>

          <p class='information' style="line-height: 200%;color:black!important;">We may change this Policy from time to time without any advance notice. Should there be material changes to the Policy, you shall be promptly notified via e-mail and/or in-app. You are strongly recommended to regularly review and read this Policy. Any changes in this Policy will be effective immediately upon posting in the Site, with an updated effective date. In case of any inconsistency with any other policy of SimCardRegistrationSystem regarding data, information and system security measures, this Privacy Policy will govern.
          </p>

          <p class='information' style="line-height: 200%;color:black!important;">This Policy applies to all information collected through our Site (which, as described above, includes our SimCardRegistrationSystem App), as well as any related services, sales, marketing or events.
          </p>

          <p class='information' style="line-height: 200%;color:black!important;">Please read this Policy carefully as it will help you understand what we do with the information that we collect. Thank you for using SimCardRegistrationSystem!
          </p>
        </div>

        <br>
        <div class="" style="display:flex;flex-direction:column;">
        <h2>Table of Contents</h2>
        <p class="information" style="line-height: 200%;color:black!important;">
          SimCardRegistrationSystem may use, combine and process your Personal Data for the following purposes:
          <ul style="display:block;">
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">1.	WHY DO WE COLLECT YOUR INFORMATION?</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">2.	WHAT INFORMATION DO WE COLLECT?</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">3.	HOW DO WE PROCESS YOUR INFORMATION</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">4.	WILL YOUR INFORMATION BE SHARED WITH ANYONE</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">5.	HOW LONG DO WE KEEP YOUR INFORMATION</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">6.	HOW DO WE KEEP YOUR INFORMATION SAFE?</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">7.	DO WE COLLECT INFORMATION FROM MINORS?</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">8.	WHAT ARE YOUR PRIVACY RIGHTS?</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">9.	CONTROLS FOR DO-NOT-TRACK FEATURES</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">10.	DO WE MAKE UPDATES TO THIS POLICY?</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">11.	HOW CAN YOU CONTACT US ABOUT THIS POLICY?</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">12.	YOUR ACKNOWLEDGMENT AND CONSENT</li>
          </ul>
        </p>
      </div>

          <br>
          <div class="" style="display:flex;flex-direction:column;">
          <h2>1.	WHY DO WE COLLECT YOUR INFORMATION?</h2>
          <p class='information' style="line-height: 200%;color:black!important;">In Short:  We collect your information to enable us to provide our Services to you.
          </p>
          <p class="information" style="line-height: 200%;color:black!important;">We are a company duly organized and existing under the laws of the British Virgin Islands and have our registered office at 3/F ML Bldg. 336 Molino-Zapote Road. Molino 3 City of Bacoor Cavite. Pursuant to this, you may register in our Site and, subject to our Terms and Conditions and User Agreement, be eligible to use our Services. To do this, we will need to collect your personal information to the extent needed for you to access and for us to provide to you our Services.
          </p>
        </div>

          <br>
          <div class="" style="display:flex;flex-direction:column;">
          <h2>2.	WHAT INFORMATION DO WE COLLECT?</h2>
          <p class='information' style="line-height: 200%;color:black!important;">Personal information you disclose to us
          </p>
          <p class='information' style="line-height: 200%;color:black!important;">In Short:  We collect information that you provide to us.
          </p>
          <p class='information' style="line-height: 200%;color:black!important;">We collect personal information that you voluntarily provide to us when you register on the Site, express an interest in obtaining information about us or our Services, when you participate in activities on the Site, or otherwise when you contact us.
          </p>
          <p class="information" style="line-height: 200%;color:black!important;">The personal information that we collect depends on the context of your interactions with us and the Site, the choices you make and the products and features you use. The personal information we collect may include the following:
          </p>

          <ul style="display:block;">
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">full name;</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">citizenship;</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">date of birth;</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">present and permanent address;</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">phone numbers;</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">government I.D.;</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">photo (selfie); and</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">other similar information.</li>
          </ul>

          <p class='information' style="line-height: 200%;color:black!important;">All personal information that you provide to us must be true, complete and accurate, and you must notify us of any changes to such personal information.
          </p>
          <p class='information' style="line-height: 200%;color:black!important;">Information collected through our Site
          </p>
          <p class='information' style="line-height: 200%;color:black!important;">In Short:  We collect information regarding your mobile device, push notifications, device behavioral data, device storage data, calendar behavioral data, telecommunications usage data when you use our Site.
          </p>
          <p class='information' style="line-height: 200%;color:black!important;">If you use our Site, we also collect the following information:
          </p>

          <ul style="display:block;">
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">•	Mobile Device Access. We may request access or permission to certain features from your mobile device, including your mobile device's contacts, and other features. If you wish to change our access or permissions, you may do so in your device's settings.</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">•	Contacts Data.  We may request access or permission to your contact data so as to allow us to collect numerical aggregations based on your contact details and the corresponding attributes of each contact such as number of contacts, consistency in how contacts are formatted and the completeness of the contact fields.</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">•	SMS Usage Data. We may request access or permission to your SMS usage data so that we may collect numerical aggregations based on your SMS and the corresponding attributes such as number of messages sent, number of messages received and the unique number of correspondents.</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">•	Storage Data. We may request access or permission to your storage data so as to collect file metadata such as file name, file path, file size, file type, last modified date of the file. We will also collect numerical aggregations based on your files and the corresponding attributes such as the number of photos, number of documents, number of files modified in a given time frame. Data collection is limited to file metadata and we will not collect the files.</li>
          </ul>
          <p class='information' style="line-height: 200%;color:black!important;">The information is needed to maintain the security and operation of our Site, for troubleshooting and for our internal analytics and reporting purposes. Such is also collected for purposes of fraud prevention.
          </p>
          <p class='information' style="line-height: 200%;color:black!important;">Information collected from other sources
          </p>
          <p class='information' style="line-height: 200%;color:black!important;">In Short:  We may collect limited data from public databases, marketing partners, and other outside sources.
          </p>
          <p class='information' style="line-height: 200%;color:black!important;">To the extent permitted by law, in order to enhance our ability to provide relevant marketing, offers and services to you and update our records, we may obtain information about you from other sources, such as public databases, joint marketing partners, affiliate programs, data providers, as well as from other third parties. This information includes mailing addresses, job titles, email addresses, phone numbers, intent data (or user behavior data), Internet Protocol (IP) addresses, social media profiles, social media URLs and custom profiles, for purposes of targeted advertising and event promotion.
          </p>
          <p class='information' style="line-height: 200%;color:black!important;">When collecting information from third-party sources, SimCardRegistrationSystem ensures that the third-party provider has secured the users’ or your consent to the sharing of their data for marketing purposes. This will be made as a representation and warranty of the third-party provider under the relevant Data Sharing/Outsourcing Agreement between the third parties and us.
          </p>
        </div>

          <br>
          <div class="" style="display:flex;flex-direction:column;">
          <h2>3.	HOW DO WE PROCESS YOUR INFORMATION?</h2>
          <p class="information" style="line-height: 200%;color:black!important;">In Short:  We process your information for purposes based on legitimate business interests, the fulfillment of our contract with you, compliance with our legal obligations, and/or for other purposes such as fraud prevention and administration of our Services with your consent.
          </p>
          <p class="information" style="line-height: 200%;color:black!important;">We use personal information collected via our Site for a variety of business purposes described below. We process your personal information for these purposes in reliance on our legitimate business interests, in order to enter into or perform a contract with you, with your consent, and/or for compliance with our legal obligations. We indicate the specific processing grounds we rely on next to each purpose listed below
          </p>
          <p class="information" style="line-height: 200%;color:black!important;">We use the information we collect or receive:
          </p>

          <ul style="display:block;">
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">a.	To perform our Know-Your-Customer and Verification procedures. In order to provide to you our Services, we will need to collect your personal information and verify your identity as our user.</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">b.	To administer our business. We may disclose your personal information to third party service providers solely for the purpose of rendering services to us in the administration of our business and improvement of our Services.</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">c.	To post testimonials. We post testimonials on our Site that may contain personal information. Prior to posting a testimonial, we will obtain your consent to use your name and the consent of the testimonial. If you wish to update, or delete your testimonial, please contact us at privacy@SimCardRegistrationSystem.gg and be sure to include your name, testimonial location, and contact information. </li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">d.	To request feedback. We may use your information to request feedback and to contact you about your use of our Site.</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">e.	To enable user-to-user communications. We may use your information in order to enable user-to-user communications with each user’s consent.</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">f.	To manage user accounts. We may use your information for the purposes of managing our account and keeping it in working order.</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">g.	To protect our Site. We may use your information as part of our efforts to keep our Site safe and secure (for example, for fraud monitoring and prevention).</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">h.	To enforce our terms, conditions and policies for business purposes, to comply with legal and regulatory requirements or in connection with our contract.</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">i.	To respond to legal requests and prevent harm. If we receive a subpoena or other legal request, we may need to inspect the data we hold to determine how to respond.</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">j.	To respond to user inquiries/offer support to users. We may process your information to respond to your inquiries and solve any potential issues you might have with the requested service.</li>
          </ul>

        </div>

          <br>
          <div class="" style="display:flex;flex-direction:column;">
          <h2>4.	WILL YOUR INFORMATION BE SHARED WITH ANYONE?</h2>
          <p class="information" style="line-height: 200%;color:black!important;">In Short:   We only process your personal information when we believe it is necessary and we have a valid legal reason (i.e., legal basis) to do so under applicable law, like with your consent, to comply with laws, to provide you with services to enter into or fulfill our contractual obligations, to protect your rights, or to fulfill our legitimate business interests.
          </p>
          <p class="information" style="line-height: 200%;color:black!important;">The Company acknowledges its role and responsibilities under the law, subject to the provisions of this Policy. In providing our Services to you, you consent to our outsourcing of our data processing activities within and among SimCardRegistrationSystem and its subsidiaries and affiliates.
          </p>
          <p class="information" style="line-height: 200%;color:black!important;">We may also process or share your data that we hold based on the following legal basis:
          </p>

          <ul style="display:block;">
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">a.	Consent. We may process your information if you have given us specific consent to use your personal information for a specific purpose. You can withdraw your consent at any time.</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">b.	Performance of a Contract. Where we have entered into a contract with you, we may process your personal information to fulfill the terms of our contract, including third party data processors necessary to perform such contractual services (ex. cloud providers).</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">c.	Legitimate Business Interests. We may process your information when we believe it is reasonably necessary to achieve our legitimate business interests and those interests do not outweigh your interests and fundamental rights and freedoms. For example, we may process your personal information for some of the purposes described in order to:<ul>
              <li style="list-style:none; margin-bottom:10px; line-height: 200%;">•	Analyze how our services are used so we can improve them to engage and retain users;</li>
              <li style="list-style:none; margin-bottom:10px; line-height: 200%;">•	Diagnose problems and/or prevent fraudulent activities; and</li>
              <li style="list-style:none; margin-bottom:10px; line-height: 200%;">•	Understand how our users use our Services so we can improve user experience</li>
            </ul></li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">d.	Legal Obligations. We may process your information where we believe it is necessary for compliance with our legal obligations, such as to cooperate with a law enforcement body or regulatory agency, exercise or defend our legal rights, or disclose your information as evidence in litigation in which we are involved. We may also disclose your information where we are legally required to do so in order to comply with applicable law, governmental requests, a judicial proceeding, court order, or legal process, such as in response to a court order or a subpoena (including in response to public authorities to meet national security or law enforcement requirements).</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">e.	Vital Interests. We may process your information where we believe it is necessary to protect your vital interests or the vital interests of a third party, such as situations involving potential threats to the safety of any person. We may disclose your information where we believe it is necessary to investigate, prevent, or take action regarding potential violations of our policies, suspected fraud, or as evidence in litigation in which we are involved.</li>
          </ul>
          <p class="information" style="line-height: 200%;color:black!important;">More specifically, subject to the requirements of the applicable law/s, we may also need to process your data or share your personal information in the following situations:
          </p>
          <ul style="display:block;">
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">a.	Business Transfers. We may share or transfer your information in connection with, or during negotiations of, any merger, sale of company assets, financing, or acquisition of all or a portion of our business to another company.</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">b.	Affiliates. We may share your information with our affiliates, in which case we will require those affiliates to honor this Policy. Affiliates, if any, include our parent company and subsidiaries, joint venture partners or other companies that we control or that are under common control with us.</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">c.	Business Partners. We may share your information with our business partners to offer you certain products, services or promotions.</li>
          </ul>
          <p class="information" style="line-height: 200%;color:black!important;">Any data transfer/sharing to outside parties will be covered by a Data Sharing/Outsourcing Agreement, when applicable.
          </p>
        </div>

          <br>
          <div class="" style="display:flex;flex-direction:column;">
          <h2>5.	HOW LONG DO WE KEEP YOUR INFORMATION?</h2>
          <p class="information" style="line-height: 200%;color:black!important;">In Short:  We keep your information for as long as necessary to fulfill the purposes outlined in this Policy unless otherwise required by law.
          </p>
          <p class='information' style="line-height: 200%;color:black!important;">We will only keep your personal information for as long as it is necessary for the purposes set out in this Policy, and in the case of account termination, for an archiving period of twelve (12) months to allow for ease of account revival, unless a longer retention period is required or permitted by law (such as tax, accounting, anti-money laundering or other legal requirements).
          </p>
          <p class='information' style="line-height: 200%;color:black!important;">When we have no ongoing legitimate business need to process your personal information, we will either irreversibly delete or anonymize such information, or, if this is not possible (for example, because your personal information has been stored in backup archives), then we will securely store your personal information and isolate it from any further processing until deletion is possible.
          </p>
          <p class='information' style="line-height: 200%;color:black!important;">You understand that you are, at any time, free to unsubscribe from our newsletters, delete your account, uninstall our Site from your devices, and/or submit an official request for deletion of your data, subject to this Policy. Should you wish to have your personal information deleted and destroyed or you wish to withdraw your consent in the processing of your personal information, you may do so by contacting us.
          </p>
          <p class='information' style="line-height: 200%;color:black!important;">The deletion of your personal data shall be honored within a reasonable time from request and as long as it will not compromise, damage, injure, or make inefficient the entirety, integrity, confidentiality, and security of the Site and/or Services, and shall be performed within such reasonable time from the time of your request to do so.
          </p>
      </div>

          <br>
          <div class="" style="display:flex;flex-direction:column;">
          <h2>6.	HOW DO WE KEEP YOUR INFORMATION SAFE?</h2>
          <p class="information" style="line-height: 200%;color:black!important;">In Short:  We aim to protect your personal information through a system of physical, organizational, and technical security measures.</p>
          <p class='information' style="line-height: 200%;color:black!important;">We have implemented appropriate physical, organizational, and technical security measures designed to protect the security of any personal information we process subject to the requirements of the law and of commercially acceptable standards for data protection.
          </p>
          <p class='information' style="line-height: 200%;color:black!important;">We will develop and implement measures to ensure that all our staff who have access to any personal information will strictly process such data in compliance with applicable laws and regulations. These measures may include drafting new or updated relevant policies of SimCardRegistrationSystem and conducting or sponsoring training programs to educate our stockholders, directors, officers, employees, agents and other interested parties on data privacy-related concerns. A continuing obligation of confidentiality is also imposed on our stockholders, directors, officers, employees, agents or other interested parties in connection with such personal information that they may encounter during the period of which they are such. This obligation will still apply after they cease to work with SimCardRegistrationSystem for whatever reason.
          </p>
          <p class='information' style="line-height: 200%;color:black!important;">Furthermore, SimCardRegistrationSystem will, from time to time, conduct a privacy impact assessment relative to all activities, projects and systems involving the processing of personal information. We will review security policies, conduct vulnerability assessments and perform penetration testing, as applicable, on a regular schedule to be prescribed by our IT Team.
          </p>
          <p class='information' style="line-height: 200%;color:black!important;">Our IT team will continuously evaluate this Privacy Policy, considering the following:
          </p>
          <ul style="display:block;">
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">a.	Safeguards to protect the SimCardRegistrationSystem network and systems against accidental, unlawful, or unauthorized usage, any interference which will affect data integrity or hinder the functioning or availability of the system, and unauthorized access;</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">b.	Our ability to ensure and maintain the confidentiality, integrity, availability, and resilience of SimCardRegistrationSystem data processing systems and services;</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">c.	Regular monitoring for security breaches, and a process for identifying and accessing reasonably foreseeable vulnerabilities in the SimCardRegistrationSystem network and system, and taking preventive and corrective actions against security incidents;</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">d.	Our ability to restore the availability and access to personal information in a timely manner in the event of a security incident;</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">e.	A process for regularly testing and evaluating effectiveness of security measures; and</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">f.	Encryption of personal information during storage and while in transit, authentication process, and other technical security measures that control and limit access thereto.</li>
          </ul>
          <p class='information' style="line-height: 200%;color:black!important;">However, despite our safeguards and efforts to secure your information, no electronic transmission over the Internet or information storage technology can be guaranteed to be 100% secure, so we cannot promise or guarantee that hackers, cybercriminals, or other unauthorized third parties will not be able to defeat our security, and improperly collect, access, steal, or modify your information. Although we will do our best to protect your personal information, transmission of personal information to and from our Site is at your own risk. You should only access the Site within a secure environment.
          </p>
      </div>

          <br>
          <div class="" style="display:flex;flex-direction:column;">
          <h2>7.	DO WE COLLECT INFORMATION FROM MINORS?</h2>
          <p class="information" style="line-height: 200%;color:black!important;">In Short:  We do not knowingly collect data from or market to children under 18 years of age.
          </p>
          <p class="information" style="line-height: 200%;color:black!important;">We do not knowingly solicit data from or market to minors, being individuals under 18 years of age. By using the Site, you represent that you are at least 18 or that you are the parent or guardian of such a minor and consent to such minor dependent’s use of the Site. If we learn that personal information from users less than 18 years of age has been collected, we will deactivate the account and take reasonable measures to promptly delete such data from our records. If you become aware of any data we may have collected from children under age 18, please contact us at proo.bonno@gmail.com.
          </p>
        </div>

          <br>
          <div class="" style="display:flex;flex-direction:column;">
          <h2>8.	WHAT ARE YOUR PRIVACY RIGHTS?</h2>
          <p class="information" style="line-height: 200%;color:black!important;">In Short:  You may review, change, or terminate your account at any time. </p>
          <p class="information" style="line-height: 200%;color:black!important;">Under the law, you are entitled to the following data privacy rights:</p>
          <ul style="display:block;">
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">a.	the right to be informed whether your personal information shall be, are being, or have been processed;</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">b.	the right to object to the processing of your personal information;</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">c.	the right to reasonably access your personal information;</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">d.	the right to dispute the inaccuracy or error in your personal information and have us correct it immediately and accordingly;</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">e.	the right to suspend, withdraw, or order the blocking, removal or destruction of your personal information from our records; </li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">f.	the right to file a complaint with the proper government authorities for any violation of your data privacy rights;</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">g.	the right to be indemnified for any damages sustained due to such inaccurate, incomplete, outdated, false, unlawfully obtained or unauthorized use of your personal information not in accordance with this Statement;</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">h.	the right to data portability of your personal information; and</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">i.	the right to be informed whether personal information is being or has been processed. This includes processing through automated processing, automated decision-making and profiling</li>
          </ul>
          <p class="information" style="line-height: 200%;color:black!important;">In respecting your data privacy rights, you may opt to tell us at proo.bonno@gmail.com:</p>
          <ul style="display:block;">
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">a.	not to share your information with our subsidiaries and affiliates or with other companies that we have business with provided that such information is not critical nor required by applicable law in maintaining the Services that you have availed with us;</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">b.	to provide you with information that we currently have about you subject to restrictions applied to us as a company operating in the applicable jurisdictions;</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">c.	to update your personal information;</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">d.	about your other concerns relating to how we collect, use, share, protect or dispose your information; and</li>
            <li style="list-style:none; margin-bottom:10px; line-height: 200%;">e.	to withdraw your consent to process your personal information (However, please note that this will not affect the lawfulness of the processing before its withdrawal, or when applicable law allows on grounds other than consent)</li>
          </ul>
            <p class="information" style="line-height: 200%;color:black!important;">If you would at any time like to review or change the information in your account or terminate your account on our Site, you can:</p>
            <ul style="display:block;">
              <li style="list-style:none; margin-bottom:10px; line-height: 200%;">•	Log in to your account settings and update your user account; or</li>
              <li style="list-style:none; margin-bottom:10px; line-height: 200%;">•	Contact us at proo.bonno@gmail.com. </li>
            </ul>
            <p class="information" style="line-height: 200%;color:black!important;">Upon your request to terminate your account, we will deactivate or delete your account and information from our active databases. However, we may retain some information in our files to prevent fraud, troubleshoot problems, assist with any investigations, enforce our Terms and Conditions and User Agreement and/or comply with applicable legal requirements.</p>
        </div>

          <br>
          <div class="" style="display:flex;flex-direction:column;">
          <h2>9.	DO WE MAKE UPDATES TO THIS POLICY?</h2>
          <p class="information" style="line-height: 200%;color:black!important;">In Short:  Yes, we will update this Policy as necessary to stay compliant with relevant laws.</p>
          <p class="information" style="line-height: 200%;color:black!important;">We may update this Policy from time to time. The updated version will be indicated by an updated “Revised” date and the updated version will be effective as soon as it is accessible. If we make material changes to this Policy, we may notify you either by prominently posting a notice of such changes or by directly sending you a notification. We encourage you to review this Policy frequently to be informed of how we are protecting your information.</p>
        </div>

          <br>
          <div class="" style="display:flex;flex-direction:column;">
          <h2>10.	HOW CAN YOU CONTACT US ABOUT THIS POLICY?</h2>
          <p class="information" style="line-height: 200%;color:black!important;">If you have questions or comments about this Policy, you may contact us by email at proo.bonno@gmail.com.</p>
          <p class="information" style="line-height: 200%;color:black!important;">You have the right to request access to the personal information we collect from you, change that information, or delete it in some circumstances. To request to review, update, or delete your personal information, please email us at proo.bonno@gmail.com.</p>
      </div>

        <br>
        <div class="" style="display:flex;flex-direction:column;">
        <h2>11.	YOUR ACKNOWLEDGMENT AND CONSENT</h2>
        <p class="information" style="line-height: 200%;color:black!important;">In Short:  Yes, you acknowledge and consent to our data processing activities as described in this Policy.</p>
        <p class="information" style="line-height: 200%;color:black!important;">By communicating with us using the Site and our Services, you acknowledge that you have read and understood this Policy and agree and consent to the use, processing and/or transfer of your personal information by us as described in this Policy.</p>
        <p class="information" style="line-height: 200%;color:black!important;">You agree that we may use your personal data and other Information for automated processing, automated decision-making, and profiling in connection with your registration, establishment, maintenance, cancellation and/or closure of your account and your relationship with us including our provision of our Services and your use of the Site and our Services.</p>
        <p class="information" style="line-height: 200%;color:black!important;">From time to time we may update or amend the terms of this Privacy Policy by placing the updated Policy on our Site. The effective date of such modifications, updates or amendments will be noted at the start of the Policy. You should therefore review it periodically so that you are up to date on our most current policies and practices. If we make material changes to our practices regarding the processing and/or use of your personal information, your personal information will continue to be governed by the version of the Policy to which such personal information was subject (prior to those changes), unless you have been provided notice of, and have not objected to, the changes. By continuing to communicate with us, by continuing to use our Site and Services or by your continued engagement with us following the modifications, updates or amendments to this Policy, such actions shall signify your acceptance of such modifications, updates or amendments; provided, we shall secure your express consent when so required by the law.</p>
        <p class="information" style="line-height: 200%;color:black!important;">By submitting the required personal information to us, you consent to such collection, disclosure, processing and use thereof. You hereby expressly waive and release us from any and all liability, claims, causes of action or damages arising from our legitimate use of personal information submitted by you. </p>

      </div>
        </div>

      </div>
