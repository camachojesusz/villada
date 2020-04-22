<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends CI_Controller
{
   function __construct()
   {
      parent:: __construct();
      $this->load->model('logistic/vehicles/vehicles_model');
   }

   function index()
   {
      $data['vehicle_vt'] = $this->vehicles_model->get_vehicle_type()->result();
      $this->load->view('logistic/vehicle/index',$data);
   }

   function index_vehicle()
   {
      $data['vt']['-1'] = 'Elige una opción';
      foreach ($this->vehicles_model->get_vehicle_type()->result() as $vt)
      {
         $data['vt'][$vt->vt_id] = $vt->description_vt;
      }
      $data['vehicle'] = $this->vehicles_model->_get_vehicle()->result();
      $this->load->view('logistic/vehicle/vehicle_s', $data);
   }

   function status($sender = NULL, $status = NULL, $id = NULL)
   {
      if ($sender === '0')
      {
         $info_vt = [
            'vt_id'  => $id,
            'status' => ($status === '1') ? '0' : '1'
         ];
         $this->vehicles_model->edit_vehicle_type($info_vt);
         $data['status_alert'] = $info_vt['status'];
         $data['vehicle_vt']   = $this->vehicles_model->get_vehicle_type()->result();
         $this->load->view('logistic/vehicle/index',$data);
      }
      else
      {
         $info_vehicle = [
            'vehicle_id' => $id,
            'status_v'     => ($status === '1') ? '0' : '1'
         ];
         $this->vehicles_model->edit_vehicle($info_vehicle);
         $data['status_alert'] = $info_vehicle['status'];
         $data['vt']['-1'] = 'Elige una opción';
         foreach ($this->vehicles_model->get_vehicle_type()->result() as $vt)
         {
            $data['vt'][$vt->vt_id] = $vt->description_vt;
         }
         $data['vehicle'] = $this->vehicles_model->_get_vehicle()->result();
         $this->load->view('logistic/vehicle/vehicle_s', $data);
      }
   }

   function _form_validation($config_rules = NULL)
   {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('txtsender', 'Procedimiento', 'numeric', ['numeric' => 'Error de <b>%s</b>']);
      $this->form_validation->set_rules('auxiliar_sender', 'Procedimiento', 'numeric', ['numeric' => 'Error de <b>%s</b>']);
      if ($config_rules['auxiliar_sender'] === '0')
      {
         if ($config_rules['sender'] === '1')
         {
            $this->form_validation->set_rules('txtvt_id', 'Procedimiento', 'numeric|required', ['numeric' => 'Error de <b>%s</b>', 'required' => 'Error de <b>%s</b>']);
         }
         $this->form_validation->set_rules('txtdescription_vt', 'Tipo de vehículo', 'trim|required', ['trim' => 'Error de <b>%s</b>', 'required' => 'Campo requerido <b>%s</b>']);
      }
      else
      {
         if ($config_rules['sender'] === '1')
         {
            $this->form_validation->set_rules('vehicle_id', 'Procedimiento', 'numeric|required', ['numeric' => 'Error de <b>%s</b>', 'required' => 'Error de <b>%s</b>']);
            $this->form_validation->set_rules('key_v', 'Placa o Matrícula', 'trim|required', ['trim' => 'Error de <b>%s</b>', 'required' => 'Campo requerido <b>%s</b>']);
         }
         else
         {
            $this->form_validation->set_rules('key_v', 'Placa o Matrícula', 'trim|required|is_unique[vehicle.key_v]', ['trim' => 'Error de <b>%s</b>', 'required' => 'Campo requerido <b>%s</b>', 'is_unique'=> 'La <b>%s</b> ingresada ya existe en los registros']);
         }
         $this->form_validation->set_rules('txtdescription_v', 'Descripción', 'trim|required', ['trim' => 'Error de <b>%s</b>', 'required' => 'Campo requerido <b>%s</b>']);
         $this->form_validation->set_rules('txtvehicle_type', 'Tipo de vehiculo', 'numeric|required', ['numeric' => 'Formato inválido en: <b>%s</b>', 'required' => 'Campo requerido <b>%s</b>']);
      }
      $this->form_validation->set_error_delimiters('<li>', '</li>');
   }

   function set_info()
   {
      $txtsender = $this->input->post('txtsender');
      $config_rules['sender'] = $txtsender;
      $config_rules['auxiliar_sender'] = $this->input->post('auxiliar_sender');
      $this->_form_validation($config_rules);
      if ($this->form_validation->run() === FALSE)
      {
         if ($config_rules['auxiliar_sender'] === '0')
         {
            $data['vehicle_vt'] = $this->vehicles_model->get_vehicle_type()->result();
            $this->load->view('logistic/vehicle/index',$data);
         }
         else
         {
            $data['vt']['-1'] = 'Elige una opción';
            foreach ($this->vehicles_model->get_vehicle_type()->result() as $vt)
            {
               $data['vt'][$vt->vt_id] = $vt->description_vt;
            }
            $data['vehicle'] = $this->vehicles_model->_get_vehicle()->result();
            $this->load->view('logistic/vehicle/vehicle_s', $data);
         }
      }
      else
      {
         if ($config_rules['auxiliar_sender'] === '0')
         {
            $auto_complete = [
               'description_vt' => mb_strtoupper($this->input->post('txtdescription_vt')),
               'user_id'        => 1
            ];
            if ($txtsender === '0')
            {
               $this->vehicles_model->save_vehicle_type($auto_complete);
               $data['success_save']  = TRUE;
               $data['auto_complete'] = FALSE;
               $data['vehicle_vt']    = $this->vehicles_model->get_vehicle_type()->result();
               $this->load->view('logistic/vehicle/index', $data);

            }
            else
            {
               $auto_complete['vt_id'] = $this->input->post('txtvt_id');
               $this->vehicles_model->edit_vehicle_type($auto_complete);
               $data['success_update'] = TRUE;
               $data['auto_complete']  = FALSE;
               $data['vehicle_vt']     = $this->vehicles_model->get_vehicle_type()->result();
               $this->load->view('logistic/vehicle/index', $data);
            }
         }
         else
         {
            $auto_complete = [
               'key_v'         => mb_strtoupper($this->input->post('key_v')),
               'description_v' => mb_strtoupper($this->input->post('txtdescription_v')),
               'vehicle_type'  => $this->input->post('txtvehicle_type'),
               'user_id'       => 1
            ];
            if ($txtsender === '0')
            {
               $this->vehicles_model->save_vehicle($auto_complete);
               $data['success_save']  = TRUE;
               $data['auto_complete'] = FALSE;
               $data['vt']['-1']      = 'Elige una opción';
               foreach ($this->vehicles_model->get_vehicle_type()->result() as $vt)
               {
                  $data['vt'][$vt->vt_id] = $vt->description_vt;
               }
               $data['vehicle'] = $this->vehicles_model->_get_vehicle()->result();
               $this->load->view('logistic/vehicle/vehicle_s', $data);
            }
            else
            {
               $auto_complete['vehicle_id'] = $this->input->post('vehicle_id');
               $this->vehicles_model->edit_vehicle($auto_complete);
               $data['success_update'] = TRUE;
               $data['auto_complete']  = FALSE;
               $data['vt']['-1']       = 'Elige una opción';
               foreach ($this->vehicles_model->get_vehicle_type()->result() as $vt)
               {
                  $data['vt'][$vt->vt_id] = $vt->description_vt;
               }
               $data['vehicle'] = $this->vehicles_model->_get_vehicle()->result();
               $this->load->view('logistic/vehicle/vehicle_s', $data);
            }
         }
      }
   }
}
