<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

   public function __construct()
   {
      parent:: __construct();
      $this->load->model('employee/employee_model');
   }

   function index()
   {
      $data['info_profile'] = $this->employee_model->get_profile()->result();
      $data['allemployee'] = $this->employee_model->get_employee_profile()->result();
      $this->load->view('employee/index', $data);
   }

   function new()
   {
      $data['info_profile']['-1'] = 'Elige una opción';
      foreach ($this->employee_model->get_profile()->result() as $profile)
      {
         $data['info_profile'][$profile->id_profile] = $profile->character_profile;
      }
      $data['states']['-1'] = 'Elige una opción';
      foreach ($this->employee_model->get_states()->result() as $states)
      {
         $data['states'][$states->name] = $states->name.' ('.$states->abrev.')';
      }
      $this->load->view('employee/newemployee', $data);
   }

   function edit($id_employee = NULL)
   {
      $data['info_profile']['-1'] = 'Elige una opción';
      foreach ($this->employee_model->get_profile()->result() as $profile)
      {
         $data['info_profile'][$profile->id_profile] = $profile->character_profile;
      }
      $data['states']['-1'] = 'Elige una opción';
      foreach ($this->employee_model->get_states()->result() as $states)
      {
         $data['states'][$states->name] = $states->name.' ('.$states->abrev.')';
      }
      $data['allemployee'] = $this->employee_model->get_employee_profile($id_employee);
      $this->load->view('employee/edit', $data);
   }

   function status_employee($id_employee = NULL)
   {
      $info_employee = [
         'id_employee' => $id_employee,
         'status_employee' =>  ($this->employee_model->get_employee_profile($id_employee)->row()->status_employee === '1') ? '0' : '1'
      ];
      $info_user = [
         'id_users' => $id_employee,
         'status_users' =>  ($this->employee_model->get_employee_profile($id_employee)->row()->status_employee === '1') ? '0' : '1'
      ];
      $this->employee_model->update_employee($info_employee);
      $this->employee_model->update_user($info_user);
      $data['status_alert'] = ($this->employee_model->get_employee_profile($id_employee)->row()->status_employee === '1') ? '0' : '1' ;
      $data['info_profile'] = $this->employee_model->get_profile()->result();
      $data['allemployee'] = $this->employee_model->get_employee_profile()->result();
      $this->load->view('employee/index', $data);
   }

   function _form_validation($config_rules = NULL)
   {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('txtsender', 'Procedimiento', 'numeric', ['numeric' => 'Error de <b>%s</b>']);
      if ($config_rules['ctrl_rules'] === '0')
      {
         $this->form_validation->set_rules('txtcurp', 'CURP', 'required|exact_length[18]|is_unique[employee.curp_employee]', ['required' => 'Error de <b>%s</b>', 'exact_length' => 'Formato inválido en: <b>%s</b>, debe contener 18 caracteres', 'is_unique'=> 'La <b>%s</b> ingresada ya existe en los registros']);
         $this->form_validation->set_rules('txtusername', 'Usuario', 'required|is_unique[users.username_users]', ['required' => 'Campo requerido <b>%s</b>', 'is_unique' => 'El <b>%s</b> ingresado ya existe en los registros']);
      }
      else
      {
         $this->form_validation->set_rules('txtcurp', 'CURP', 'required|exact_length[18]', ['required' => 'Error de <b>%s</b>', 'exact_length' => 'Formato inválido en: <b>%s</b>, debe contener 18 caracteres']);
         $this->form_validation->set_rules('txtusername', 'Usuario', 'required', ['required' => 'Campo requerido <b>%s</b>']);
         $this->form_validation->set_rules('txtideditable', 'Procedimiento', 'required|integer', ['required' => 'Error de <b>%s</b> required', 'integer' => 'Error de <b>%s</b>']);
      }
      $this->form_validation->set_rules('txtname', 'Nombre', 'trim|required', ['trim' => 'Error de <b>%s</b>', 'required' => 'Error de <b>%s</b>']);
      $this->form_validation->set_rules('txtap1', 'Apellido paterno', 'trim|required', ['trim' => 'Error de <b>%s</b>', 'required' => 'Error de <b>%s</b>']);
      $this->form_validation->set_rules('txtap2', 'Apellido materno', 'trim|required', ['trim' => 'Error de <b>%s</b>', 'required' => 'Error de <b>%s</b>']);
      $this->form_validation->set_rules('txtstreet', 'Calle', 'trim', ['trim' => 'Error de <b>%s</b>']);
      $this->form_validation->set_rules('txtnumint', 'Número interior', 'trim', ['trim' => 'Error de <b>%s</b>']);
      $this->form_validation->set_rules('txtnumext', 'Número exterior', 'trim', ['trim' => 'Error de <b>%s</b>']);
      $this->form_validation->set_rules('txtlocal', 'Localidad o Colonia', 'trim|alpha_numeric_spaces', ['trim' => 'Error de <b>%s</b>', 'alpha_numeric_spaces' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtmuni', 'Municipio', 'trim|alpha_numeric_spaces', ['trim' => 'Error de <b>%s</b>', 'alpha_numeric_spaces' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtstate', 'Entidad federativa', 'trim', ['trim' => 'Error de <b>%s</b>']);
      $this->form_validation->set_rules('txtpostalcode', 'Código Postal', 'integer|exact_length[5]', ['integer' => 'Error de <b>%s</b>', 'exact_length' => 'Formato inválido en: <b>%s</b>, debe contener 5 caracteres']);
      $this->form_validation->set_rules('txtphone', 'Telefono', 'trim|alpha_numeric_spaces', ['trim' => 'Error de <b>%s</b>', 'alpha_numeric_spaces' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtcel', 'Celular', 'trim|alpha_numeric_spaces', ['trim' => 'Error de <b>%s</b>', 'alpha_numeric_spaces' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtemail', 'Correcto electrónico', 'trim|valid_email', ['trim' => 'Error de <b>%s</b>', 'valid_email' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtcel', 'Celular', 'trim|alpha_numeric_spaces', ['trim' => 'Error de <b>%s</b>', 'alpha_numeric_spaces' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtdrivercandidate', '¿Cuenta con licencia de conducir?', 'required', ['required' => 'Campo requerido <b>%s</b>']);
      if ($config_rules['driver'] === '1')
      {
         $this->form_validation->set_rules('txtemail', 'Tipo de licencia', 'trim|required', ['trim' => 'Error de <b>%s</b>', 'required' => 'Campo requerido <b>%s</b>']);
         if ($config_rules['ctrl_rules'] === '0')
         {
            $this->form_validation->set_rules('txtsheetlicence', 'Folio de licencia', 'trim|required|is_unique[employee.sheetlicence_employee]', ['trim' => 'Error de <b>%s</b>', 'required' => 'Campo requerido <b>%s</b>', 'is_unique'=> 'El <b>%s</b> ingresado ya existe en los registros']);
         }
         else
         {
            $this->form_validation->set_rules('txtsheetlicence', 'Folio de licencia', 'trim|required', ['trim' => 'Error de <b>%s</b>', 'required' => 'Campo requerido <b>%s</b>']);
         }
         $this->form_validation->set_rules('txtexperieciedrive', 'Experiencia de manejo', 'trim|numeric|required', ['trim' => 'Error de <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>','required' => 'Campo requerido <b>%s</b>']);
      }
      // $this->form_validation->set_rules('txtusername', 'Usuario', 'required|is_unique[users.username_users]', ['required' => 'Campo requerido <b>%s</b>', 'is_unique' => 'El <b>%s</b> ingresado ya existe en los registros']);
      $this->form_validation->set_rules('txtpuserpass1', 'Contraseña', 'required|min_length[8]|max_length[32]', ['required' => 'Campo requerido <b>%s</b>', 'min_length' => 'La <b>%s</b> debe contener entre 8 y 32 caracteres', 'max_length' => 'La <b>%s</b> debe contener entre 8 y 32 caracteres']);
      $this->form_validation->set_rules('txtpuserpass2', 'Confirma la contraseña', 'required|min_length[8]|max_length[32]|matches[txtpuserpass1]', ['required' => 'Campo requerido <b>%s</b>', 'min_length' => '<b>%s</b> debe contener entre 8 y 32 caracteres', 'max_length' => 'La <b>%s</b> debe contener entre 8 y 32 caracteres', 'matches' => 'Las <b>Contraseñas</b> no coinciden']);
      $this->form_validation->set_error_delimiters('<li>', '</li>');
   }

   function set_info()
   {
      $txt_sender = $this->input->post('txtsender');
      $txt_userpass1 = $this->input->post('txtpuserpass1');
      $txt_userpass2 = $this->input->post('txtpuserpass2');
      $driver = $this->input->post('txtdrivercandidate');
      $config_rules['ctrl_rules'] = $txt_sender;
      $config_rules['driver'] = $driver;
      $autocomplete1 = [
         'id_employee'              => $this->input->post('txtideditable'),
         'curp_employee'            => mb_strtoupper($this->input->post('txtcurp')),
         'name_employee'            => mb_strtoupper($this->input->post('txtname')),
         'ap1_employee'             => mb_strtoupper($this->input->post('txtap1')),
         'ap2_employee'             => mb_strtoupper($this->input->post('txtap2')),
         'street_employee'          => mb_strtoupper($this->input->post('txtstreet')),
         'numint_employee'          => mb_strtoupper(($this->input->post('txtnumint') === '') ? '0' : $this->input->post('txtnumint')),
         'numext_employee'          => mb_strtoupper(($this->input->post('txtnumext') === '') ? '0' : $this->input->post('txtnumext')),
         'local_employee'           => mb_strtoupper($this->input->post('txtlocal')),
         'muni_employee'            => mb_strtoupper($this->input->post('txtmuni')),
         'state_employee'           => mb_strtoupper($this->input->post('txtstate')),
         'postalcode_employee'      => $this->input->post('txtpostalcode'),
         'phone_employee'           => $this->input->post('txtphone'),
         'cel_employee'             => $this->input->post('txtcel'),
         'email_employee'           => $this->input->post('txtemail'),
         'drivercandidate_employee' => $driver,
         'typelicence_employee'     => $this->input->post('txttypelicence'),
         'sheetlicence_employee'    => mb_strtoupper($this->input->post('txtsheetlicence')),
         'experieciedrive_employee' => $this->input->post('txtexperieciedrive'),
         'iduser_employee'          => 1
      ];
      $autocomplete2 = [
         'username_users' => $this->input->post('txtusername'),
         'userpass_users' => $txt_userpass1,
         'profile_users'  => $this->input->post('txtprofile'),
         'iduser_users'   => 1
      ];
      $this->_form_validation($config_rules);
      if ($this->form_validation->run() === FALSE)
      {
         $data['autocomplete1'] = $autocomplete1;
         $data['autocomplete2'] = $autocomplete2;
         $data['info_profile']['-1'] = 'Elige una opción';
         foreach ($this->employee_model->get_profile()->result() as $profile)
         {
            $data['info_profile'][$profile->id_profile] = $profile->character_profile;
         }
         $data['states']['-1'] = 'Elige una opción';
         foreach ($this->employee_model->get_states()->result() as $states)
         {
            $data['states'][$states->name] = $states->name.' ('.$states->abrev.')';
         }
         if ($txt_sender === '0')
         {
            $this->load->view('employee/newemployee', $data);
         }
         else
         {
            $data['allemployee'] = $this->employee_model->get_employee_profile($autocomplete1['id_employee']);
            $this->load->view('employee/edit', $data);
         }
      }
      else
      {
         switch ($txt_sender)
         {
            case '0':
               foreach ($this->employee_model->save_employee($autocomplete1) as $ctrl_insert)
               {
                  $id = $ctrl_insert->id_employee;
               }
               $autocomplete2['employee_users'] = $id;
               $this->employee_model->save_user($autocomplete2);
               $autocomplete1 = FALSE;
               $autocomplete2 = FALSE;
               $data['success_curp'] = TRUE;
               $data['info_profile'] = $this->employee_model->get_profile()->result();
               $data['allemployee'] = $this->employee_model->get_employee_profile()->result();
               $this->load->view('employee/index', $data);
               break;
            case '1':
               $autocomplete2['id_users'] = $autocomplete1['id_employee'];
               $this->employee_model->update_employee($autocomplete1);
               $this->employee_model->update_user($autocomplete2);
               $autocomplete1 = FALSE;
               $autocomplete2 = FALSE;
               $data['success_updateemployee'] = TRUE;
               $data['info_profile'] = $this->employee_model->get_profile()->result();
               $data['allemployee'] = $this->employee_model->get_employee_profile()->result();
               $this->load->view('employee/index', $data);
               break;
            default:
               echo "Error de direccionamiento";
               break;
         }
      }
   }

   function delete_empl($product_id)
   {
      if ($this->producer_model->get_supply(NULL, $product_id)->num_rows() > 0)
      {
         $data['alert_delete_product'] = '0';
      }
      else
      {
         $info_product = [
            'id_product'     => $product_id,
            'status_product' => '0'
         ];
         $this->product_model->update_product($info_product);
         $data['alert_delete_product'] = '1';
      }
      $data['allproduct']  = $this->product_model->get_all_product();
      $data['ctrl_size_a'] = [
         '0' => '0',
         '1' => '1'
      ];
      $data['ctrl_size_b'] = [
         '0' => 'Calidad',
         '1' => 'Categoría'
      ];
      $this->load->view('product/index', $data);
   }
}
