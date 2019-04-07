$( document ).ready(function() {

});


function urlblockchain(value){

    var ccount=0, adminfee;
    $.get(value , function( d ) {
        
        $.each( d, function( key, value ) {
            if(ccount==1) {
                adminfee=value;
            }
            ccount=ccount+1;
        });

        $('[name=urlblockchaini]').val(adminfee);

        $.ajax({
            type: "POST",
            url: 'https://tbcmerchantservices.com/checktrade/',
            data: $("#urlblockchain").serialize(),
            success: function(data){
                $('#exchangecontent').html(data);
            }
        });

    });
}
