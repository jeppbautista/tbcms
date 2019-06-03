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
  $("#price" + id).hide();
  $("#prod_price" + id).show();
  $("#raw_description" + id).hide();
  $("#description" + id).show();
  $('#edit_' + id).show();

}

function cancel_edit(id){
  var divHtml = $("#div_desc" + id).html().replace(/<(.|\n)*?>/g, '');
  $("#txt_desc" + id).text($.trim(divHtml));
  $("#txt_desc" + id).hide();
  $('#edit_' + id).hide();
  $("#description" + id).hide();
  $("#prod_price" + id).hide();
  $("#price" + id).show();
  $("#raw_description" + id).show();
  $("#div_desc" + id).show();

}

function edit_profile() {

  $("#desc_last").hide();
  $("#desc_middle").hide();
  $("#desc_first").hide();
  $("#desc_cell").hide();
  $("#desc_birth").hide();
  $("#desc_address").hide();
  $("#edit_profile_btn").hide();

  $("#txt_last").show();
  $("#txt_middle").show();
  $("#txt_first").show();
  $("#txt_cell").show();
  $("#txt_birth").show();
  $("#txt_address").show();
  $("#confirm_profile_btn").show();
  $("#cancel_profile_btn").show();
}


function edit_merchantprofile() {
  $("#desc_country").hide();
  // $("#desc_fullname").hide();
  $("#desc_cell").hide();
  $("#desc_birth").hide();
  $("#desc_address").hide();
  $("#edit_merchantprofile_btn").hide();
  $("#desc_bussiness_name").hide();
  $("#desc_business_desc").hide();

  $("#txtm_business_desc").show();
  $("#txtm_business_name").show();
  $("#txtm_country").show();
  $("#txtm_fullname").show();
  $("#txtm_cellphone").show();
  $("#txtm_birthday").show();
  $("#txtm_addr").show();
  $("#confirm_merchantprofile_btn").show();
  $("#cancel_merchantprofile_btn").show();
}

function cancel_edit_profile() {
  $("#desc_last").show();
  $("#desc_middle").show();
  $("#desc_first").show();
  $("#desc_cell").show();
  $("#desc_birth").show();
  $("#desc_address").show();
  $("#edit_profile_btn").show();

  $("#txt_last").hide();
  $("#txt_middle").hide();
  $("#txt_first").hide();
  $("#txt_cell").hide();
  $("#txt_birth").hide();
  $("#txt_address").hide();
  $("#confirm_profile_btn").hide();
  $("#cancel_profile_btn").hide();
}

function cancel_edit_merchantprofile() {
  $("#desc_business_desc").show();
  $("#desc_bussiness_name").show();
  $("#desc_country").show();
  $("#desc_fullname").show();
  $("#desc_cell").show();
  $("#desc_birth").show();
  $("#desc_address").show();
  $("#edit_merchantprofile_btn").show();

  $("#txtm_business_desc").hide();
  $("#txtm_business_name").hide();
  $("#txtm_country").hide();
  $("#txtm_fullname").hide();
  $("#txtm_cellphone").hide();
  $("#txtm_birthday").hide();
  $("#txtm_addr").hide();
  $("#confirm_merchantprofile_btn").hide();
  $("#cancel_merchantprofile_btn").hide();
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
