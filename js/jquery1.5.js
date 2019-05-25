$( document ).ready(function() {
});

function delete_product(id){
  if(confirm("This product will be PERMANENTLY deleted")){
    $("#product_requestnumber" + id).click();
  }
}

function edit_product(id){
  // var divHtml = $("#" + id).html().replace(/<(.|\n)*?>/g, ''); //select's the contents of div immediately previous to the button
  // var editableText = $("<textarea id='" + id + "' style='width:100%; height:120px; resize:none;' />");
  // editableText.val(divHtml);
  // $("#" + id).replaceWith(editableText); //replaces the required div with textarea
  // editableText.focus();
  // $('#edit_' + id).show();
  //
  $("#div_desc" + id).hide();
  $("#txt_desc" + id).show();
  $('#edit_' + id).show();

}

function cancel_edit(id){
  var divHtml = $("#div_desc" + id).html().replace(/<(.|\n)*?>/g, '');
  $("#txt_desc" + id).text($.trim(divHtml));
  $("#txt_desc" + id).hide();
  $('#edit_' + id).hide();
  $("#div_desc" + id).show();

}


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
