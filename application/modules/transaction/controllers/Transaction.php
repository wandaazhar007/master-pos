<?php defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->wandalibs->_checkLoginSession();
    $this->load->model('m_transaction', 'model');
  }

  function index()
  {
    $idtransaction =  htmlspecialchars($this->input->post('idtransaction', true));
    $code_transaction =  $this->wandalibs->getCodeTransaction($idtransaction);
    // var_dump($idtransaction_group);
    // die;
    $data['title']            = 'Transaksi Master POS';
    $data['contents']         = 'transaction';
    // $data['getIdTransactionGroup']  = $this->model->getIdTransactionGroup();
    $data['getProduct']       = $this->model->getProduct();
    $data['getAddProduct']    = $this->model->getAddProduct();

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
      // $idtransaction_group =  $this->input->post('idtransaction_group');
      $data['title']      = 'Transaksi Master POS';
      $data['contents']   = 'transaction';
      $data['getProduct']  = $this->model->getProduct();
      $data['getIdTransactionGroup']  = $this->model->getIdTransactionGroup();
      $data['getAddProduct']  = $this->model->getAddProduct();
      $this->load->view('templates/core', $data);
    } else {
      $idproduct            = htmlspecialchars($this->input->post('idproduct', true));
      $idtransaction_group  =  htmlspecialchars($this->input->post('idtransaction_group'));
      $qty                  = htmlspecialchars($this->input->post('qty', true));
      $selling_price        = htmlspecialchars($this->input->post('selling_price', true));
      $final_price          = htmlspecialchars($this->input->post('final_price', true));

      $data = [
        'code_transaction'  => $this->wandalibs->getCodeTransaction(),
        'idproduct'     => $idproduct,
        'qty'           => $qty,
        'selling_price'    => $selling_price,
        'final_price'   => $final_price,
        'status'        => 'PROCESS',
        'created'       => date('Y-m-d h:i:s'),
        'created_by'    => $this->session->userdata('name')
      ];
      $this->db->insert('temp_transaction', $data);
      redirect('transaction');
    }
  }

  function bayar()
  {
    $this->db->query("INSERT INTO `transaction`(`idtransaction`, `code_transaction` `idproduct`, `qty`, `final_price`) SELECT `idtransaction`, `code_transaction` `idproduct`, `qty`, `final_price` FROM `temp_transaction`");
    $this->db->empty_table('temp_transaction');
    $this->session->set_flashdata('message', '<div class="alert alert-success bg-teal alert-styled-left">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Berhasil!</span> Transaksi sukses.
      </div>');
    redirect('transaction');
  }

  function showFormEditTransaction()
  {
    $idtemp_transaction = $this->input->post('idtemp_transaction');
    if (isset($idtemp_transaction) and !empty($idtemp_transaction)) {
      $query = $this->model->getDetailById($idtemp_transaction);
      $output = '';
      foreach ($query as $i) :
        $output .= '
      
    <form action="' . base_url('transaction/updateList') . '" method="post">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-12">
            <label>Nama Produk</label>
            <input type="hidden" name="idtemp_transaction" value="' . $i['idtemp_transaction'] . '" class="form-control" required readonly>
            <input type="text" name="name" value="' . $i['name'] . '" class="form-control" readonly>
          </div>
          <div class="col-sm-12">
            <label>Qty</label>
            <input type="number" min="1" name="qty" value="' . $i['qty'] . '" class="form-control" required>
          </div>
          <div class="col-sm-12" style="margin-top: 10px;">
          <button type="submit" class="tombol-tambah pull-right"><i class="fa fa-save"></i>&nbsp;Update</button>
          </div>
        </div>
      </div>
    </form>
                ';

      endforeach;
      echo $output;
    } else {
      echo 'not founds';
    }
  }

  function updateList()
  {
    $idtemp_transaction = htmlspecialchars($this->input->post('idtemp_transaction', true));
    $name                = htmlspecialchars($this->input->post('name', true));
    $qty                = htmlspecialchars($this->input->post('qty', true));

    $data = [
      'qty' => $qty,
      'updated' => date('Y-m-d h:i:s'),
      'updated_by'  => $this->session->userdata('name')
    ];
    $this->db->where('idtemp_transaction', $idtemp_transaction);
    $this->db->update('temp_transaction', $data);

    $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Yeay!</span> ' . $name . ' berhasil diupdate.
    </div>');
    redirect('transaction');
  }

  function showModalDelete()
  {
    $idtemp_transaction = $this->input->post('idtemp_transaction');
    if (isset($idtemp_transaction) and !empty($idtemp_transaction)) {
      $query = $this->model->getDetailById($idtemp_transaction);
      $output = '';
      foreach ($query as $i) :
        $output .= '
          <div class="row">
          <div class="col-sm-12 text-center">
            <p>Apakah Anda yakin akan menghapus</p>
            <h6 class="text-bold" style="margin-top: -10px;">' . $i['name'] . '</h6>
            <input type="hidden" name="name" value="' . $i['name'] . '">
          </div>
            <div class="col-sm-12 text-center">
              <a href="' . base_url('transaction/delete/') . $i['idtemp_transaction'] . '">
                <button type="submit" class="tombol-tambah"><i class="fa fa-check"></i>&nbsp;Ya, Hapus</button>
                <button type="button" class="tombol-modal-hapus" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Tidak!</button>
              </a>
            </div>
          </div>
                ';

      endforeach;
      echo $output;
    } else {
      echo 'not founds';
    }
  }

  function delete($idtemp_transaction)
  {
    $name = htmlspecialchars($this->input->post('name', true));
    $this->db->where('idtemp_transaction', $idtemp_transaction);
    $this->db->delete('temp_transaction');
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Yeay!</span> product ' . $name . '  berhasil dihapus dari daftar!.
    </div>');
    redirect('transaction');
  }
}
