<?php

class Product_model extends CI_Model
{
   private $table_category;
   private $table_product;
   private $table_product_size;
   private $table_quality;

   public function __construct()
   {
      parent::__construct();
      $this->table_category     = 'category';
      $this->table_product      = 'product';
      $this->table_product_size = 'product_size';
      $this->table_quality      = 'quality';
   }

   function get_all_product($id_product = NULL)
   {
      if ($id_product != NULL)
      {
         $this->db->where('id_product', $id_product);
      }

      return $this->db->get($this->table_product);
   }

   function get_product_size($id_product = NULL, $id_size = NULL, $quality = NULL, $category = NULL)
   {
      $this->db->join($this->table_product_size, $this->table_product.'.id_product = '.$this->table_product_size.'.product_id');
      $this->db->join($this->table_quality, $this->table_product_size.'.quality_id = '.$this->table_quality.'.quality_id');
      $this->db->join($this->table_category, $this->table_product_size.'.category_id = '.$this->table_category.'.category_id');

      if ($id_product)
      {
         $this->db->where($this->table_product.'.id_product', $id_product);
      }

      if ($id_size)
      {
         $this->db->where($this->table_product_size.'.product_size_id', $id_size);
      }

      if ($quality)
      {
         $this->db->where($this->table_quality.'.quality_id', $quality);
      }

      if ($category)
      {
         $this->db->where($this->table_category.'.category_id', $category);
      }

      return $this->db->get($this->table_product);

   }

   function update_product($info_product)
   {
      $this->db->where('id_product', $info_product['id_product']);
      $this->db->update($this->table_product, $info_product);
      return $this->db->affected_rows() > 0;
   }

   function get_last_keyproduct()
   {
      $this->db->select_max('keycontrol_product');
      $this->db->from($this->table_product);
      $query = $this->db->get();
      $row = $query->row();

      if (isset($row) && !empty($row))
      {
         $last_keyregister = $row->keycontrol_product;
         if (!$comp_lastkey = strcmp('', $last_keyregister))
         {
            $last_keyregister = 1000;
            $new_key = $last_keyregister + 1;
            return $new_key;
         }
         $new_key = $last_keyregister + 1;
         return $new_key;
      }
      else
      {
         return FALSE;
      }
   }

   function save_product($info_product)
   {
      $this->db->insert($this->table_product, $info_product);
      return $this->db->insert_id();
   }
}
