<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Logistic_index extends CI_Controller
{
   function __construct()
   {
      parent:: __construct();
      $this->load->model('logistic/departure/departure_model');
   }

   function index()
   {
      $data['departure'] = $this->departure_model->get_departure(5, NULL)->result();
      $this->load->view('logistic/lg/index', $data);
   }
}
