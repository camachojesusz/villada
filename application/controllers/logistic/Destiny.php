<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Destiny extends CI_Controller
{
   function __construct()
   {
      parent:: __construct();
      $this->load->model('logistic/destiny/destiny_model');
      $this->load->model('buy/size_box/size_box_model');
   }

   function index()
   {
      $data['destiny'] = $this->destiny_model->get_destiny()->result();
      $this->load->view('logistic/destiny/index', $data);
   }

   function new()
   {
      foreach ($this->size_box_model->get_info_sb()->result() as $sb)
      {
         $data['size_box'][$sb->destare_value] = $sb->description." (x".$sb->destare_value.")";
      }
      $data['states']['-1'] = 'Elige una opción';
      foreach ($this->destiny_model->get_states()->result() as $states)
      {
         $data['states'][$states->name] = $states->name.' ('.$states->abrev.')';
      }
      $this->load->view('logistic/destiny/new', $data);
   }

   function edit($destiny_id = NULL)
   {
      $data['destiny'] = $this->destiny_model->get_destiny($destiny_id);
      foreach ($this->size_box_model->get_info_sb()->result() as $sb)
      {
         $data['size_box'][$sb->destare_value] = $sb->description." (x".$sb->destare_value.")";
      }
      $data['states']['-1'] = 'Elige una opción';
      foreach ($this->destiny_model->get_states()->result() as $states)
      {
         $data['states'][$states->name] = $states->name.' ('.$states->abrev.')';
      }
      $this->load->view('logistic/destiny/edit', $data);
   }

   function status($status = NULL, $destiny_id = NULL)
   {
      $info_destiny = [
         'destiny_id' => $destiny_id,
         'status' => ($status === '1') ? '0' : '1'
      ];
      $this->destiny_model->edit_destiny($info_destiny);
      $data['status_alert'] = $info_destiny['status'];
      $data['destiny'] = $this->destiny_model->get_destiny()->result();
      $this->load->view('logistic/destiny/index', $data);
   }

   function _form_validation($config_rules = NULL)
   {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('txtsender', 'Procedimiento', 'numeric', ['numeric' => 'Error de <b>%s</b>']);
      if ($config_rules['sdr'] === '1')
      {
         $this->form_validation->set_rules('txtdestiny', 'Destino', 'integer|required', ['integer' => 'Error de <b>%s</b>', 'required' => 'Campo requerido <b>%s</b>']);
      }
      $this->form_validation->set_rules('txtname', 'Destino', 'trim|required', ['trim' => 'Error de <b>%s</b>', 'required' => 'Campo requerido <b>%s</b>']);
      $this->form_validation->set_rules('txtctrldestare', 'Procedimiento', 'required|numeric', ['required' => '<b>%s</b> por defecto es <b>Automático</b>. Seleccione una opción.', 'numeric' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtvaldestare', 'Calcular destare', 'numeric|greater_than_equal_to[0]', ['numeric' => 'Formato inválido en: <b>%s</b>', 'greater_than_equal_to'=> '<b>%s</b>, debe ser mayor a cero (0)']);
      $this->form_validation->set_rules('txtstreet', 'Calle', 'trim', ['trim' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtnumint', 'Número interior', 'trim', ['trim' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtnumext', 'Número exterior', 'trim', ['trim' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtlocal', 'Localidad o Colonia', 'trim|alpha_numeric_spaces', ['trim' => 'Error de <b>%s</b>', 'alpha_numeric_spaces' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtmuni', 'Municipio', 'trim|alpha_numeric_spaces', ['trim' => 'Formato inválido en: <b>%s</b>', 'alpha_numeric_spaces' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtstate', 'Entidad federativa', 'trim', ['trim' => 'Error de <b>%s</b>']);
      $this->form_validation->set_rules('txtpostalcode', 'Código Postal', 'integer|exact_length[5]', ['integer' => 'Formato inválido en: <b>%s</b>', 'exact_length' => 'Formato inválido en: <b>%s</b>, debe contener 5 caracteres']);
      $this->form_validation->set_error_delimiters('<li>', '</li>');
   }

   function set_info()
   {
      $txt_sender          = $this->input->post('txtsender');
      $config_rules['sdr'] = $txt_sender;
      $ctrldestare   = $this->input->post('txtctrldestare');
      $val_destare   = ($ctrldestare === '0') ? $this->input->post('txtsizebox') : $this->input->post('txtvaldestare');
      $auto_complete = [
         'destiny_id'    => $this->input->post('txtdestiny'),
         'description_d' => mb_strtoupper($this->input->post('txtname')),
         'type_destare'  => $ctrldestare,
         'destare'       => $val_destare,
         'street'        => mb_strtoupper($this->input->post('txtstreet')),
         'numint'        => mb_strtoupper(($this->input->post('txtnumint') === '') ? '0' : $this->input->post('txtnumint')),
         'numext'        => mb_strtoupper(($this->input->post('txtnumext') === '') ? '0' : $this->input->post('txtnumext')),
         'local'         => mb_strtoupper($this->input->post('txtlocal')),
         'muni'          => mb_strtoupper($this->input->post('txtmuni')),
         'state'         => $this->input->post('txtstate'),
         'postal_code'   => mb_strtoupper($this->input->post('txtpostalcode')),
         'user_id'       => 1
      ];
      $this->_form_validation($config_rules);
      if ($this->form_validation->run() === FALSE)
      {
         if ($txt_sender === '0')
         {
            foreach ($this->size_box_model->get_info_sb()->result() as $sb)
            {
               $data['size_box'][$sb->destare_value] = $sb->description." (x".$sb->destare_value.")";
            }
            $data['states']['-1'] = 'Elige una opción';
            foreach ($this->destiny_model->get_states()->result() as $states)
            {
               $data['states'][$states->name] = $states->name.' ('.$states->abrev.')';
            }
            $data['auto_complete'] = $auto_complete;
            $this->load->view('logistic/destiny/new', $data);
         }
         else
         {
            $data['destiny'] = $this->destiny_model->get_destiny($auto_complete['destiny_id']);
            foreach ($this->size_box_model->get_info_sb()->result() as $sb)
            {
               $data['size_box'][$sb->destare_value] = $sb->description." (x".$sb->destare_value.")";
            }
            $data['states']['-1'] = 'Elige una opción';
            foreach ($this->destiny_model->get_states()->result() as $states)
            {
               $data['states'][$states->name] = $states->name.' ('.$states->abrev.')';
            }
            $this->load->view('logistic/destiny/edit', $data);
         }
      }
      else
      {
         if ($txt_sender === '0')
         {
            $this->destiny_model->save_destiny($auto_complete);
            $data['auto_complete'] = FALSE;
            $data['success_destiny'] = TRUE;
         }
         else
         {
            $this->destiny_model->edit_destiny($auto_complete);
            $data['auto_complete'] = FALSE;
            $data['update_destiny'] = TRUE;
         }
         $data['destiny'] = $this->destiny_model->get_destiny()->result();
         $this->load->view('logistic/destiny/index', $data);
      }
   }
}
