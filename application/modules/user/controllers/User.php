<?php defined('BASEPATH') or exit('No direct script access allowed');

class User extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->wandalibs->_checkLoginSession();
    $this->load->library('datatables');
    $this->load->model('m_user', 'model');
  }

  function index()
  {
    $data['title']      = 'Data Pengguna Master POS';
    $data['contents']   = 'list_user';
    $data['getAll']     = $this->model->getAll();
    $this->load->view('templates/core', $data);
  }

  function getAllTable()
  {

    $list = $this->model->datatables_getAllTable();
    $data = array();
    $no = 1;
    foreach ($list as $value) {
      $queryAction = '<a href="#">
        <button class="tombol-edit view_user" id="' . $value['iduser'] . '"><i class="fa fa-pencil"></i>&nbsp;edit</button>
        </a>
        <a href="#">
        <button class="tombol-hapus view_hapus" id="' . $value['iduser'] . '"><i class="fa fa-trash"></i>&nbsp;hapus</button>
        </a>';
      // <button class="tombol-hapus view_delete_user" id="tombol-delete-user"><i class="fa fa-trash"></i>&nbsp;hapus</button>


      $row = array();
      $row[] = $no++;
      $row[] = $value['name'];
      $row[] = $value['username'];
      $row[] = $value['phone'];
      $row[] = $value['group_name'];
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
    $this->form_validation->set_rules('name', 'Nama Pengguna', 'required', [
      'required'  => 'Nama pengguna belum diisi!'
    ]);
    // $this->form_validation->set_rules('phone', 'No Handphone', 'required|trim', [
    //   'required'  => 'No Handphone pengguna belum diisi'
    // ]);
    // $this->form_validation->set_rules('group_name', 'Hak Akses', 'required', [
    //   'required'  => 'Hak akses pengguna belum dipilih'
    // ]);
    // $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]', [
    //   'required'  => 'Alamat Email belum diisi',
    //   'valid_email' => 'Format email tidak valid',
    //   'is_unique'   => 'Maaf, email ini sudah terdaftar'
    // ]);
    // $this->form_validation->set_rules('username', 'Username', 'required|trim', [
    //   'required'  => 'Username belum diisi'
    // ]);
    // $this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]', [
    //   'required'  => 'Password belum diisi',
    //   'matches'   => 'Password tidak sama'
    // ]);
    // $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
    //   'required'  => 'Password belum diisi',
    //   'matches'   => 'Password tidak sama'
    // ]);

    if ($this->form_validation->run() == true) {
      $query = $this->db->query("SELECT `user`.`iduser` FROM `user` ORDER BY `user`.`iduser` DESC LIMIT 1")->row_array();
      $iduser = $query['iduser'];

      $name         = htmlspecialchars($this->input->post('name', true));
      $phone        = htmlspecialchars($this->input->post('phone', true));
      $group_name   = htmlspecialchars($this->input->post('group_name', true));
      $email        = htmlspecialchars($this->input->post('email', true));
      $username     = htmlspecialchars($this->input->post('username', true));
      $password1    = htmlspecialchars($this->input->post('password1', true));

      $data = [
        'name'          => $name,
        'phone'         => $phone,
        'group_name'    => $group_name,
        'email'         => $email,
        'username'      => $username,
        'password'      => $password1,
        'createdby'     => $this->session->userdata('name'),
        'created'       => date('Y-m-d h:i:s')
      ];

      $this->db->insert('user', $data);
      //     $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      //   <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      //   <span class="text-semibold">Yeay!</span> Data pengguna atas nama ' . $name . ' berhasil ditambahkan.
      // </div>');
      $this->session->set_flashdata('message', '<div class="alert alert-success bg-teal alert-styled-left">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Berhasil!</span> Data pengguna atas nama &nbsp; <b><i><a href="' . base_url('user/detail/') . $iduser . '" class="alert-link"> ' . $name . ' </a></i></b>&nbsp; berhasil ditambahkan.
      </div>');
      redirect('user');
    } else {
      $data['title']      = 'Data Pengguna Master POS';
      $data['contents']   = 'list_user';
      $this->load->view('templates/core', $data);
    }
  }

  function showFormUpdate()
  {
    $iduser = $this->input->post('iduser');
    if (isset($iduser) and !empty($iduser)) {
      $query = $this->model->getDetailById($iduser);
      $output = '';
      foreach ($query as $i) :
        $output .= '
      
    <form action="' . base_url('user/update') . '" method="post">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label>Nama user</label>
            <input type="hidden" name="iduser" value="' . $i['iduser'] . '" class="form-control" required>
            <input type="text" name="name" value="' . $i['name'] . '" class="form-control" required>
          </div>

          <div class="col-sm-6">
            <label>No Handphone</label>
            <input type="text" name="phone" value="' . $i['phone'] . '" class="form-control" required>
          </div>

          <div class="col-sm-12">
            <label>Hak Akses</label>
            <textarea name="alamat" class="form-control" id="" cols="5" rows="5">' . $i['group_name'] . '</textarea>
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
    $iduser     = htmlspecialchars($this->input->post('iduser', true));
    $name       = htmlspecialchars($this->input->post('name', true));
    $phone      = htmlspecialchars($this->input->post('phone', true));
    $akses      = htmlspecialchars($this->input->post('akses', true));

    $data = [
      'name'      => $name,
      'phone'     => $phone,
      'akses'     => $akses,
      // 'createdby' => $this->session->userdata('name'),
    ];

    $this->db->where('iduser', $iduser);
    $this->db->update('user', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Yeay!</span> Data pengguna atas nama ' . $name . ' berhasil diupdate.
  </div>');
    redirect('user');
  }

  function showModalDelete()
  {
    $iduser = $this->input->post('iduser');
    if (isset($iduser) and !empty($iduser)) {
      $query = $this->model->getDetailById($iduser);
      $output = '';
      foreach ($query as $i) :
        $output .= '
          <div class="row">
          <div class="col-sm-12 text-center">
            <p>Apakah Anda yakin akan menghapus data pengguna atas nama</p>
            <h6 class="text-bold" style="margin-top: -10px;">' . $i['name'] . '</h6>
          </div>
            <div class="col-sm-12 text-center">
              <a href="' . base_url('user/delete/') . $i['iduser'] . '">
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

  function delete($iduser)
  {
    $query = $this->db->get_where('user', ['iduser' => $iduser])->row_array();
    $queryuser = $this->db->get_where('user', ['iduser' => $iduser])->row_array();
    if ($query['iduser'] == $iduser) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Ups!</span> Data pengguna atas nama <b><i>' . $queryuser['name'] . '</i></b> sudah masuk ke daftar!.
    </div>');
      redirect('user');
    } else {
      $this->db->where('iduser', $iduser);
      $this->db->delete('user');
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Yeay!</span> Data pengguna berhasil dihapus!.
    </div>');
      redirect('user');
    }
  }

  function detail($iduser)
  {
    $data['title']    = 'Detail Pengguna';
    $data['contents'] = 'detail';
    $data['getById']  = $this->model->getById($iduser);

    $this->load->view('templates/core', $data);
  }
}
