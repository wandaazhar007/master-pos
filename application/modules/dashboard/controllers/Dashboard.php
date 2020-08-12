<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $data['title']      = 'Dashboard Master POS';
    $data['contents']   = 'v_dashboard';
    $this->load->view('templates/core', $data);
  }
}
