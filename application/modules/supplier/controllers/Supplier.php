<?php defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $data['title']      = 'Data Supplier Master POS';
    $data['contents']   = 'supplier';
    $this->load->view('templates/core', $data);
  }
}
