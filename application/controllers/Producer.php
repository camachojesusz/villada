<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producer extends CI_Controller
{
   public function __construct()
   {
      parent:: __construct();
      $this->load->model('producer/producer_model');
   }

   function index()
   {
      $data['allproducer'] = $this->producer_model->get_all_producer()->result();
      $this->load->view('producer/index', $data);
   }

   function new_producer()
   {
      $data['states']['-1'] = 'Elige una opción';
      foreach ($this->producer_model->get_states()->result() as $states)
      {
         $data['states'][$states->name] = $states->name.' ('.$states->abrev.')';
      }
      $this->load->view('producer/newproducer', $data);
   }

   function origins($id = NULL)
   {
      foreach ($this->producer_model->get_product() as $products)
      {
         $data['info_product'][$products->id_product] = $products->describe_product;
      }
      $data['info_producer']  = $this->producer_model->get_info_producer($id);
      $data['all_origin'] = $this->producer_model->get_origin($data['info_producer']->row()->noctrl_e_producer);
      $data['supply_product'] = $this->producer_model->get_supply()->result();
      $this->load->view('producer/origin', $data);
   }

   function edit($id_producer = NULL)
   {
      $data['states']['-1'] = 'Elige una opción';
      foreach ($this->producer_model->get_states()->result() as $states)
      {
         $data['states'][$states->name] = $states->name.' ('.$states->abrev.')';
      }
      $data['producer_info'] = $this->producer_model->get_all_producer($id_producer);
      $this->load->view('producer/edit', $data);
   }

   function status_producer($status = NULL, $id_producer = NULL)
   {
      $info_producer = [
         'noctrl_e_producer' => $id_producer,
         'status_producer' =>  ($status === '1') ? '0' : '1'
      ];
      $this->producer_model->update_producer($info_producer);
      $data['allproducer'] = $this->producer_model->get_all_producer()->result();
      $data['status_alert'] = $info_producer['status_producer'];
      $this->load->view('producer/index', $data);
   }

   function status_origin($status = NULL, $id_origin = NULL, $id = NULL)
   {
      $info_origin = [
         'id_origin' => $id_origin,
         'status_origin' =>  ($status === '1') ? '0' : '1'
      ];
      $this->producer_model->edit_origin($info_origin);
      foreach ($this->producer_model->get_product() as $products)
      {
         $data['info_product'][$products->id_product] = $products->describe_product;
      }
      $data['info_producer']  = $this->producer_model->get_info_producer($id);
      $data['all_origin']     = $this->producer_model->get_origin($id);
      $data['supply_product'] = $this->producer_model->get_supply()->result();
      foreach ($data['supply_product'] as $selected_products)
      {
         $data['selected_products'][$selected_products->origin_supply] = $selected_products->product_supply;
      }
      $data['status_alert'] = $info_origin['status_origin'];
      $this->load->view('producer/origin', $data);
   }

   function _form_validation($config_rules = null)
   {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('txtsender', 'Error', 'numeric', ['numeric' => '<b>%s</b> no identificado']);
      if ($config_rules['auxiliar_sender'] === '1')
      {
         $this->form_validation->set_rules('txtdocument', 'Identificación', 'required|integer', ['required' => 'Error de <b>%s</b> required', 'integer' => 'Error de <b>%s</b>']);
         if ($config_rules['ctrl_rules'] === '0')
         {
            if ($config_rules['doc_type'] === '0')
            {
               $this->form_validation->set_rules('txtdescribedocument', 'CURP', 'required|exact_length[18]|is_unique[producer.describedocument_producer]', ['required' => 'Error de <b>%s</b> required', 'exact_length' => 'Formato inválido en: <b>%s</b>, debe contener 18 caracteres', 'is_unique' => 'La <b>%s</b> ingresada ya existe en los registros']);
            }
            else
            {
               $this->form_validation->set_rules('txtdescribedocument', 'RFC', 'required|min_length[10]|max_length[13]|is_unique[producer.describedocument_producer]', ['required' => 'Error de <b>%s</b> required', 'min_length' => 'Formato inválido en: <b>%s</b>, debe contener entre 10 y 13 caracteres', 'max_length' => 'Formato inválido en: <b>%s</b>, debe contener entre 10 y 13caracteres', 'is_unique' => 'La <b>%s</b> ingresada ya existe en los registros']);
            }
         }
         else
         {
            $this->form_validation->set_rules('txtideditable', 'Procedimiento', 'required|alpha_numeric', ['required' => 'Error de <b>%s</b> required', 'alpha_numeric' => 'Error de <b>%s</b>']);
            $this->form_validation->set_rules('txtnoctrl', 'Procedimiento', 'required|alpha_numeric', ['required' => 'Error de <b>%s</b> required', 'alpha_numeric' => 'Error de <b>%s</b>']);
            if ($config_rules['doc_type'] === '0')
            {
               $this->form_validation->set_rules('txtdescribedocument', 'CURP', 'required|exact_length[18]', ['required' => 'Error de <b>%s</b> required', 'exact_length' => 'Formato inválido en: <b>%s</b>, debe contener 18 caracteres']);
            }
            else
            {
               $this->form_validation->set_rules('txtdescribedocument', 'RFC', 'required|min_length[10]|max_length[13]', ['required' => 'Error de <b>%s</b> required', 'min_length' => 'Formato inválido en: <b>%s</b>, debe contener entre 10 y 13 caracteres', 'max_length' => 'Formato inválido en: <b>%s</b>, debe contener entre 10 y 13 caracteres']);
            }
         }
         $this->form_validation->set_rules('txtdescribe', 'Proveedor o empresa', 'required|trim', ['required' => 'Campo requerido <b>%s</b>', 'trim' => 'Formato inválido en: <b>%s</b>']);
         $this->form_validation->set_rules('txtname', 'Nombre (s)', 'required|trim', ['required' => 'Campo requerido <b>%s</b>', 'trim' => 'Formato inválido en: <b>%s</b>']);
         $this->form_validation->set_rules('txtap1', 'Apellido paterno', 'required|trim', ['required' => 'Campo requerido <b>%s</b>', 'trim' => 'Formato inválido en: <b>%s</b>']);
         $this->form_validation->set_rules('txtap1', 'Apellido paterno', 'trim', ['trim' => 'Formato inválido en: <b>%s</b>']);
         $this->form_validation->set_rules('txtap1', 'Apellido paterno', 'trim', ['trim' => 'Formato inválido en: <b>%s</b>']);
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
      }
      else
      {
         if ($config_rules['ctrl_rules'] === '0')
         {
            $this->form_validation->set_rules('txtdescribe_new_origin', 'Origen', 'required|trim', ['required' => 'Campo requerido <b>%s</b>', 'trim' => 'Formato inválido en: <b>%s</b>']);
         }
         else
         {
            $this->form_validation->set_rules('txtorigin', 'Procedimiento', 'required', ['required' => 'Error de <b>%s</b> en Or']);
         }
         $this->form_validation->set_rules('txtproducer', 'Procedimiento', 'required', ['required' => 'Error de <b>%s</b> en pr']);
         $this->form_validation->set_rules('txtlocation_origin', 'Ubicación', 'trim', ['trim' => 'Formato inválido en: <b>%s</b>']);
         $this->form_validation->set_rules('txtproduct_origin', 'Productos', 'integer', ['integer' => 'Error en: <b>%s</b>, inténtalo más tarde']);
      }
      $this->form_validation->set_error_delimiters('<li>', '</li>');
   }

   function set_info()
   {
      $txt_sender = $this->input->post('txtsender');
      $document_type = $this->input->post('txtdocument');
      $config_rules['ctrl_rules'] = $txt_sender;
      $config_rules['doc_type'] =$document_type;
      $config_rules['auxiliar_sender'] = '1';

      $autocomplete = [
         'noctrl_e_producer'         => $this->input->post('txtideditable'),
         'noctrl_producer'           => $this->input->post('txtnoctrl'),
         'document_producer'         => $document_type,
         'describedocument_producer' => mb_strtoupper($this->input->post('txtdescribedocument')),
         'describe_producer'         => mb_strtoupper($this->input->post('txtdescribe')),
         'name_producer'             => mb_strtoupper($this->input->post('txtname')),
         'ap1_producer'              => mb_strtoupper($this->input->post('txtap1')),
         'ap2_producer'              => mb_strtoupper($this->input->post('txtap2')),
         'street_producer'           => mb_strtoupper($this->input->post('txtstreet')),
         'numint_producer'           => mb_strtoupper(($this->input->post('txtnumint') === '') ? '0': $this->input->post('txtnumint')),
         'numext_producer'           => mb_strtoupper(($this->input->post('txtnumext') === '') ? '0': $this->input->post('txtnumext')),
         'local_producer'            => mb_strtoupper($this->input->post('txtlocal')),
         'muni_producer'             => mb_strtoupper($this->input->post('txtmuni')),
         'state_producer'            => $this->input->post('txtstate'),
         'postalcode_producer'       => $this->input->post('txtpostalcode'),
         'phone_producer'            => $this->input->post('txtphone'),
         'cel_producer'              => $this->input->post('txtcel'),
         'email_producer'            => $this->input->post('txtemail'),
         'status_producer'           => $this->input->post('txtstatus'),
         'iduser_producer'           => 1
      ];

      $this->_form_validation($config_rules);
      if ($this->form_validation->run() === FALSE)
      {
         $data['states']['-1'] = 'Elige una opción';
         foreach ($this->producer_model->get_states()->result() as $states)
         {
            $data['states'][$states->name] = $states->name.' ('.$states->abrev.')';
         }
         if ($txt_sender === '0')
         {
            $data['autocomplete'] = $autocomplete;
            $this->load->view('producer/newproducer', $data);
         }
         else
         {
            $data['producer_info'] = $this->producer_model->get_all_producer($autocomplete['txtideditable']);
            $this->load->view('producer/edit', $data);
         }
      }
      else
      {
         switch ($txt_sender)
         {
            case '0':
               $autocomplete['noctrl_producer'] = $this->producer_model->get_last_controlnumber();
               $autocomplete['noctrl_e_producer'] = md5($this->producer_model->get_last_controlnumber());
               $this->producer_model->save_producer($autocomplete);
               $data['autocomplete']     = FALSE;
               $data['success_producer'] = TRUE;
               $data['allproducer']      = $this->producer_model->get_all_producer()->result();
               $data['info_producer']    = $this->producer_model->get_info_producer($autocomplete['describedocument_producer']);
               $this->load->view('producer/index', $data);
               break;
            case '1':
               $this->producer_model->update_producer($autocomplete);
               $data['autocomplete']           = FALSE;
               $data['success_updateproducer'] = TRUE;
               $data['allproducer'] = $this->producer_model->get_all_producer()->result();
               $this->load->view('producer/index', $data);
               break;
            default:
               echo "Error de direccionamiento";
               break;
         }
      }
   }

   function set_info_og()
   {
      $txt_sender = $this->input->post('txtsender');
      $config_rules['ctrl_rules'] = $txt_sender;
      $config_rules['auxiliar_sender'] = '0';

      $autocomplete_origin = [
         'id_origin'       => $this->input->post('txtorigin'),
         'producer_origin' => $this->input->post('txtproducer'),
         'describe_origin' => mb_strtoupper($this->input->post('txtdescribe_new_origin')),
         'location_origin' => mb_strtoupper($this->input->post('txtlocation_origin')),
         'iduser_origin'   => 1 //Usuario que realiza la opeación
      ];
      $autocomplete_supply = [
         'origin_supply'  => $this->input->post('txtorigin'),
         'product_supply' => $this->input->post('txtproduct_origin'),
         'iduser_supply'  => 1 //Usuario que realiza la opeación
      ];

      $this->_form_validation($config_rules);
      if ($this->form_validation->run() === FALSE)
      {
         foreach ($this->producer_model->get_product() as $products)
         {
            $data['info_product'][$products->id_product] = $products->describe_product;
         }
         $data['info_producer']  = $this->producer_model->get_info_producer($autocomplete_origin['producer_origin']);
         $data['all_origin'] = $this->producer_model->get_origin($data['info_producer']->row()->noctrl_e_producer);
         $data['supply_product'] = $this->producer_model->get_supply()->result();
         $this->load->view('producer/origin', $data);
      }
      else
      {
         switch ($txt_sender)
         {
            case '0':
            $check_origin = $this->producer_model->save_origin($autocomplete_origin);
            foreach ($check_origin as $origin_found)
            {
               $id = $origin_found->id_origin;
               $autocomplete_supply['origin_supply'] = $id;
            }
            foreach ($autocomplete_supply['product_supply'] as $supply)
            {
               $info_supply = [
                  'origin_supply'  => $autocomplete_supply['origin_supply'],
                  'product_supply' => $supply,
                  'iduser_supply'  => $autocomplete_supply['iduser_supply']
               ];

               $this->producer_model->insert_product($info_supply);
            }
            foreach ($this->producer_model->get_product() as $products)
            {
               $data['info_product'][$products->id_product] = $products->describe_product;
            }
            $data['info_producer']  = $this->producer_model->get_info_producer($autocomplete_origin['producer_origin']);
            $data['all_origin'] = $this->producer_model->get_origin($data['info_producer']->row()->noctrl_e_producer);
            $data['supply_product'] = $this->producer_model->get_supply()->result();
            $data['save_origin'] = TRUE;
            $autocomplete_origin = FALSE;
            $autocomplete_supply = FALSE;
            $this->load->view('producer/origin', $data);
            break;

            case '1':
               $this->producer_model->edit_origin($autocomplete_origin);
               foreach ($this->producer_model->get_product() as $products)
               {
                  $data['info_product'][$products->id_product] = $products->describe_product;
               }
               $data['info_producer']  = $this->producer_model->get_info_producer($autocomplete_origin['producer_origin']);
               $data['all_origin'] = $this->producer_model->get_origin($data['info_producer']->row()->noctrl_e_producer);
               $data['supply_product'] = $this->producer_model->get_supply()->result();
               $data['edit_origin'] = TRUE;
               $autocomplete_origin = FALSE;
               $autocomplete_supply = FALSE;
               $this->load->view('producer/origin', $data);
               break;

            case '2':
               foreach ($autocomplete_supply['product_supply'] as $supply)
               {
                  $check_product = $this->producer_model->get_supply($autocomplete_supply['origin_supply'], $supply);
                  if ($check_product->num_rows() > 0)
                  {
                     $data['add_product'] = '0';
                  }
                  else
                  {
                     $info_supply = [
                     'origin_supply'  => $autocomplete_supply['origin_supply'],
                     'product_supply' => $supply,
                     'iduser_supply'  => $autocomplete_supply['iduser_supply']
                     ];
                     $this->producer_model->insert_product($info_supply);
                     $data['add_product'] = '1';
                  }
               }
               foreach ($this->producer_model->get_product() as $products)
               {
                  $data['info_product'][$products->id_product] = $products->describe_product;
               }
               $data['info_producer']  = $this->producer_model->get_info_producer($autocomplete_origin['producer_origin']);
               $data['all_origin'] = $this->producer_model->get_origin($data['info_producer']->row()->noctrl_e_producer);
               $data['supply_product'] = $this->producer_model->get_supply()->result();
               $autocomplete_origin = FALSE;
               $autocomplete_supply = FALSE;
               $this->load->view('producer/origin', $data);
               break;

            default:
               echo "Error de direccionamiento";
               break;
         }
      }

   }
}
