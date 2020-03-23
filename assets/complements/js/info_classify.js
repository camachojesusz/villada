$(document).ready(function(){
   $("#txtquality").change(function(){
      product_change('');
   });
   product_change();
});

var base_url = $('#site_url').val();

function product_change(sufix)
{
   var quality_id = $('#txtquality'+sufix).val();
   var product_id = $('#product_id'+sufix).val();
   $("#txtcategory"+sufix).empty().removeAttr("disabled").append("<option value=''>Elige un proveedor</option>");
   $.ajax({
      type:"POST",
      dataType:"html",
      url:base_url+"classify/get_category",
      data: {quality_id_js:quality_id, product_id_js: product_id},
      success:function(msg){
         $("#txtcategory"+sufix).empty().removeAttr("disabled").append(msg);
      }
   });
}
