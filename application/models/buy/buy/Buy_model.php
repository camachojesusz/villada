<?php

class Buy_model extends CI_Model
{
   private $table_arrival;
   private $table_arrival_c;
   private $table_origin;
   private $table_producer;
   private $table_product;
   private $table_supply;

   function __construct()
   {
      parent::__construct();
      $this->table_arrival  = 'arrival';
      $this->table_arrival_c = 'clone_arrival';
      $this->table_origin   = 'origin';
      $this->table_producer = 'producer';
      $this->table_product  = 'product';
      $this->table_supply   = 'supply';
   }

   function get_last_sheet()
   {
      //Encuentra el último folio y genera el siguiente
      $this->db->select_max('sheet_arrival');
      $this->db->select('YEAR(NOW()) AS actual_year');

      $this->db->from($this->table_arrival);

      $query = $this->db->get();
      $row = $query->row();

      if (isset($row) && !empty($row))
      {

         $last_yearregister = $row->sheet_arrival / 100000000;
         $actual_year = $row->actual_year;

         if (floor($last_yearregister) != $actual_year)
         {
            $new_sheet = $actual_year * 100000000 + 1;
         }
         else
         {
            $new_sheet = $row->sheet_arrival + 1;
         }

         return $new_sheet;
      }
      else
      {
         return FALSE;
      }
   }

   function get_product($id_product = NULL)
   {
      if ($id_product)
      {
         $this->db->where('id_product', $id_product);
      }

      $this->db->where('status_product', '1');

      return $this->db->get($this->table_product);
   }

   function get_producer($id = NULL)
   {

      $this->db->distinct();
      if ($id)
      {
         $this->db->where('noctrl_e_producer', $id);
      }

      $this->db->where('status_producer', '1');

      return $this->db->get($this->table_producer);
   }

   function get_origin($id = NULL, $producer = NULL)
   {
      if ($id)
      {
         $this->db->where('id_origin', $id);
      }

      if($producer)
      {
         $this->db->where('producer_origin', $producer);
      }

      $this->db->where('status_origin', '1');

      return $this->db->get($this->table_origin);
   }

   function _get_supply($product = NULL, $producer = NULL, $origin = NULL)
   {
      $this->db->join($this->table_supply, $this->table_supply.'.product_supply ='.$this->table_product.'.id_product');
      $this->db->join($this->table_origin, $this->table_origin.'.id_origin = '.$this->table_supply.'.origin_supply');
      $this->db->join($this->table_producer, $this->table_producer.'.noctrl_e_producer = '.$this->table_origin.'.producer_origin');

      if ($product)
      {
         $this->db->distinct();
         $this->db->select($this->table_producer.'.id_producer, '.$this->table_producer.'.noctrl_producer, '.$this->table_producer.'.describe_producer');
         $this->db->where($this->table_product.'.id_product', $product);
      }

      if ($producer)
      {
         $this->db->select($this->table_origin.'.id_origin, '.$this->table_origin.'.describe_origin');
         $this->db->where($this->table_producer.'.id_producer', $producer);
      }

      if ($origin)
      {
         $this->db->select($this->table_supply.'.id_supply');
         $this->db->where($this->table_origin.'.id_origin', $origin);
      }

      return $this->db->get($this->table_product);
   }

   function _get_arrival($arrival = NULL, $supply = NULL, $producer = NULL, $product = NULL, $origin = NULL)
   {
      $this->db->join($this->table_supply, $this->table_arrival.'.supply_arrival = '.$this->table_supply.'.id_supply');
      $this->db->join($this->table_origin, $this->table_supply.'.origin_supply = '.$this->table_origin.'.id_origin');
      $this->db->join($this->table_product, $this->table_supply.'.product_supply = '.$this->table_product.'.id_product');
      $this->db->join($this->table_producer, $this->table_origin.'.producer_origin = '.$this->table_producer.'.noctrl_e_producer');

      if ($arrival)
      {
         $this->db->where('sheet_arrival', $arrival);
         $this->db->or_where('id_arrival', $arrival);
      }

      if ($supply)
      {
         $this->db->select($this->table_supply.'.id_supply');
      }

      if ($producer)
      {
         $this->db->select($this->table_origin.'.id_origin,'.$this->table_origin.'.describe_origin');
         $this->db->where($this->table_producer.'.id_producer', $producer);
      }

      if ($product)
      {
         $this->db->distinct();
         $this->db->select($this->table_producer.'.id_producer, '.$this->table_producer.'.noctrl_producer, '.$this->table_producer.'.describe_producer');
         $this->db->where($this->table_product.'.id_product', $product);
      }

      if ($origin)
      {
         $this->db->where($this->table_origin.'.id_origin', $origin);
      }

      $this->db->where($this->table_arrival.'.status_arrival', '1');

      return $this->db->get($this->table_arrival);
   }

   function save_buy($info_buy)
   {
      $this->db->insert($this->table_arrival, $info_buy);
      $this->db->insert($this->table_arrival_c, $info_buy);

      return $this->db->insert_id();
   }

   function update_buy($info_buy)
   {
      $this->db->where($this->table_arrival.'.sheet_arrival', $info_buy['sheet_arrival']);
      $this->db->update($this->table_arrival, $info_buy);

      $this->db->where($this->table_arrival_c.'.sheet_arrival', $info_buy['sheet_arrival']);
      $this->db->update($this->table_arrival_c, $info_buy);

      return $this->db->affected_rows() > 0;
   }
}
