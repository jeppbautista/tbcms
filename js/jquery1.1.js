$( document ).ready(function() {

	$('#btn_email_confirm').click( function(){
		$('[name=submit_email_confirm]').click();
	});

	$('#btn_btc_transact').click( function(){
		$('[name=submit_btc_transact]').click();
	});

	$('#btn_coinph_transact').click( function(){
		$('[name=submit_coinph_transact]').click();
	});

	$('#btn_paypal_transact').click( function(){
		$('[name=submit_paypal_transact]').click();
	});

	$('#btn_upload_requirements').click( function(){
		console.log("js");
		$('#txtsubmit_upload').click();
	});

	$('#btn_phpeud_transact').click(function(){
		$('[name=submit_phpeud_transact]').click();
	});

	$('#btn_phpeud_transact2').click(function(){
		$('[name=submit_phpeud_transact2]').click();
	});


});
