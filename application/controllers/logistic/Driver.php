<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Driver extends CI_Controller
{
   function __construct()
   {
      parent:: __construct();
      $this->load->model('logistic/driver/driver_model');
   }

   function index()
   {
      $data['driver'] = $this->driver_model->get_driver()->result();
      $data['employee_driver'] = $this->driver_model->get_employe_driver()->result();
      $this->load->view('logistic/driver/index', $data);
   }

   function new()
   {
      $data['states']['-1'] = 'Elige una opción';
      foreach ($this->driver_model->get_states()->result() as $states)
      {
         $data['states'][$states->name] = $states->name.' ('.$states->abrev.')';
      }
      $this->load->view('logistic/driver/new', $data);
   }

   function edit($driver_id = NULL)
   {
      $data['drive'] = $this->driver_model->get_driver($driver_id);
      $data['states']['-1'] = 'Elige una opción';
      foreach ($this->driver_model->get_states()->result() as $states)
      {
         $data['states'][$states->name] = $states->name.' ('.$states->abrev.')';
      }
      $this->load->view('logistic/driver/edit', $data);
   }

   function status($status = NULL, $driver_id = NULL)
   {
      $info_driver = [
         'driver_id' => $driver_id,
         'status' => ($status === '1') ? '0' : '1'
      ];
      $this->driver_model->update_driver($info_driver);
      $data['status_alert'] = $info_driver['status'];
      $data['driver'] = $this->driver_model->get_driver()->result();
      $data['employee_driver'] = $this->driver_model->get_employe_driver()->result();
      $this->load->view('logistic/driver/index', $data);
   }

   function _form_validation($config_rules = NULL)
   {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('txtsender', 'Procedimiento', 'numeric', ['numeric' => 'Error de <b>%s</b>']);
      if ($config_rules['sdr'] === '0')
      {
         $this->form_validation->set_rules('txtsheetlicence', 'Folio de licencia', 'trim|required|is_unique[driver.sheet_licence]', ['trim' => 'Error de <b>%s</b>', 'required' => 'Campo requerido <b>%s</b>', 'is_unique'=> 'El <b>%s</b> ingresado ya existe en los registros']);
         $this->form_validation->set_rules('txtsheetlicence', 'Folio de licencia', 'is_unique[employee.sheetlicence_employee]', ['trim' => 'Error de <b>%s</b>', 'required' => 'Campo requerido <b>%s</b>', 'is_unique'=> 'El <b>%s</b> ingresado ya existe en los registros de los <b>Empleados</b>. Se recomienda consultar a un usuario <b>Administrador</b> para verificarlo.']);
      }
      else
      {
         $this->form_validation->set_rules('txtsheetlicence', 'Folio de licencia', 'trim|required', ['trim' => 'Error de <b>%s</b>', 'required' => 'Campo requerido <b>%s</b>']);
      }
      $this->form_validation->set_rules('txttypelicence', 'Tipo de licencia', 'trim|required', ['trim' => 'Error de <b>%s</b>', 'required' => 'Campo requerido <b>%s</b>']);
      $this->form_validation->set_rules('txtexperieciedrive', 'Experiencia de manejo (años)', 'trim|integer', ['trim' => 'Error de <b>%s</b>', 'integer' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtname', 'Nombre', 'trim|required', ['trim' => 'Error de <b>%s</b>', 'required' => 'Campo requerido <b>%s</b>']);
      $this->form_validation->set_rules('txtap1', 'Apellido paterno', 'trim|required', ['trim' => 'Formato inválido en: <b>%s</b>', 'required' => 'Campo requerido <b>%s</b>']);
      $this->form_validation->set_rules('txtap2', 'Apellido materno', 'trim|required', ['trim' => 'Formato inválido en: <b>%s</b>', 'required' => 'Campo requerido <b>%s</b>']);
      $this->form_validation->set_rules('txtstreet', 'Calle', 'trim', ['trim' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtnumint', 'Número interior', 'trim', ['trim' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtnumext', 'Número exterior', 'trim', ['trim' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtlocal', 'Localidad o Colonia', 'trim|alpha_numeric_spaces', ['trim' => 'Error de <b>%s</b>', 'alpha_numeric_spaces' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtmuni', 'Municipio', 'trim|alpha_numeric_spaces', ['trim' => 'Formato inválido en: <b>%s</b>', 'alpha_numeric_spaces' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtstate', 'Entidad federativa', 'trim', ['trim' => 'Error de <b>%s</b>']);
      $this->form_validation->set_rules('txtpostalcode', 'Código Postal', 'integer|exact_length[5]', ['integer' => 'Formato inválido en: <b>%s</b>', 'exact_length' => 'Formato inválido en: <b>%s</b>, debe contener 5 caracteres']);
      $this->form_validation->set_rules('txtphone', 'Telefono', 'trim|alpha_numeric_spaces', ['trim' => 'Formato inválido en: <b>%s</b>', 'alpha_numeric_spaces' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtcel', 'Celular', 'trim|alpha_numeric_spaces', ['trim' => 'Formato inválido en: <b>%s</b>', 'alpha_numeric_spaces' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtemail', 'Correcto electrónico', 'trim|valid_email', ['trim' => 'Formato inválido en: <b>%s</b>', 'valid_email' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_error_delimiters('<li>', '</li>');
   }

   function set_info()
   {
      $txt_sender          = $this->input->post('txtsender');
      $config_rules['sdr'] = $txt_sender;
      $auto_complete       = [
         'driver_id'        => $this->input->post('txtdriver'),
         'sheet_licence'    => mb_strtoupper($this->input->post('txtsheetlicence')),
         'type_licence'     => mb_strtoupper($this->input->post('txttypelicence')),
         'experiencie_drive' => mb_strtoupper($this->input->post('txtexperieciedrive')),
         'name'             => mb_strtoupper($this->input->post('txtname')),
         'ap1'              => mb_strtoupper($this->input->post('txtap1')),
         'ap2'              => mb_strtoupper($this->input->post('txtap2')),
         'phone'            => $this->input->post('txtphone'),
         'mobile_phone'     => $this->input->post('txtcel'),
         'email'            => $this->input->post('txtemail'),
         'street'           => mb_strtoupper($this->input->post('txtstreet')),
         'numint'           => mb_strtoupper(($this->input->post('txtnumint') === '') ? '0' : $this->input->post('txtnumint')),
         'numext'           => mb_strtoupper(($this->input->post('txtnumext') === '') ? '0' : $this->input->post('txtnumext')),
         'local'            => mb_strtoupper($this->input->post('txtlocal')),
         'muni'             => mb_strtoupper($this->input->post('txtmuni')),
         'state'            => $this->input->post('txtstate'),
         'postal_code'      => mb_strtoupper($this->input->post('txtpostalcode'))
      ];
      $this->_form_validation($config_rules);
      if ($this->form_validation->run() === FALSE)
      {
         if ($txt_sender === '0')
         {
            $data['states']['-1'] = 'Elige una opción';
            foreach ($this->driver_model->get_states()->result() as $states)
            {
               $data['states'][$states->name] = $states->name.' ('.$states->abrev.')';
            }
            $data['auto_complete'] = $auto_complete;
            $this->load->view('logistic/driver/new', $data);
         }
         else
         {
            $data['drive'] = $this->driver_model->get_driver($auto_complete['driver_id']);
            $data['states']['-1'] = 'Elige una opción';
            foreach ($this->driver_model->get_states()->result() as $states)
            {
               $data['states'][$states->name] = $states->name.' ('.$states->abrev.')';
            }
            $this->load->view('logistic/driver/edit', $data);
         }
      }
      else
      {
         if ($txt_sender === '0')
         {
            $this->driver_model->save_driver($auto_complete);
            $data['auto_complete'] = FALSE;
            $data['success_driver'] = TRUE;
            $data['driver'] = $this->driver_model->get_driver()->result();
            $data['employee_driver'] = $this->driver_model->get_employe_driver()->result();
            $this->load->view('logistic/driver/index', $data);
         }
         else
         {
            $this->driver_model->update_driver($auto_complete);
            $data['auto_complete'] = FALSE;
            $data['update_driver'] = TRUE;
            $data['driver'] = $this->driver_model->get_driver()->result();
            $data['employee_driver'] = $this->driver_model->get_employe_driver()->result();
            $this->load->view('logistic/driver/index', $data);
         }
      }
   }
}
