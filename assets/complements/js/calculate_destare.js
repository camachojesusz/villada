var val_destare = 0;
var txt_sizebox = document.getElementById('txtsizebox');
var txt_ctrldestare_a = document.getElementById('txtctrldestare_a')
var txt_ctrldestare_b = document.getElementById('txtctrldestare_b')
var txt_valdestare = document.getElementById('txtvaldestare')
var btn_destare = document.getElementById('btndestare');

function data_ent()
{
   txt_boxes = $("#txtboxes").val();

   if (txt_ctrldestare_a.checked)
   {
      txt_valdestare.disabled = true;
      btn_destare.disabled =  true;
      txt_sizebox.disabled = false;
      $('#txtvaldestare').val('');
      val_destare = $('#txtsizebox').val();
   }
   else
   {
      txt_valdestare.disabled = false;
      btn_destare.disabled = false;
      txt_sizebox.disabled = true;
      val_destare = $('#txtvaldestare').val();
   }

   $("#txtdestare_a").val(parseInt(txt_boxes) * val_destare);

   txt_weight = $("#txtweight").val();
   txt_destare = $("#txtdestare_a").val();

   $("#txtdestare_b").val(txt_destare); //hidden input destare

   txt_total = parseFloat(txt_weight) - parseFloat(txt_destare);

   if (txt_total < 0)
   {
      txt_total = 0;
   }

   $('#txttotalweight_a').val(txt_total);
   $('#txttotalweight_b').val(txt_total); //hidden input total kg
}

txt_ctrldestare_a.addEventListener('change', data_ent)
txt_ctrldestare_b.addEventListener('change', data_ent)
txt_valdestare.addEventListener('change', data_ent)
txt_sizebox.addEventListener('change', data_ent)
