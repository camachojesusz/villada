<?php

class Driver_model extends CI_Model
{
   private $table_employee;
   private $table_driver;

   function __construct()
   {
      parent:: __construct();
      $this->table_employee = 'employee';
      $this->table_driver   = 'driver';
   }

   function get_driver($id = NULL)
   {
      if ($id)
      {
         $this->db->where('driver_id', $id);
      }
      $this->db->where('status', '1');
      return $this->db->get($this->table_driver);
   }

   function get_employe_driver($id = NULL)
   {
      if ($id)
      {
         $this->db->where('id_employee', $id);
      }
      $this->db->where('drivercandidate_employee', '1');
      $this->db->where('status_employee', '1');
      return $this->db->get($this->table_employee);
   }

   function save_driver($info_driver = NULL)
   {
      $this->db->insert($this->table_driver, $info_driver);

      return $this->db->insert_id();
   }

   function edit_driver($info_driver = NULL)
   {
      $this->db->where('driver_id', $info_driver['driver_id']);
      $this->db->update($this->table_driver, $info_driver);

      return $this->db->affected_rows() > 0;
   }
}
