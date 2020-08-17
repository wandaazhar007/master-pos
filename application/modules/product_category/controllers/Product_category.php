<?php defined('BASEPATH') or exit('No direct script access allowed');

class Product_category extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
    // $this->wandalibs->_checkLoginSession();
    $this->load->library('datatables');
    $this->load->model('m_product_category', 'model');
  }

  function index()
  {
    $data['title']      = 'Data product_category Master POS';
    $data['contents']   = 'product_category';
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
          <button class="tombol-hapus view_hapus pull-right" id="' . $value['idproduct_category'] . '"><i class="fa fa-trash"></i>&nbsp;hapus</button>
        </a>
        <a href="#">
          <button style="margin-right: 5px;" class="tombol-edit view_product_category pull-right" id="' . $value['idproduct_category'] . '"><i class="fa fa-pencil"></i>&nbsp;edit</button>
        </a>
        ';
      // <button class="tombol-hapus view_delete_product_category" id="tombol-delete-product_category"><i class="fa fa-trash"></i>&nbsp;hapus</button>

      $row = array();
      $row[] = $no++;
      $row[] = $value['name'];
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
    $this->form_validation->set_rules('name', 'Nama Pelanggan', 'required|is_unique[product_category.name]', [
      'required'  => 'Nama pelanggan belum diisi!',
      'is_unique'  => 'Kategori ' . $name . ' sudah ada di database'
    ]);

    if ($this->form_validation->run() == true) {
      $name     = htmlspecialchars($this->input->post('name', true));

      $data = [
        'name'      => $name,
        // 'createdby' => $this->session->userdata('name'),
        'created'   => date('Y-m-d h:i:s')
      ];

      $this->db->insert('product_category', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">Yeay!</span> Kategori ' . $name . ' berhasil ditambahkan.
      </div>');
      redirect('product_category');
    } else {
      $data['title']      = 'Kategori Produk Master POS';
      $data['contents']   = 'product_category';
      $this->load->view('templates/core', $data);
    }
  }

  function showFormUpdate()
  {
    $idproduct_category = $this->input->post('idproduct_category');
    if (isset($idproduct_category) and !empty($idproduct_category)) {
      $query = $this->model->getDetailById($idproduct_category);
      $output = '';
      foreach ($query as $i) :
        $output .= '
      
    <form action="' . base_url('product_category/update') . '" method="post">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-12">
            <label>Nama Kategori Produk</label>
            <input type="hidden" name="idproduct_category" value="' . $i['idproduct_category'] . '" class="form-control" required>
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
    $idproduct_category = htmlspecialchars($this->input->post('idproduct_category', true));
    $name       = htmlspecialchars($this->input->post('name', true));

    $data = [
      'name'      => $name,
      // 'createdby' => $this->session->userdata('name'),
      'created'   => date('Y-m-d h:i:s')
    ];

    $this->db->where('idproduct_category', $idproduct_category);
    $this->db->update('product_category', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Yeay!</span> Kategori ' . $name . ' berhasil diupdate.
  </div>');
    redirect('product_category');
  }

  function showModalDelete()
  {
    $idproduct_category = $this->input->post('idproduct_category');
    if (isset($idproduct_category) and !empty($idproduct_category)) {
      $query = $this->model->getDetailById($idproduct_category);
      $output = '';
      foreach ($query as $i) :
        $output .= '
          <div class="row">
          <div class="col-sm-12 text-center">
            <p>Apakah Anda yakin akan menghapus kategori</p>
            <h6 class="text-bold" style="margin-top: -10px;">' . $i['name'] . '</h6>
          </div>
            <div class="col-sm-12 text-center">
              <a href="' . base_url('product_category/delete/') . $i['idproduct_category'] . '">
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

  function delete($idproduct_category)
  {
    $query = $this->db->get_where('product', ['idproduct_category' => $idproduct_category])->row_array();
    $queryProduct_category = $this->db->get_where('product_category', ['idproduct_category' => $idproduct_category])->row_array();
    if ($query['idproduct_category'] == $idproduct_category) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Ups!</span> Kategori <b><i>' . $queryProduct_category['name'] . '</i></b> sudah pernah digunakan!.
    </div>');
      redirect('product_category');
    } else {
      $this->db->where('idproduct_category', $idproduct_category);
      $this->db->delete('product_category');
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Yeay!</span> Kategori ' . $queryProduct_category['name'] . 'berhasil dihapus!.
    </div>');
      redirect('product_category');
    }
  }
}
