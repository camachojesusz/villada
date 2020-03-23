<?php
   class Producer_model extends CI_Model
   {
      private $table_origin;
      private $table_producer;
      private $table_product;
      private $table_supply;
      private $table_states;

      function __construct()
      {
         parent::__construct();
         $this->table_origin   = 'origin';
         $this->table_producer = 'producer';
         $this->table_product  = 'product';
         $this->table_supply   = 'supply';
         $this->table_states   = 'states';
      }

      function get_states()
      {
         $this->db->where('status', '1');
         return $this->db->get($this->table_states);
      }

      function get_all_producer($id = NULL)
      {
         if ($id)
         {
            $this->db->where('id_producer', $id);
         }
         return $this->db->get($this->table_producer);
      }

      function update_producer($info_producer)
      {
         $this->db->where('noctrl_e_producer', $info_producer['noctrl_e_producer']);
         $this->db->update($this->table_producer, $info_producer);

         return $this->db->affected_rows() > 0;
      }

      function get_info_producer($key_producer)
      {
         $this->db->where('noctrl_e_producer ',$key_producer);
         $this->db->or_where('describedocument_producer', $key_producer);

         return $this->db->get($this->table_producer);
      }

      function get_origin($id_producer = NULL)
      {
         $this->db->select('id_origin, describe_origin, location_origin, status_origin');
         if($id_producer)
         {
            $this->db->where('producer_origin', $id_producer);
         }

         //$this->db->where('status_origin', '1');
         return $this->db->get($this->table_origin);
      }

      function get_supply($id_origin = NULL, $id_product = NULL)
      {

         $this->db->select($this->table_supply.'.id_supply, '.$this->table_supply.'.origin_supply, '.$this->table_supply.'.status_supply, '.$this->table_supply.'.product_supply');
         $this->db->select($this->table_product.'.id_product, '.$this->table_product.'.key_product, '.$this->table_product.'.describe_product');

         $this->db->join($this->table_product, $this->table_supply.'.product_supply = '.$this->table_product.'.id_product');

         if($id_origin)
         {
            //Busqueda por Origen
            $this->db->where($this->table_supply.'.origin_supply', $id_origin);
         }

         if ($id_product)
         {
            //Busqueda por producto(s)
            $this->db->where($this->table_supply.'.product_supply', $id_product);
         }

         return $this->db->get($this->table_supply);

      }

      function get_product($id = NULL)
      {
         if ($id)
         {
            $this->db->where( 'id_product', $id);
         }

         $this->db->where( 'status_product', '1');

         return $this->db->get($this->table_product)->result();
      }

      function get_last_controlnumber()
      {
         $this->db->select_max('noctrl_producer');
         $this->db->select('YEAR(NOW()) AS actual_year');

         $this->db->from($this->table_producer);

         $query = $this->db->get();
         $row = $query->row();

         if (isset($row) && !empty($row))
         {
            $last_yearregister = $row->noctrl_producer / 10000;
            $actual_year = $row->actual_year;

            if (floor($last_yearregister) != $actual_year)
            {
               $new_controlnumber = $actual_year * 10000 + 1;
            }
            else
            {
               $new_controlnumber = $row->noctrl_producer + 1;
            }
            return $new_controlnumber;
         }
         else
         {
            return FALSE;
         }
      }

      function save_producer($info_producer)
      {
         $this->db->insert($this->table_producer, $info_producer);
         return $this->db->insert_id();
      }

      function save_origin($info_origin)
      {
         $this->db->insert($this->table_origin, $info_origin);

         $this->db->select_max('id_origin');

         $this->db->where('producer_origin', $info_origin['producer_origin']);
         $this->db->where('describe_origin', $info_origin['describe_origin']);

         return $this->db->get($this->table_origin)->result();
      }

      function insert_product($info_supply)
      {

         $this->db->insert($this->table_supply, $info_supply);
         return $this->db->insert_id();

      }

      function edit_origin($info_origin)
      {
         $this->db->where('id_origin', $info_origin['id_origin']);
         $this->db->update($this->table_origin, $info_origin);
         return $this->db->affected_rows() > 0;
      }
   }
