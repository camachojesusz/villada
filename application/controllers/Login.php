<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

  public function __construct(){
    parent:: __construct();
    $this->load->model('login/login_model');
  }

	function index()
	{
		$this->load->view('login/index');
	}

  function is_post()
  {

    $data['info_user'] = [
      'user_name' => $txt_user = $this->input->post('txtuser'),
      'user_pass' => $txt_pass = $this->input->post('txtpass')
    ];

    $find_user = $this->login_model->find_user($data);

    if ($find_user)
    {

      $chargedata = [
        'name'   => $find_user->name_user,
        'type'   => $find_user->profile_user,
        'status' =>TRUE
      ];
      $this->session->set_userdata($chargedata);

      redirect('login/in_sess');
    }

  }

  function in_sess()
  {
    if($this->session->status)
    {
      $data = array();
      $data['nam_ses'] = $this->session->name;
      $this->load->view('login/home', $data);
    }
    else
    {
      redirect('login');
    }
  }

  function cs_sess()
  {
    $this->session->sess_destroy();
    redirect('login', 'refresh');
  }
}
