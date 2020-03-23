
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
})
