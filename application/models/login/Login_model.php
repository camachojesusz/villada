<?php
class Login_model extends CI_Model
{

  private $table_users;
  function __construct()
  {
    parent::__construct();
    $this->table_users = 'users';
  }

  function find_user($data)
  {

    $arrary_infouser = $data['info_user'];

    $this->db->select('username_users, employee_users, profile_users');
    $this->db->from($this->table_users);
    $this->db->where("username_users = '".$arrary_infouser['user_name']."' AND userpass_users ='".$arrary_infouser['user_pass']."'");
    $query = $this->db->get();

    if ($query->num_rows() > 0)
    {
      return $query;
    }
    else
    {
      //No Encontrado
      $data['user_false'] = TRUE;
      $data['info_user'] = $arrary_infouser;
      $this->load->view('login/index',$data);
    }
  }

}
