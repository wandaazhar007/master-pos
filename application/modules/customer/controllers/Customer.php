<?php defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('datatables');
    $this->load->model('m_customer', 'model');
  }

  function index()
  {
    $data['title']      = 'Data customer Master POS';
    $data['contents']   = 'customer';
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
          <button class="tombol-hapus view_hapus pull-right" id="' . $value['idcustomer'] . '"><i class="fa fa-trash"></i>&nbsp;hapus</button>
        </a>
        <a href="#">
          <button style="margin-right: 5px;" class="tombol-edit view_customer pull-right" id="' . $value['idcustomer'] . '"><i class="fa fa-pencil"></i>&nbsp;edit</button>
        </a>
        ';
      // <button class="tombol-hapus view_delete_customer" id="tombol-delete-customer"><i class="fa fa-trash"></i>&nbsp;hapus</button>


      $row = array();
      $row[] = $no++;
      $row[] = $value['name'];
      $row[] = $value['phone'];
      // $row[] = $value['email'];
      $row[] = $value['address'];
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
    $this->form_validation->set_rules('phone', 'No Handphone', 'required|trim', [
      'required'  => 'Nomor Telepon/Handphone pelanggan belum diisi'
    ]);
    $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required', [
      'required'  => 'Jenis kelamin belum dipilih'
    ]);

    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[customer.email]', [
      'required'      => 'Email pelanggan belum diisi',
      'valid_email'   => 'Format email tidak valid',
      'is_unique'     => 'Maaf!. Email ' . $email . ' sudah terdaftar. Silahkan menggunakan alamat email yang lain'
    ]);
    $this->form_validation->set_rules('address', 'Alamat pelanggan', 'required', [
      'required'  => 'Alamat pelanggan belum diisi'
    ]);

    if ($this->form_validation->run() == true) {
      $name     = htmlspecialchars($this->input->post('name', true));
      $phone    = htmlspecialchars($this->input->post('phone', true));
      $address  = htmlspecialchars($this->input->post('address', true));
      $email    = htmlspecialchars($this->input->post('email', true));
      $gender   = htmlspecialchars($this->input->post('gender', true));

      $data = [
        'name'      => $name,
        'phone'     => $phone,
        'address'   => $address,
        'email'     => $email,
        'gender'    => $gender,
        // 'createdby' => $this->session->userdata('name'),
        'created'   => date('Y-m-d h:i:s')
      ];

      $this->db->insert('customer', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Yeay!</span> Data pelanggan atas nama ' . $name . ' berhasil ditambahkan.
  </div>');
      redirect('customer');
    } else {
      $data['title']      = 'Data Pelanggan Master POS';
      $data['contents']   = 'customer';
      $this->load->view('templates/core', $data);
    }
  }

  function showFormUpdate()
  {
    $idcustomer = $this->input->post('idcustomer');
    if (isset($idcustomer) and !empty($idcustomer)) {
      $query = $this->model->getDetailById($idcustomer);
      $output = '';
      foreach ($query as $i) :
        $output .= '
      
    <form action="' . base_url('customer/update') . '" method="post">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label>Nama customer</label>
            <input type="hidden" name="idcustomer" value="' . $i['idcustomer'] . '" class="form-control" required>
            <input type="text" name="name" value="' . $i['name'] . '" class="form-control" required>
          </div>

          <div class="col-sm-6">
            <label>No Handphone</label>
            <input type="text" name="phone" value="' . $i['phone'] . '" class="form-control" required>
          </div>

          <div class="col-sm-12">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" id="" cols="5" rows="5">' . $i['address'] . '</textarea>
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
    $idcustomer = htmlspecialchars($this->input->post('idcustomer', true));
    $name       = htmlspecialchars($this->input->post('name', true));
    $phone      = htmlspecialchars($this->input->post('phone', true));
    $alamat     = htmlspecialchars($this->input->post('alamat', true));

    $data = [
      'name'      => $name,
      'phone'     => $phone,
      'address'   => $alamat,
      // 'createdby' => $this->session->userdata('name'),
    ];

    $this->db->where('idcustomer', $idcustomer);
    $this->db->update('customer', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Yeay!</span> Data customer atas nama ' . $name . ' berhasil diupdate.
  </div>');
    redirect('customer');
  }

  function showModalDelete()
  {
    $idcustomer = $this->input->post('idcustomer');
    if (isset($idcustomer) and !empty($idcustomer)) {
      $query = $this->model->getDetailById($idcustomer);
      $output = '';
      foreach ($query as $i) :
        $output .= '
          <div class="row">
          <div class="col-sm-12 text-center">
            <p>Apakah Anda yakin akan menghapus data supllier atas nama</p>
            <h6 class="text-bold" style="margin-top: -10px;">' . $i['name'] . '</h6>
          </div>
            <div class="col-sm-12 text-center">
              <a href="' . base_url('customer/delete/') . $i['idcustomer'] . '">
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

  function delete($idcustomer)
  {
    $query = $this->db->get_where('transaction_group', ['idcustomer' => $idcustomer])->row_array();
    $querycustomer = $this->db->get_where('customer', ['idcustomer' => $idcustomer])->row_array();
    if ($query['idcustomer'] == $idcustomer) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Ups!</span> Data customer atas nama <b><i>' . $querycustomer['name'] . '</i></b> sudah pernah bertransaksi!.
    </div>');
      redirect('customer');
    } else {
      $this->db->where('idcustomer', $idcustomer);
      $this->db->delete('customer');
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Yeay!</span> Data pelanggan atas nama ' . $querycustomer['name'] . 'berhasil dihapus!.
    </div>');
      redirect('customer');
    }
  }
}
