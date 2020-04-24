<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller
{
   public function __construct()
   {
      parent:: __construct();
      $this->load->model('product/product_model');
      $this->load->model('producer/producer_model');
   }

   function index()
   {
      $data['allproduct'] = $this->product_model->get_all_product()->result();
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

   function size()
   {
      $data['size'] = $this->product_model->get_quality();
      $data['allsize'] = $this->product_model->get_category();
      $this->load->view('product/config_size', $data);

   }

   function _form_validation()
   {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('txtdescribe', 'Producto', 'required', ['required' => '<b>%s</b>, campo requerido']);
      $this->form_validation->set_rules('txtcharacter', 'Descripción', 'trim', ['trim' => 'Formato invalido en: <b>%s</b>']);
      $this->form_validation->set_rules('ctrl_size_new', 'Tamaños', 'numeric', ['numeric' => 'Elija una o más opciones par aagregar <b>%s</b>']);
      $this->form_validation->set_rules('ctrl_size_edit', 'Tamaños', 'numeric', ['numeric' => 'Elija una o más opciones par aagregar <b>%s</b>']);
      $this->form_validation->set_error_delimiters('<li>', '</li>');
   }

   function set_info()
   {
      $txtsender = $this->input->post('txtsender');
      $auto_complete = [
         'id_product'        => $this->input->post('txtidproduct'),
         'key_product'       => $this->input->post('txtkey'),
         'describe_product'  => trim(mb_strtoupper($this->input->post('txtdescribe'))),
         'character_product' => trim(mb_strtoupper($this->input->post('txtcharacter'))),
         'ctrl_size'         => ((count($this->input->post('ctrl_size')) > 1) ? implode(',', $this->input->post('ctrl_size')) : implode('', $this->input->post('ctrl_size'))),
         'iduser_product'    => 1 //usuario que realiza la accion
      ];

      $this->_form_validation();
      if ($this->form_validation->run() === FALSE)
      {
         $data['allproduct'] = $this->product_model->get_product_size()->result();
         $data['auto_complete'] = $auto_complete;
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
      else
      {
         if ($txtsender === '0')
         {
            $auto_complete['key_product']        = 'HV-'.$this->product_model->get_last_keyproduct();
            $auto_complete['keycontrol_product'] = $this->product_model->get_last_keyproduct();
            $this->product_model->save_product($auto_complete);
            $auto_complete = FALSE;
            $data['succes_product'] = TRUE;
            $data['allproduct']     = $this->product_model->get_all_product()->result();
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
         else
         {
            $this->product_model->update_product($auto_complete);
            $data['success_updateproduct'] = TRUE;
            $auto_complete                 = FALSE;
            $data['allproduct']            = $this->product_model->get_all_product()->result();
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
   }

   function delete_product($product_id)
   {
      if ($this->producer_model->get_supply(NULL, $product_id)->num_rows() > 0)
      {
         $data['alert_delete_product'] = '0';
      }
      else
      {
         $info_product = [
            'id_product' => $product_id,
            'status_product' => '0'
         ];
         $this->product_model->update_product($info_product);
         $data['alert_delete_product'] = '1';
      }

      $data['allproduct'] = $this->product_model->get_all_product()->result();
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

   function active($product_id)
   {
      $info_product =[
         'id_product'=>$product_id,
         'status_product' =>'1'
      ];
      $this->product_model->update_product($info_product);
      $data['success_updateproduct'] =    TRUE;
      $data['allproduct'] = $this->product_model->get_all_product()->result();
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
