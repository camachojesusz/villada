var txtctrldestare_a = document.getElementById('txtctrldestare_a');
var txtctrldestare_b = document.getElementById('txtctrldestare_b')
var txtctrldestare_b = document.getElementById('txtsizebox')
var txtvaldestare    = document.getElementById('txtvaldestare')

function select_destare()
{
   if (txtctrldestare_b.checked)
   {
      txtctrldestare_b.disabled = true;
      txtvaldestare.disabled    = false;
   }
   else
   {
      txtctrldestare_b.disabled = false;
      txtvaldestare.disabled    = true;
   }
}

txtctrldestare_a.addEventListener('change', select_destare)
txtctrldestare_b.addEventListener('change', select_destare)
txtctrldestare_b.addEventListener('change', select_destare)
txtvaldestare.addEventListener('change', select_destare)
