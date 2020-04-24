<?php

class Classify extends CI_Controller
{
   function __construct()
   {
      parent:: __construct();
      $this->load->model('buy/buy/buy_model');
      $this->load->model('buy/classify/classify_model');
      $this->load->model('buy/size_box/size_box_model');
      $this->load->model('product/product_model');
   }

   function index($sheet_arrival, $type_alert = NULL)
   {
      if ($type_alert === '0')
      {
         $data['success_clfy'] = TRUE;
      }
      if ($type_alert === '1')
      {
         $data['new_clfy'] = TRUE;
      }
      if ($type_alert === '2')
      {
         $data['delete_clfy'] = TRUE;
      }
      $data['sheet_arrival'] = $sheet_arrival;
      $data['arrival']       = $this->buy_model->_get_arrival($sheet_arrival, NULL, NULL, NULL, NULL);
      $data['arrival_c']     = $this->classify_model->get_clone_arrival($sheet_arrival);
      $data['classify']      = $this->classify_model->get_classify($sheet_arrival, NULL, NULL);
      $data['count']         = $this->classify_model->count($sheet_arrival);
      $this->load->view('buy/classify/index', $data);
   }

   function new_classify($sheet_arrival, $auto_complete = NULL)
   {
      if ($auto_complete)
      {
         $data['auto_complete'] = $auto_complete;
      }
      $data['sheet_arrival'] = $sheet_arrival;
      $data['arrival']       = $this->buy_model->_get_arrival($sheet_arrival, NULL, NULL, NULL, NULL);
      $data['arrival_c']     = $this->classify_model->get_clone_arrival($sheet_arrival);
      $data['classify']      = $this->classify_model->get_classify($sheet_arrival, NULL, NULL);

      $data['quality']['-1'] = 'Elige una calidad';
      foreach ($this->product_model->get_product_size($data['arrival']->row()->id_product, NULL, NULL, NULL)->result() as $quality)
      {
         $data['quality'][$quality->quality_id] = $quality->description_q;
      }
      $data['category']['-1'] = 'Elige una categoría';
      foreach ($this->product_model->get_product_size($data['arrival']->row()->id_product, NULL, NULL, NULL)->result() as $quality)
      {
         $data['category'][$quality->category_id] = $quality->description_c;
      }

      $this->load->view('buy/classify/add_classify', $data);
   }

   function edit_classify($classify_id)
   {
      $data['classify']      = $this->classify_model->get_classify(NULL, $classify_id, NULL);
      $sheet_arrival         = $data['classify']->row()->sheet_arrival;
      $data['sheet_arrival'] = $sheet_arrival;
      $data['arrival']       = $this->buy_model->_get_arrival($sheet_arrival, NULL, NULL, NULL, NULL);
      $data['arrival_c']     = $this->classify_model->get_clone_arrival($sheet_arrival);

      $data['quality']['-1'] = 'Elige una calidad';
      foreach ($this->product_model->get_product_size($data['arrival']->row()->id_product, NULL, NULL, NULL)->result() as $quality)
      {
         $data['quality'][$quality->quality_id] = $quality->description_q;
      }
      $data['category']['-1'] = 'Elige una categoría';
      foreach ($this->product_model->get_product_size($data['arrival']->row()->id_product, NULL, NULL, NULL)->result() as $quality)
      {
         $data['category'][$quality->category_id] = $quality->description_c;
      }

      $this->load->view('buy/classify/edit_classify', $data);
   }

