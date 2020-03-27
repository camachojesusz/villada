<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Driver_index extends CI_Controller
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
}
