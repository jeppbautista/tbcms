<?php
  session_start();
  date_default_timezone_set('Asia/Manila');
	$sessiondate=date('mdY');
  include 'class_admin.php';
  $class=new mydesign;
  $class->database_connect();

  if(!isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate])){
    header("location: https://tbcmerchantservices.com/welcome/");
  }

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

  $query="select * from xtbl_eudodona_wallet WHERE Main_Ctr='$Mainctr'";
  $rs=mysql_query($query);
  $row=mysql_fetch_assoc($rs);
  $total_reward = $row['Balance'];

  $query="select * from xtbl_eudodona WHERE MainCtr='$Mainctr'";
  $rs=mysql_query($query);
  $row=mysql_fetch_assoc($rs);
  $table_id = $row['table_id'];
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

    $amount=intval($amount);

    if($total_reward<3700){
      echo "<script>alert('Minimum withdraw amoutn is 3700 PHP!')</script>";
    }
    else if ($total_reward<$amount){
        echo "<script>alert('Insufficient balance')</script>";
    }
    else if(strlen($mobile)<10) {

      echo "<script>alert('Mobile GCASH number invalid')</script>";
    }
    else {
      $query="Insert into xtbl_reward(Amount, Main_Ctr, Datetime, Remarks, Mobile)
				values('$total_reward', '$Mainctr', '".date('Y-m-d H:i:s')."', 'Withdraw via EDUDONA GCASH Card',
				'$mobile')";
			$rs=mysql_query($query);

      $query2 = "update xtbl_eudodona_wallet SET Balance = 0 WHERE Main_Ctr = '$Mainctr'";
      mysql_query($query2);

			echo '<script>window.location.assign("https://tbcmerchantservices.com/welcome/");</script>';
    }
  }

  if(isset($_POST['txtphpeud_trans_id']))
  {
    # payment sent

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
        echo '<script>window.location.href = "https://tbcmerchantservices.com/edudona/";</script>';
      }
    }
    else{
      echo '<script>console.log("Transaction ID already in use")</script>';
      $error2='Transaction ID already used';
    }
  }

  if(isset($_POST['txtphpeud_trans_id2']))
  {
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
      echo '<script>window.location.href = "https://tbcmerchantservices.com/edudona/";</script>';
    }
  }

  ?>

<?php
  if ($card_status == "INACTIVE" || $email_status=='INACTIVE' || $account_status=='INACTIVE'){
    echo "<script>alert('You are not qualified to access edudona. Please activate your account first.')</script>";
    echo '<script>window.location.assign("https://tbcmerchantservices.com/welcome/");</script>';
  }

  if($rows == 1)
  {
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

      $query = "select * from xtbl_eudodona WHERE table_id='$table_id' ORDER BY rank";
      $rs=mysql_query($query);
      $row=mysql_fetch_array($rs);

      // var_dump(mysql_fetch_array($rs)['username']);

    ?>

    <div style="background-color: rgb(255,255,255,0.5); height: auto; padding-top: 10px; background-image: url('https://tbcmerchantservices.com/images/Picture3.jpg'); background-size: 100% auto">
        <div class="container">
          <div class="col-md-10" style="padding-bottom: 5px;">
            <img width="230px" src="https://tbcmerchantservices.com/images/tbsheader.png">
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
          <h4>Note: Minimum withdrawal is P3,700</h4>

          <a href="javascript:void(0)" onclick="$('#modal_eudodona').modal('show');" class="btn btn-info btn-lg">
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
          <tr style="height : 50px">
            <th scope="col"> </th>
            <th scope="col"> </th>
            <th scope="col"> </th>
            <th scope="col"><img src="https://tbcmerchantservices.com/images/network.png"></th>
            <th scope="col"> </th>
            <th scope="col"> </th>
            <th scope="col"> </th>
          </tr>
          <tr style="height : 60px">
            <th scope="col"> </th>
            <th scope="col"> </th>
            <th scope="col"> </th>
            <th scope="col">
              <!-- <div class="table-div"> -->
                <!-- <div class="dot" style="">
                  <span>
                  </span>
                </div> -->
              <!-- </div> -->
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
            <th scope="col"><img src="https://tbcmerchantservices.com/images/network.png"></th>
            <th scope="col"><img src="https://tbcmerchantservices.com/images/network.png"></th>
            <th scope="col"><img src="https://tbcmerchantservices.com/images/network.png"></th>
            <th scope="col"> </th>
            <th scope="col"><img src="https://tbcmerchantservices.com/images/network.png"></th>
            <th scope="col"><img src="https://tbcmerchantservices.com/images/network.png"></th>
            <th scope="col"><img src="https://tbcmerchantservices.com/images/network.png"></th>
          </tr>
          <tr style="height : 20px">
            <th scope="col">
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
            <th scope="col">
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
            <th scope="col">
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
            <th scope="col">
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
            <th scope="col">
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
            <th scope="col">
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
      ?>

      <div class="container">
      <hr>
      <h4><img src="https://tbcmerchantservices.com/images/coinph.png" width="80px"> </h4>
      Send Amount to our PHP Address below <span style="color: red"><?php echo $error2;?></span>
      <input class="form-control"/ readonly name="txtemail_phpeud_trans_id2"
             placeholder="PHP Transaction ID Here" value=<?php echo '"3A9qBQkV9tu3zQ7cDosenG5ev3TyJ56CfG"';?> >
      <span style="font-size: 5px">&nbsp</span>
      <form method="POST">
        <div width="50%">
          <input class="form-control"/ name="txtphpeud_trans_id2" placeholder="PHP Transaction ID Here">
        </div><br>
        <input name="submit_phpeud_transact2" type="submit" hidden />
        <a href="javascript:void(0)" id="btn_phpeud_transact2" class="btn btn-primary btn-lg">SEND REQUEST</a>
      </form>

    </div>

      <?php
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
            <img width="230px" src="https://tbcmerchantservices.com/images/tbsheader.png">
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
      <h4>You can register for 1,000 pesos only! </h4>
    </center>

    <div class="container">
    <h4><img src="https://tbcmerchantservices.com/images/coinph.png" width="80px"> </h4>
    Send Amount to our PHP Address below <span style="color: red"><?php echo $error2;?></span>
    <input class="form-control"/ readonly name="txtemail_phpeud_trans_id"
           placeholder="PHP Transaction ID Here" value=<?php echo '"3A9qBQkV9tu3zQ7cDosenG5ev3TyJ56CfG"';?> >
    <span style="font-size: 5px">&nbsp</span>
    <form method="POST">
      <div width="50%">
        <input class="form-control"/ name="txtphpeud_trans_id" placeholder="PHP Transaction ID Here">
      </div><br>
      <input name="submit_phpeud_transact" type="submit" hidden />
      <a href="javascript:void(0)" id="btn_phpeud_transact" class="btn btn-primary btn-lg">SEND REQUEST</a>
    </form>

  </div>

<?php
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