   function delete_classify($classify_id, $sheet_arrival)
   {
      $clfy = $this->classify_model->get_classify(NULL, $classify_id, NULL);
      $arrival_c = $this->classify_model->get_clone_arrival($sheet_arrival);

      $info_product_boxes = [
         'classify_id' => $classify_id,
         'status' => '0'
      ];

      $auto_complete_b = [
         'id_arrival'     => $clfy->row()->arrival_id,
         'boxes_arrival'  => $arrival_c->row()->boxes_arrival + $clfy->row()->boxes_c,
         'weight_arrival' => round($arrival_c->row()->weight_arrival + $clfy->row()->weight_c, 2)
      ];

      $auto_complete_c = [
         'sheet_arrival' => $clfy->row()->sheet_arrival,
         'status_classify' => '1'
      ];

      $this->classify_model->edit_classify($info_product_boxes);
      $this->classify_model->alter_clone_arrival($auto_complete_b);
      $this->classify_model->change_status_classify($auto_complete_c);
      $this->index($clfy->row()->sheet_arrival, $type_alert = '2');
   }

   function get_category()
   {
      $quality = (($this->input->post('quality_id_js'))?($this->input->post('quality_id_js')):(0));
      $product = (($this->input->post('product_id_js'))?($this->input->post('product_id_js')):(0));

      $res = '<option value="-1">Elige una categoría</option>';
      foreach ($this->product_model->get_product_size($product, NULL, $quality, NULL)->result() as $cat)
      {
         $res .= '<option value="'.$cat->category_id.'">'.$cat->description_c.'</option>';
      }

      echo $res;
   }

