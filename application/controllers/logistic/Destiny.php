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
      foreach ($this->size_box_model->get_info_sb()->result() as $sb)
      {
         $data['size_box'][$sb->destare_value] = $sb->description." (x".$sb->destare_value.")";
      }
      $this->load->view('logistic/destiny/index', $data);
   }
}
