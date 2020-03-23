<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Size extends CI_Controller
{
   public function __construct()
   {
      parent:: __construct();
      $this->load->model('size/size_model');
      $this->load->model('product/product_model');
   }

   function index()
   {
   	$data['quality'] = $this->size_model->get_quality()->result();
      $data['category'] = $this->size_model->get_category()->result();
      $this->load->view('size/index', $data);
   }

   function config_size($product_id = NULL)
   {
      $data['info_product'] = $this->product_model->get_all_product($product_id);
   	$data['allsize'] = $this->product_model->get_product_size($product_id, NULL, NULL, NULL);
   	foreach ($this->size_model->get_quality()->result() as $qualities)
   	{
   		$data['qualities'][$qualities->quality_id] = $qualities->description_q;
   	}
   	foreach ($this->size_model->get_category()->result() as $categories)
   	{
   		$data['categories'][$categories->category_id] = $categories->description_c;
   	}
   	$this->load->view('product/config_size', $data);
   }

   function _form_validation($config_rules = NULL)
   {
   	$this->load->library('form_validation');
   	$this->form_validation->set_rules('txtsender', 'txtsender', 'required|integer', ['required' => 'Error de <b>%s</b>', 'integer' => 'Error de <b>%s</b>']);
      $this->form_validation->set_rules('auxiliar_sender', 'auxiliar_sender', 'integer', ['integer' => 'Error de <b>%s</b>']);
      switch (($config_rules['ctrl_rules']) ? $config_rules['ctrl_rules'] : NULL)
      {
         case '0':
            $this->form_validation->set_rules('txtidproduct', 'txtidproduct', 'required', ['required' => 'Error de <b>%s</b>']);
            if ($config_rules['sz'] === '0')
            {
               $this->form_validation->set_rules('qualities', 'Calidad', 'integer', ['integer' => 'Error en: <b>%s</b>, inténtalo más tarde']);
            }
            if ($config_rules['sz'] === '1')
            {
               $this->form_validation->set_rules('categories', 'Categoría', 'integer', ['integer' => 'Error en: <b>%s</b>, inténtalo más tarde']);
            }
            if ($config_rules['sz'] === '2')
            {
               $this->form_validation->set_rules('qualities', 'Calidad', 'integer', ['integer' => 'Error en: <b>%s</b>, inténtalo más tarde']);
               $this->form_validation->set_rules('categories', 'Categoría', 'integer', ['integer' => 'Error en: <b>%s</b>, inténtalo más tarde']);
            }
            break;
         case '1':
            if ($config_rules['sz'] === '0')
            {
               $this->form_validation->set_rules('txtdescribe_q', 'Calidad', 'required|trim', ['required' => 'Campo requerido, <b>%s</b>', 'trim' => 'Formato inválido en: <b>%s</b>']);
            }
            else
            {
               $this->form_validation->set_rules('txtdescribe_c', 'Categoría','required|trim',['required' => 'Campo requerido, <b>%s</b>', 'trim' => 'Formato invalido en: <b>&s</b>']);
            }
            break;
         default:
            return FALSE;
            break;
      }
   	$this->form_validation->set_error_delimiters('<li>', '</li>');
   }

   function set_info_cs()
   {
      $config_rules = ['ctrl_rules' => '0'];
      $auxiliar_sender = implode(',', $this->input->post('auxiliar_sender'));
      switch ($auxiliar_sender)
      {
         case '0':
            $config_rules['sz'] = '0';
            $qualities          = $this->input->post('qualities');
            $categories[]       = '1';
            break;

         case '1':
            $config_rules['sz'] = '1';
            $qualities[]        = '1';
            $categories         = $this->input->post('categories');
            break;

         case '0,1':
            $config_rules['sz'] = '2';
            $qualities          = $this->input->post('qualities');
            $categories         = $this->input->post('categories');
            break;

         default:
            $config_rules['sz'] = NULL;
            $qualities[]        = NULL;
            $categories[]       = NULL;
            break;
      }
      $product_id = $this->input->post('txtidproduct');
      $product    = $this->product_model->get_all_product($product_id);
      $this->_form_validation($config_rules);
      if ($this->form_validation->run() === FALSE)
      {
         $data['info_product'] = $product;
      	$data['allsize']      = $this->product_model->get_product_size($product_id, NULL, NULL, NULL);
      	foreach ($this->size_model->get_quality()->result() as $qualities)
      	{
      		$data['qualities'][$qualities->quality_id] = $qualities->description_q;
      	}
      	foreach ($this->size_model->get_category()->result() as $categories)
      	{
      		$data['categories'][$categories->category_id] = $categories->description_c;
      	}
      	$this->load->view('product/config_size', $data);
      }
      else
      {
         if ($this->input->post('txtsender') === '0')
         {
            foreach ($categories as $cat)
            {
               foreach ($qualities as $qt)
               {
                  $auto_complete = [
                     'product_id'  => $product_id,
                     'quality_id'  => $qt,
                     'category_id' => $cat,
                     'user_id'     => 1
                  ];
                  $this->size_model->save_config($auto_complete);
               }
            }
            $data['create_config_size'] = TRUE;
         }
         else
         {
            $config_size = $this->product_model->get_product_size($product_id, NULL, implode('', $qualities), implode('', $categories));
            if ($config_size->num_rows() === 0)
            {
               $auto_complete = [
                  'product_size_id' => $this->input->post('config_id'),
                  'quality_id'      => implode('', $qualities),
                  'category_id'     => implode('', $categories)
               ];
               $this->size_model->update_config($auto_complete);
               $data['edit_alert'] = '0';
            }
            else
            {
               $data['edit_alert'] = '1';
            }
         }
         $data['info_product'] = $product;
      	$data['allsize']      = $this->product_model->get_product_size($product_id, NULL, NULL, NULL);
      	foreach ($this->size_model->get_quality()->result() as $qualities)
      	{
      		$data['qualities'][$qualities->quality_id] = $qualities->description_q;
      	}
      	foreach ($this->size_model->get_category()->result() as $categories)
      	{
      		$data['categories'][$categories->category_id] = $categories->description_c;
      	}
      	$this->load->view('product/config_size', $data);
      }
   }

   function set_info()
   {
      $config_rules = ['ctrl_rules' => '1'];
      $auxiliar_sender = $this->input->post('auxiliar_sender');
      if ($auxiliar_sender === '0')
      {
         $config_rules['sz'] = '0';
      }
      else
      {
         $config_rules['sz'] = '1';
      }
      $this->_form_validation($config_rules);
      if ($this->form_validation->run() === FALSE)
      {
         $this->index();
      }
      else
      {
         $sender = $this->input->post('txtsender');
         if ($auxiliar_sender === '0')
         {
            $auto_complete = [
               'quality_id'    => $this->input->post('quality_id'),
               'description_q' => mb_strtoupper($this->input->post('txtdescribe_q')),
               'user_id'       => 1
            ];
            if ($sender === '0')
            {
               $this->size_model->save_quality($auto_complete);
               $data['success_quality'] = TRUE;
            }
            else
            {
               $this->size_model->update_quality($auto_complete);
               $data['update_quality'] = TRUE;
            }
         }
         else
         {
            $auto_complete = [
               'category_id'   => $this->input->post('category_id'),
               'description_c' => mb_strtoupper($this->input->post('txtdescribe_c')),
               'user_id'       => 1
            ];
            if ($sender === '0')
            {
               $this->size_model->save_category($auto_complete);
               $data['success_category'] = TRUE;
            }
            else
            {
               $this->size_model->update_category($auto_complete);
               $data['update_category'] = TRUE;
            }
         }
         $data['quality'] = $this->size_model->get_quality()->result();
         $data['category'] = $this->size_model->get_category()->result();
         $this->load->view('size/index', $data);
      }
   }

   function status_config($config_id = NULL, $product_id = NULL)
   {
      $info_config = [
         'product_size_id' => $config_id,
         'status_ps' => ($this->product_model->get_product_size(NULL, $config_id, NULL, NULL)->row()->status_ps === '1') ? '0' : '1'
      ];
      $this->size_model->update_config($info_config);
      $data['status_alert'] = $info_config['status_ps'];
      $data['info_product'] = $this->product_model->get_all_product($product_id);
   	$data['allsize'] = $this->product_model->get_product_size($product_id, NULL, NULL, NULL);
   	foreach ($this->size_model->get_quality()->result() as $qualities)
   	{
   		$data['qualities'][$qualities->quality_id] = $qualities->description_q;
   	}
   	foreach ($this->size_model->get_category()->result() as $categories)
   	{
   		$data['categories'][$categories->category_id] = $categories->description_c;
   	}
   	$this->load->view('product/config_size', $data);
   }

   function status_size($ctrl_status = NULL, $id_size = NULL)
   {
      switch ($ctrl_status)
      {
         case '0':
            $info_size = [
               'quality_id' => $id_size,
               'status' => ($this->size_model->get_quality($id_size)->row()->status === '1') ? '0' : '1'
            ];
            if ($this->product_model->get_product_size(NULL, NULL, $id_size, NULL)->num_rows() > 0)
            {
               $data['status_alert_a'] = '0';
            }
            else
            {
               $this->size_model->update_quality($info_size);
               $data['status_alert_a'] = '1';
            }
            break;
         case '1':
            $info_size = [
               'category_id' => $id_size,
               'status' => ($this->size_model->get_category($id_size)->row()->status === '1') ? '0' : '1'
            ];
            if ($this->product_model->get_product_size(NULL, NULL, NULL, $id_size)->num_rows() > 0)
            {
               $data['status_alert_b'] = '0';
            }
            else
            {
               $this->size_model->update_category($info_size);
               $data['status_alert_b'] = '1';
            }
            break;
         default:
            return FALSE;
            break;
      }
      $data['quality'] = $this->size_model->get_quality()->result();
      $data['category'] = $this->size_model->get_category()->result();
      $this->load->view('size/index', $data);
   }
}
