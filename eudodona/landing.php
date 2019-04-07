
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
        console.log(data);
        $.ajax({
          type:'POST',
          url : 'insert.php',
          success : function(data){
              console.log(data);
          }
      });
    });
}
}, '#paypal-button-container');
</script>

