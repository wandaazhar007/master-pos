<?php defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->wandalibs->_checkLoginSession();
    $this->load->model('m_transaksi', 'model');
  }

  function index()
  {
    $idtransaction_group =  htmlspecialchars($this->input->post('idtransaction_group', true));
    // var_dump($idtransaction_group);
    // die;
    $data['title']      = 'Transaksi Master POS';
    $data['contents']   = 'transaksi';
    $data['getIdTransactionGroup']  = $this->model->getIdTransactionGroup();
    $data['getProduct']  = $this->model->getProduct();
    $data['getAddProduct']  = $this->model->getAddProduct($idtransaction_group);
    $this->load->view('templates/core', $data);
  }

  function tambah()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('idproduct', 'Nama Produk', 'required', [
      'required'    => 'Nama produk belum dipilih'
    ]);
    $this->form_validation->set_rules('qty', 'Jumlah', 'required|trim', [
      'required'    => 'jumlah produk belum diisi'
    ]);

    if ($this->form_validation->run() == false) {
      $idtransaction_group =  $this->input->post('idtransaction_group');
      $data['title']      = 'Transaksi Master POS';
      $data['contents']   = 'transaksi';
      $data['getProduct']  = $this->model->getProduct();
      $data['getIdTransactionGroup']  = $this->model->getIdTransactionGroup();
      $data['getAddProduct']  = $this->model->getAddProduct($idtransaction_group);
      $this->load->view('templates/core', $data);
    } else {
      $idproduct           = htmlspecialchars($this->input->post('idproduct', true));
      $idtransaction_group =  $this->input->post('idtransaction_group');
      $qty            = htmlspecialchars($this->input->post('qty', true));
      $sell_price     = htmlspecialchars($this->input->post('sell_price', true));
      $final_price    = htmlspecialchars($this->input->post('final_price', true));

      $data = [
        'idproduct'     => $idproduct,
        'idtransaction_group'     => $idtransaction_group,
        'qty'           => $qty,
        'sell_price'    => $sell_price,
        'final_price'   => $final_price,
        'status'        => 'PROCESS',
        'created'       => date('Y-m-d h:i:s')
      ];
      $this->db->insert('transaction', $data);
      // $this->session->set_flashdata('message', '<div class="alert alert-success bg-teal alert-styled-left">
      // <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      // <span class="text-semibold">Berhasil!</span> Data pengguna atas nama &nbsp; <b><i><a href="' . base_url('user/detail/') . $iduser . '" class="alert-link"> ' . $name . ' </a></i></b>&nbsp; berhasil ditambahkan.
      // </div>');
      redirect('transaksi');
    }
  }

  function bayar()
  {
    $this->db->query("INSERT INTO `transaction`(`idtransaction`, `idproduct`, `qty`, `final_price`) SELECT `idtransaction`, `idproduct`, `qty`, `final_price` FROM `temp_transaction`");
    $this->db->empty_table('temp_transaction');
    $this->session->set_flashdata('message', '<div class="alert alert-success bg-teal alert-styled-left">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Berhasil!</span> Transaksi sukses.
      </div>');
    redirect('transaksi');
  }
}
