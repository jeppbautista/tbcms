$( document ).ready(function() {

    var url=window.location.href;
    var res = url.split("#");

	$("[name=btc_amount]").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }

    });

    $("[name=btc_amount]").keyup(function (e) {
    	$.ajax({
			type: "POST",
			url: 'https://tbcmerchantservices.com/amount2/',
			data: $("form").serialize(),
			success: function(amount){
				$('#btc_lbl_amount').html(amount);
			}
		});
   	});

    $("[name=txtpesoamount_onadd]").keydown(function (e) {
        var chatr=$("[name=txtpesoamount_onadd]").val();
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)  ) {
            e.preventDefault();
        }
    });

    $("[name=txtpesoamount_onadd]").keyup(function (e) {
        var s=$("[name=txtpesoamount_onadd]").val();
        if(isNaN(s) ){
            s = s.substring(0, s.length - 1);
            $("[name=txtpesoamount_onadd]").val(s);
        }
    });

    //shopping
    $("#txtitem_quantity").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)  ) {
            e.preventDefault();
        }
    });

    $("#txtitem_quantity").keyup(function (e) {
        $('#txtitem_totalprice').val($('[name=txtitem_quantityandamounta]').val()*$("#txtitem_quantity").val());
    });

    $("#txtitem_quantity").focusout(function() {
        $('#txtitem_totalprice').val($('[name=txtitem_quantityandamounta]').val()*$("#txtitem_quantity").val());
    });

    $('#txtitem_clickrequest').click(function(){
        $('#modal_save_newitem').modal('show');
    });


    $(function () {
      $('[data-toggle="popover"]').popover()
    });

    // $(".product-holder").popover({
    //   html: true,
    //   content : function(){
    //     return $("#popover_content_wrapper").html();
    //   }
    // });

    $('[data-toggle="popover-hover"]').popover({
      html: true,
      trigger: 'hover',
      content : function(){
        return $("#popover_content_wrapper").html();
      }
    });




});
