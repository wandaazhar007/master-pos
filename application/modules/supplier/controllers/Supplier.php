<?php defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->wandalibs->_checkLoginSession();
    $this->load->library('datatables');
    $this->load->model('m_supplier', 'model');
  }

  function index()
  {
    $data['title']      = 'Data Supplier Master POS';
    // $data['contents']   = 'supplier';
    $data['contents']   = 'supplier';
    $this->load->view('templates/core', $data);
    // $this->load->view('supplier2', $data);
  }

  function getAllTable()
  {

    $list = $this->model->datatables_getAllTable();
    $data = array();
    $no = 1;
    foreach ($list as $value) {
      $queryAction = '<a href="#">
        <button class="tombol-edit view_supplier" id="' . $value['idsupplier'] . '"><i class="fa fa-pencil"></i>&nbsp;edit</button>
        </a>
        <a href="#">
        <button class="tombol-hapus view_hapus" id="' . $value['idsupplier'] . '"><i class="fa fa-trash"></i>&nbsp;hapus</button>
        </a>';
      // <button class="tombol-hapus view_delete_supplier" id="tombol-delete-supplier"><i class="fa fa-trash"></i>&nbsp;hapus</button>


      $row = array();
      $row[] = $no++;
      // $row[] = $value['idsupplier'];
      $row[] = $value['name_supplier'];
      $row[] = $value['phone'];
      $row[] = $value['email'];
      $row[] = $value['address'];
      // $action = $queryAction;
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
    $this->form_validation->set_rules('name_supplier', 'Nama Supplier', 'required', [
      'required'  => 'Nama supplier belum diisi!'
    ]);
    $this->form_validation->set_rules('phone', 'No Handphone', 'required|trim', [
      'required'  => 'Nomor Telepon/Handphone supplier belum diisi'
    ]);
    $this->form_validation->set_rules('email', 'No Handphone', 'required|trim|valid_email', [
      'required'  => 'Nomor Telepon/Handphone supplier belum diisi',
      'vald_email'  => 'Format email tidak vaid!'
    ]);

    if ($this->form_validation->run() == true) {
      $name_supplier    = htmlspecialchars($this->input->post('name_supplier', true));
      $phone            = htmlspecialchars($this->input->post('phone', true));
      $email            = htmlspecialchars($this->input->post('email', true));
      $description      = htmlspecialchars($this->input->post('description', true));
      $address          = htmlspecialchars($this->input->post('address', true));

      $data = [
        'name_supplier' => $name_supplier,
        'phone'         => $phone,
        'address'       => $address,
        'email'         => $email,
        'description'   => $description,
        'created_by'     => $this->session->userdata('name'),
        'date_created'       => date('Y-m-d h:i:s')
      ];

      $this->db->insert('supplier', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Yeay!</span> Data Supplier atas nama ' . $name_supplier . ' berhasil ditambahkan.
  </div>');
      redirect('supplier');
    } else {
      // redirect('supplier');
      $data['title']      = 'Data Supplier Master POS';
      $data['contents']   = 'supplier';
      $this->load->view('templates/core', $data);
    }
  }

  function showFormUpdate()
  {
    $idsupplier = $this->input->post('idsupplier');
    if (isset($idsupplier) and !empty($idsupplier)) {
      $query = $this->model->getDetailById($idsupplier);
      $output = '';
      foreach ($query as $i) :
        $output .= '
      
    <form action="' . base_url('supplier/update') . '" method="post">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label>Nama Supplier</label>
            <input type="hidden" name="idsupplier" value="' . $i['idsupplier'] . '" class="form-control" required>
            <input type="text" name="name_supplier" value="' . $i['name_supplier'] . '" class="form-control" required>
          </div>

          <div class="col-sm-6">
            <label>No Handphone</label>
            <input type="text" name="phone" value="' . $i['phone'] . '" class="form-control" required>
          </div>
          
          <div class="col-sm-6">
            <label>Email</label>
            <input type="text" name="email" value="' . $i['email'] . '" class="form-control" required>
          </div>

          <div class="col-sm-12">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" id="" cols="5" rows="5">' . $i['description'] . '</textarea>
          </div>
          
          <div class="col-sm-12">
            <label>Alamat</label>
            <textarea name="address" class="form-control" id="" cols="5" rows="5">' . $i['address'] . '</textarea>
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
    $this->load->library('form_validation');
    $this->form_validation->set_rules('name_supplier', 'Nama Supplier', 'required', [
      'required'  => 'Nama supplier belum diisi!'
    ]);
    $this->form_validation->set_rules('phone', 'No Handphone', 'required|trim', [
      'required'  => 'Nomor Telepon/Handphone supplier belum diisi'
    ]);
    $this->form_validation->set_rules('email', 'No Handphone', 'required|trim|valid_email', [
      'required'  => 'Nomor Telepon/Handphone supplier belum diisi',
      'vald_email'  => 'Format email tidak vaid!'
    ]);

    if ($this->form_validation->run() == false) {
      $data['title']      = 'Data Supplier Master POS';
      $data['contents']   = 'supplier';
      $this->load->view('templates/core', $data);
    } else {
      $idsupplier       = htmlspecialchars($this->input->post('idsupplier', true));
      $name_supplier    = htmlspecialchars($this->input->post('name_supplier', true));
      $phone            = htmlspecialchars($this->input->post('phone', true));
      $email            = htmlspecialchars($this->input->post('email', true));
      $description      = htmlspecialchars($this->input->post('description', true));
      $address          = htmlspecialchars($this->input->post('address', true));

      $data = [
        'name_supplier' => $name_supplier,
        'phone'         => $phone,
        'address'       => $address,
        'email'         => $email,
        'description'   => $description,
        'created_by'     => $this->session->userdata('name'),
        'date_created'       => date('Y-m-d h:i:s')
      ];

      $this->db->where('idsupplier', $idsupplier);
      $this->db->update('supplier', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Yeay!</span> Data supplier atas nama ' . $name_supplier . ' berhasil diupdate.
  </div>');
      redirect('supplier');
    }
  }

  function showModalDelete()
  {
    $idsupplier = $this->input->post('idsupplier');
    if (isset($idsupplier) and !empty($idsupplier)) {
      $query = $this->model->getDetailById($idsupplier);
      $output = '';
      foreach ($query as $i) :
        $output .= '
          <div class="row">
          <div class="col-sm-12 text-center">
            <p>Apakah Anda yakin akan menghapus data supllier atas nama</p>
            <h6 class="text-bold" style="margin-top: -10px;">' . $i['name_supplier'] . ' ?</h6>
          </div>
            <div class="col-sm-12 text-center">
              <a href="' . base_url('supplier/delete/') . $i['idsupplier'] . '">
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

  function delete($idsupplier)
  {
    $query = $this->db->get_where('product', ['idsupplier' => $idsupplier])->row_array();
    $querySupplier = $this->db->get_where('supplier', ['idsupplier' => $idsupplier])->row_array();
    if ($query['idsupplier'] == $idsupplier) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Ups!</span> Data supplier atas nama <b><i>' . $querySupplier['name_supplier'] . '</i></b> sudah masuk ke daftar stok produk!.
    </div>');
      redirect('supplier');
    } else {
      $this->db->where('idsupplier', $idsupplier);
      $this->db->delete('supplier');
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Yeay!</span> Data supplier berhasil dihapus!.
    </div>');
      redirect('supplier');
    }
    // $data = $this->db->query("DELETE `supplier`, `product_stock`
    //                   FROM `supplier`
    //                   INNER JOIN `product_stock` ON `supplier`.`idsupplier` = `product_stock`.`idsupplier`
    //                   WHERE `supplier`.`idsupplier` = '$idsupplier'");
    // if ($data->num_rows() > 0) {
    //   foreach ($data->result() as $row) {
    //     $result[] = $row;
    //   }

    //   return $result;
    // }
    // if ($data->num_rows() > 0) {
    //   $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
    //   <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    //   <span class="text-semibold">Yeay!</span> Data supplier berhasil dihapus!.
    // </div>');
    //   redirect('supplier');
    // } else {
    //   $this->session->set_flashdata('message', '<div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
    //   <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    //   <span class="text-semibold">Ups!</span> Data supplier sudah masuk kedalam database!.
    // </div>');
    //   redirect('supplier');
    // }
  }
}
