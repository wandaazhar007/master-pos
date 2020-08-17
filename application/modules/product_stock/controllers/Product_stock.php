<?php defined('BASEPATH') or exit('No direct script access allowed');

class Product_stock extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
    // $this->wandalibs->_checkLoginSession();
    $this->load->library('datatables');
    $this->load->model('m_product_stock', 'model');
  }

  function index()
  {
    $data['title']      = 'Stok Produk Master POS';
    $data['contents']   = 'product_stock';
    $data['getProduct'] = $this->model->getProduct();
    $data['getSupplier'] = $this->model->getSupplier();
    $this->load->view('templates/core', $data);
  }

  function getAllTable()
  {

    $list = $this->model->datatables_getAllTable();
    $data = array();
    $no = 1;
    foreach ($list as $value) {
      $queryAction = '
        <a href="#">
          <button class="tombol-hapus view_hapus pull-right" id="' . $value['idproduct_stock'] . '"><i class="fa fa-trash"></i>&nbsp;hapus</button>
        </a>
        <a href="#">
          <button style="margin-right: 5px;" class="tombol-edit view_product_stock pull-right" id="' . $value['idproduct_stock'] . '"><i class="fa fa-pencil"></i>&nbsp;edit</button>
        </a>
        ';
      $a = strtotime($value['stock_date']);
      $tgl = date('d F Y', $a);
      // var_dump($a);
      // die;
      // <button class="tombol-hapus view_delete_product_stock" id="tombol-delete-product_stock"><i class="fa fa-trash"></i>&nbsp;hapus</button>

      $row = array();
      $row[] = $no++;
      $row[] = $tgl;
      $row[] = $value['barcode'];
      $row[] = $value['name'];
      $row[] = $value['detail'];
      $row[] = $value['name_supplier'];
      $row[] = $value['total'];
      $row[] = $queryAction;
      $data[] = $row;
    }
    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->model->countAll(),
      "recordsFiltered" => $this->model->countFiltered(),
      "data" => $data
    );
    echo json_encode($output);
  }

  function save()
  {
    $this->load->library('form_validation');
    $name    = htmlspecialchars($this->input->post('name', true));
    $this->form_validation->set_rules('name', 'Nama Produk', 'required', [
      'required'  => 'Nama pelanggan belum diisi!'
    ]);

    if ($this->form_validation->run() == true) {
      $name     = htmlspecialchars($this->input->post('name', true));

      $data = [
        'name'      => $name,
        // 'createdby' => $this->session->userdata('name'),
        'created'   => date('Y-m-d h:i:s')
      ];

      $this->db->insert('product_stock', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">Yeay!</span> Kategori ' . $name . ' berhasil ditambahkan.
      </div>');
      redirect('product_stock');
    } else {
      $data['title']      = 'Kategori Produk Master POS';
      $data['contents']   = 'product_stock';
      $data['getProduct'] = $this->model->getProduct();
      $data['getSupplier'] = $this->model->getSupplier();

      $this->load->view('templates/core', $data);
    }
  }

  function showFormUpdate()
  {
    $idproduct_stock = $this->input->post('idproduct_stock');
    if (isset($idproduct_stock) and !empty($idproduct_stock)) {
      $query = $this->model->getDetailById($idproduct_stock);
      $output = '';
      foreach ($query as $i) :
        $output .= '
      
    <form action="' . base_url('product_stock/update') . '" method="post">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-12">
            <label>Nama Kategori Produk</label>
            <input type="hidden" name="idproduct_stock" value="' . $i['idproduct_stock'] . '" class="form-control" required>
            <input type="text" name="name" value="' . $i['name'] . '" class="form-control" required>
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


  function update()
  {
    $idproduct_stock = htmlspecialchars($this->input->post('idproduct_stock', true));
    $name       = htmlspecialchars($this->input->post('name', true));

    $data = [
      'name'      => $name,
      // 'createdby' => $this->session->userdata('name'),
      'created'   => date('Y-m-d h:i:s')
    ];

    $this->db->where('idproduct_stock', $idproduct_stock);
    $this->db->update('product_stock', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Yeay!</span> Kategori ' . $name . ' berhasil diupdate.
  </div>');
    redirect('product_stock');
  }

  function showModalDelete()
  {
    $idproduct_stock = $this->input->post('idproduct_stock');
    if (isset($idproduct_stock) and !empty($idproduct_stock)) {
      $query = $this->model->getDetailById($idproduct_stock);
      $output = '';
      foreach ($query as $i) :
        $output .= '
          <div class="row">
          <div class="col-sm-12 text-center">
            <p>Apakah Anda yakin akan menghapus kategori</p>
            <h6 class="text-bold" style="margin-top: -10px;">' . $i['name'] . '</h6>
          </div>
            <div class="col-sm-12 text-center">
              <a href="' . base_url('product_stock/delete/') . $i['idproduct_stock'] . '">
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

  function delete($idproduct_stock)
  {
    $query = $this->db->get_where('product', ['idproduct' => $idproduct_stock])->row_array();
    $queryProduct_stock = $this->db->get_where('product_stock', ['idproduct_stock' => $idproduct_stock])->row_array();
    if ($query['idproduct_stock'] == $idproduct_stock) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Ups!</span> produk <b><i>' . $queryProduct_stock['name'] . '</i></b> sudah pernah digunakan!.
    </div>');
      redirect('product_stock');
    } else {
      $this->db->where('idproduct_stock', $idproduct_stock);
      $this->db->delete('product_stock');
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Yeay!</span> riwayat stok produk berhasil dihapus!.
    </div>');
      redirect('product_stock');
    }
  }
}
