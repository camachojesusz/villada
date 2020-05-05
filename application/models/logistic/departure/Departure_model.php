<?php

class Departure_model extends CI_Model
{
   private $table_departure;
   private $table_destiny;
   private $table_driver;
   private $table_employee;
   private $table_vehicle;

   function __construct()
   {
      parent:: __construct();
      $this->table_departure = 'departure';
      $this->table_destiny   = 'destiny';
      $this->table_driver    = 'driver';
      $this->table_employee  = 'employee';
      $this->table_vehicle   = 'vehicle';
   }

   function get_last_sheet()
   {
      $this->db->select('sheet_departure');

      if ($this->db->get($this->table_departure)->last_row())
      {
         return $this->db->get($this->table_departure)->last_row();
      }
      else
      {
         return FALSE;
      }
   }

   function get_departure($departure_id = NULL)
   {
      $this->db->join($this->table_destiny, $this->table_destiny.'.destiny_id = '.$this->table_departure.'.destiny_id');
      // $this->db->join($this->table_driver, $this->table_driver.'.driver_id = '.$this->table_departure.'.driver_id');
      // $this->db->join($this->table_employee, $this->table_employee.'.id_employee = '.$this->table_departure.'.driver_id');
      $this->db->join($this->table_vehicle, $this->table_vehicle.'.vehicle_id = '.$this->table_departure.'.vehicle_id');

      if ($departure_id)
      {
         $this->db->where($this->table_departure.'.status', '1');
      }
      return $this->db->get($this->table_departure);
   }

   /*
   function get_departure($departure_id = NULL)
   {
      $this->db->join($this->table_destiny, $this->table_destiny.'.destiny_id = '.$this->table_departure.'.destiny_id');
      $this->db->join($this->table_driver, $this->table_driver.'.driver_id = '.$this->table_departure.'.driver_id');
      $this->db->join($this->table_employee, $this->table_employee.'.id_employee = '.$this->table_departure.'.driver_id');
      $this->db->join($this->table_vehicle, $this->table_vehicle.'.vehicle_id = '.$this->table_departure.'.vehicle_id');

      if ($departure_id)
      {
         $this->db->where('departure_id', $departure_id);
      }

      $this->db->where($this->table_departure.'.status', '1');

      return $this->db->get($this->table_departure);
   }
   */

   function save_departure($info_departure)
   {
      $this->db->insert($this->table_departure, $info_departure);
      return $this->db->insert_id();
   }
}
