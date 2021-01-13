<?php defined('BASEPATH') or exit('No direct script access allowed');

class Options extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->wandalibs->_checkLoginSession();
    $this->load->model('m_options', 'model');
  }

  function index()
  {
    $data['title']      = 'Pengaturan Aplikasi';
    $data['contents']   = 'options';
    $data['getAllDataOption'] = $this->model->getAllDataOption();
    $this->load->view('templates/core', $data);
  }
}
