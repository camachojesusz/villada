$(document).ready(function(){
   $("#txtproduct").change(function(){
      product_change('');
   });
   product_change();

   $("#txtproducer").change(function(){
      producer_change('');
   });
   producer_change();
});

var base_url = $('#site_url').val();

function product_change(sufix)
{
   var product_id = $('#txtproduct'+sufix).val();
   $("#txtproducer"+sufix).empty().removeAttr("disabled").append("<option value=''>Elige un proveedor</option>");
   $.ajax({
      type:"POST",
      dataType:"html",
      url:base_url+"buy/get_producer",
      data: {product_id_js:product_id},
      success:function(msg){
         $("#txtproducer"+sufix).empty().removeAttr("disabled").append(msg);
      }
   });
}

function producer_change(sufix) {
   var product_id = $('#txtproduct'+sufix).val();
   var producer_id = $('#txtproducer'+sufix).val();
   $("#txtorigin").empty().removeAttr("disabled").append("<option value=''>Elige un origen</option>");
   $.ajax({
      type:"POST",
      dataType:"html",
      url:base_url+"buy/get_origin",
      data: { product_id_js:product_id, producer_id_js:producer_id },
      success:function(msg){
         $("#txtorigin").empty().removeAttr("disabled").append(msg);
      }
   });
}
