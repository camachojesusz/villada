
$(document).ready(function() {
	$('#txtboxes_c').val('0');
	$('#txtweight_c').val('0');
});

$("#btn_min_bx").click(function(){
   min_box();
	data_ent();
});

$("#btn_add_bx").click(function(){
   add_box();
	data_ent();
});

$("#btn_min_kg").click(function(){
   min_kg();
	data_ent();
});

$("#btn_add_kg").click(function(){
   add_kg();
	data_ent();
});

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

function min_box()
{
   aux_bx   = $('#j_box_min').val();
   aux_bx_b = $('#txtboxes').val();
	if (aux_bx != '' && (aux_bx <= aux_bx_b || aux_bx >= aux_bx_b))
	{
      new_boxes = aux_bx_b - aux_bx;
      if (new_boxes <= 0)
      {
         new_boxes = aux_bx_b;
         alert('¡Acción invalida!\n\nNo puedes retirar más Cajas de las disponibles En existencia');
      }
      $('#txtboxes').val(new_boxes);
	}
   else
   {
      alert('¡Acción invalida!\n\nFormato inválido en Cajas');
   }
   $('#j_box_min').val('');
}

function min_kg()
{
   aux_kg   = $('#j_kg_min').val();
   aux_kg_b = $('#txtweight').val();
   if (aux_kg != '' && (aux_kg <= aux_kg_b || aux_kg >= aux_kg_b))
   {
      new_kg = aux_kg_b - aux_kg;
      if (new_kg <= 0)
      {
         new_kg = aux_kg_b;
         alert('¡Acción invalida!\n\nNo puedes retirar más Kilos de las disponibles En existencia');
      }
      $('#txtweight').val(new_kg);
   }
   else
   {
      alert('¡Acción invalida!\n\nFormato inválido en Kilos');
   }
   $('#j_kg_min').val('');
}

function add_box()
{
   aux_bx = $('#j_box_add').val();
	if (aux_bx != '')
	{
      if (aux_bx >= $('#ctrl_boxes').val())
      {
         aux_bx = 0;
         $('#j_box_add').val('');
      }
		new_boxes = parseInt($('#txtboxes').val()) + parseInt(aux_bx);
		$('#txtboxes').val(new_boxes);
	}
	$('#j_box_add').val();
}

function add_kg()
{
   aux_kg = $('#j_kg_add').val();
	if (aux_kg != '')
	{
      if (aux_kg >= $('#ctrl_weigth').val())
      {
         aux_kg = 0;
         $('#j_kg_add').val('');
      }
		new_kg = parseFloat($('#txtweight').val()) + parseFloat(aux_kg);
		$('#txtweight').val(new_kg);
	}
	$('#j_kg_add').val();
}

function add_all_bx()
{
   $('#txtboxes').val('0');
	if ($('#ctrl_boxes_b').val() != '')
	{
		new_boxes = parseInt($('#txtboxes_b').val()) + parseInt($('#ctrl_boxes_b').val());
		$('#txtboxes').val(new_boxes);
		$('#ctrl_boxes_b').val('0');
	}
	$("#btn_add_all_bx").attr('disabled');
}

function add_all_kg()
{
   $('#txtweight').val('0');
	if ($('#ctrl_weigth_b').val() != '')
	{
		new_kg = parseFloat($('#txtweight_b').val()) + parseFloat($('#ctrl_weigth_b').val());
		$('#txtweight').val(new_kg);
		$('#ctrl_weigth_b').val('0');
	}
	$("#btn_add_all_kg").attr('disabled');
}

function data_ent()
{
	txt_boxes   = $('#txtboxes').val();
	txt_boxes_b = $('#txtboxes_b').val();
	val_destare = $('#txtvaldestare').val();

	dif_bx = txt_boxes - txt_boxes_b;
	$('#txtboxes_c').val(dif_bx);
   value_lb_bx = parseInt($('#ctrl_boxes_b').val()) - (parseInt($('#txtboxes_c').val()));
	if (value_lb_bx <= 0)
	{
		value_lb_bx = 0;
	}
   $('#txtboxes_lb').html(value_lb_bx);
	$('#txtboxes_lb_b').html(value_lb_bx);
   $('#j_txtboxes_lb').html(txt_boxes);

   $('#txtdestare_a').val(parseInt(txt_boxes) * val_destare);

   txt_weight   = $('#txtweight').val();
	txt_weight_b = $('#txtweight_b').val();
   txt_destare  = $('#txtdestare_a').val();
   $('#txtdestare_b').val(txt_destare);

	dif_kg = txt_weight - txt_weight_b;
	$('#txtweight_c').val(dif_kg);
   value_lb_kg = parseFloat($('#ctrl_weigth_b').val()) - (parseFloat($('#txtweight_c').val()));
	if (value_lb_kg <= 0)
	{
		value_lb_kg = 0;
	}
   $('#txtweight_lb').html(value_lb_kg);
	$('#txtweight_lb_b').html(value_lb_kg);
	$('#j_txtweight_lb').html(txt_weight);

   txt_total = parseFloat(txt_weight) - parseFloat(txt_destare);

   if (txt_total < 0)
   {
      txt_total = 0;
   }

   $('#txttotalweight_a').val(txt_total);
   $('#txttotalweight_b').val(txt_total);
}
