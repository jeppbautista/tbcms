function btnaccept(value) {
    $('[name=temporary_value]').val(value);
    $('#modal_accept').modal('show');
}

function btndenied(value) {
    $('[name=temporary_valueD]').val(value);
    $('#modal_denied').modal('show');
}

function markasdone(value) {
    $.ajax({
		type: "POST",
		url: 'https://tbcmerchantservices.com/markasdone/',
		data: $("#frmmarkasdone"+value).serialize(),
		success: function(data){
			if(data=='success'){
				window.location.assign("https://tbcmerchantservices.com/admin_trade/");
			}
			else {
				alert(data);
			}
		}
	});
}

$(document).ready(function(){
	$(".dropdown-menu li a").click(function(){
		var selText = $(this).text();
		$(this).parents('.dropdown').find('.dropdown-toggle').html(selText + '<span class="caret"></span>');
	  });
});