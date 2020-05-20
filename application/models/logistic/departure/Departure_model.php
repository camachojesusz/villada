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

      return $this->db->get($this->table_departure)->last_row();
   }

   function get_departure($limit = NULL , $departure_id = NULL, $driver_type = NULL, $driver_id = NULL)
   {
      $this->db->join($this->table_destiny, $this->table_destiny.'.destiny_id = '.$this->table_departure.'.destiny_id');
      $this->db->join($this->table_vehicle, $this->table_vehicle.'.vehicle_id = '.$this->table_departure.'.vehicle_id');

      if ($driver_type ==='0')
      {
         $this->db->select($this->table_departure.'.*');
         $this->db->select($this->table_driver.'.driver_id');
         $this->db->select($this->table_driver.'.sheet_licence');
         $this->db->select($this->table_driver.'.name');
         $this->db->select($this->table_driver.'.ap1');
         $this->db->join($this->table_driver, $this->table_driver.'.driver_id = '.$this->table_departure.'.driver_id');
         $this->db->where($this->table_driver.'.driver_id', $driver_id);
      }

      if ($driver_type ==='1')
      {
         $this->db->select($this->table_departure.'.*');
         $this->db->select($this->table_employee.'.id_employee');
         $this->db->select($this->table_employee.'.sheetlicence_employee');
         $this->db->select($this->table_employee.'.name_employee');
         $this->db->select($this->table_employee.'.ap1_employee');
         $this->db->join($this->table_employee, $this->table_employee.'.id_employee = '.$this->table_departure.'.driver_id');
         $this->db->where($this->table_employee.'.id_employee', $driver_id);
      }

      if ($limit)
      {
         $this->db->limit($limit);
         $this->db->order_by($this->table_departure.'.departure_id', 'DESC');
      }

      if ($departure_id)
      {
         $this->db->where($this->table_departure.'.departure_id', $departure_id);
      }

      $this->db->where($this->table_departure.'.status', '1');

      return $this->db->get($this->table_departure);
   }

   function save_departure($info_departure)
   {
      $this->db->insert($this->table_departure, $info_departure);
      return $this->db->insert_id();
   }

   function edit_departure($info_departure = NULL)
   {
      $this->db->where('departure_id', $info_departure['departure_id']);
      $this->db->update($this->table_departure, $info_departure);

      return $this->db->affected_rows() > 0;
   }
}
