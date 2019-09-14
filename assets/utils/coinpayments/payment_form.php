<?php
// require('/examples/create_simple_transaction.php');


class PaymentForm {

	/*
		@param merchant 		- seller mechant ID located on Coins Account Settings
		@param item_name 		- name of specific item to purchase
		@param currency 		- avaialable currenct to transact
		@param amountf 			- amount of each item to purchase
		@param quantity 		- inital quantity of item
		@param allow_quantity	- 0 = don't allow customer to change the quantity on checkout page
								- 1 = allow customer to change the quantity on checkout page
		
		@param want_shippping 	- 0 = disable shipping fee
								- 1 = enable shipping fee
		@param shippingf		- shipping fee amount
		@param success_url		- landing page URL address after the success transaction
		@param cancel_url		- landing page URL address if customer cancel the transaction (option in checkout page)
		@param allow_extra 		- put extra text area to checkout page on customer notes
		@param image_height 	- to set the height of the button's image
		@param image_width 		- to set the width of the button's image
	*/

	public function __construct($merchant, $item_name, $currency, $amountf, $quantity,$allow_quantity,$want_shipping,$shippingf,$success_url,$cancel_url,$allow_extra,$image_height,$image_width){

		$form = '
			<form action="https://www.coinpayments.net/index.php" method="post">
				<input type="hidden" name="cmd" value="_pay">
				<input type="hidden" name="reset" value="1">
				<input type="hidden" name="merchant" value="'.$merchant.'">
				<input type="hidden" name="item_name" value="'.$item_name.'">
				<input type="hidden" name="currency" value="'.$currency.'">
				<input type="hidden" name="amountf" value="'.$amountf.'">
				<input type="hidden" name="quantity" value="'.$quantity.'">
				<input type="hidden" name="allow_quantity" value="'.$allow_quantity.'">
				<input type="hidden" name="want_shipping" value="'.$want_shipping.'">
				<input type="hidden" name="shippingf" value="'.$shippingf.'">
				<input type="hidden" name="success_url" value="'.$success_url.'">
				<input type="hidden" name="cancel_url" value="'.$cancel_url.'">
				<input type="hidden" name="allow_extra" value="'.$allow_extra.'">
				<input type="image" src="https://www.coinpayments.net/images/pub/CP-third-med.png" alt="Buy Now with CoinPayments.net" height="'.$image_height.'" width="'.$image_width.'">
			</form>

		';
		echo $form;
	}

}

// SAMPLE USAGE
$obj = new PaymentForm(
	$merchant='136666752e03bf5ad700af4196b13fb3',
	$item_name='Sample',
	$currency='BTC',
	$amountf=0.20523,
	$quantity = 1,
	$allow_quantity = 1,
	$want_shipping=0.020102,
	$shippingf=0.002,
	$success_url="http://www.google.com",
	$cancel_url="http://www.google.com",
	$allow_extra=1,
	$image_height="100px",
	$image_width='auto');
?>