var txt_ctrl_driver_a = document.getElementById('txt_ctrl_driver_a');
var txt_ctrl_driver_b = document.getElementById('txt_ctrl_driver_b')
var txtdriver_id      = document.getElementById('txtdriver_id')
var txtdriver_emp_id  = document.getElementById('txtdriver_emp_id')

function select_driver()
{
   txtdriver_id.disabled = false;
   if (txt_ctrl_driver_b.checked)
   {
      txtdriver_id.disabled = true;
      txtdriver_emp_id.disabled = false;
   }
   else
   {
      txtdriver_id.disabled = false;
      txtdriver_emp_id.disabled = true;
   }
}

txt_ctrl_driver_a.addEventListener('change', select_driver)
txt_ctrl_driver_b.addEventListener('change', select_driver)
txtdriver_id.addEventListener('change', select_driver)
txtdriver_emp_id.addEventListener('change', select_driver)
