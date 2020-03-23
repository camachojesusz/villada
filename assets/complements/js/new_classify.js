
$("#btn_add_all_bx").click(function(){
   add_all_bx();
   add_all_kg();
	data_ent();
});

$("#btn_add_all_kg").click(function(){
   add_all_bx();
   add_all_kg();
	data_ent();
});

function add_all_bx() {
   $('#txtboxes').val('0')
	if ($('#ctrl_boxes_b').val() != '')
	{
		new_boxes = parseInt($('#txtboxes').val()) + parseInt($('#ctrl_boxes_b').val());
		$('#txtboxes').val(new_boxes);
		$('#ctrl_boxes_b').val('0')
	}
}

function add_all_kg() {
   $('#txtweight').val('0')
	if ($('#ctrl_weigth_b').val() != '')
	{
		new_kg = parseFloat($('#txtweight').val()) + parseFloat($('#ctrl_weigth_b').val());
		$('#txtweight').val(new_kg);
		$('#ctrl_weigth_b').val('0');
	}
}

// -----------------------------------------------------------------------------

var txt_boxes  = document.getElementById('txtboxes')
var txt_weight = document.getElementById('txtweight')

function data_ent()
{
	if($("#ctrl_status_classify").val() === 2)
	{

		txt_boxes.disabled  = true;
		txt_weight.disabled = true;
	}

   txt_boxes = $("#txtboxes").val();
   val_destare = $('#txtvaldestare').val();

   $("#txtdestare_a").val(parseInt(txt_boxes) * val_destare);

   txt_weight = $("#txtweight").val();
   txt_destare = $("#txtdestare_a").val();
   $("#txtdestare_b").val(txt_destare);

   txt_total = parseFloat(txt_weight) - parseFloat(txt_destare);

   if (txt_total < 0)
   {
      txt_total = 0;
   }

   $('#txttotalweight_a').val(txt_total);
   $('#txttotalweight_b').val(txt_total);
}

txt_boxes.addEventListener('change', data_ent)
txt_weight.addEventListener('change', data_ent)
