<?php
require('../src/CoinpaymentsAPI.php');
require('../src/keys.php');

/** Scenario: Create a simple transaction. **/

// Create a new API wrapper instance
/* 
    Keys for payment. This can be configure in ../src/keys.php
    @param private_key - private key of seller API
    @param public_key - public key of seller API
    @param response_type_file ('json') - response file format 
*/
$cps_api = new CoinpaymentsAPI($private_key, $public_key, 'json');

if(isset($_POST['btn-submit-payment'])){
   // Enter amount for the transaction
    $amount = $_POST['coin-amount'];

    // Litecoin Testnet is a no value currency for testing
    $currency = 'BTC';

    // Enter buyer email below
    $buyer_email = $_POST['buyer-email'];

    // Make call to API to create the transaction
    try {
        $transaction_response = $cps_api->CreateSimpleTransaction($amount, $currency, $buyer_email);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
        exit();
    }

    if ($transaction_response['error'] == 'ok') {
        // Success!
        $output = 'Transaction created with ID: ' . $transaction_response['result']['txn_id'] . '<br>';
        $output .= 'Amount for buyer to send: ' . $transaction_response['result']['amount'] . '<br>';
        $output .= 'Address for buyer to send to: ' . $transaction_response['result']['address'] . '<br>';
        $output .= 'Seller can view status here: ' . $transaction_response['result']['status_url'].'<br>';
        $output .= 'Checkout: <a href=' . $transaction_response['result']['checkout_url'].'>Proceed to checkout</a>';
    } else {
        // Something went wrong!
        $output = 'Error: ' . $transaction_response['error'];
    }

    // Output the response of the API call
    echo $output;
}

