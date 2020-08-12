<?php defined('BASEPATH') or exit('No direct script access allowed');

class Stok extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
  }

  function stokMasuk()
  {
    $data['title']      = 'Data Stok Master POS';
    $data['contents']   = 'stok_masuk';
    $this->load->view('templates/core', $data);
  }
  function stokKeluar()
  {
    $data['title']      = 'Data Stok Master POS';
    $data['contents']   = 'stok_keluar';
    $this->load->view('templates/core', $data);
  }
}
