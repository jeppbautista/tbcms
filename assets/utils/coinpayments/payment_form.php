<?php
// require('/examples/create_simple_transaction.php');

$form = '
	<form action="./examples/create_simple_transaction.php" method="POST">
		<div class="row">
			<label>email for now</label>
			<input type="email" value="ajcestrada02@gmail.com" name="buyer-email">
		</div>
		<div class="row">
			<label>Enter Amount</label>
			<input type="number" placeholder="0.00 BTC" name="coin-amount">
		</div>
		<input type="submit" name="btn-submit-payment" value="Submit">
	</form>
';

echo $form;
?>