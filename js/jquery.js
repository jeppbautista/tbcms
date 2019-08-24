$( document ).ready(function() {

	$('#birth-text').on('keypress', function(e){
  	var keyCode = e.which;

		var numChars = $("#birth-text").val().length;

		if ((keyCode != 8 ) && (keyCode < 48 || keyCode > 57) && (keyCode != 109 || keyCode != 189) || (numChars > 9)){
			e.preventDefault();
		}

		if((keyCode !== 8)) {
			if(numChars === 4 || numChars === 7){
				var thisVal = $("#birth-text").val();
				thisVal += '-';
				$("#birth-text").val(thisVal);
			}
		}


	 });

	var url=window.location.href;
	var res = url.split("#");

	$('[name=txttbc_referral_signup]').val(res[1]);
	$.ajax({
		type: "POST",
		url: 'https://tbcmerchantservices.com/checkurl/',
		data: $("form").serialize(),
		success: function(error){
			$('[name=txttbc_referral_signup]').val(error);
		}
	});

	$('[name=txttbc_signasmerchantornot_signup]').click( function() {
		if($('[name=txttbc_signasmerchantornot_signup]').is(':checked')) {
			$('#spanbuyerormerchant').show();
		}
		else {$('#spanbuyerormerchant').hide();}
	});

	$("[name=txttbc_bday_signup]").datetimepicker({
		language:  "en",
	    weekStart: 1,
	    todayBtn:  1,
	    autoclose: 1,
	    todayHighlight: 1,
	    startView: 2,
	    minView: 2,
	    // forceParse: 0,
	    format: "yyyy-mm-dd"
	});

	$("[name=txttbc_cellphone_signup]").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $('#submit_complete_signupbutton').click( function() {
    	$('#submit_complete_signupbutton').hide();
    	$.ajax({
			type: "POST",
			url: 'https://tbcmerchantservices.com/checksignup/',
			data: $("form").serialize(),
			success: function(error){
				$('#personal_error').html('');
				$('#business_error').html('');
				$('#wallet_error').html('');
				$('#account_error').html('');

				if(error=='error1') {$('#personal_error').html('Referral ID Error'); $('#submit_complete_signupbutton').show();}
				else if(error=='error2') {$('#personal_error').html('Invalid Email Format');$('#submit_complete_signupbutton').show(); }
				else if(error=='error3') {$('#personal_error').html('Email not available'); $('#submit_complete_signupbutton').show();}
				else if(error=='error4') {$('#personal_error').html('Please Fill lastname'); $('#submit_complete_signupbutton').show();}
				else if(error=='error5') {$('#personal_error').html('Please Fill firtsname');$('#submit_complete_signupbutton').show(); }
				else if(error=='error6') {$('#personal_error').html('Please Select Birth date');$('#submit_complete_signupbutton').show(); }
				else if(error=='error7') {$('#personal_error').html('Please Fill Cell No'); $('#submit_complete_signupbutton').show(); }
				else if(error=='error8') {$('#personal_error').html('Please Fill Address');$('#submit_complete_signupbutton').show(); }

				else if(error=='error9') {$('#business_error').html('Please Fill Business Name'); $('#submit_complete_signupbutton').show();}
				else if(error=='error10') {$('#business_error').html('Please Fill Business Description'); $('#submit_complete_signupbutton').show();}
				else if(error=='error11') {$('#business_error').html('Please Select Business Category'); $('#submit_complete_signupbutton').show();}
				else if(error=='error12') {$('#business_error').html('Please Select Business Country'); $('#submit_complete_signupbutton').show();}

				else if(error=='error13') {$('#wallet_error').html('Please Fill BTC Wallet'); $('#submit_complete_signupbutton').show();}
				else if(error=='error14') {$('#wallet_error').html('Please Fill CoinsPH Wallet'); $('#submit_complete_signupbutton').show();}
				else if(error=='error15') {$('#wallet_error').html('Please Fill Paypal Email'); $('#submit_complete_signupbutton').show();}
				else if(error=='error16') {$('#wallet_error').html('Paypal Email not valid'); $('#submit_complete_signupbutton').show();}

				else if(error=='error17') {$('#account_error').html('Please Fill Username'); $('#submit_complete_signupbutton').show();}
				else if(error=='error18') {$('#account_error').html('Please Fill Password'); $('#submit_complete_signupbutton').show();}
				else if(error=='error19') {$('#account_error').html('Password Mismatch'); $('#submit_complete_signupbutton').show();}
				else if(error=='error20') {$('#account_error').html('Username not available'); $('#submit_complete_signupbutton').show();}
				else if(error=='error21') {$('#account_error').html('Invalid birth date'); $('#submit_complete_signupbutton').show();}
				// else if(error=='error21') {alert('ERROR CONNECTION'); $('#submit_complete_signupbutton').show();}
				else { window.location.assign("https://tbcmerchantservices.com/welcome/");}
			}
		});
    });

	$("#signup_form_submit").attr("onsubmit", "return false");
	$("#btn-get-started").on('click', function(){
		$("#btn-get-started").fadeOut(3000);
		$("#")
	});

});
