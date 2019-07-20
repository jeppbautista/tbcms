$(document).ready(function(){
  paypal.Button.render({
    env: 'sandbox', // sandbox | production
    style: {
                label: 'paypal',size:  'medium',shape: 'rect',color: 'blue',tagline: false
            },
    payment: function(data, actions){

    },
    onAuthorize: function(data, actions) {

    },
    onError: function(err){

    }
    // funding: {
    //   allowed: [
    //     paypal.FUNDING.CARD
    //   ],
    //   disallowed: []
    // },
    // commit: true,
    // client: {
    //   sandbox: 'AcbAorOUrYTMMGKbTf1FTXRqOb2CwIbw86NU7SjmLcyW671Cf3Bax52MeHVD09Vf4y7y0akNx19Wed5r',
    //   // production: 'AQ4nznkSsjkp2VVHiV95Cjk6hkMb8Ln5d16c6aVhpIvrPsx4-D03i3rZcYE5cJ-eZ2ZG6ZUhoHKj-7EP'
    // },
    //
    // payment: function (data, actions) {
    //   return actions.payment.create({
    //     payment: {
    //       transactions: [
    //         {
    //           amount: {
    //             total: '1'  ?>,
    //             currency: 'PHP'
    //           }
    //         }
    //       ]
    //     }
    //   });
    // },
    //
    // onAuthorize: function (data, actions) {
    //   return actions.payment.execute()
    //     .then(function () {
    //       var paymentID = JSON.stringify(data['paymentID']);
    //       // console.log(paymentID)
    //       getTransaction(paymentID.slice(1,-1));
    //     });
    // },
    // onError: function(err)
    // {
    //   window.alert(err);
    // }
  }, '#paypal-button-container');
});
