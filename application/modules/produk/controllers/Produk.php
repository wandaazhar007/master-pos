<?php defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->wandalibs->_checkLoginSession();
    $this->load->library('datatables');
    $this->load->model('m_data_produk', 'model');
  }

  function dataProduk()
  {
    $data['title']      = 'Data Produk Master POS';
    $data['contents']   = 'data_produk';
    $data['getBarcode'] = $this->model->getBarcode();
    $this->load->view('templates/core', $data);
  }

  function getAllTable()
  {

    $list = $this->model->datatables_getAllTableDataProduk();
    $data = array();
    $no = 1;
    foreach ($list as $value) {
      $queryAction = '
        <a href="#">
          <button class="tombol-hapus view_hapus pull-right" id="' . $value['idproduct'] . '"><i class="fa fa-trash"></i>&nbsp;hapus</button>
        </a>
        <a href="#">
          <button style="margin-right: 5px;" class="tombol-edit view_data_produk pull-right" id="' . $value['idproduct'] . '"><i class="fa fa-pencil"></i>&nbsp;edit</button>
        </a>
        ';
      // <button class="tombol-hapus view_delete_customer" id="tombol-delete-customer"><i class="fa fa-trash"></i>&nbsp;hapus</button>
      $queryCategory = $this->db->get_where('product_category', ['idproduct_category' => $value['idproduct_category']])->row_array();
      $queryUnit = $this->db->get_where('product_unit', ['idproduct_unit' => $value['idproduct_unit']])->row_array();
      $category = $queryCategory['name'];
      $unit = $queryUnit['name'];


      $row = array();
      $row[] = $no++;
      $row[] = $value['barcode'];
      $row[] = $value['name'];
      $row[] = $value['price'];
      $row[] = $value['persentase'] . '%';
      $row[] = $value['price_selling'];
      $row[] = $category;
      $row[] = $unit;
      $row[] = $value['description'];
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
    $email    = htmlspecialchars($this->input->post('email', true));
    $this->form_validation->set_rules('name', 'Nama Pelanggan', 'required', [
      'required'  => 'Nama pelanggan belum diisi!'
    ]);
    $this->form_validation->set_rules('idproduct_unit', 'Unit Produk', 'required', [
      'required'  => 'Nama pelanggan belum diisi!'
    ]);
    $this->form_validation->set_rules('idproduct_category', 'Kategori Produk', 'required', [
      'required'  => 'Nama pelanggan belum diisi!'
    ]);
    $this->form_validation->set_rules('barcode', 'Kode Barcode', 'required|trim', [
      'required'  => 'Nomor Telepon/Handphone pelanggan belum diisi'
    ]);
    $this->form_validation->set_rules('price', 'Jenis Kelamin', 'required|trim', [
      'required'  => 'Harga belum dipilih'
    ]);
    $this->form_validation->set_rules('persentase', 'Persentase', 'required|trim', [
      'required'  => 'Persentase belum ditentukan'
    ]);

    if ($this->form_validation->run() == true) {
      $name               = htmlspecialchars($this->input->post('name', true));
      $barcode            = htmlspecialchars($this->input->post('barcode', true));
      $idproduct_unit     = htmlspecialchars($this->input->post('idproduct_unit', true));
      $idproduct_category = htmlspecialchars($this->input->post('idproduct_category', true));
      $price              = htmlspecialchars($this->input->post('price', true));
      $persentase         = htmlspecialchars($this->input->post('persentase', true));
      $price_selling      = htmlspecialchars($this->input->post('price_selling', true));

      $data = [
        'name'              => $name,
        'barcode'           => $barcode,
        'idproduct_unit'    => $idproduct_unit,
        'idproduct_category' => $idproduct_category,
        'price'             => $price,
        'persentase'        => $persentase,
        'price_selling'     => $price_selling,
        // 'createdby' => $this->session->userdata('name'),
        'created'           => date('Y-m-d h:i:s')
      ];

      $this->db->insert('product', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Yeay!</span> Data produk ' . $name . ' berhasil ditambahkan.
  </div>');
      redirect('product/dataProduk');
    } else {
      $data['title']      = 'Data Produk Master POS';
      $data['contents']   = 'data_produk';
      $this->load->view('templates/core', $data);
    }
  }

  function showFormUpdate()
  {
    $idproduct = $this->input->post('idproduct');
    if (isset($idproduct) and !empty($idproduct)) {
      $query = $this->model->getDetailById($idproduct);
      $output = '';
      foreach ($query as $i) :
        $output .= '
      
    <form action="' . base_url('product/update') . '" method="post">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label>Nama Produk</label>
            <input type="hidden" name="idproduct" value="' . $i['idproduct'] . '" class="form-control" required>
            <input type="text" name="name" value="' . $i['barcode'] . '" class="form-control" required>
          </div>

          <div class="col-sm-6">
            <label>No Handphone</label>
            <input type="text" name="phone" value="' . $i['name'] . '" class="form-control" required>
          </div>
          
          <div class="col-sm-6">
            <label>Satuan Produk</label>
            <input type="text" name="phone" value="' . $i['idproduct_unit'] . '" class="form-control" required>
          </div>
          
          <div class="col-sm-6">
            <label>Kategory Produk</label>
            <input type="text" name="phone" value="' . $i['idproduct_category'] . '" class="form-control" required>
          </div>
          
          <div class="col-sm-6">
            <label>Harga Beli</label>
            <input type="text" name="phone" value="' . $i['price'] . '" class="form-control" required>
          </div>
          
          <div class="col-sm-6">
            <label>Persentase</label>
            <input type="text" name="phone" value="' . $i['persentase'] . '" class="form-control" required>
          </div>
          
          <div class="col-sm-6">
            <label>Harga Jual</label>
            <input type="text" name="phone" value="' . $i['price_selling'] . '" class="form-control" required>
          </div>

          <div class="col-sm-12">
            <label>Deskripsi Produk</label>
            <textarea name="alamat" class="form-control" id="" cols="5" rows="5">' . $i['description'] . '</textarea>
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
    $idproduct          = htmlspecialchars($this->input->post('idproduct', true));
    $name               = htmlspecialchars($this->input->post('name', true));
    $barcode            = htmlspecialchars($this->input->post('barcode', true));
    $idproduct_unit     = htmlspecialchars($this->input->post('idproduct_unit', true));
    $idproduct_category = htmlspecialchars($this->input->post('idproduct_category', true));
    $price              = htmlspecialchars($this->input->post('price', true));
    $persentase         = htmlspecialchars($this->input->post('persentase', true));
    $price_selling      = htmlspecialchars($this->input->post('price_selling', true));

    $data = [
      'name'              => $name,
      'barcode'           => $barcode,
      'idproduct_unit'    => $idproduct_unit,
      'idproduct_category' => $idproduct_category,
      'price'             => $price,
      'persentase'        => $persentase,
      'price_selling'     => $price_selling,
      // 'createdby' => $this->session->userdata('name'),
      'created'           => date('Y-m-d h:i:s')

    ];

    $this->db->where('idproduct', $idproduct);
    $this->db->update('product', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Yeay!</span> Data product ' . $name . ' berhasil diupdate.
  </div>');
    redirect('product');
  }

  function showModalDelete()
  {
    $idproduct = $this->input->post('idproduct');
    if (isset($idproduct) and !empty($idproduct)) {
      $query = $this->model->getDetailById($idproduct);
      $output = '';
      foreach ($query as $i) :
        $output .= '
          <div class="row">
          <div class="col-sm-12 text-center">
            <p>Apakah Anda yakin akan menghapus data produk</p>
            <h6 class="text-bold" style="margin-top: -10px;">' . $i['name'] . ' ?</h6>
          </div>
            <div class="col-sm-12 text-center">
              <a href="' . base_url('produk/delete/') . $i['idproduct'] . '">
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

  function delete($idproduct)
  {
    $query = $this->db->get_where('product_stock', ['idproduct' => $idproduct])->row_array();
    // var_dump($query['idproduct_unit']);
    // die;
    $queryproduct = $this->db->get_where('product', ['idproduct' => $idproduct])->row_array();
    if ($query['idproduct'] == $idproduct) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Ups!</span> Anda tidak dapat menghapusnya. Data product <b><i>' . $queryproduct['name'] . '</i></b> sudah ada yang terjual!.
    </div>');
      redirect('produk/dataProduk');
    } else {
      $this->db->where('idproduct', $idproduct);
      $this->db->delete('product');
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Yeay!</span> Data produk ' . $queryproduct['name'] . 'berhasil dihapus!.
    </div>');
      redirect('produk/dataProduk');
    }
  }
}
