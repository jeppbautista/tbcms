$( document ).ready(function() {

    var url=window.location.href;
    var res = url.split("#");

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    function isPressed(selector) {
        var aria = $(selector).attr('class');
        return aria == "collapse";
    }

    function proc_details(){
        var email = $('#check-email').val();
        var phone = $('#check-phone').val();
        var proceed1 = true;

        if(!isEmail(email) || email==""){
            proceed1 = false;
            $('#check-email').css('border', '1px solid red');
        }else{
            $('#check-email').css('border', '1px solid #ccc');
        }
        if(phone==""){
            proceed1 = false;
            $('#check-phone').css('border', '1px solid red');
        }else{
            $('#check-phone').css('border', '1px solid #ccc');
        }

        if(proceed1){
            $('#headingTwo > * > button').prop('disabled', false);
            $('#collapseOne').removeClass('in');
            $('#collapseOne').addClass('collapse');

            if(isPressed('#collapseTwo')){
                $('#headingTwo > * > button').click();
            }

            $('#headingOne > * > button > * > .fa.fa-times-circle').hide();
            $('#headingOne > * > button > * > .fa.fa-check-circle-o').show();

            $('#check-email').css('border', '1px solid #ccc');
            $('#check-phone').css('border', '1px solid #ccc');
            $('#hd-details').val("1");
        }
        else{
            $('#headingOne > * > button > * > .fa.fa-times-circle').show();
            $('#headingOne > * > button > * > .fa.fa-check-circle-o').hide();
            $('#hd-details').val("");
        }
    }

    function proc_shipping(){

        var proceed2 = true;

        $('#collapseTwo > div > div > input[type="text"]').each(function(){
            if ($(this).val() === '') {
                proceed2 = false;
                $(this).css('border', '1px solid red');
            }else{
                $(this).css('border', '1px solid #ccc');
            }
        });

        if(proceed2){
            $('#headingThree > * > button').prop('disabled', false);
            $('#collapseTwo').removeClass('in');
            $('#collapseTwo').addClass('collapse');

            if(isPressed('#collapseThree')){
                $('#headingThree > * > button').click();
            }

            $('#headingTwo > * > button > * > .fa.fa-check-circle-o').show();
            $('#headingTwo > * > button > * > .fa.fa-times-circle').hide();

            $('#collapseTwo > div > div > input[type="text"]').each(function(){
                $(this).css('border', '1px solid #ccc');
            });
            $('#hd-shipping').val("1");
        }
        else{
            $('#headingTwo > * > button > * > .fa.fa-times-circle').show();
            $('#headingTwo > * > button > * > .fa.fa-check-circle-o').hide();
            $('#hd-shipping').val("");
        }
    }

    $('#check-proceed1').on('click', function(){
        proc_details();
    });

    $('#check-proceed2').on('click', function(){
        proc_shipping();
    });

    $('.btn-submit').on('click', function(){
        var completeForm = true;
        var payment_type = this.id;

        $('#check-proceed1').click();
        $('#check-proceed2').click();

        if ($('#txt-trans-'+payment_type).val() == "" ){
            $('#txt-trans-'+payment_type).css('border', '1px solid red');
            $('#hd-payment').val("");
        }
        else{
            $('#hd-payment').val("1");
        }

        $('#hd-form-check > input').each(function(){
            if ($(this).val() != "1"){
                completeForm = false;
            }
        });

        if(completeForm){
            $('#txt-payment-type').val(payment_type);
            $('#btn-submit-payment').click();
        }else{
            alert("Please fill up all the forms");
        }
        
    });
});
