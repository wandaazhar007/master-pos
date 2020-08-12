<?php defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $data['title']      = 'Transaksi Master POS';
    $data['contents']   = 'transaksi';
    $this->load->view('templates/core', $data);
  }
}
