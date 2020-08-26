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
          <button class="tombol-hapus view_hapus pull-right" id="' . $value['idunit'] . '"><i class="fa fa-trash"></i>&nbsp;hapus</button>
        </a>
        <a href="#">
          <button style="margin-right: 5px;" class="tombol-edit view_product_unit pull-right" id="' . $value['idunit'] . '"><i class="fa fa-pencil"></i>&nbsp;edit</button>
        </a>
        ';
      // <button class="tombol-hapus view_delete_product_unit" id="tombol-delete-product_unit"><i class="fa fa-trash"></i>&nbsp;hapus</button>

      $row = array();
      $row[] = $no++;
      $row[] = $value['name_unit'];
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
    $name_unit    = htmlspecialchars($this->input->post('name_unit', true));
    $this->form_validation->set_rules('name_unit', 'Nama Pelanggan', 'required|is_unique[unit.name_unit]', [
      'required'  => 'Satuan Produk belum diisi!',
      'is_unique'  => 'Satuan Produk ' . $name_unit . ' sudah ada di database'
    ]);

    if ($this->form_validation->run() == true) {
      $name_unit     = htmlspecialchars($this->input->post('name_unit', true));

      $data = [
        'name_unit'      => $name_unit,
        'created_by'     => $this->session->userdata('nama'),
        'date_created'   => date('Y-m-d h:i:s')
      ];

      $this->db->insert('unit', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">Yeay!</span> Satuan produk ' . $name_unit . ' berhasil ditambahkan.
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
    $idunit = $this->input->post('idunit');
    if (isset($idunit) and !empty($idunit)) {
      $query = $this->model->getDetailById($idunit);
      $output = '';
      foreach ($query as $i) :
        $output .= '
      
    <form action="' . base_url('product_unit/update') . '" method="post">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-12">
            <label>Nama Satuan Produk</label>
            <input type="hidden" name="idunit" value="' . $i['idunit'] . '" class="form-control" required>
            <input type="text" name="name_unit" value="' . $i['name_unit'] . '" class="form-control" required>
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
    $idunit = htmlspecialchars($this->input->post('idunit', true));
    $name_unit       = htmlspecialchars($this->input->post('name_unit', true));

    $data = [
      'name_unit'      => $name_unit,
      'updated_by' => $this->session->userdata('nama'),
      'updated'   => date('Y-m-d h:i:s')
    ];

    $this->db->where('idunit', $idunit);
    $this->db->update('unit', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Yeay!</span> Satuan Produk ' . $name_unit . ' berhasil diupdate.
  </div>');
    redirect('product_unit');
  }

  function showModalDelete()
  {
    $idunit = $this->input->post('idunit');
    if (isset($idunit) and !empty($idunit)) {
      $query = $this->model->getDetailById($idunit);
      $output = '';
      foreach ($query as $i) :
        $output .= '
          <div class="row">
          <div class="col-sm-12 text-center">
            <p>Apakah Anda yakin akan menghapus Satuan Produk</p>
            <h6 class="text-bold" style="margin-top: -10px;">' . $i['name_unit'] . '</h6>
          </div>
            <div class="col-sm-12 text-center">
              <a href="' . base_url('product_unit/delete/') . $i['idunit'] . '">
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

  function delete($idunit)
  {
    $query = $this->db->get_where('product', ['idunit' => $idunit])->row_array();
    $queryunit = $this->db->get_where('unit', ['idunit' => $idunit])->row_array();
    if ($query['idunit'] == $idunit) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Ups!</span> Satuan Produk <b><i>' . $queryunit['name_unit'] . '</i></b> sudah pernah digunakan!.
    </div>');
      redirect('product_unit');
    } else {
      $this->db->where('idunit', $idunit);
      $this->db->delete('unit');
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Yeay!</span> Satuan Produk ' . $queryunit['name_unit'] . 'berhasil dihapus!.
    </div>');
      redirect('product_unit');
    }
  }
}
