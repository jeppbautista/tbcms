<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

$email = "tbcmsapp@gmail.com";
$from = "TBCMerchantServices<automail@tbcmerchantservices.com>";
$subject = "Email Verification";
$message = "<html><body>Test email foo</body></html>";
$headers = "From:" . $from. "\r\n";
$headers .= "Reply-To: ". $from. "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();
$headers.= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers.= "X-Priority: 1\r\n";
@mail($email,$subject,$message, $headers);

 ?>

<div id="paypal-button-container"></div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>

paypal.Button.render({
env: 'production', // sandbox | production

style: {
            label: 'paypal',
            size:  'medium',    // small | medium | large | responsive
            shape: 'rect',     // pill | rect
            color: 'blue',     // gold | blue | silver | black
            tagline: false
        },

// Options:
// - paypal.FUNDING.CARD
// - paypal.FUNDING.CREDIT
// - paypal.FUNDING.ELV
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
  // sandbox: 'AcbAorOUrYTMMGKbTf1FTXRqOb2CwIbw86NU7SjmLcyW671Cf3Bax52MeHVD09Vf4y7y0akNx19Wed5r',
  production: 'AeVUKSad_DseckErsDT3xuxwi3o4PkxKfWqI_a0siIn94A8zsPw1kfv1Ic1JSK9c-A8OCWh57V0DSJdt'
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
    });
}
}, '#paypal-button-container');
</script>
