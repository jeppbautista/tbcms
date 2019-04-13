<?php
  session_start();
  date_default_timezone_set('Asia/Manila');
	$sessiondate=date('mdY');
  include 'class.php';
  $class=new mydesign;
  $class->database_connect();
  $class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
  $Mainctr=$_SESSION['session_tbcmerchant_ctr'.$sessiondate];

  $query="select * from xtbl_eudodona WHERE MainCtr='$Mainctr'";
  $rs=mysql_query($query);
  $row=mysql_fetch_assoc($rs);

  $rows=mysql_num_rows($rs);

  if(!isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate])){
    header("location: https://tbcmerchantservices.com/welcome/");
  }
  else {
    ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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

    // onAuthorize: function (data, actions) {
    //   return actions.payment.get()
    //     .then(function () {
    //         window.alert('Payment Complete!');
    //         console.log(data);
    //         var payload = {
    //             paymentId: data.paymentID,
    //             payerId:   data.payerID
    //         };
    //
    //         return paypal.request({
    //           method : 'post',
    //           url: 'https://api.sandbox.paypal.com/v1/payments/payment/',
    //           json: payload
    //         }).then(
    //           function(res){
    //             alert("foo");
    //           }
    //         ).catch(
    //           function(err){
    //             console.log(err);
    //             console.log(data);
    //             alert("aw");
    //           }
    //         );
    //
    //     });
    // }

    }, '#paypal-button-container');
    </script>

<?php
  }


  # TODO fix this: if already paid
  // if($rows == 1)
  // {
  //   // header("location: main.php");
  //   header("location: landing.php");
  // }
  // else
  // {
  //   header("location: landing.php");
  // }


?>
