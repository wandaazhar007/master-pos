<?php defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
  }

  function dataProduk()
  {
    $data['title']      = 'Data Produk Master POS';
    $data['contents']   = 'data_produk';
    $this->load->view('templates/core', $data);
  }

  function kategoriProduk()
  {
    $data['title']      = 'Data Produk Master POS';
    $data['contents']   = 'kategori';
    $this->load->view('templates/core', $data);
  }

  function satuanProduk()
  {
    $data['title']      = 'Data Produk Master POS';
    $data['contents']   = 'satuan';
    $this->load->view('templates/core', $data);
  }
}
