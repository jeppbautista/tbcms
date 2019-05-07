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

    $rows=mysql_num_rows($rs);


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

        $query2 = "update xtbl_eudodona_wallet SET Balance = '$new_balance' WHERE Main_Ctr = '$Mainctr'";
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
          $class->script('https://tbcmerchantservices.com/js/jquery1.4.js');
          $class->script('https://tbcmerchantservices.com/js/jquery1.1.js');
        $class->head_end();

        $class->body_start('');

        $query = "select * from xtbl_eudodona WHERE table_id='$table_id' AND refcode='$refcode' ORDER BY rank";
        $rs=mysql_query($query);
        $row=mysql_fetch_array($rs);

      ?>

      <div style="background-color: rgb(255,255,255,0.5); height: auto; padding-top: 10px; background-image: url('https://tbcmerchantservices.com/images/Picture3.jpg'); background-size: 100% auto">
          <div class="container">
            <div class="col-md-10" style="padding-bottom: 5px;">
              <a href="https://tbcmerchantservices.com/home/">
              <img width="230px" src="https://tbcmerchantservices.com/images/tbsheader.png"></a>
            </div>
            <div class="col-md-2" style="padding-bottom: 5px; text-align: center;">
            </div>
          </div>
        </div>


      <div class="container"><h3>Welcome back to your EDUDONA dashboard,  <b><?php echo $current_email ?></b></h3></div>'
      <br>

      <div class="container">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="alert alert-success" align="center" style="background-color:#DAA520; border-radius: 20px; color: white">
            Total Edudona balance<br>
             <h1><?php echo '<small>PHP</small> '.number_format($total_balance,2); ?></h1>
             Thank you for trusting TBCMS<br>
          </div><br>
          <div align="center">
            <span style="color:red; font-size: 25px"><?php echo $error;?></span>
            <!-- <h4>P300 will be deducted to your reward for the TBCMS GCash Card</h4> -->
            <h4>Note: Minimum withdrawal is P2,500</h4>

            <a href="javascript:void(0)" onclick="$('#modal_eudodona').modal('show');" class="btn btn-info">
                WITHDRAW TO EDUODONA GCASH CARD
            </a>
            <h4>Withdrawal might take 1-2 working days to transfer on GCASH</h4>
            <br><br>
            <hr>
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>

      <div class="container">
        <br>
        <h3><b>EDUDONA Table</b></h3>
        <table class="table borderless">
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
              <th scope="col" id="padd"> </th>
              <th scope="col"> </th>
              <th scope="col"> </th>
              <th scope="col" >
                <img src="https://tbcmerchantservices.com/images/network.png">
                <br>
                <?php
                  mysql_data_seek($rs, 0);
                  $sq = mysql_fetch_array($rs);
                  $user = $sq['username'];
                  $paid = $sq['paid'];
                  if ($user == null) {
                    echo "VACANT";
                  } else {
                    echo $user;
                    echo "<br>";
                    if($paid == 1){echo "(PAID)";}else{echo "(NOT PAID)";}
                  }
                ?>
              </th>
              <th scope="col"> </th>
              <th scope="col"> </th>
              <th scope="col"> </th>
            </tr>
            <tr style="height : 100px">
              <th scope="col" class="c">
                <img src="https://tbcmerchantservices.com/images/network.png">
                <br>
                <?php
                  mysql_data_seek($rs, 1);
                  $sq = mysql_fetch_array($rs);
                  $user = $sq['username'];
                  $paid = $sq['paid'];
                  if ($user == null) {
                    echo "VACANT";
                  } else {
                    echo $user;
                    echo "<br>";
                    if($paid == 1){echo "(PAID)";}else{echo "(NOT PAID)";}
                  }
                ?>
              </th>
              <th scope="col" class="c">
                <img src="https://tbcmerchantservices.com/images/network.png">
                <br>
                <?php
                  mysql_data_seek($rs, 2);
                  $sq = mysql_fetch_array($rs);
                  $user = $sq['username'];
                  $paid = $sq['paid'];
                  if ($user == null) {
                    echo "VACANT";
                  } else {
                    echo $user;
                    echo "<br>";
                    if($paid == 1){echo "(PAID)";}else{echo "(NOT PAID)";}
                  }
                ?>
              </th>
              <th scope="col" class="c">
                <img src="https://tbcmerchantservices.com/images/network.png">
                <br>
                <?php
                  mysql_data_seek($rs, 3);
                  $sq = mysql_fetch_array($rs);
                  $user = $sq['username'];
                  $paid = $sq['paid'];
                  if ($user == null) {
                    echo "VACANT";
                  } else {
                    echo $user;
                    echo "<br>";
                    if($paid == 1){echo "(PAID)";}else{echo "(NOT PAID)";}
                  }
                ?>
              </th>
              <th scope="col"> </th>
              <th scope="col" class="c">
                <img src="https://tbcmerchantservices.com/images/network.png">
                <br>
                <?php
                  mysql_data_seek($rs, 4);
                  $sq = mysql_fetch_array($rs);
                  $user = $sq['username'];
                  $paid = $sq['paid'];
                  if ($user == null) {
                    echo "VACANT";
                  } else {
                    echo $user;
                    echo "<br>";
                    if($paid == 1){echo "(PAID)";}else{echo "(NOT PAID)";}
                  }
                ?>
              </th>
              <th scope="col" class="c">
                <img src="https://tbcmerchantservices.com/images/network.png">
                <br>
                <?php
                  mysql_data_seek($rs, 5);
                  $sq = mysql_fetch_array($rs);
                  $user = $sq['username'];
                  $paid = $sq['paid'];
                  if ($user == null) {
                    echo "VACANT";
                  } else {
                    echo $user;
                    echo "<br>";
                    if($paid == 1){echo "(PAID)";}else{echo "(NOT PAID)";}
                  }
                ?>
              </th>
              <th scope="col" class="c">
                <img src="https://tbcmerchantservices.com/images/network.png">
                <br>
                <?php
                  mysql_data_seek($rs, 6);
                  $sq = mysql_fetch_array($rs);
                  $user = $sq['username'];
                  $paid = $sq['paid'];
                  if ($user == null) {
                    echo "VACANT";
                  } else {
                    echo $user;
                    echo "<br>";
                    if($paid == 1){echo "(PAID)";}else{echo "(NOT PAID)";}
                  }
                ?>
              </th>
            </tr>

          </tbody>
        </table>
      </div>

      <br><br>

      <style>
        td, th { border: none !important; vertical-align: center; text-align: center;}
        tr {
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
          display: table;
          margin: auto;
        }

        @media screen and (max-width: 700px) {
          tr{
            height: 100px;
            display: block;
          }

          .c{
            display: inline-block;
          }

          #padd {
            width: 30%;
          }
        }
      </style>

      <?php
      $query = "select * FROM  xtbl_admin_eudodona WHERE Main_Ctr='$Mainctr' AND STATUS = 'WAITING'";
      $rs=mysql_query($query);
      $row=mysql_fetch_assoc($rs);
      $waiting = mysql_num_rows($rs);
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
        $class->show_payforms2();
      }
      ?>
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
  }
  ?>





    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <h1>You are not yet register click here</h1>
    <div id="paypal-button-container"></div>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>


    paypal.Button.render({
    env: 'sandbox', // sandbox | production

    style: {
                label: 'paypal',
                size:  'medium',    // small | medium | large | responsive
                shape: 'rect',     // pill | rect
                color: 'blue',     // gold | blue | silver | black
                tagline: false
            },

    funding: {
      allowed: [
        paypal.FUNDING.CARD,
        // paypal.FUNDING.CREDIT
      ],
      disallowed: []
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // PayPal Client IDs - replace with your own
    // Create a PayPal app: https://developer.paypal.com/developer/applications/create
    client: {
      sandbox: 'AcbAorOUrYTMMGKbTf1FTXRqOb2CwIbw86NU7SjmLcyW671Cf3Bax52MeHVD09Vf4y7y0akNx19Wed5r',
      //production: 'AeVUKSad_DseckErsDT3xuxwi3o4PkxKfWqI_a0siIn94A8zsPw1kfv1Ic1JSK9c-A8OCWh57V0DSJdt'
    },

    payment: function (data, actions) {
      return actions.payment.create({
        payment: {
          transactions: [
            {
              amount: {
                total: '0.1',
                currency: 'USD'
              }
            }
          ]
        }
      });
    },

    onAuthorize: function (data, actions) {
      return actions.payment.execute()
        .then(function () {
            window.alert('Payment Complete!');
            // var xhttp = new XMLHttpRequest();
            // xhttp.open('GET', 'https://tbcmerchantservices.com/insert.php', false);
            // xhttp.send();

            $.ajax({
              type:'POST',
              url : 'insert.php',
              success : function(data){
                console.log(data);
                // if(data == 1){
                //   window.location.href = 'index.php';
                // }
                // else{
                //   window.location.href = "test_welcome.php";
                // }
              }
          });
        });
    }

    }, '#paypal-button-container');
    </script> -->
