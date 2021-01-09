<?php defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('m_profile', 'model');
  }

  function myProfile($iduser_admin)
  {
    $name_sesssion = $this->session->userdata('name');
    $data['title']        = $name_sesssion;
    $data['contents']     = 'v_profile';
    $data['getUser']      = $this->model->getUser($iduser_admin);

    $this->load->view('templates/core', $data);
  }
}
