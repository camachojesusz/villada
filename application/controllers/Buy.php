<?php

defined('BASEPATH') OR exit('No direct script access allowed');

   class Buy extends CI_Controller
   {
      function __construct()
      {
         parent:: __construct();
         $this->load->model('buy/buy/buy_model');
         $this->load->model('buy/size_box/size_box_model');
      }

      function index()
      {
         $data['buy'] = $this->buy_model->_get_arrival()->result();
         $this->load->view('buy/buy/index', $data);
      }

      function new_buy()
      {
         $data['product']['-1']  = 'Elige un producto';
         $data['producer']['-1'] = 'Elige un proveedor';
         $data['origin']['-1']   = 'Elige un origen';
         foreach ($this->buy_model->_get_supply()->result() as $pd)
         {
            $data['product'][$pd->id_product]   = $pd->key_product." - ".$pd->describe_product;
            $data['producer'][$pd->id_producer] = $pd->noctrl_producer." - ".$pd->describe_producer;
            $data['origin'][$pd->id_origin]     = $pd->describe_origin;
         }

         foreach ($this->size_box_model->get_info_sb()->result() as $sb)
         {
            $data['size_box'][$sb->destare_value] = $sb->description." (x".$sb->destare_value.")";
         }

         $this->load->view('buy/buy/add_buy', $data);
      }

      function edit_buy($sheet_arrival)
      {
         $data['arrival']        = $this->buy_model->_get_arrival($sheet_arrival, NULL, NULL, NULL)->result();
         $data['product']['-1']  = 'Elige un producto';
         $data['producer']['-1'] = 'Elige un proveedor';
         $data['origin']['-1']   = 'Elige un origen';
         foreach ($this->buy_model->_get_supply()->result() as $pd)
         {
            $data['product'][$pd->id_product]   = $pd->key_product." - ".$pd->describe_product;
            $data['producer'][$pd->id_producer] = $pd->noctrl_producer." - ".$pd->describe_producer;
            $data['origin'][$pd->id_origin]     = $pd->describe_origin;
         }

         foreach ($this->size_box_model->get_info_sb()->result() as $sb)
         {
            $data['size_box'][$sb->destare_value] = $sb->description." (x".$sb->destare_value.")";
         }

         $this->load->view('buy/buy/edit_buy', $data);
      }

      function get_producer()
      {
         $product = (($this->input->post('product_id_js'))?($this->input->post('product_id_js')):(0));

         $res = '<option value="-1">Elige un proveedor</option>';
         foreach ($this->buy_model->_get_supply($product, NULL, NULL)->result() as $pd)
         {
            $res .= '<option value="'.$pd->id_producer.'">'.$pd->noctrl_producer." - ".$pd->describe_producer.'</option>';
         }

         echo $res;
      }

      function get_origin()
      {
         $product  = (($this->input->post('product_id_js'))?($this->input->post('product_id_js')):(0));
         $producer = (($this->input->post('producer_id_js'))?($this->input->post('producer_id_js')):(0));

         $res = '<option value="-1">Elige un origen</option>';
         foreach ($this->buy_model->_get_supply($product, $producer, NULL)->result() as $og)
         {
            $res .= '<option value="'.$og->id_origin.'">'.$og->describe_origin.'</option>';
         }

         echo $res;
      }

      function _form_validation()
      {
         $this->load->library('form_validation');
         $this->form_validation->set_rules('txtsender', '', 'numeric', ['numeric' => 'Formato inválido en: <b>%s</b>']);
         $this->form_validation->set_rules('txtproduct', 'Producto', 'required|numeric|greater_than[0]', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>', 'greater_than'=> 'Elige un <b>%s</b>']);
         $this->form_validation->set_rules('txtproducer', 'Proveedor', 'required|numeric|greater_than[0]', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>', 'greater_than'=> 'Elige un <b>%s</b>']);
         $this->form_validation->set_rules('txtorigin', 'Origen', 'required|numeric|greater_than[0]', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>', 'greater_than'=> 'Elige un <b>%s</b>']);
         $this->form_validation->set_rules('txtboxes', 'Cajas', 'required|numeric|greater_than[0]|integer', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>', 'greater_than'=> '<b>%s</b>, debe ser mayor a cero (0)', 'integer' => '<b>%s</b>, debe contener un número entero']);
         $this->form_validation->set_rules('txtweight', 'Kilos', 'required|numeric|greater_than[0]', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>', 'greater_than'=> '<b>%s</b>, debe ser mayor a cero (0)']);
         $this->form_validation->set_rules('txtctrldestare', 'Calcular destare', 'required|numeric', ['required' => '<b>%s</b> por defecto es <b>Automático</b>. Seleccione una opción.', 'numeric' => 'Formato inválido en: <b>%s</b>']);
         $this->form_validation->set_rules('txtsizebox', 'Tipo de caja', 'numeric', ['numeric' => 'Formato inválido en: <b>%s</b>']);
         $this->form_validation->set_rules('txtvaldestare', 'Calcular destare', 'numeric|greater_than[0]', ['numeric' => 'Formato inválido en: <b>%s</b>', 'greater_than'=> '<b>%s</b>, debe ser mayor a cero (0)']);
         $this->form_validation->set_rules('txtdestare_b', 'Destare calculado', 'required|numeric|greater_than[0]', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>', 'greater_than'=> '<b>%s</b>, debe ser mayor a cero (0), verifíca: <b>Cajas</b>']);
         $this->form_validation->set_rules('txttotalweight_b', 'Total kg entrada', 'required|numeric|greater_than[0]', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>', 'greater_than'=> '<b>%s</b>, debe ser mayor a cero (0), verifíca: <b>Cajas</b> o <b>Kilos</b>']);
         $this->form_validation->set_rules('txtobserve', 'Observaciones', 'trim', ['trim' => 'Formato inválido en: <b>%s</b>']);
         $this->form_validation->set_error_delimiters('<li>', '</li>');
      }

      function set_info()
      {
         $this->_form_validation();
         $product       = (($this->input->post('txtproduct') != '-1') ? ($this->input->post('txtproduct')) : (NULL));
         $producer      = (($this->input->post('txtproducer') != '-1') ? ($this->input->post('txtproducer')) : (NULL));
         $origin        = (($this->input->post('txtorigin') != '-1') ? ($this->input->post('txtorigin')) : (NULL));
         $orserve       = ((mb_strtoupper($this->input->post('txtobserve')) != '') ? (mb_strtoupper($this->input->post('txtobserve'))) : (NULL));
         $ctrldestare   = $this->input->post('txtctrldestare');
         $sheet_arrival = ($this->input->post('arrival_sheet') === '') ? $this->buy_model->get_last_sheet() : $this->input->post('arrival_sheet');
         $val_destare   = ($ctrldestare === '0') ? $this->input->post('txtsizebox') : $this->input->post('txtvaldestare');
         $boxes         = $this->input->post('txtboxes');
         $destare       = $boxes * $val_destare;
         $weight        = round($this->input->post('txtweight'), 2);
         $total_weight  = round($weight - $destare, 2);
         $auto_complete = [
            'sheet_arrival'       => $sheet_arrival,
            'boxes_arrival'       => $boxes,
            'weight_arrival'      => $weight,
            'type_destare'        => $ctrldestare,
            'val_destare'         => $val_destare,
            'destare_arrival'     => $destare,
            'totalweight_arrival' => $total_weight,
            'observe_arrival'     => $orserve,
         ];

         if ($this->form_validation->run() === FALSE)
         {
            $auto_complete['product']  = $product;
            $auto_complete['producer'] = $producer;
            $auto_complete['origin']   = $origin;
            $data['product']['-1']     = 'Elige un producto';
            $data['producer']['-1']    = 'Elige un proveedor';
            $data['origin']['-1']      = 'Elige un origen';
            foreach ($this->buy_model->_get_supply()->result() as $pd)
            {
               $data['product'][$pd->id_product]   = $pd->key_product." - ".$pd->describe_product;
               $data['producer'][$pd->id_producer] = $pd->noctrl_producer." - ".$pd->describe_producer;
               $data['origin'][$pd->id_origin]     = $pd->describe_origin;
            }

            foreach ($this->size_box_model->get_info_sb()->result() as $sb)
            {
               $data['size_box'][$sb->destare_value] = $sb->description." (x".$sb->destare_value.")";
            }

            $data['auto_complete'] = $auto_complete;

            switch ($this->input->post('txtsender'))
            {
               case '0':
                  $this->load->view('buy/buy/add_buy', $data);
                  break;
               case '1':
                  $data['arrival'] = $this->buy_model->_get_arrival($auto_complete['sheet_arrival'], NULL, NULL, NULL)->result();
                  $this->load->view('buy/buy/edit_buy', $data);
                  break;
               default:
                  echo "Error de direccionamiento";
                  break;
            }
         }
         else
         {
            $auto_complete['supply_arrival'] = $this->buy_model->_get_supply($product, $producer, $origin)->row()->id_supply;
            $auto_complete['iduser_arrival'] = 2;
            switch ($this->input->post('txtsender'))
            {
               case '0':
                  $this->buy_model->save_buy($auto_complete);
                  $data['product']['-1']  = 'Elige un producto';
                  $data['producer']['-1'] = 'Elige un proveedor';
                  $data['origin']['-1']   = 'Elige un origen';
                  foreach ($this->buy_model->_get_supply()->result() as $pd)
                  {
                     $data['product'][$pd->id_product]   = $pd->key_product." - ".$pd->describe_product;
                     $data['producer'][$pd->id_producer] = $pd->noctrl_producer." - ".$pd->describe_producer;
                     $data['origin'][$pd->id_origin]     = $pd->describe_origin;
                  }

                  foreach ($this->size_box_model->get_info_sb()->result() as $sb)
                  {
                     $data['size_box'][$sb->destare_value] = $sb->description." (x".$sb->destare_value.")";
                  }

                  $data['success_buy']         = TRUE;
                  $data['auto_complete']       = FALSE;
                  $data['label_sheet_arrival'] = $this->buy_model->get_last_sheet() - 1;
                  $this->load->view('buy/buy/add_buy', $data);

                  break;

               case '1':
                  $this->buy_model->update_buy($auto_complete);

                  $data['success_update_buy'] = TRUE;
                  $data['auto_complete']      = FALSE;
                  $data['buy'] = $this->buy_model->_get_arrival()->result();
                  $this->load->view('buy/buy/index', $data);
                  break;

               default:
                  echo "Error de direccionamiento";
                  break;
            }
         }
      }

      function delete_arrival($sheet_arrival)
      {
         $info_buy = ['sheet_arrival'=> $sheet_arrival, 'status_arrival' => '0'];
         $this->buy_model->update_buy($info_buy);

         $data['delete_buy'] = TRUE;
         $data['auto_complete'] = FALSE;
         $data['buy'] = $this->buy_model->_get_arrival()->result();
         $this->load->view('buy/buy/index', $data);
      }
   }
