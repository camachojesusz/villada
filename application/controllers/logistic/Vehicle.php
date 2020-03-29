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
      $data['vehicle'] = $this->vehicles_model->get_vehicle()->result();
      $this->load->view('logistic/vehicle/index');
   }
}
