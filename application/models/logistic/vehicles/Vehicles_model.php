<?php

class Vehicles_model extends CI_Model
{
   private $table_vehicle;
   private $table_vehicle_type;

   function __construct()
   {
      parent:: __construct();
      $this->table_vehicle      = 'vehicle';
      $this->table_vehicle_type = 'vehicle_type';
   }

   function get_vehicle($id = NULL)
   {
      if ($id)
      {
         $this->db->where('vehicle_id', $id);
      }
      $this->db->where('status_v', '1');
      return $this->db->get($this->table_vehicle);
   }

   function _get_vehicle($vehicle_id = NULL, $vt_id = NULL)
   {
      $this->db->join($this->table_vehicle_type, $this->table_vehicle.'.vehicle_type = '.$this->table_vehicle_type.'.vt_id');
      if ($vehicle_id)
      {
         $this->db->where($this->table_vehicle.'.vehicle_id',$vehicle_id);
      }
      if ($vt_id)
      {
         $this->db->where($this->table_vehicle_type.'.vt_id',$vt_id);
      }
      return $this->db->get($this->table_vehicle);
   }

   function get_vehicle_type($id = NULL)
   {
      if ($id)
      {
         $this->db->where('vt_id', $id);
      }
      $this->db->where('status', '1');
      return $this->db->get($this->table_vehicle_type);
   }

   function save_vehicle($info_vehicle = NULL)
   {
      $this->db->insert($this->table_vehicle, $info_vehicle);

      return $this->db->insert_id();
   }

   function save_vehicle_type($info_vt = NULL)
   {
      $this->db->insert($this->table_vehicle_type, $info_vt);

      return $this->db->insert_id();
   }

   function edit_vehicle($info_vehicle = NULL)
   {
      $this->db->where('vehicle_id', $info_vehicle['vehicle_id']);
      $this->db->update($this->table_vehicle, $info_vehicle);

      return $this->db->affected_rows() > 0;
   }

   function edit_vehicle_type($info_vt = NULL)
   {
      $this->db->where('vt_id', $info_vt['vt_id']);
      $this->db->update($this->table_vehicle_type, $info_vt);

      return $this->db->affected_rows() > 0;
   }
}
