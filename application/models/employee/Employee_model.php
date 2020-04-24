<?php
class Employee_model extends CI_Model
{
   private $table_profile;
   private $table_employee;
   private $table_users;
   private $table_states;

   public function __construct()
   {
      parent::__construct();
      $this->table_profile  = 'profile';
      $this->table_employee = 'employee';
      $this->table_users    = 'users';
      $this->table_states   = 'states';
   }

   function get_states()
   {
      $this->db->where('status', '1');
      return $this->db->get($this->table_states);
   }

   function get_profile()
   {
      $this->db->where('status_profile', '1');
      return $this->db->get($this->table_profile);
   }

   function update_user($info_user)
   {
      $this->db->where('id_users', $info_user['id_users']);
      $this->db->update($this->table_users, $info_user);

      return $this->db->affected_rows() > 0;
   }

   function update_employee($info_employee)
   {
      $this->db->where('id_employee', $info_employee['id_employee']);
      $this->db->update($this->table_employee, $info_employee);

      return $this->db->affected_rows() > 0;
   }

   function get_employee_profile($id_employee = NULL)
   {
      $this->db->join($this->table_employee, $this->table_users.'.employee_users ='.$this->table_employee.'.id_employee');
      $this->db->join($this->table_profile, $this->table_users.'.profile_users ='.$this->table_profile.'.id_profile');
      if ($id_employee)
      {
         $this->db->where($this->table_employee.'.id_employee', $id_employee);
      }

      return $this->db->get($this->table_users);

   }

   function get_employee($curp = NULL, $sheetlicence = NULL)
   {
      if ($curp != NULL)
      {
         $this->db->where('curp_employee', $curp);
      }
      if ($sheetlicence != NULL)
      {
         $this->db->where('sheetlicence_employee', $sheetlicence);
      }

      return $this->db->get($this->table_employee);
   }

   function get_user($username=NULL)
   {
      if ($username)
      {
         $this->db->where('username_users', $username);
      }

      return $this->db->get($this->table_users);
   }

   function save_employee($info_employee)
   {
      $this->db->insert($this->table_employee, $info_employee);

      $this->db->select('id_employee');
      $this->db->where('curp_employee', $info_employee['curp_employee']);

      $query = $this->db->get($this->table_employee);

      return $query->result();
   }

   function save_user($info_user)
   {
      $this->db->insert($this->table_users, $info_user);
      return $this->db->insert_id();
   }
}
