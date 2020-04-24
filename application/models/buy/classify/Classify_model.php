<?php

class Classify_model extends CI_Model
{
   private $table_arrival;
   private $table_arrival_c;
   private $table_category;
   private $table_classify;
   private $table_product;
   private $table_product_size;
   private $table_quality;

   function __construct()
   {
      parent:: __construct();
      $this->table_arrival      = 'arrival';
      $this->table_category     = 'category';
      $this->table_classify     = 'classify';
      $this->table_arrival_c    = 'clone_arrival';
      $this->table_product      = 'product';
      $this->table_product_size = 'product_size';
      $this->table_quality      = 'quality';
   }

   function get_classify($sheet_arrival = NULL, $classify_id = NULL, $product_size = NULL)
   {
      $this->db->join($this->table_arrival, $this->table_classify.'.arrival_id = '.$this->table_arrival.'.id_arrival');
      $this->db->join($this->table_product_size, $this->table_classify.'.product_size_id = '.$this->table_product_size.'.product_size_id');
      $this->db->join($this->table_product, $this->table_product_size.'.product_id = '.$this->table_product.'.id_product');
      $this->db->join($this->table_quality, $this->table_product_size.'.quality_id = '.$this->table_quality.'.quality_id');
      $this->db->join($this->table_category, $this->table_product_size.'.category_id = '.$this->table_category.'.category_id');

      if ($sheet_arrival)
      {
         $this->db->where($this->table_arrival.'.sheet_arrival', $sheet_arrival);
      }

      if ($classify_id)
      {
         $this->db->where($this->table_classify.'.classify_id', $classify_id);
      }

      if ($product_size)
      {
         $this->db->where($this->table_classify.'.product_size_id', $product_size);
      }

      $this->db->where($this->table_classify.'.status', '1');

      return $this->db->get($this->table_classify);
   }

   function count($sheet_arrival = NULL)
   {
      $this->db->select_sum('boxes_c', 'count_bx');
      $this->db->select_sum('weight_c', 'count_kg');
      $this->db->select_sum('total_weight_c', 'count_tot');

      $this->db->join($this->table_arrival, $this->table_classify.'.arrival_id = '.$this->table_arrival.'.id_arrival');

      if ($sheet_arrival)
      {
         $this->db->where($this->table_arrival.'.sheet_arrival', $sheet_arrival);
      }

      $this->db->where($this->table_classify.'.status', '1');

      return $this->db->get($this->table_classify);
   }

   function get_clone_arrival($sheet_arrival = NULL)
   {
      $this->db->select('sheet_arrival, boxes_arrival, weight_arrival');

      if ($sheet_arrival)
      {
         $this->db->where('sheet_arrival', $sheet_arrival);
      }

      return $this->db->get($this->table_arrival_c);
   }

   function change_status_classify($info_classify_c)
   {
      $this->db->where('sheet_arrival', $info_classify_c['sheet_arrival']);
      $this->db->update($this->table_arrival, $info_classify_c);

      return $this->db->affected_rows() > 0;
   }

   function edit_classify($info_product_boxes)
   {
      $this->db->where('classify_id', $info_product_boxes['classify_id']);
      $this->db->update($this->table_classify, $info_product_boxes);

      return $this->db->affected_rows() > 0;
   }

   function save_classify($info_classify)
   {
      $this->db->insert($this->table_classify, $info_classify);
      return $this->db->insert_id();
   }

   function alter_clone_arrival($info_classify_b)
   {
      $this->db->where($this->table_arrival_c.'.id_arrival', $info_classify_b['id_arrival']);
      $this->db->update($this->table_arrival_c, $info_classify_b);
      return $this->db->affected_rows() > 0;
   }
}