   function _form_validation($config_rules = NULL)
   {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('txtsender', 'Error', 'numeric', ['numeric' => '<b>%s</b> no identificado']);
      $this->form_validation->set_rules('id_arrival', 'Compra', 'required|numeric', ['required' => '<b>%s</b> no identificado', 'numeric' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('sheet_arrival', 'Compra', 'required|numeric', ['required' => '<b>%s</b> no identificado', 'numeric' => 'Formato inválido en: <b>%s</b>']);
      if ($config_rules['ed'] === '1')
      {
         $this->form_validation->set_rules('txtboxes_c', 'Cajas', 'required|numeric|less_than_equal_to['.$config_rules['bx'].']|integer', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>', 'less_than_equal_to' => 'Límite de <b>%s</b> excedido, disponibles: <b>'.$config_rules['bx'].'</b> cajas.', 'integer' => '<b>%s</b>, debe contener un número entero']);
         $this->form_validation->set_rules('txtweight_c', 'Kilos', 'required|numeric|less_than_equal_to['.$config_rules['kg'].']', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>', 'less_than_equal_to' => 'Límite de <b>%s</b> excedido, disponibles: <b>'.$config_rules['kg'].'</b> kg.']);
      }
      else
      {
         $this->form_validation->set_rules('txtboxes', 'Cajas', 'required|numeric|less_than_equal_to['.$config_rules['bx'].']|integer', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>',  'less_than_equal_to' => 'Límite de <b>%s</b> excedido, disponibles: <b>'.$config_rules['bx'].'</b> cajas.', 'integer' => '<b>%s</b>, debe contener un número entero']);
         $this->form_validation->set_rules('txtweight', 'Kilos', 'required|numeric|less_than_equal_to['.$config_rules['kg'].']', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>',  'less_than_equal_to' => 'Límite de <b>%s</b> excedido, disponibles: <b>'.$config_rules['kg'].'</b> kg.']);
      }
      $this->form_validation->set_rules('ctrl_boxes', 'Cajas', 'required|numeric|greater_than_equal_to[0]|integer', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>', 'greater_than_equal_to'=> '<b>%s</b>, debe ser mayor a cero (0)', 'integer' => '<b>%s</b>, debe contener un número entero']);
      $this->form_validation->set_rules('ctrl_weigth', 'Kilos', 'required|numeric|greater_than_equal_to[0]', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>', 'greater_than_equal_to'=> '<b>%s</b>, debe ser mayor a cero (0)']);
      $this->form_validation->set_rules('txtctrldestare', 'Calcular destare', 'required|numeric', ['required' => '<b>%s</b> por defecto es <b>Automático</b>. Seleccione una opción.', 'numeric' => 'Formato inválido en: <b>%s</b>']);
      $this->form_validation->set_rules('txtvaldestare', 'Calcular destare', 'numeric|greater_than_equal_to[0]', ['numeric' => 'Formato inválido en: <b>%s</b>', 'greater_than_equal_to'=> '<b>%s</b>, debe ser mayor a cero (0)']);
      if ($config_rules['sz'] === '0')
      {
         $this->form_validation->set_rules('txtquality', 'Calidad', 'required|numeric|greater_than_equal_to[0]|integer', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>', 'greater_than_equal_to'=> 'Campo requerido <b>%s</b>', 'integer' => 'Formato inválido en: <b>%s</b>']);
      }
      elseif ($config_rules['sz'] === '1')
      {
         $this->form_validation->set_rules('txtcategory', 'Categoría', 'required|numeric|greater_than_equal_to[0]|integer', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>', 'greater_than_equal_to'=> 'Campo requerido <b>%s</b>', 'integer' => 'Formato inválido en: <b>%s</b>']);
      }
      else
      {
         $this->form_validation->set_rules('txtquality', 'Calidad', 'required|numeric|greater_than_equal_to[0]|integer', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>', 'greater_than_equal_to'=> 'Campo requerido <b>%s</b>', 'integer' => 'Formato inválido en: <b>%s</b>']);
         $this->form_validation->set_rules('txtcategory', 'Categoría', 'required|numeric|greater_than_equal_to[0]|integer', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>', 'greater_than_equal_to'=> 'Campo requerido <b>%s</b>', 'integer' => 'Formato inválido en: <b>%s</b>']);
      }
      $this->form_validation->set_rules('txtdestare_b', 'Destare calculado', 'required|numeric|greater_than[0]', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>', 'greater_than'=> '<b>%s</b>, debe ser mayor a cero (0)']);
      $this->form_validation->set_rules('txttotalweight_b', 'Total kg entrada', 'required|numeric|greater_than[0]', ['required' => 'Campo requerido <b>%s</b>', 'numeric' => 'Formato inválido en: <b>%s</b>', 'greater_than'=> '<b>%s</b>, debe ser mayor a cero (0)']);
      $this->form_validation->set_error_delimiters('<li>', '</li>');
   }

   function set_info()
   {
      $sheet_arrival = $this->input->post('sheet_arrival');
      $sender        = $this->input->post('txtsender');
      $id_classify   = ($this->input->post('id_classify')) ? $this->input->post('id_classify') : NULL;
      if ($this->input->post('ctrl_size') === '0')
      {
         $ctrl_size = '0';
         $quality = (($this->input->post('txtquality'))?($this->input->post('txtquality')):(NULL));
         $category = NULL;
      }
      elseif ($this->input->post('ctrl_size') === '1')
      {
         $ctrl_size = '1';
         $quality = '1';
         $category =(($this->input->post('txtcategory'))?($this->input->post('txtcategory')):(NULL));
      }
      else
      {
         $ctrl_size = '2';
         $quality = (($this->input->post('txtquality'))?($this->input->post('txtquality')):(NULL));
         $category = (($this->input->post('txtcategory'))?($this->input->post('txtcategory')):(NULL));
      }
      $auto_complete = [
         'arrival_id'      => $this->input->post('id_arrival'),
         'boxes_c'         => $this->input->post('txtboxes'),
         'weight_c'        => round($this->input->post('txtweight'), 2),
         'type_destare'    => $this->input->post('txtctrldestare'),
         'val_destare'     => $this->input->post('txtvaldestare'),
         'destare_c'       => round($this->input->post('txtdestare_b'), 2),
         'total_weight_c'  => round($this->input->post('txttotalweight_b'), 2),
         'user_id'         => 2
      ];
      $config_rules = [
         'bx' => $this->input->post('ctrl_boxes'),
         'kg' => round($this->input->post('ctrl_weigth'), 2),
         'sz' => $ctrl_size,
         'ed' => '0'
      ];
      $this->_form_validation($config_rules);
      if ($this->form_validation->run() === FALSE)
      {
         $this->new_classify($sheet_arrival, $auto_complete);
      }
      else
      {
         $auto_complete['product_size_id'] = $this->product_model->get_product_size($this->input->post('product_id'), NULL, $quality, $category)->row()->product_size_id;
         $clfy = $this->classify_model->get_classify($sheet_arrival, NULL, $auto_complete['product_size_id']);
         $data['sheet_arrival'] = $sheet_arrival;
         $data['arrival']       = $this->buy_model->_get_arrival($sheet_arrival, NULL, NULL, NULL, NULL);
         $data['arrival_c']     = $this->classify_model->get_clone_arrival($sheet_arrival);
         $auto_complete_b = [
            'id_arrival'     => $auto_complete['arrival_id'],
            'boxes_arrival'  => $this->input->post('ctrl_boxes') - $auto_complete['boxes_c'],
            'weight_arrival' => round($this->input->post('ctrl_weigth') - $auto_complete['weight_c'], 2)
         ];

         $destare_c                       = $auto_complete['boxes_c'] * $auto_complete['val_destare'];
         $total_weight_c                  = $auto_complete['weight_c'] - ($destare_c);
         $auto_complete['destare_c']      = round($destare_c, 2);
         $auto_complete['total_weight_c'] = round($total_weight_c, 2);

         if ($clfy->num_rows() > 0)
         {
            $info_product_boxes = [
               'classify_id'    => $clfy->row()->classify_id,
               'boxes_c'        => $clfy->row()->boxes_c + $auto_complete['boxes_c'],
               'weight_c'       => round($clfy->row()->weight_c + $auto_complete['weight_c'], 2),
               'destare_c'      => round($clfy->row()->destare_c + $destare_c, 2),
               'total_weight_c' => round($clfy->row()->total_weight_c + $total_weight_c, 2)
            ];
            $data['add_product_boxes'] = TRUE;
            $this->classify_model->edit_classify($info_product_boxes);
            $this->classify_model->alter_clone_arrival($auto_complete_b);
         }
         else
         {
            $this->classify_model->save_classify($auto_complete);
            $this->classify_model->alter_clone_arrival($auto_complete_b);
         }
         $data['success_clfy']  = TRUE;
         $data['auto_complete'] = FALSE;
         $data['sheet_arrival'] = $sheet_arrival;
         $data['arrival']       = $this->buy_model->_get_arrival($sheet_arrival, NULL, NULL, NULL, NULL);
         $data['arrival_c']     = $this->classify_model->get_clone_arrival($sheet_arrival);
         if ($data['arrival']->row()->status_classify === '0')
         {
            $info_classify_c = ['sheet_arrival' => $sheet_arrival, 'status_classify' => '1'];
            $this->classify_model->change_status_classify($info_classify_c);
         }
         else
         {
            if ($data['arrival_c']->row()->boxes_arrival <= 0 OR $data['arrival_c']->row()->weight_arrival <= 0)
            {
               $info_classify_c = ['sheet_arrival' => $sheet_arrival, 'status_classify' => '2'];
               $this->classify_model->change_status_classify($info_classify_c);
               redirect('classify/index/'.$sheet_arrival, 'refresh');
            }
         }
         $data['quality']['-1'] = 'Elige una calidad';
         foreach ($this->product_model->get_product_size($data['arrival']->row()->id_product, NULL, NULL, NULL)->result() as $quality)
         {
            $data['quality'][$quality->quality_id] = $quality->description_q;
         }
         $data['category']['-1'] = 'Elige una categoría';
         foreach ($this->product_model->get_product_size($data['arrival']->row()->id_product, NULL, NULL, NULL)->result() as $quality)
         {
            $data['category'][$quality->category_id] = $quality->description_c;
         }
         $this->load->view('buy/classify/add_classify', $data);
      }
   }

   function set_info_edit()
   {
      $sheet_arrival = $this->input->post('sheet_arrival');
      $sender        = $this->input->post('txtsender');
      $id_classify   = ($this->input->post('id_classify')) ? $this->input->post('id_classify') : NULL;
      if ($this->input->post('ctrl_size') === '0')
      {
         $ctrl_size = '0';
         $quality = (($this->input->post('txtquality'))?($this->input->post('txtquality')):(NULL));
         $category = NULL;
      }
      elseif ($this->input->post('ctrl_size') === '1')
      {
         $ctrl_size = '1';
         $quality = '1';
         $category =(($this->input->post('txtcategory'))?($this->input->post('txtcategory')):(NULL));
      }
      else
      {
         $ctrl_size = '2';
         $quality = (($this->input->post('txtquality'))?($this->input->post('txtquality')):(NULL));
         $category = (($this->input->post('txtcategory'))?($this->input->post('txtcategory')):(NULL));
      }
      $auto_complete = [
         'arrival_id'      => $this->input->post('id_arrival'),
         'boxes_c'         => $this->input->post('txtboxes'),
         'weight_c'        => round($this->input->post('txtweight'), 2),
         'type_destare'    => $this->input->post('txtctrldestare'),
         'val_destare'     => $this->input->post('txtvaldestare'),
         'destare_c'       => round($this->input->post('txtdestare_b'), 2),
         'total_weight_c'  => round($this->input->post('txttotalweight_b'), 2),
         'user_id'         => 2
      ];
      $clfy      = $this->classify_model->get_classify(NULL, $id_classify, NULL);
      $arrival_c = $this->classify_model->get_clone_arrival($sheet_arrival);
      $config_rules = [
         'bx' => $this->input->post('ctrl_boxes'),
         'kg' => round($this->input->post('ctrl_weigth'), 2),
         'sz' => $ctrl_size,
         'ed' => '1'
      ];
      $this->_form_validation($config_rules);
      if ($this->form_validation->run() === FALSE)
      {
         $this->edit_classify($id_classify);
      }
      else
      {
         $auto_complete['product_size_id'] = $this->product_model->get_product_size($this->input->post('product_id'), NULL, $quality, $category)->row()->product_size_id;
         $auto_complete['classify_id'] = $id_classify;
         $boxes_c   = $this->input->post('txtboxes_c');
         $weight_c  = $this->input->post('txtweight_c');

         $auto_complete_b = [
            'id_arrival'     => $auto_complete['arrival_id'],
            'boxes_arrival'  => $arrival_c->row()->boxes_arrival - $boxes_c,
            'weight_arrival' => $arrival_c->row()->weight_arrival - $weight_c
         ];
         $this->classify_model->edit_classify($auto_complete);
         $this->classify_model->alter_clone_arrival($auto_complete_b);
         $arrival   = $this->buy_model->_get_arrival($sheet_arrival, NULL, NULL, NULL, NULL);
         $arrival_c = $this->classify_model->get_clone_arrival($sheet_arrival);
         if ($arrival->row()->status_classify === '1')
         {
            if ($arrival_c->row()->boxes_arrival <= 0 OR $arrival_c->row()->weight_arrival <= 0)
            {
               $info_classify_c = ['sheet_arrival' => $sheet_arrival, 'status_classify' => '2'];
               $this->classify_model->change_status_classify($info_classify_c);
               redirect('classify/index/'.$sheet_arrival, 'refresh');
            }
            else
            {
               $info_classify_c = ['sheet_arrival' => $sheet_arrival, 'status_classify' => '1'];
               $this->classify_model->change_status_classify($info_classify_c);
               redirect('classify/index/'.$sheet_arrival, 'refresh');
            }
         }
         else
         {
            $info_classify_c = ['sheet_arrival' => $sheet_arrival, 'status_classify' => '1'];
            $this->classify_model->change_status_classify($info_classify_c);
            redirect('classify/index/'.$sheet_arrival, 'refresh');
         }
         $type_alert = '0';
         $this->index($sheet_arrival, $type_alert);
      }
   }
}
