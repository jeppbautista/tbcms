$( document ).ready(function() {

	$("[name=txt_amount]").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
        
    });

    $("[name=txt_amount]").keyup(function (e) {
    	$.ajax({
			type: "POST",
			url: 'https://tbcmerchantservices.com/amount/',
			data: $("form").serialize(),
			success: function(amount){
				$('#lbl_amount').html(amount);
			}
		});
   	});

});