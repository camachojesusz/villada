
$(document).ready(function(){
   $('#txtpuserpass1').on('paste', function(e){
      e.preventDefault();
      alert('¡Acción invalida!\n\nNo se permite Pegar');
   })
   $('#txtpuserpass1').on('copy', function(e){
      e.preventDefault();
      alert('¡Acción invalida!\n\nNo se permite Copiar');
   })
   $('#txtpuserpass2').on('paste', function(e){
      e.preventDefault();
      alert('¡Acción invalida!\n\nNo se permite Pegar');
   })
   $('#txtpuserpass2').on('copy', function(e){
      e.preventDefault();
      alert('¡Acción invalida!\n\nNo se permite Copiar');
   })
   dirver_candidate();
})

var txt_ctrldriver_b = document.getElementById('txtdrivercandidate_b');
var txt_ctrldriver_a = document.getElementById('txtdrivercandidate_a');
var type_licence = document.getElementById('txttypelicence');
var sheet_licence = document.getElementById('txtsheetlicence');
var experiecie_drive = document.getElementById('txtexperieciedrive');
function dirver_candidate()
{
   if (txt_ctrldriver_a.checked == true)
   {
      type_licence.disabled = false;
      sheet_licence.disabled = false;
      experiecie_drive.disabled = false;
   }
   if (txt_ctrldriver_b.checked == true)
   {
      type_licence.disabled = true;
      sheet_licence.disabled = true;
      experiecie_drive.disabled = true;
   }
}
txt_ctrldriver_a.addEventListener('change', dirver_candidate)
txt_ctrldriver_b.addEventListener('change', dirver_candidate)
type_licence.addEventListener('change', dirver_candidate)
sheet_licence.addEventListener('change', dirver_candidate)
experiecie_drive.addEventListener('change', dirver_candidate)
