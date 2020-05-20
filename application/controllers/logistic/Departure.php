<?php

defined('BASEPATH') OR exit('No direct script access allowed');
   class Departure extends CI_Controller
   {
      function __construct()
      {
         parent:: __construct();
         $this->load->model('logistic/departure/departure_model');
         $this->load->model('logistic/destiny/destiny_model');
         $this->load->model('logistic/vehicles/vehicles_model');
         $this->load->model('logistic/driver/driver_model');

      }

      function index()
      {
         $data['departure'] = $this->departure_model->get_departure()->result();
         foreach ($data['departure'] as $dr)
         {
            $data['driver'] = $this->departure_model->get_departure(NULL, NULL, NULL, $dr->driver_id);
         }
         $this->load->view('logistic/departure/index', $data);
      }

      function new()
      {
         $data['dy']['-1'] = 'Elige una opción';
         foreach ($this->destiny_model->get_destiny(NULL, $dp = TRUE)->result() as $dy)
         {
            $data['dy'][$dy->destiny_id] = $dy->description_d;
         }
         $data['ve']['-1'] = 'Elige una opción';
         foreach ($this->vehicles_model->get_vehicle()->result() as $ve)
         {
            $data['ve'][$ve->vehicle_id] = $ve->description_v;
         }
         $data['dr']['-1'] = 'Elige una opción';
         foreach ($this->driver_model->get_driver()->result() as $dr)
         {
            $data['dr'][$dr->driver_id] = $dr->sheet_licence.' - '.$dr->name.' - '.$dr->ap1;
         }
         $data['dr_employ']['-1'] = 'Elige una opción';
         foreach ($this->driver_model->get_employe_driver()->result() as $dr)
         {
            $data['dr_employ'][$dr->id_employee] = $dr->sheetlicence_employee.' - '.$dr->name_employee.' - '.$dr->ap1_employee;
         }
         $this->load->view('logistic/departure/new', $data);
      }

      function edit($departure_id, $driver_type, $driver_id)
      {
         $data['departure'] = $this->departure_model->get_departure(NULL, $departure_id, $driver_type, $driver_id);
         $data['dy']['-1'] = 'Elige una opción';
         foreach ($this->destiny_model->get_destiny(NULL, $dp = TRUE)->result() as $dy)
         {
            $data['dy'][$dy->destiny_id] = $dy->description_d;
         }
         $data['ve']['-1'] = 'Elige una opción';
         foreach ($this->vehicles_model->get_vehicle()->result() as $ve)
         {
            $data['ve'][$ve->vehicle_id] = $ve->description_v;
         }
         $data['dr']['-1'] = 'Elige una opción';
         foreach ($this->driver_model->get_driver()->result() as $dr)
         {
            $data['dr'][$dr->driver_id] = $dr->sheet_licence.' - '.$dr->name.' - '.$dr->ap1;
         }
         $data['dr_employ']['-1'] = 'Elige una opción';
         foreach ($this->driver_model->get_employe_driver()->result() as $dr)
         {
            $data['dr_employ'][$dr->id_employee] = $dr->sheetlicence_employee.' - '.$dr->name_employee.' - '.$dr->ap1_employee;
         }
         $this->load->view('logistic/departure/edit', $data);
      }

      function day_week($date_p = NULL)
      {
         $date    = explode('-', $date_p);
         $jd      = gregoriantojd($date[1], $date[2], $date[0]);
         $num_day = jddayofweek($jd, 0);
         switch ($num_day)
         {
            case '0':
               $day = 'DOMINGO';
               break;
            case '1':
               $day = 'LUNES';
               break;
            case '2':
               $day = 'MARTES';
               break;
            case '3':
               $day = 'MIÉRCOLES';
               break;
            case '4':
               $day = 'JUEVES';
               break;
            case '5':
               $day = 'VIERNES';
               break;
            case '6':
               $day = 'SÁBADO';
               break;
            default:
               $day = 'NO ENCONTRADO';
               break;
         }
         return $day;
      }

      function sheet_departure()
      {
         $get_sheet = $this->departure_model->get_last_sheet();
         if (! empty($get_sheet))
         {
            foreach ($get_sheet as $last_sheet)
            {
               $l_sheet = $last_sheet;
            }
            $ctrl_l_sheet = explode('-', $l_sheet);
            $actual_year = date('Y');
            $conct_year = $actual_year.$ctrl_l_sheet[1];
            $last_yearregister = $conct_year / 10000;
            if (floor($last_yearregister) != $actual_year)
            {
               $n_sheet = $actual_year * 10000 + (($ctrl_l_sheet[1] === '9999') ? 2 : 1);
            }
            else
            {
               $n_sheet = $conct_year + (($ctrl_l_sheet[1] === '9999') ? 2 : 1);
            }
            $next_num = mb_substr($n_sheet, 4, 6);
            if ($ctrl_l_sheet[1] === '9999')
            {
               $next_letter = trim(++$ctrl_l_sheet[0].PHP_EOL);
            }
            else
            {
               $next_letter = $ctrl_l_sheet[0];
            }
            $new_sheet = $next_letter.'-'.$next_num;
         }
         else
         {
            $new_sheet = 'A-0001';
         }
         return trim($new_sheet);

      }

      function status($status = NULL, $departure_id = NULL)
      {
         $info_departure = [
            'departure_id' => $departure_id,
            'status' => ($status === '1') ? '0' : '1'
         ];
         $this->departure_model->edit_departure($info_departure);
         $data['status_alert'] = $info_departure['status'];
         $data['departure'] = $this->departure_model->get_departure()->result();
         $data['dy']['-1'] = 'Elige una opción';
         foreach ($this->destiny_model->get_destiny(NULL, $dp = TRUE)->result() as $dy)
         {
            $data['dy'][$dy->destiny_id] = $dy->description_d;
         }
         $data['ve']['-1'] = 'Elige una opción';
         foreach ($this->vehicles_model->get_vehicle()->result() as $ve)
         {
            $data['ve'][$ve->vehicle_id] = $ve->description_v;
         }
         $data['dr']['-1'] = 'Elige una opción';
         foreach ($this->driver_model->get_driver()->result() as $dr)
         {
            $data['dr'][$dr->driver_id] = $dr->sheet_licence.' - '.$dr->name.' - '.$dr->ap1;
         }
         $data['dr_employ']['-1'] = 'Elige una opción';
         foreach ($this->driver_model->get_employe_driver()->result() as $dr)
         {
            $data['dr_employ'][$dr->id_employee] = $dr->sheetlicence_employee.' - '.$dr->name_employee.' - '.$dr->ap1_employee;
         }
         $this->load->view('logistic/departure/index', $data);
      }

      function _form_validation($config_rules = NULL)
      {
         $this->load->library('form_validation');
         $this->form_validation->set_rules('txtsender', 'Procedimiento', 'numeric', ['numeric' => 'Error de <b>%s</b>']);
         $this->form_validation->set_rules('txtplan_date', 'Fecha estimada', 'required', ['required' => 'Campo requerido <b>%s</b>']);
         $this->form_validation->set_rules('txtdestiny_id', 'Destino', 'required|integer', ['required' => 'Campo requerido <b>%s</b>', 'integer' => 'Formato inválido en: <b>%s</b>']);
         $this->form_validation->set_rules('txtvehicle_id', 'Vehículo', 'required|integer', ['required' => 'Campo requerido <b>%s</b>', 'integer' => 'Formato inválido en: <b>%s</b>']);
         $this->form_validation->set_rules('txt_ctrl_driver', 'Conductor', 'required|integer', ['required' => 'Campo requerido <b>%s</b>', 'integer' => 'Formato inválido en: <b>%s</b>']);
         if ($config_rules['type_driver'] === '0')
         {
            $this->form_validation->set_rules('txtdriver_id', 'Conductor', 'required|integer', ['required' => 'Campo requerido <b>%s</b>', 'integer' => 'Formato inválido en: <b>%s</b>']);
         }
         else
         {
            $this->form_validation->set_rules('txtdriver_emp_id', 'Candidato a chofer', 'required|integer', ['required' => 'Campo requerido <b>%s</b>', 'integer' => 'Formato inválido en: <b>%s</b>']);
         }
         $this->form_validation->set_error_delimiters('<li>', '</li>');
      }

      function set_info()
      {
         $txt_sender = $this->input->post('txtsender');
         $date_p = $this->input->post('txtplan_date');
         $config_rules = [
            'type_driver' => $this->input->post('txt_ctrl_driver'),
            'date_p'      => $date_p
         ];
         $auto_complete = [
            'departure_id'    => $this->input->post('departure_id'),
            'sheet_departure' => ($txt_sender === '0') ? $this->sheet_departure() : $this->input->post('sheet_departure'),
            'plan_date'       => $date_p,
            'destiny_id'      => $this->input->post('txtdestiny_id'),
            'vehicle_id'      => $this->input->post('txtvehicle_id'),
            'driver_type'     => $this->input->post('txt_ctrl_driver'),
            'driver_id'       => ($this->input->post('txt_ctrl_driver') === '0') ? $this->input->post('txtdriver_id') : $this->input->post('txtdriver_emp_id'),
            'user_id'         => 1
         ];
         $this->_form_validation($config_rules);
         if ($this->form_validation->run() === FALSE)
         {
            $data['dy']['-1'] = 'Elige una opción';
            foreach ($this->destiny_model->get_destiny(NULL, $dp = TRUE)->result() as $dy)
            {
               $data['dy'][$dy->destiny_id] = $dy->description_d;
            }
            $data['ve']['-1'] = 'Elige una opción';
            foreach ($this->vehicles_model->get_vehicle()->result() as $ve)
            {
               $data['ve'][$ve->vehicle_id] = $ve->description_v;
            }
            $data['dr']['-1'] = 'Elige una opción';
            foreach ($this->driver_model->get_driver()->result() as $dr)
            {
               $data['dr'][$dr->driver_id] = $dr->sheet_licence.' - '.$dr->name.' - '.$dr->ap1;
            }
            $data['dr_employ']['-1'] = 'Elige una opción';
            foreach ($this->driver_model->get_employe_driver()->result() as $dr)
            {
               $data['dr_employ'][$dr->id_employee] = $dr->sheetlicence_employee.' - '.$dr->name_employee.' - '.$dr->ap1_employee;
            }
            $data['auto_complete'] = $auto_complete;
            if ($txt_sender === '0')
            {
               $this->load->view('logistic/departure/new', $data);
            }
            else
            {
               $this->load->view('logistic/departure/edit', $data);
            }
         }
         else
         {
            $auto_complete['day'] = $this->day_week($date_p);
            if ($txt_sender === '0')
            {
               $this->departure_model->save_departure($auto_complete);
               $data['succes_dp'] = TRUE;
               $auto_complete = FALSE;
            }
            else
            {
               $this->departure_model->edit_departure($auto_complete);
               $data['update_dp'] = TRUE;
               $auto_complete = FALSE;
            }
            $data['departure'] = $this->departure_model->get_departure()->result();
            $data['dy']['-1'] = 'Elige una opción';
            foreach ($this->destiny_model->get_destiny(NULL, $dp = TRUE)->result() as $dy)
            {
               $data['dy'][$dy->destiny_id] = $dy->description_d;
            }
            $data['ve']['-1'] = 'Elige una opción';
            foreach ($this->vehicles_model->get_vehicle()->result() as $ve)
            {
               $data['ve'][$ve->vehicle_id] = $ve->description_v;
            }
            $data['dr']['-1'] = 'Elige una opción';
            foreach ($this->driver_model->get_driver()->result() as $dr)
            {
               $data['dr'][$dr->driver_id] = $dr->sheet_licence.' - '.$dr->name.' - '.$dr->ap1;
            }
            $data['dr_employ']['-1'] = 'Elige una opción';
            foreach ($this->driver_model->get_employe_driver()->result() as $dr)
            {
               $data['dr_employ'][$dr->id_employee] = $dr->sheetlicence_employee.' - '.$dr->name_employee.' - '.$dr->ap1_employee;
            }
            $this->load->view('logistic/departure/index', $data);
         }
      }
   }
