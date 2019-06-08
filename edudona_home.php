<?php
  session_start();
  date_default_timezone_set('Asia/Manila');
  $sessiondate=date('mdY');
  include 'class_edudona.php';
  $class=new mydesign;
  $class->database_connect();
  if(!isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate])){
    $class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
    $class->script('https://tbcmerchantservices.com/js/bootstrap.js');
    $class->link('https://tbcmerchantservices.com/css/bootstrap.css');
    $class->display_nologin();
  }
  else {
    $class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
    $Mainctr=$_SESSION['session_tbcmerchant_ctr'.$sessiondate];
    $query="select * from xtbl_adminaccount";
    $rs=mysql_query($query);
    $row=mysql_fetch_assoc($rs);
    $our_btc='3DPzNKXwUVTU8jtzY4FRMCQ6sANfzWUUFL';
    $our_coinsph='3DPzNKXwUVTU8jtzY4FRMCQ6sANfzWUUFL';
    $our_paypal=$row['Paypal'];
    $tbc_to_peso=$row['Tbc_to_Peso'];
    $query="select * from xtbl_account_info WHERE Main_Ctr='$Mainctr'";
    $rs=mysql_query($query);
    $row=mysql_fetch_assoc($rs);
    $email_status=$row['Email_Status'];
    $account_type=$row['Account_Type'];
    $account_status=$row['Account_Status'];
    $card_status=$row['Card_Status'];
    $username=$row['Username'];
    $passwordlink=$row['Password'];
    $currentcryptid=$row['Crypt_Id'];
    $activation_amount=1000;
    $activation_tbc_amount=$activation_amount/$tbc_to_peso;
    $query="select * from xtbl_main_info WHERE Ctr='$Mainctr'";
    $rs=mysql_query($query);
    $row=mysql_fetch_assoc($rs);
    $current_email=$row['Email'];
    $business_logo=$row['Business_Logo'];
    $business_name=$row['Business_Name'];
    $business_category=$row['Business_Category'];
    $business_description=$row['Description'];
    $business_country=$row['Country'];
    $refcode  = $row['Sponsor_Id'];

    $query="select * from xtbl_personal WHERE Main_Ctr='$Mainctr'";
    $rs=mysql_query($query);
    $row=mysql_fetch_assoc($rs);
    $mybtc_account=$row['Btc_Account'];
    $mycoinsph_account=$row['Coinsph_Account'];
    $mypaypal_email=$row['Paypal_Email'];
    $profile_image = $row["Profile_Image"];

    $query="select * from xtbl_admin_eudodona WHERE Main_Ctr='$Mainctr'";
    $rs=mysql_query($query);
    $row=mysql_fetch_assoc($rs);
    $admin_transaction_id=$row['Transaction'];
    $admin_transaction_status=$row['Status'];
    $admin_transaction_type=$row['Type'];
    $trans_count=mysql_num_rows($rs);

    $query="select * FROM xtbl_eudodona_wallet WHERE Ctr='$Mainctr'";
    $rs=mysql_query($query);
    $row=mysql_fetch_assoc($rs);
    $total_balance = $row['Balance'];

    $query="select * from xtbl_eudodona_wallet WHERE MainCtr='$Mainctr'";
    $rs=mysql_query($query);
    $row=mysql_fetch_assoc($rs);
    $total_reward = $row['Balance'];

    $query="select * from xtbl_eudodona WHERE MainCtr='$Mainctr'";
    $rs=mysql_query($query);
    $row=mysql_fetch_assoc($rs);
    $table_id = $row['table_id'];
    $refcode = $row['refcode'];
    $is_paid = $row['paid'];
    $current_rank = $row['rank'];
    $rows=mysql_num_rows($rs);

    $query22="select * from xtbl_eudodona WHERE paid = 1";
    $rs22=mysql_query($query22);
    $paid_count = mysql_num_rows($rs22);
    echo "<script>console.log('$paid_count')</script>";


    if(isset($_POST['gcashmobile2']) && isset($_POST['gcashwithdraw'])) {
      # withdrawal
      $mobile=str_replace("'", '', $_REQUEST['gcashmobile2']);
      $mobile=str_replace('"', '', $mobile);
      $mobile=str_replace("<", '', $mobile);
      $mobile=str_replace('>', '', $mobile);
      $amount=str_replace("'", '', $_REQUEST['gcashwithdraw']);
      $amount=str_replace('"', '', $amount);
      $amount=str_replace("<", '', $amount);
      $amount=str_replace('>', '', $amount);
      $amount=(int)$amount;
      if($total_reward<2500){
        $class->show_alert('Minimum withdraw amoutn is 2,500 PHP!');
      }
      else if ($amount == 0){
        $class->show_alert('Amount could not be blank!');
      }
      else if ($total_reward<$amount){
        $class->show_alert('Insufficient balance');
      }
      else if(strlen($mobile)<10) {
        $class->show_alert('Mobile GCASH number invalid');
      }
      else {
        $class->show_alert('Payment transaction successful! Please wait for 2-3 working days.');
        $query="Insert into xtbl_reward(Amount, Main_Ctr, Datetime, Remarks, Mobile)
          values('$amount', '$Mainctr', '".date('Y-m-d H:i:s')."', 'Withdraw via EDUDONA GCASH Card',
          '$mobile')";
        $rs=mysql_query($query);
        $new_balance = $total_reward - $amount;
        $query2 = "update xtbl_eudodona_wallet SET Balance = '$new_balance' WHERE MainCtr = '$Mainctr'";
        mysql_query($query2);
        echo '<script>window.location.assign("https://tbcmerchantservices.com/edudona/");</script>';
      }
    }
	    if(isset($_POST['txtphpeud_trans_id']))
    {
      # payment 1 PHP
      $txtphpeud_trans=str_replace("'", '', $_POST['txtphpeud_trans_id']);
      $txtphpeud_trans=str_replace('"', '', $txtphpeud_trans);
      $txtphpeud_trans=str_replace("<", '', $txtphpeud_trans);
      $txtphpeud_trans=str_replace('>', '', $txtphpeud_trans);
      $query78="select * from xtbl_admin_eudodona WHERE Transaction='$txtphpeud_trans'";
      $rs78=mysql_query($query78);
      $row78=mysql_fetch_assoc($rs78);
      if(mysql_num_rows($rs78)==0){
        if($trans_count==1) { echo '<script>alert("Request already sent")</script>';}
        else if($txtphpeud_trans=='' || strlen($txtphpeud_trans)<9){echo '<script>alert("Invalid Transaction ID")</script>';}
        else{
          $phpeud_query="insert into xtbl_admin_eudodona
          (Tbc_Amount, Peso_Amount, Sender_Address, Type, Main_Ctr, Status, Datetime, Transaction, Remarks)
          values('$activation_tbc_amount', '$activation_amount',
          '$mycoinsph_account', 'EDUDONA COINSPH', '$Mainctr', 'WAITING', NOW(),
          '$txtphpeud_trans', 'EDUDONA ENTRY')";
          $eud_rs=@mysql_query($phpeud_query);
          $class->show_alert('Request sent Successfully, please wait 2-3 working days for approval');
          echo '<script>window.location.href = "https://tbcmerchantservices.com/edudona/";</script>';
        }
      }
      else{
        $class->show_alert('Transaction ID already in use');
        $error2='Transaction ID already used';
      }
    }
    if(isset($_POST['txtphpeud_trans_id2']))
    {
      # payment 2 PHP
      $txtphpeud_trans=str_replace("'", '', $_POST['txtphpeud_trans_id2']);
      $txtphpeud_trans=str_replace('"', '', $txtphpeud_trans);
      $txtphpeud_trans=str_replace("<", '', $txtphpeud_trans);
      $txtphpeud_trans=str_replace('>', '', $txtphpeud_trans);
      if($txtphpeud_trans=='' || strlen($txtphpeud_trans)<9){echo '<script>alert("Invalid Transaction ID")</script>';}
      else{
        $phpeud_query="insert into xtbl_admin_eudodona
        (Tbc_Amount, Peso_Amount, Sender_Address, Type, Main_Ctr, Status, Datetime, Transaction, Remarks)
        values('$activation_tbc_amount', '$activation_amount',
        '$mycoinsph_account', 'EDUDONA COINSPH', '$Mainctr', 'WAITING', NOW(),
        '$txtphpeud_trans', 'EDUDONA RE-ENTRY')";
        $eud_rs=@mysql_query($phpeud_query);
        echo '<script>window.location.href = "https://tbcmerchantservices.com/edudona_home/";</script>';
      }
    }
    if(isset($_POST['txtbtceud_trans_id'])){
      # payment 1 BTC
      $txtbtceud_trans=str_replace("'", '', $_POST['txtbtceud_trans_id']);
      $txtbtceud_trans=str_replace('"', '', $txtbtceud_trans);
      $txtbtceud_trans=str_replace("<", '', $txtbtceud_trans);
      $txtbtceud_trans=str_replace('>', '', $txtbtceud_trans);
      $query78="select * from xtbl_admin_eudodona WHERE Transaction='$txtbtceud_trans'";
      $rs78=mysql_query($query78);
      $row78=mysql_fetch_assoc($rs78);
      if(mysql_num_rows($rs78)==0){
        if($trans_count==1) { echo '<script>alert("Request already sent")</script>';}
        else{
          $btceud_query="insert into xtbl_admin_eudodona
          (Tbc_Amount, Peso_Amount, Sender_Address, Type, Main_Ctr, Status, Datetime, Transaction, Remarks)
          values('$activation_tbc_amount', '$activation_amount',
          '$mycoinsph_account', 'EDUDONA BTC', '$Mainctr', 'WAITING', NOW(),
          '$txtbtceud_trans', 'EDUDONA ENTRY')";
          $eud_rs=@mysql_query($btceud_query);
          $class->show_alert('Request sent Successfully, please wait 2-3 working days for approval');
          echo '<script>window.location.href = "https://tbcmerchantservices.com/edudona/";</script>';
        }
      }
      else{
        $class->show_alert('Transaction ID already in use');
        $error2='Transaction ID already used';
      }
    }
    if(isset($_POST['txtbtceud_trans_id2']))
    {
      # payment 2 BTC
      $txtbtceud_trans=str_replace("'", '', $_POST['txtbtceud_trans_id2']);
      $txtbtceud_trans=str_replace('"', '', $txtbtceud_trans);
      $txtbtceud_trans=str_replace("<", '', $txtbtceud_trans);
      $txtbtceud_trans=str_replace('>', '', $txtbtceud_trans);
        $phpeud_query="insert into xtbl_admin_eudodona
        (Tbc_Amount, Peso_Amount, Sender_Address, Type, Main_Ctr, Status, Datetime, Transaction, Remarks)
        values('$activation_tbc_amount', '$activation_amount',
        '$mycoinsph_account', 'EDUDONA BTC', '$Mainctr', 'WAITING', NOW(),
        '$txtbtceud_trans', 'EDUDONA RE-ENTRY')";
        $eud_rs=@mysql_query($phpeud_query);
        echo '<script>window.location.href = "https://tbcmerchantservices.com/edudona_home/";</script>';
    }

    ?>

  <?php
    if ($card_status == "INACTIVE" || $email_status=='INACTIVE' || $account_status=='INACTIVE'){
      echo "<script>alert('You are not qualified to access edudona. Please activate your account first.')</script>";
      echo '<script>window.location.assign("https://tbcmerchantservices.com/welcome/");</script>';
    }
    if($rows == 1)
    {
      # if exists in edudona table
      $class->doc_type();
      $class->html_start('');
        $class->head_start();
          echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
          $class->title_page('TBCMS: EDUDONA');
          $class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
          $class->script('https://tbcmerchantservices.com/js/bootstrap.js');
          $class->link('https://tbcmerchantservices.com/css/bootstrap.css');
          $class->link('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');
          $class->script('https://tbcmerchantservices.com/js/jquery1.4.js');
          $class->script('https://tbcmerchantservices.com/js/jquery1.1.js');
        $class->head_end();
        $class->body_start('');
        $query = "
        SELECT e.username, e.paid, p.Profile_Image, m.Business_Logo, a.Account_Type FROM xtbl_eudodona e
          LEFT JOIN xtbl_personal p
          ON e.MainCtr = p.Main_Ctr
          LEFT JOIN xtbl_main_info m
          ON e.MainCtr = m.Ctr
          LEFT JOIN xtbl_account_info a
          ON e.MainCtr = a.Ctr
        WHERE table_id=1
        ORDER BY rank
        ";
        $rs=mysql_query($query);
        $row=mysql_fetch_array($rs);

        $query2 = "select * from xtbl_edudona_trans";
        $rs2 = mysql_query($query2);
        $cycles = mysql_num_rows($rs2);

        $query3 = "select count(1) as members from xtbl_eudodona";
        $rs3 = mysql_query($query3);
        $members = mysql_fetch_assoc($rs3)["members"];

        $total_earning = $members * 1000;
        $total_referral = $members * 100;
        $total_rewards = $cycles * 2500;

        $company_balance = $total_earning - ($total_referral + $total_rewards);
        if($account_type=='MERCHANT') {
					$class->page_home_header_start();
					$class->page_home2_header_content();
					$class->page_home_header_end();
        }
        else{
          $class->page_home_header_start();
          $class->page_home3_header_content();
          $class->page_home_header_end();
        }
      ?>

      <style media="screen">
        .shadow{
          box-shadow: 0 0.46875rem 2.1875rem rgba(63, 106, 216, 0.03), 0 0.9375rem 1.40625rem rgba(63, 106, 216, 0.03), 0 0.25rem 0.53125rem rgba(63, 106, 216, 0.05), 0 0.125rem 0.1875rem rgba(63, 106, 216, 0.03);
          border-radius: 1%;
          padding: 20px;
          background-color: white;
        }

        body {
          background-color: #F1F4F6;
          font-family: 'Open Sans', sans-serif;
        }

        .body {
          display: table;
          border-collapse: separate;
          border-spacing: 5px;
          }

          .left-side {
              float: none;
              display: table-cell;
              border: 0;
              vertical-align: top;
          }

          .left-side > .row > div > .shadow {
            margin-left: -20px;
          }

          .right-side {
              float: none;
              display: table-cell;
              border: 0;
              margin-left: 15px;
              vertical-align: top;
          }

          @media screen and (max-width: 700px) {
            .left-side{
              display: block;
            }

            .right-side{
              display: block;
            }

            .left-side > .row > div > .shadow {
              margin-left: 0px;
            }
          }


      </style>


        <div class="container-fluid">
          <div class="row">
            <div class="col-xl" style="padding:10px; background-color:#F8F9FA">
              <div class="text-center">
                <div class="">
                  <?php
                  if($account_type == "MERCHANT"){
                    if(!file_exists('business/'.$business_logo)) {
                      echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/business/00000.jpg" style="height: 50px; width: 50px; border-radius:50%">';
                    }
                    else {
                      echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/business/'.$business_logo.'" style="height: 50px; width: 50px; border-radius:50%">';
                    }
                  }
                  else {
                    if(!file_exists('profile/'.$profile_image)) {
                      echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/00000.jpg" style="height: 50px; width: 50px; border-radius:50%">';
                    }
                    else {
                      echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/'.$profile_image.'" style="height: 50px; width: 50px; border-radius:50%">';
                    }
                  }

                   ?>


                </div>
                <div>
                  <h3 style="">Welcome back to your Edudona Dashboard, <span style="color:#5E6D76"><?php echo $username ?><span> </h3>
                </div>
              </div>
            </div>
          </div>
    <br>
          <div class="row body" style=" margin:auto" id="myrow">
            <div class="col-xs-12 col-md-4  left-side">

              <div class="row" style="margin-top: -10px">
                <div class="col-xs-12 col-md-12">
                  <div class="shadow">
                    <p>Edudona Wallet Balance</p>
                    <h2> <small>PHP</small> <?php echo number_format($total_balance,2) ?> </h2>
                    <hr>
                    <a href="javascript:void(0)" onclick="$('#modal_eudodona').modal('show');">
                        Withdraw from Wallet using Gcash
                    </a>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-6 col-md-6">
                  <div class="shadow" style="background-color: #DAA520;color: white;">
                    <p>Total Edudona Members</p>
                    <h3 style="text-align: left"> <?php echo $members; ?> </h3>
                  </div>
                </div>
                <div class="col-xs-6 col-md-6">
                  <div class="shadow" style="background-color: #4B2B85;color: white;">
                    <p>Total Number of Cycles</p>
                    <h3  style="text-align: left"> <?php echo $cycles; ?> </h3>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-6 col-md-6">
                  <div class="shadow" style="background-color: #196889;color: white;">
                    <p>Current table rank</p>
                    <h3 style="text-align: left"><?php echo "#".$table_id; ?></h3>
                  </div>
                </div>
                <div class="col-xs-6 col-md-6">
                  <div class="shadow" style="background-color: #DA2520;color: white;">
                    <p>Current rank (before exit)</p>
                    <h3 style="text-align: left"> <?php echo "#".$current_rank; ?> </h3>
                  </div>
                </div>
              </div>

              <div class="row" style="margin-bottom: -10px;">
                <div class="col-xs-12 col-md-12">
                  <div class="shadow">
                    <h3 style="text-align: left"> <?php echo $paid_count; ?>/7 donations completed</h3>
                    <div class="progress">
                     <div class="progress-bar" role="progressbar" aria-valuenow='<?php echo $paid_count ?>'
                     aria-valuemin="0" aria-valuemax="7" style='<?php echo "width:".($paid_count/7)*100 ."%"?>; background-color: #004E00'>
                      <?php echo $paid_count;?>/7
                     </div>
                    </div>
                  </div>
                </div>

              </div>

            </div>
            <div class="col-xs-12 col-md-8 right-side shadow" style="margin: 5px 0">
                  <br>
                  <h3><b>EDUDONA Table</b></h3>
                  <hr style="border-color: #DAA520">
                  <?php if($table_id != 1){echo "<h3>You are currently in the WAITING table. This is the current status of the exit table.</h3>";} ?>
                  <table id="tbl_edu" class="table borderless" style="table-layout:fixed">
                    <thead>
                      <tr >
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="col"> </th>
                        <th scope="col"> </th>
                        <th scope="col"> </th>
                        <th scope="col" style="width:100%" >

                          <?php
                          mysql_data_seek($rs, 0);
                          $sq = mysql_fetch_array($rs);
                          $profile_image = $sq["Profile_Image"];
                          $business_logo = $sq["Business_Logo"];
                          $account_type = $sq["Account_Type"];
                          if($account_type == "MERCHANT"){
                            if(!file_exists('business/'.$business_logo)) {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/network2.png" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                            else {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/business/'.$business_logo.'" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                          }
                          else {
                            if(!file_exists('profile/'.$profile_image)) {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/network2.png" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                            else {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/'.$profile_image.'" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                          }

                           ?>

                          <br>
                          <?php

                            $user = $sq['username'];
                            $paid = $sq['paid'];
                            if ($user == null) {
                              echo "VACANT";
                            } else {
                              echo $user;
                              echo "<br>";
                              if($paid == 1){echo "<p style='color: #004E00'>(PAID)</p>";}else{echo "<p style='color:black'>(NOT PAID)</p>";}
                            }
                          ?>
                        </th>
                        <th scope="col"> </th>
                        <th scope="col"> </th>
                        <th scope="col"> </th>
                      </tr>
                      <tr style="height : 100px">
                        <th scope="col" class="c">

                          <br>
                          <?php
                          mysql_data_seek($rs, 1);
                          $sq = mysql_fetch_array($rs);
                          $profile_image = $sq["Profile_Image"];
                          $business_logo = $sq["Business_Logo"];
                          $account_type = $sq["Account_Type"];
                          if($account_type == "MERCHANT"){
                            if(!file_exists('business/'.$business_logo)) {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/network2.png" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                            else {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/business/'.$business_logo.'" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                          }
                          else {
                            if(!file_exists('profile/'.$profile_image)) {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/network2.png" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                            else {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/'.$profile_image.'" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                          }
                           ?>

                          <br>
                          <?php

                            $user = $sq['username'];
                            $paid = $sq['paid'];
                            if ($user == null) {
                              echo "VACANT";
                            } else {
                              echo $user;
                              echo "<br>";
                              if($paid == 1){echo "<p style='color: #004E00'>(PAID)</p>";}else{echo "<p style='color:black'>(NOT PAID)</p>";}
                            }
                          ?>
                        </th>
                        <th scope="col" class="c">

                          <br>
                          <?php
                          mysql_data_seek($rs, 2);
                          $sq = mysql_fetch_array($rs);
                          $profile_image = $sq["Profile_Image"];
                          $business_logo = $sq["Business_Logo"];
                          $account_type = $sq["Account_Type"];
                          if($account_type == "MERCHANT"){
                            if(!file_exists('business/'.$business_logo)) {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/network2.png" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                            else {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/business/'.$business_logo.'" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                          }
                          else {
                            if(!file_exists('profile/'.$profile_image)) {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/network2.png" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                            else {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/'.$profile_image.'" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                          }
                           ?>

                          <br>
                          <?php

                            $user = $sq['username'];
                            $paid = $sq['paid'];
                            if ($user == null) {
                              echo "VACANT";
                            } else {
                              echo $user;
                              echo "<br>";
                              if($paid == 1){echo "<p style='color: #004E00'>(PAID)</p>";}else{echo "<p style='color:black'>(NOT PAID)</p>";}
                            }
                          ?>
                        </th>
                        <th scope="col" class="c">

                          <br>
                          <?php
                          mysql_data_seek($rs, 3);
                          $sq = mysql_fetch_array($rs);
                          $profile_image = $sq["Profile_Image"];
                          $business_logo = $sq["Business_Logo"];
                          $account_type = $sq["Account_Type"];
                          if($account_type == "MERCHANT"){
                            if(!file_exists('business/'.$business_logo)) {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/network2.png" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                            else {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/business/'.$business_logo.'" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                          }
                          else {
                            if(!file_exists('profile/'.$profile_image)) {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/network2.png" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                            else {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/'.$profile_image.'" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                          }
                           ?>

                          <br>
                          <?php

                            $user = $sq['username'];
                            $paid = $sq['paid'];
                            if ($user == null) {
                              echo "VACANT";
                            } else {
                              echo $user;
                              echo "<br>";
                              if($paid == 1){echo "<p style='color: #004E00'>(PAID)</p>";}else{echo "<p style='color:black'>(NOT PAID)</p>";}
                            }
                          ?>
                        </th>
                        <th scope="col"> </th>
                        <th scope="col" class="c">

                          <br>
                          <?php
                          mysql_data_seek($rs, 4);
                          $sq = mysql_fetch_array($rs);
                          $profile_image = $sq["Profile_Image"];
                          $business_logo = $sq["Business_Logo"];
                          $account_type = $sq["Account_Type"];
                          if($account_type == "MERCHANT"){
                            if(!file_exists('business/'.$business_logo)) {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/network2.png" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                            else {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/business/'.$business_logo.'" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                          }
                          else {
                            if(!file_exists('profile/'.$profile_image)) {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/network2.png" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                            else {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/'.$profile_image.'" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                          }
                           ?>

                          <br>
                          <?php

                            $user = $sq['username'];
                            $paid = $sq['paid'];
                            if ($user == null) {
                              echo "VACANT";
                            } else {
                              echo $user;
                              echo "<br>";
                              if($paid == 1){echo "<p style='color: #004E00'>(PAID)</p>";}else{echo "<p style='color:black'>(NOT PAID)</p>";}
                            }
                          ?>
                        </th>
                        <th scope="col" class="c">

                          <br>
                          <?php
                          mysql_data_seek($rs, 5);
                          $sq = mysql_fetch_array($rs);
                          $profile_image = $sq["Profile_Image"];
                          $business_logo = $sq["Business_Logo"];
                          $account_type = $sq["Account_Type"];
                          if($account_type == "MERCHANT"){
                            if(!file_exists('business/'.$business_logo)) {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/network2.png" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                            else {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/business/'.$business_logo.'" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                          }
                          else {
                            if(!file_exists('profile/'.$profile_image)) {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/network2.png" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                            else {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/'.$profile_image.'" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                          }
                           ?>

                          <br>
                          <?php

                            $user = $sq['username'];
                            $paid = $sq['paid'];
                            if ($user == null) {
                              echo "VACANT";
                            } else {
                              echo $user;
                              echo "<br>";
                              if($paid == 1){echo "<p style='color: #004E00'>(PAID)</p>";}else{echo "<p style='color:black'>(NOT PAID)</p>";}
                            }
                          ?>
                        </th>
                        <th scope="col" class="c" style="margin-bottom:100px">

                          <br>
                          <?php
                          mysql_data_seek($rs, 6);
                          $sq = mysql_fetch_array($rs);
                          $profile_image = $sq["Profile_Image"];
                          $business_logo = $sq["Business_Logo"];
                          $account_type = $sq["Account_Type"];
                          if($account_type == "MERCHANT"){
                            if(!file_exists('business/'.$business_logo)) {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/network2.png" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                            else {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/business/'.$business_logo.'" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                          }
                          else {
                            if(!file_exists('profile/'.$profile_image)) {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/network2.png" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                            else {
                              echo '<img class="img-thumbnail" width="100%" src="https://tbcmerchantservices.com/profile/'.$profile_image.'" style="height: 70px; width: 70px; border-radius:50%">';
                            }
                          }
                           ?>

                          <br>
                          <?php

                            $user = $sq['username'];
                            $paid = $sq['paid'];
                            if ($user == null) {
                              echo "VACANT";
                            } else {
                              echo $user;
                              echo "<br>";
                              if($paid == 1){echo "<p style='color: #004E00'>(PAID)</p>";}else{echo "<p style='color:black'>(NOT PAID)</p>";}
                            }
                          ?>
                        </th>
                      </tr>

                    </tbody>
                  </table>
                </div>

          </div>


          <?php
            $latest_query = "
              SELECT * FROM xtbl_edudona_trans ORDER BY ctr DESC
            ";
            $rs = mysql_query($latest_query);
            $exits = mysql_fetch_assoc($rs);

            $latest_query2 = "
            SELECT m.Datetime, a.Username FROM `xtbl_admin_eudodona` m
              LEFT JOIN xtbl_account_info a
              ON m.Main_Ctr = a.Main_Ctr
            ORDER BY m.Ctr DESC
            ";
            $rs2 = mysql_query($latest_query2);
            $donations = mysql_fetch_assoc($rs2);
          ?>

          <div class="container">
            <hr>
          </div>
          <div class="container-fluid">
            <div class="row">
              <div class="col-xs-12 col-md-6">
                <div class="shadow">
                  <h4>Latest exits</h4>
                  <hr>
                  <table id="tbl_exit" class="table table-striped table2">
                    <thead>
                      <tr>
                        <th scope="col"><b>#</b></th>
                        <th scope="col"><b>Member</b></th>
                        <th scope="col"><b>Exit date</b></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php
                          mysql_data_seek($rs, 0);
                          $exits = mysql_fetch_array($rs);
                        ?>
                        <th scope="row">1</th>
                        <td> <?php echo $exits["username"] ?> </td>
                        <td><?php echo date('Y-m-d', strtotime($exits["datetime"])); ?></td>
                      </tr>
                      <tr>
                        <?php
                          mysql_data_seek($rs, 1);
                          $exits = mysql_fetch_array($rs);
                        ?>
                        <th scope="row">2</th>
                        <td> <?php echo $exits["username"] ?> </td>
                       <td><?php echo date('Y-m-d', strtotime($exits["datetime"])); ?></td>
                      </tr>
                      <tr>
                        <?php
                          mysql_data_seek($rs, 2);
                          $exits = mysql_fetch_array($rs);
                        ?>
                        <th scope="row">3</th>
                        <td> <?php echo $exits["username"] ?> </td>
                       <td><?php echo date('Y-m-d', strtotime($exits["datetime"])); ?></td>
                      </tr>
                      <tr>
                        <?php
                          mysql_data_seek($rs, 3);
                          $exits = mysql_fetch_array($rs);
                        ?>
                        <th scope="row">4</th>
                        <td> <?php echo $exits["username"] ?> </td>
                       <td><?php echo date('Y-m-d', strtotime($exits["datetime"])); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="col-xs-12 col-md-6">
                <div class="shadow">
                  <h4>Latest donations</h4>
                  <hr>
                  <table class="table table-striped table2">
                    <thead>
                      <tr>
                        <th scope="col"><b>#</b></th>
                        <th scope="col"><b>Member</b></th>
                        <th scope="col"><b>Entry date</b></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php
                          mysql_data_seek($rs2, 0);
                          $donations = mysql_fetch_array($rs2);
                        ?>
                        <th scope="row">1</th>
                        <td> <?php echo $donations["Username"] ?> </td>
                        <td><?php echo date('Y-m-d', strtotime($donations["Datetime"])); ?></td>
                      </tr>
                      <tr>
                        <?php
                          mysql_data_seek($rs2, 1);
                          $donations = mysql_fetch_array($rs2);
                        ?>
                        <th scope="row">2</th>
                        <td> <?php echo $donations["Username"] ?> </td>
                        <td><?php echo date('Y-m-d', strtotime($donations["Datetime"])); ?></td>
                      </tr>
                      <tr>
                        <?php
                          mysql_data_seek($rs2, 2);
                          $donations = mysql_fetch_array($rs2);
                        ?>
                        <th scope="row">3</th>
                        <td> <?php echo $donations["Username"] ?> </td>
                        <td><?php echo date('Y-m-d', strtotime($donations["Datetime"])); ?></td>
                      </tr>
                      <tr>
                        <?php
                          mysql_data_seek($rs2, 3);
                          $donations = mysql_fetch_array($rs2);
                        ?>
                        <th scope="row">4</th>
                        <td> <?php echo $donations["Username"] ?> </td>
                        <td><?php echo date('Y-m-d', strtotime($donations["Datetime"])); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
          </div>


        </div>

      <br><br>

      <style>
        td, th { border: none !important; vertical-align: center; text-align: center; font-weight: unset}
        #tbl_edu > tr {
          height: 100px;
        }

        .dot {
          border-radius: 50%;
          color: white;
          display: table-cell;
          font-size: 14px;
          height: 60px;
          margin: auto;
          vertical-align: middle;
          width: 60px;
        }
        .table-div{

        }



        @media screen and (max-width: 700px) {
          tr{
            height: 100px;
            display: block;
          }
          td {
            word-break:break-all;
          }
          .c{
            display: block;
          }
          #padd {
            width: 32%;
          }
          #tbl_edu {
            height: 400px;
            margin-bottom: 830px;
          }
        }
      </style>

      <?php
      $query = "select * FROM  xtbl_admin_eudodona WHERE Main_Ctr='$Mainctr' AND STATUS = 'WAITING'";
      $rs=mysql_query($query);
      $row=mysql_fetch_assoc($rs);
      $waiting = mysql_num_rows($rs);



      ?>

      <?php

      if($waiting == 1)
      {
        ?>
        <div class="container">
          <hr>
          <h4>Payment submitted please wait for approval.</h4>
          <br>
        </div>
        <?php
      }
      if ($is_paid == 0 && $waiting==0){
        // $class->show_payforms2();
      }
      ?>
      <br>
      <!-- ---------------------- MODAL  -->

      <div id="modal_eudodona" class="modal fade">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #191970; text-align: center; color: white">
              <span class="modal-title" style="font-size: 20px">CONFIRMATION</span>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" style="color: white">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                <input name="sendnew" hidden value="us56udg668h28hcb7w7eg6" />
                <input name="submitnew2" hidden type="submit" />
                <label>How much would you like to withdraw?</label>
                <input type="number" class="form-control" name="gcashwithdraw" />
                <label>TBCMS GCash Mobile Number</label>
                <input class="form-control" name="gcashmobile2" />
              </form>
              <!-- <b>ARE YOU SURE YOU WANT TO WITHDRAW ALL?</b> -->
            </div>
            <div class="modal-footer">
              <a href="javascript:void(0)" onclick="$('[name=submitnew2]').click();" class="btn btn-primary" data-dismiss="modal" style="border-radius: 0px">&nbsp YES &nbsp</a>
              <a href="javascript:void(0)" class="btn btn-danger" data-dismiss="modal" style="border-radius: 0px">&nbsp NO &nbsp</a>
            </div>
          </div>
        </div>
      </div>

  <?php
    }
    else
    {
      # if not existing in edudona table
      $class->doc_type();
      $class->html_start('');
        $class->head_start();
          echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
          $class->title_page('TBCMS: EDUDONA');
          $class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
          $class->script('https://tbcmerchantservices.com/js/bootstrap.js');
          $class->link('https://tbcmerchantservices.com/css/bootstrap.css');
          $class->script('https://tbcmerchantservices.com/js/jquery1.1.js');
        $class->head_end();
        $class->body_start('');
      ?>

      <div style="background-color: r gb(255,255,255,0.5); height: auto; padding-top: 10px; background-image: url('https://tbcmerchantservices.com/images/Picture3.jpg'); background-size: 100% auto">
          <div class="container">
            <div class="col-md-10" style="padding-bottom: 5px;">
              <a href="https://tbcmerchantservices.com/home/">
              <img width="230px" src="https://tbcmerchantservices.com/images/tbsheader.png"></a>
            </div>
            <div class="col-md-2" style="padding-bottom: 5px; text-align: center;">
            </div>
          </div>
        </div>


      <div class="container"><h3>Welcome back,  <b><?php echo $current_email ?></b></h3></div>'
      <br><br><br>


      <center>
        <h3>Be part of TBCMS' Edudona network.</h3><br>
        <!-- <img src="https://tbcmerchantservices.com/images/Red-Gift-Bow-PNG.png" width="200px"> -->
        <h4>You can now register P1,000 ($20) only as your donation!</h4>
      </center>



      <?php
        $class->show_payforms();
    }
    $class->page_welcome_header_content_start_footer2();
  }
  ?>
