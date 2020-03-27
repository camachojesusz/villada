<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Logistic_index extends CI_Controller
{
   function __construct()
   {
      parent:: __construct();
      $this->load->model('logistic/driver/driver_model');
      $this->load->model('logistic/vehicles/vehicles_model');
   }

   function index()
   {
      $this->load->view('logistic/lg/index');
   }
}
