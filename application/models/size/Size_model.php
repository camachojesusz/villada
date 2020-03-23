<?php

class Size_model extends CI_Model
{
   private $table_category;
   private $table_product_size;
   private $table_quality;

	public function __construct()
   {
      parent::__construct();
      $this->table_category     = 'category';
      $this->table_product_size = 'product_size';
      $this->table_quality      = 'quality';
   }

   function get_quality($quality_id = NULL)
   {
      if ($quality_id)
      {
         $this->db->where('quality_id', $quality_id);
      }

      $this->db->where('status', '1');
      $this->db->where_not_in('quality_id', 1);

      return $this->db->get($this->table_quality);

   }

   function get_category($category_id = NULL)
   {
      if ($category_id)
      {
         $this->db->where('category_id', $category_id);
      }
      $this->db->where('status', '1');
      $this->db->where_not_in('category_id', 1);

      return $this->db->get($this->table_category);
   }

   function _get_size($quality_id = NULL, $category_id = NULL)
   {

      $this->db->join($this->table_quality, $this->table_product_size.'.quality_id = '.$this->table_quality.'.quality_id');
      $this->db->join($this->table_category, $this->table_product_size.'.category_id = '.$this->table_category.'.category_id');

      if($quality_id)
      {
         $this->db->where($this->table_quality.'.quality_id', $quality_id);
      }

      if ($category_id)
      {
         $this->db->where($this->table_category.'.category_id', $category_id);
      }

      return $this->db->get($this->table_product_size);
   }

    function save_quality($info_quality)
   {
      $this->db->insert($this->table_quality, $info_quality);

      return $this->db->insert_id();
   }

   function save_category($info_category)
   {
      $this->db->insert($this->table_category, $info_category);

      return $this->db->insert_id();
   }

   function update_quality($info_quality)
   {
      $this->db->where('quality_id', $info_quality['quality_id']);
      $this->db->update($this->table_quality, $info_quality);

      return $this->db->affected_rows() > 0;
   }

   function update_category($info_category)
   {
      $this->db->where('category_id', $info_category['category_id']);
      $this->db->update($this->table_category, $info_category);

      return $this->db->affected_rows() > 0;
   }

   function save_config($auto_complete)
   {
      $this->db->insert($this->table_product_size, $auto_complete);
      return $this->db->insert_id();
   }

   function update_config($info_config)
   {
      $this->db->where('product_size_id', $info_config['product_size_id']);
      $this->db->update($this->table_product_size, $info_config);
      return $this->db->affected_rows() > 0;
   }
}
