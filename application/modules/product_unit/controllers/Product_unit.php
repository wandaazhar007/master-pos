<?php defined('BASEPATH') or exit('No direct script access allowed');

class Product_unit extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
    // $this->wandalibs->_checkLoginSession();
    $this->load->library('datatables');
    $this->load->model('m_product_unit', 'model');
  }

  function index()
  {
    $data['title']      = 'Satuan Produk Master POS';
    $data['contents']   = 'product_unit';
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
          <button class="tombol-hapus view_hapus pull-right" id="' . $value['idproduct_unit'] . '"><i class="fa fa-trash"></i>&nbsp;hapus</button>
        </a>
        <a href="#">
          <button style="margin-right: 5px;" class="tombol-edit view_product_unit pull-right" id="' . $value['idproduct_unit'] . '"><i class="fa fa-pencil"></i>&nbsp;edit</button>
        </a>
        ';
      // <button class="tombol-hapus view_delete_product_unit" id="tombol-delete-product_unit"><i class="fa fa-trash"></i>&nbsp;hapus</button>

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
    $this->form_validation->set_rules('name', 'Nama Pelanggan', 'required|is_unique[product_unit.name]', [
      'required'  => 'Satuan Produk belum diisi!',
      'is_unique'  => 'Satuan Produk ' . $name . ' sudah ada di database'
    ]);

    if ($this->form_validation->run() == true) {
      $name     = htmlspecialchars($this->input->post('name', true));

      $data = [
        'name'      => $name,
        // 'createdby' => $this->session->userdata('name'),
        'created'   => date('Y-m-d h:i:s')
      ];

      $this->db->insert('product_unit', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">Yeay!</span> Satuan produk ' . $name . ' berhasil ditambahkan.
      </div>');
      redirect('product_unit');
    } else {
      $data['title']      = 'Satuan Produk Master POS';
      $data['contents']   = 'product_unit';
      $this->load->view('templates/core', $data);
    }
  }

  function showFormUpdate()
  {
    $idproduct_unit = $this->input->post('idproduct_unit');
    if (isset($idproduct_unit) and !empty($idproduct_unit)) {
      $query = $this->model->getDetailById($idproduct_unit);
      $output = '';
      foreach ($query as $i) :
        $output .= '
      
    <form action="' . base_url('product_unit/update') . '" method="post">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-12">
            <label>Nama Satuan Produk</label>
            <input type="hidden" name="idproduct_unit" value="' . $i['idproduct_unit'] . '" class="form-control" required>
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
    $idproduct_unit = htmlspecialchars($this->input->post('idproduct_unit', true));
    $name       = htmlspecialchars($this->input->post('name', true));

    $data = [
      'name'      => $name,
      // 'createdby' => $this->session->userdata('name'),
      'created'   => date('Y-m-d h:i:s')
    ];

    $this->db->where('idproduct_unit', $idproduct_unit);
    $this->db->update('product_unit', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Yeay!</span> Satuan Produk ' . $name . ' berhasil diupdate.
  </div>');
    redirect('product_unit');
  }

  function showModalDelete()
  {
    $idproduct_unit = $this->input->post('idproduct_unit');
    if (isset($idproduct_unit) and !empty($idproduct_unit)) {
      $query = $this->model->getDetailById($idproduct_unit);
      $output = '';
      foreach ($query as $i) :
        $output .= '
          <div class="row">
          <div class="col-sm-12 text-center">
            <p>Apakah Anda yakin akan menghapus Satuan Produk</p>
            <h6 class="text-bold" style="margin-top: -10px;">' . $i['name'] . '</h6>
          </div>
            <div class="col-sm-12 text-center">
              <a href="' . base_url('product_unit/delete/') . $i['idproduct_unit'] . '">
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

  function delete($idproduct_unit)
  {
    $query = $this->db->get_where('product', ['idproduct_unit' => $idproduct_unit])->row_array();
    $queryproduct_unit = $this->db->get_where('product_unit', ['idproduct_unit' => $idproduct_unit])->row_array();
    if ($query['idproduct_unit'] == $idproduct_unit) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Ups!</span> Satuan Produk <b><i>' . $queryproduct_unit['name'] . '</i></b> sudah pernah digunakan!.
    </div>');
      redirect('product_unit');
    } else {
      $this->db->where('idproduct_unit', $idproduct_unit);
      $this->db->delete('product_unit');
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Yeay!</span> Satuan Produk ' . $queryproduct_unit['name'] . 'berhasil dihapus!.
    </div>');
      redirect('product_unit');
    }
  }
}
