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
        <button class="tombol-edit view_user" id="' . $value['iduser_admin'] . '"><i class="fa fa-pencil"></i>&nbsp;edit</button>
        </a>
        <a href="#">
        <button class="tombol-hapus view_hapus" id="' . $value['iduser_admin'] . '"><i class="fa fa-trash"></i>&nbsp;hapus</button>
        </a>';
      // <button class="tombol-hapus view_delete_user" id="tombol-delete-user"><i class="fa fa-trash"></i>&nbsp;hapus</button>

      $row = array();
      $row[] = $no++;
      $row[] = $value['name'];
      $row[] = $value['username'];
      $row[] = $value['email'];
      $row[] = $value['phone'];
      $row[] = $value['name_access'];
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
    $this->form_validation->set_rules('phone', 'No Handphone', 'required|trim', [
      'required'  => 'No Handphone pengguna belum diisi'
    ]);
    $this->form_validation->set_rules('iduser_access', 'Hak Akses', 'required', [
      'required'  => 'Hak akses pengguna belum dipilih'
    ]);
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user_admin.email]', [
      'required'  => 'Alamat Email belum diisi',
      'valid_email' => 'Format email tidak valid',
      'is_unique'   => 'Maaf, email ini sudah terdaftar'
    ]);
    $this->form_validation->set_rules('username', 'Username', 'required|trim', [
      'required'  => 'Username belum diisi'
    ]);
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]', [
      'required'  => 'Password belum diisi',
      'matches'   => 'Password tidak sama'
    ]);
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
      'required'  => 'Password belum diisi',
      'matches'   => 'Password tidak sama'
    ]);

    if ($this->form_validation->run() == true) {
      $query = $this->db->query("SELECT `user_admin`.`iduser_admin` FROM `user_admin` ORDER BY `user_admin`.`iduser_admin` DESC LIMIT 1")->row_array();
      $iduser = $query['iduser_admin'];

      $name         = htmlspecialchars($this->input->post('name', true));
      $phone        = htmlspecialchars($this->input->post('phone', true));
      $iduser_access = htmlspecialchars($this->input->post('iduser_access', true));
      $email        = htmlspecialchars($this->input->post('email', true));
      $username     = htmlspecialchars($this->input->post('username', true));
      $password1    = password_hash($this->input->post('password1', true), PASSWORD_DEFAULT);

      $uploadGambar = $_FILES['photo']['name'];
      if ($uploadGambar) {
        $config['upload_path']      = './assets/images/profile/';
        $config['allowed_types']    = 'gif|jpg|png|pdf';
        $config['max_size']         = '2048';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('photo')) {
          $this->upload->data('file_name');
        } else {
          echo $this->upload->display_errors();
        }
      } else {
        $uploadGambar = 'default-user.png';
      }

      $data = [
        'name'          => $name,
        'phone'         => $phone,
        'iduser_access' => $iduser_access,
        'email'         => $email,
        'username'      => $username,
        'password'      => $password1,
        'photo'         => $uploadGambar,
        'created_by'    => $this->session->userdata('name'),
        'date_created'  => date('Y-m-d h:i:s')
      ];

      $this->db->insert('user_admin', $data);
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
    $iduser_admin = $this->input->post('iduser_admin');
    if (isset($iduser_admin) and !empty($iduser_admin)) {
      $query = $this->model->getDetailById($iduser_admin);
      $output = '';
      foreach ($query as $i) :
        $output .= '
        <script type="text/javascript" src="' .  base_url() . 'assets/js/plugins/forms/selects/select2.min.js"></script>
        <script type="text/javascript" src="' .  base_url() . 'assets/js/pages/form_select2.js"></script>
        ';
        $output .= '
      
    <form action="' . base_url('user/update') . '" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label>Nama user</label>
            <input type="hidden" name="iduser_admin" value="' . $i['iduser_admin'] . '" class="form-control" required>
            <input type="text" name="name" value="' . $i['name'] . '" class="form-control" required>
          </div>

          <div class="col-sm-6">
            <label>Username</label>
            <input type="text" name="username" value="' . $i['username'] . '" class="form-control" readonly>
          </div>

          <div class="col-sm-6" style="margin-top: 10px;">
            <label>No Handphone</label>
            <input type="text" name="phone" value="' . $i['phone'] . '" class="form-control" required>
          </div>
          
          <div class="col-sm-6" style="margin-top: 10px;">
            <label>Email</label>
            <input type="text" name="email" value="' . $i['email'] . '" class="form-control" required>
          </div>

          <div class="col-sm-6" style="margin-top: 10px;">
            <label>Hak Akses</label>
            <select data-placeholder="Pilih hak akses pengguna..." class="select select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="iduser_access">
            
            <option value="' . $i['iduser_access'] . '">' . $i['name_access'] . '</option>
                   ' . $this->wandalibs->getAllUserAccessArray() . '
              
            </select>
          </div>

          <div class="col-sm-6" style="margin-top: 10px;">
            <label>Email</label>
            <input type="file" name="photo" class="form-control">
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
    $this->form_validation->set_rules('name', 'Nama Pengguna', 'required', [
      'required'  => 'Nama pengguna belum diisi!'
    ]);
    $this->form_validation->set_rules('phone', 'No Handphone', 'required|trim', [
      'required'  => 'No Handphone pengguna belum diisi'
    ]);
    $this->form_validation->set_rules('iduser_access', 'Hak Akses', 'required', [
      'required'  => 'Hak akses pengguna belum dipilih'
    ]);
    // $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user_admin.email]', [
    //   'required'  => 'Alamat Email belum diisi',
    //   'valid_email' => 'Format email tidak valid',
    //   'is_unique'   => 'Maaf, email ini sudah terdaftar'
    // ]);
    // $this->form_validation->set_rules('username', 'Username', 'required|trim', [
    //   'required'  => 'Username belum diisi'
    // ]);

    if ($this->form_validation->run() == true) {
      // $query = $this->db->query("SELECT `user_admin`.`iduser_admin` FROM `user_admin` ORDER BY `user_admin`.`iduser_admin` DESC LIMIT 1")->row_array();
      // $iduser = $query['iduser_admin'];

      $iduser_admin   = htmlspecialchars($this->input->post('iduser_admin', true));
      $name           = htmlspecialchars($this->input->post('name', true));
      $phone          = htmlspecialchars($this->input->post('phone', true));
      $iduser_access  = htmlspecialchars($this->input->post('iduser_access', true));
      $email          = htmlspecialchars($this->input->post('email', true));
      $username       = htmlspecialchars($this->input->post('username', true));

      $uploadGambar = $_FILES['photo']['name'];
      if ($uploadGambar) {
        $config['upload_path']      = './assets/images/profile/';
        $config['allowed_types']    = 'gif|jpg|png|pdf';
        $config['max_size']         = '2048';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('photo')) {
          $this->upload->data('file_name');
        } else {
          echo $this->upload->display_errors();
        }
      } else {
        $query = $this->db->get_where('user_admin', ['iduser_admin' => $iduser_admin])->row_array();
        $uploadGambar = $query['photo'];
      }

      $data = [
        'name'          => $name,
        'phone'         => $phone,
        'iduser_access' => $iduser_access,
        'email'         => $email,
        'username'      => $username,
        'photo'         => $uploadGambar,
        'updated_by'    => $this->session->userdata('name'),
        'updated'       => date('Y-m-d h:i:s')
      ];

      $this->db->where('iduser_admin', $iduser_admin);
      $this->db->update('user_admin', $data);
      //     $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      //   <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      //   <span class="text-semibold">Yeay!</span> Data pengguna atas nama ' . $name . ' berhasil ditambahkan.
      // </div>');
      $this->session->set_flashdata('message', '<div class="alert alert-success bg-teal alert-styled-left">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Berhasil!</span> Data pengguna atas nama &nbsp; <b><i><a href="' . base_url('user/detail/') . $iduser_admin . '" class="alert-link"> ' . $name . ' </a></i></b>&nbsp; berhasil diupdate.
      </div>');
      redirect('user');
    } else {
      $data['title']      = 'Data Pengguna Master POS';
      $data['contents']   = 'list_user';
      $this->load->view('templates/core', $data);
    }
  }

  function showModalDelete()
  {
    $iduser_admin = $this->input->post('iduser_admin');
    if (isset($iduser_admin) and !empty($iduser_admin)) {
      $query = $this->model->getDetailById($iduser_admin);
      $output = '';
      foreach ($query as $i) :
        $output .= '
          <div class="row">
          <div class="col-sm-12 text-center">
            <p>Apakah Anda yakin akan menghapus data pengguna atas nama</p>
            <h6 class="text-bold" style="margin-top: -10px;">' . $i['name'] . '</h6>
          </div>
            <div class="col-sm-12 text-center">
              <a href="' . base_url('user/delete/') . $i['iduser_admin'] . '">
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

  function delete($iduser_admin)
  {
    $query = $this->db->get_where('user_admin', ['iduser_admin' => $iduser_admin])->row_array();
    $queryuser = $this->db->get_where('user_admin', ['iduser_admin' => $iduser_admin])->row_array();
    if ($query['iduser_admin'] == $iduser_admin) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Ups!</span> Data pengguna atas nama <b><i>' . $queryuser['name'] . '</i></b> sudah masuk ke daftar!.
    </div>');
      redirect('user');
    } else {
      $this->db->where('iduser_admin', $iduser_admin);
      $this->db->delete('user_admin');
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
      <span class="text-semibold">Yeay!</span> Data pengguna berhasil dihapus!.
    </div>');
      redirect('user');
    }
  }

  function detail($iduser_admin)
  {
    $data['title']    = 'Detail Pengguna';
    $data['contents'] = 'detail';
    $data['getById']  = $this->model->getById($iduser_admin);

    $this->load->view('templates/core', $data);
  }
}
