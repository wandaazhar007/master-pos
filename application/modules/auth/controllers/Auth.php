<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $data['title']      = 'Selamat Datang';
    $this->load->view('login', $data);
  }
}
