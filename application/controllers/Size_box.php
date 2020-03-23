<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Size_box extends CI_Controller
{
   function __construct()
   {
      parent:: __construct();
      $this->load->model('buy/size_box/size_box_model');
   }

   function index()
   {
      $data['boxes'] = $this->size_box_model->get_info_sb();
      $this->load->view('buy/size_box/index', $data);
   }

   function status_box($status = NULL, $id = NULL)
   {
      $info_box = [
         'id' => $id,
         'status' =>  ($status === '1') ? '0' : '1' 
      ];
      $this->size_box_model->update_sb($info_box);
      $data['status_alert']= $info_box['status'];
      $data['boxes'] = $this->size_box_model->get_info_sb();
      $this->load->view('buy/size_box/index', $data);
   }

   function default_size_box($id_sb)
   {
      $new_default = '0';
      foreach ($this->size_box_model->get_info_sb(NULL, '1')->result() as $size_box)
      {
         $this->size_box_model->changue_default($size_box->id, $new_default);
      }
      $new_default = '1';
      $this->size_box_model->changue_default($id_sb, $new_default);

      $data['boxes'] = $this->size_box_model->get_info_sb();
      $data['success_default_sb'] = TRUE;
      $this->load->view('buy/size_box/index', $data);
   }

   function _form_validation()
   {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('txtidsb', 'txtidsb', 'numeric', ['numeric' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtstatus', 'txtstatus', 'numeric', ['numeric' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtdescribe', 'Descripción', 'trim', ['trim' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtvalue', 'Valor de destare', 'required|numeric|greater_than[0]', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>', 'greater_than'=> '<b>%s</b>, debe ser mayor a cero (0)']);
      $this->form_validation->set_rules('txtdefault_sb', 'Usar como predeterminado', 'required|numeric', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_error_delimiters('<li>', '</li>');
   }

   function set_info()
   {
      $this->_form_validation();

      $auto_complete = [
         'description' => mb_strtoupper($this->input->post('txtdescribe')),
         'destare_value'    => $this->input->post('txtvalue'),
         'default_value'  => $this->input->post('txtdefault_sb'),
         'user_id'   => 1
      ];

      if ($this->form_validation->run() === FALSE)
      {
         $data['auto_complete'] = $auto_complete;
         $data['boxes']         = $this->size_box_model->get_info_sb();

         $this->load->view('buy/size_box/index', $data);
      }
      else
      {
         switch ($this->input->post('txtsender'))
         {
            case '0':
               if ($auto_complete['default_value'] === '1')
               {
                  $new_default = '0';
                  foreach ($this->size_box_model->get_info_sb(NULL, $auto_complete['default_value'])->result() as $size_box)
                  {
                     $this->size_box_model->changue_default($size_box->id, $new_default);
                  }
               }
               $this->size_box_model->save_sb($auto_complete);
               $data['success_sb'] = TRUE;
               $data['boxes']      = $this->size_box_model->get_info_sb();
               $this->load->view('buy/size_box/index', $data);
               break;

            case '1':
               if ($auto_complete['default_value'] === '1')
               {
                  $new_default = '0';
                  foreach ($this->size_box_model->get_info_sb(NULL, $auto_complete['default_value'])->result() as $size_box)
                  {
                     $this->size_box_model->changue_default($size_box->id, $new_default);
                  }
               }
               $auto_complete['id']     = $this->input->post('txtidsb');
               $auto_complete['status'] = $this->input->post('txtstatus');
               $this->size_box_model->update_sb($auto_complete);
               $data['success_update_sb'] = TRUE;
               $data['boxes']             = $this->size_box_model->get_info_sb();
               $this->load->view('buy/size_box/index', $data);
               break;

            default:
               echo "Error de direccionamiento";
               break;
         }
      }
   }
}
