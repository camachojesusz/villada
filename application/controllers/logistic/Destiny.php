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
      $this->load->view('logistic/destiny/index', $data);
   }

   function new()
   {
      foreach ($this->size_box_model->get_info_sb()->result() as $sb)
      {
         $data['size_box'][$sb->destare_value] = $sb->description." (x".$sb->destare_value.")";
      }
      $data['states']['-1'] = 'Elige una opción';
      foreach ($this->destiny_model->get_states()->result() as $states)
      {
         $data['states'][$states->name] = $states->name.' ('.$states->abrev.')';
      }
      $this->load->view('logistic/destiny/new', $data);
   }

   function edit($destiny_id)
   {
      foreach ($this->size_box_model->get_info_sb()->result() as $sb)
      {
         $data['size_box'][$sb->destare_value] = $sb->description." (x".$sb->destare_value.")";
      }
      $data['states']['-1'] = 'Elige una opción';
      foreach ($this->destiny_model->get_states()->result() as $states)
      {
         $data['states'][$states->name] = $states->name.' ('.$states->abrev.')';
      }
      $this->load->view('logistic/destiny/edit', $data);
   }

   function status($status = NULL, $destiny_id = NULL)
   {
      $info_destiny = [
         'destiny_id' => $destiny_id,
         'status' => ($status === '1') ? '0' : '1'
      ];
      $this->destiny_model->update_destiny($info_destiny);
      $data['status_alert'] = $info_destiny['status'];
      $data['destiny'] = $this->destiny_model->get_destiny()->result();
      $this->load->view('logistic/destiny/index', $data);
   }
}
