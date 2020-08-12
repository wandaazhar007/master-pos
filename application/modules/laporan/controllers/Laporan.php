<?php defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
  }

  function penjualan()
  {
    $data['title']      = 'Laporan Master POS';
    $data['contents']   = 'penjualan';
    $this->load->view('templates/core', $data);
  }

  function labaRugi()
  {
    $data['title']      = 'Laporan Master POS';
    $data['contents']   = 'laba_rugi';
    $this->load->view('templates/core', $data);
  }

  function stokMasuk()
  {
    $data['title']      = 'Laporan Master POS';
    $data['contents']   = 'stok_masuk';
    $this->load->view('templates/core', $data);
  }

  function stokKeluar()
  {
    $data['title']      = 'Laporan Master POS';
    $data['contents']   = 'stok_keluar';
    $this->load->view('templates/core', $data);
  }
}
