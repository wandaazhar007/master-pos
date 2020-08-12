<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $data['title']      = 'Data Pelanggan Master POS';
    $data['contents']   = 'pelanggan';
    $this->load->view('templates/core', $data);
  }
}
