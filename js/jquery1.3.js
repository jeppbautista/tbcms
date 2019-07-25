  $( document ).ready(function() {

    function isEmail(email) {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
    }

    function numberWithCommas(number) {
        var parts = number.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    }

    function update_summary(){
      var tbody = $('table#cart tbody').children();

      var summary_total = 0.0;

      tbody.children('tr td[data-th="Subtotal"]').each(function(){
        var temp = $(this).children('b').html();
        temp = parseFloat(temp.replace(",", ""));
        summary_total += temp;
      });

      $('#summ-subtotal').children('h5').children('b').html(numberWithCommas(summary_total.toFixed(2)));
      var summ_tax = $('#summ-tax').children('h5').children('b').html();
      var summ_shipping = $('#summ-shipping').children('h5').children('b').html();

      summ_tax = parseFloat(summ_tax).toFixed(2);
      summ_shipping = parseFloat(summ_shipping).toFixed(2);
      summary_total = parseFloat(summary_total).toFixed(2);

      var grand_total = parseFloat(summary_total + summ_tax + summ_shipping).toFixed(2);

      $('#summ-total').children('h4').children('b').html(numberWithCommas(grand_total));
    }

    function load_radiobuttons(){
      $('#collapseThree > .card-body').children('.custom-radio').each(function() {
        $(this).css('border', '2px solid #EAEAEA').css('background', 'white');
      });
    }

    function hide_order_divs(){
      $('.div-pay').children('.order-div').each(function(){
        $(this).css('display', 'none');
      });
    }

    function proc_details(){
      var email = $('#check-email').val();
      var phone = $('#check-phone').val();
      var proceed = true;
      if(!isEmail(email) || email==""){
        proceed = false;
        $('#check-email').css('border', '1px solid red');
      }else{
        $('#check-email').css('border', '1px solid #ccc');
      }
      if(phone==""){
        proceed = false;
        $('#check-phone').css('border', '1px solid red');
      }else{
        $('#check-phone').css('border', '1px solid #ccc');
      }

      if(proceed){
        $('#headingTwo > * > button').prop('disabled', false);
        $('#collapseOne').removeClass('in');
        $('#collapseTwo').removeClass('collapse');
        $('#headingOne > * > button > * > .fa.fa-times-circle').hide();
        $('#headingOne > * > button > * > .fa.fa-check-circle-o').show();

        $('#check-email').css('border', '1px solid #ccc');
        $('#check-phone').css('border', '1px solid #ccc');
      }else{
        $('#headingOne > * > button > * > .fa.fa-times-circle').show();
        $('#headingOne > * > button > * > .fa.fa-check-circle-o').hide();
      }
    }

    function proc_shipping(){
      $('#headingThree > * > button').prop('disabled', false);
      $('#headingThree > * > button').click();
    }


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

      // add to cart 
      $('.add-to-cart-form').on('submit', function(){
        var id = $('#product').val();
        var quantity = $('#quantity').val();

        window.location.href = "https://tbcmerchantservices.com/add_to_cart.php?id=" + id + "&quantity=" + quantity;
        return false;
      });
      // add to cart END

      // Quantity input 
      $('.quantity-field').on('input', function(){
        var q_id = this.id;
        var id = q_id.split("-")[1];
        var price = $('#price-' + id).children("b").html()
        price = price.replace(",", "");
        price = parseFloat(price).toFixed(2);

        var q_value = parseFloat(this.value).toFixed(2);
        var new_sub_total = parseFloat(price * q_value).toFixed(2);
        $('#quantity-' + id).attr('value', q_value);

        $('#subtotal-' + id).children("b").html(numberWithCommas(new_sub_total));
        update_summary();
      });
      // Quantity input END

      // Collapsible buttons on checkout steps
      $('.btn-coll').on('click', function(){
        var id = $(this).attr('data-target');
        console.log(id);
        var aria = $(id).attr('class');
        if(aria=="collapse"){
          $(this).children('h3').css('font-weight','bold');
        }else{
          $(this).children('h3').css('font-weight','normal');
        }
      });
      // Collapsible buttons on checkout steps END

      // Radio buttons for payment type
      $('.custom-control-input').change(function(){
        load_radiobuttons();
        $('#' + this.id).parents('div.custom-control').css('border', '2px solid #214E11').css('background', '#F6F6EE');
        hide_order_divs();
        $('div.order-div[for='+this.id+']').show();
      });
      // Radio buttons for payment type END


      // $('.coinsph-control-input').change(function(){
      //   $('div.div-qrcoins').children('img').each(function(){
      //     $(this).hide();
      //   });

      //   var id = $(this).attr("for");
      //   $('img#'+id).show();

      // });
      // QR code changing for Coins.PH

      $('#check-proceed1').on('click', function(){
        proc_details();
      });

      $('#check-proceed2').on('click', function(){
        proc_shipping();
      });

      // Finalize checkout
      // $('#btn-4').on('click', function(){
      //   $('.div-steps').fadeOut(500,function(){});
      //   $('#header_text').hide();
      //   $('.div-check-cart > .table-header').html('YOUR ORDERS');
      //   setTimeout(function(){
      //     $('#checkout-finished').fadeIn(250);
      //     $('.div-order-final').fadeIn(250);
      //   },500);
      // });
      // Finalize checkout END

      $('#btn-discount').on('click', function(){
        alert('Invalid discount code');
      });

      $('.btn-submit').on('click', function(){
        var payment_type = this.id;
        $('#txt-payment-type').val(payment_type);
        $('#btn-submit-payment').click();
      });

  });
