<?php

class Destiny_model extends CI_Model
{
   private $table_destiny;

   function __construct()
   {
      parent:: __construct();
      $this->table_destiny = 'destiny';
   }

   function get_destiny($id = NULL)
   {
      if ($id)
      {
         $this->db->where('destiny_id', $id);
      }
      $this->db->where('status', '1');
      return $this->db->get($this->table_destiny);
   }

   function save_destiny($info_destiny = NULL)
   {
      $this->db->insert($this->table_destiny, $info_destiny);

      return $this->db->insert_id();
   }

   function edit_destiny($info_destiny = NULL)
   {
      $this->db->where('destiny_id', $info_destiny['destiny_id']);
      $this->db->update($this->table_destiny, $info_destiny);

      return $this->db->affected_rows() > 0;
   }
}
