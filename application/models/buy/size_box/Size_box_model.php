<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Size_box_model extends CI_Model
{
   private $table_sb;
   function __construct()
   {
      parent::__construct();
      $this->table_sb = 'size_box';
   }

   function get_info_sb($id = NULL, $default_size_box = NULL)
   {
      if ($id)
      {
         $this->db->where('id', $id);
      }

      if ($default_size_box)
      {
         $this->db->where('default_value', $default_size_box);
      }

      $this->db->order_by('default_value', 'DESC');

      $this->db->where('status', '1');

      return $this->db->get($this->table_sb);
   }

   function changue_default($id_sb, $new_default)
   {
      $this->db->set('default_value', $new_default);
      $this->db->where('id', $id_sb);
      $this->db->update($this->table_sb);
      return $this->db->affected_rows() > 0;
   }

   function update_sb($info_sb)
   {
      $this->db->where('id', $info_sb['id']);
      $this->db->update($this->table_sb, $info_sb);
      return $this->db->affected_rows() > 0;
   }

   function save_sb($info_sb)
   {
      $this->db->insert($this->table_sb, $info_sb);
      return $this->db->insert_id();
   }
}
