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
          <button class="tombol-hapus view_hapus pull-right" id="' . $value['idcategory'] . '"><i class="fa fa-trash"></i>&nbsp;hapus</button>
        </a>
        <a href="#">
          <button style="margin-right: 5px;" class="tombol-edit view_product_category pull-right" id="' . $value['idcategory'] . '"><i class="fa fa-pencil"></i>&nbsp;edit</button>
        </a>
        ';
      // <button class="tombol-hapus view_delete_product_category" id="tombol-delete-product_category"><i class="fa fa-trash"></i>&nbsp;hapus</button>

      $row = array();
      $row[] = $no++;
      $row[] = $value['name_category'];
      $row[] = $value['date_created'];
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
    $name_category    = htmlspecialchars($this->input->post('name_category', true));
    $this->form_validation->set_rules('name_category', 'Nama Kategori', 'required|is_unique[category.name_category]', [
      'required'  => 'Nama Kategori belum diisi!',
      'is_unique'  => 'Kategori ' . $name_category . ' sudah ada di database'
    ]);

    if ($this->form_validation->run() == true) {
      $name_category     = htmlspecialchars($this->input->post('name_category', true));

      $data = [
        'name_category'   => $name_category,
        'created_by'      => $this->session->userdata('nama'),
        'date_created'    => date('Y-m-d h:i:s')
      ];

      $this->db->insert('category', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">Yeay!</span> Kategori ' . $name_category . ' berhasil ditambahkan.
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
    $idcategory = $this->input->post('idcategory');
    if (isset($idcategory) and !empty($idcategory)) {
      $query = $this->model->getDetailById($idcategory);
      $output = '';
      foreach ($query as $i) :
        $output .= '
      
    <form action="' . base_url('product_category/update') . '" method="post">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-12">
            <label>Nama Kategori Produk</label>
            <input type="hidden" name="idcategory" value="' . $i['idcategory'] . '" class="form-control" required>
            <input type="text" name="name_category" value="' . $i['name_category'] . '" class="form-control" required>
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
    $idcategory = htmlspecialchars($this->input->post('idcategory', true));
    $name_category       = htmlspecialchars($this->input->post('name_category', true));

    $data = [
      'name_category'   => $name_category,
      'updated_by'     => $this->session->userdata('nama'),
      'updated'         => date('Y-m-d h:i:s')
    ];

    $this->db->where('idcategory', $idcategory);
    $this->db->update('category', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Yeay!</span> Kategori ' . $name_category . ' berhasil diupdate.
  </div>');
    redirect('product_category');
  }

  function showModalDelete()
  {
    $idcategory = $this->input->post('idcategory');
    if (isset($idcategory) and !empty($idcategory)) {
      $query = $this->model->getDetailById($idcategory);
      $output = '';
      foreach ($query as $i) :
        $output .= '
          <div class="row">
          <div class="col-sm-12 text-center">
            <p>Apakah Anda yakin akan menghapus kategori</p>
            <h6 class="text-bold" style="margin-top: -10px;">' . $i['name_category'] . '</h6>
          </div>
            <div class="col-sm-12 text-center">
              <a href="' . base_url('product_category/delete/') . $i['idcategory'] . '">
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

  function delete($idcategory)
  {
    $query = $this->db->get_where('product', ['idcategory' => $idcategory])->row_array();
    $querycategory = $this->db->get_where('category', ['idcategory' => $idcategory])->row_array();
    if ($query['idcategory'] == $idcategory) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Ups!</span> Kategori <b><i>' . $querycategory['name'] . '</i></b> sudah pernah digunakan!.
    </div>');
      redirect('product_category');
    } else {
      $this->db->where('idcategory', $idcategory);
      $this->db->delete('category');
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Yeay!</span> Kategori ' . $querycategory['name'] . 'berhasil dihapus!.
    </div>');
      redirect('product_category');
    }
  }
}
