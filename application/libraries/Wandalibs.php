<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author		Wanda Azhar
 * @link        https://github.com/wandaazhar007/admin-layanan-pengaduan/
 * @copyright	(c) 2018
 * 
 */

class Wandalibs
{
  public function __construct()
  {
    $CI = &get_instance();
    $this->db = $CI->load->database('default', TRUE);
  }

  /* Note: Function untuk cek login, jika user admin tidak memiliki session maka redirect ke halaman login | Author: wandaazhar@gmail.com */
  function _checkLoginSession()
  {
    $CI = &get_instance();
    if (!empty($CI->session->userdata('email'))) {
      // redirect('dashboard');
    } else {
      redirect('auth/login');
    }
  }

  /* Note: Function untuk set session login user admin | Author: wandaazhar@gmail.com */
  function _setSessionUser()
  {
    $CI = &get_instance();
    $email      = htmlspecialchars($CI->input->post('email'), true);
    $query = $CI->db->get_where('tb_user_admin', ['email' => $email])->row_array();
    $data = [
      'id'                => $query['id'],
      'email'             => $query['email'],
      'nama'              => $query['nama'],
      'no_hp'             => $query['no_hp'],
      'user_access'       => $query['user_access'],
      'foto'              => $query['foto'],
      'bidang'            => $query['bidang'],
      'active'            => $query['active'],
      'date_created'      => $query['date_created']
    ];
    $CI->session->set_userdata($data);
  }

  /* Note: Function untuk insert data log login user admin | Author: wandaazhar@gmail.com */
  function _insertLoginTime()
  {
    $CI = &get_instance();
    $email      = htmlspecialchars($CI->input->post('email'), true);
    $query = $CI->db->get_where('tb_user_admin', ['email' => $email])->row_array();
    $nama = $query['nama'];

    $data = [
      'nama'          => $nama,
      'email'         => $email,
      'date_created'  => time()
    ];

    $CI->db->insert('history_login', $data);
  }

  /* Note: Function untuk mengecek jika user masih memiliki session maka tidak bisa masuk ke halaman login  | Author: wandaazhar@gmail.com */
  function redirectLoginExist()
  {
    $CI = &get_instance();
    if ($CI->session->userdata('nama')) {
      redirect('dashboard');
    }
  }

  /* Note: Function untuk proses login yang ada di controller Auth | Author: wandaazhar@gmail.com */
  function _loginProcess()
  {
    $CI = &get_instance();
    $email      = htmlspecialchars($CI->input->post('email'), true);
    $password   = htmlspecialchars($CI->input->post('password'), true);

    $query = $CI->db->get_where('tb_user_admin', ['email' => $email])->row_array();
    $nama = $query['nama'];

    if ($query['active'] == 'tidak aktif') {
      $CI->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-close"></i><small><b>Maaf!</b>. Akun Anda tidak aktif, Silahkan cek Email untuk verifikasi</small>
            </div>');
      redirect('auth/login');
    }
    if (password_verify($password, $query['password'])) {
      $CI->wandalibs->_setSessionUser();
      $CI->wandalibs->_insertLoginTime();
      $CI->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fa fa-check"></i><b>Berhasil</b> Login! &nbsp;
            Selamat Datang <b>' . $nama . '</b>
            </div>');
      // echo 'test';
      redirect('dashboard');
    } elseif ($query['email'] != $email) {
      $CI->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-close"></i><small><b>Ups!</b>. Email belum terdaftar</small>
            </div>');
      redirect('auth/login');
    } elseif ($query['password'] != $password) {
      $CI->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-close"></i><small><b>Ups!</b>. Password Anda salah!</small>
            </div>');
      redirect('auth/login');
    }
  }

  /* Note: Function untuk menampilkan halaman login pertama kali user admin melakukan verifikasi lewat email | Author: wandaazhar@gmail.com */
  function _loginProcessFirstTime()
  {
    $CI = &get_instance();
    $email      = htmlspecialchars($CI->input->post('email'), true);
    $password   = htmlspecialchars($CI->input->post('password'), true);

    $query = $CI->db->get_where('tb_user_admin', ['email' => $email])->row_array();
    $nama = $query['nama'];

    if ($query['active'] == 'tidak aktif') {
      $CI->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fa fa-check"></i><small><b>Status</b>. Akun Anda sudah aktif sejak tanggal ' . date('d F Y', $query['date_created']) . '</small>
            </div>');
      redirect('auth/loginFirstTime');
    } elseif (password_verify($password, $query['password'])) {
      $CI->wandalibs->_setSessionUser();
      $CI->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h6><i class="icon fas fa-check"></i> Berhasil Login!</h6>
            Selamat datang <b>' . $nama . '</b>
            </div>');
      redirect('dashboard');
    } elseif ($query['email'] != $email) {
      $CI->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-close"></i><small><b>Ups!</b>. Email belum terdaftar</small>
            </div>');
      redirect('auth/loginFirstTime');
    } elseif ($query['password'] != $password) {
      $CI->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-close"></i><small><b>Ups!</b>. Password Anda salah!</small>
            </div>');
      redirect('' . $_SERVER['HTTP_REFERER'] . '');
    }
  }

  /* Note: Function untuk logout yang digunakan di controller Auth/logout | Author: wandaazhar@gmail.com */
  function _doLogout()
  {
    $CI = &get_instance();
    $email  = $CI->session->userdata('email');
    $query  = $CI->db->get_where('tb_user_admin', ['email' => $email])->row_array();
    $dataSession = [
      'id'        => $query['id'],
      'email'     => $query['email'],
      'nama'      => $query['nama'],
      'no_hp'      => $query['no_hp'],
      'foto'      => $query['foto']
    ];
    $CI->session->unset_userdata('id');
    $CI->session->unset_userdata('email');
    $CI->session->unset_userdata('nama');
    $CI->session->unset_userdata('user_access');
    $CI->session->unset_userdata('no_hp');
    $CI->session->unset_userdata('bidang');
    $CI->session->unset_userdata('active');
    $CI->session->unset_userdata('foto');
    $CI->session->unset_userdata('date_created');
    $CI->session->sess_destroy($dataSession);
    $CI->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show">
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
              <i class="nc-icon nc-simple-remove"></i>
            </button>
            <span><small><b>Terimakasih - </b> Anda telah berhasil logout </small></span>
          </div>');
    redirect('auth/login');
  }

  function restrictUserAccess($bidang)
  {
    $CI = &get_instance();
    $session = $CI->session->userdata('bidang');
    if ($session != $bidang or $session != 'promkes') {
      $CI->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show">
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
              <i class="nc-icon nc-simple-remove"></i>
            </button>
            <span><small><b>Maaf!, Anda tidak memiliki akses ke bidang <b><i>' . $bidang . '</i></b></small></span>
          </div>');
      // redirect('' . $_SERVER['HTTP_REFERER'] . '');
      redirect('dashboard');
    }
  }

  /* Note: Function untuk mengirim email | Author: wandaazhar@gmail.com */
  function _sendEmail($token, $type)
  {
    $CI = &get_instance();
    //load library send email CodeIgniter
    $CI->load->library('email');
    // $config = [
    //   'protocol'      => 'smtp',
    //   'smtp_host'     => 'ssl://smtp.googlemail.com',
    //   'smtp_user'     => 'promkesrsutangsel@gmail.com',
    //   'smtp_pass'     => 'PkRs2017',
    //   'smtp_port'     =>  465,
    //   'mailtype'      => 'html',
    //   'charset'       => 'utf-8'
    // ];

    $config = [
      'protocol'      => 'smtp',
      'smtp_crypto'   => 'tls',
      'smtp_host'     => 'smtp.googlemail.com',
      'smtp_user'     => 'promkesrsutangsel@gmail.com',
      'smtp_pass'     => 'PkRs2017',
      'smtp_port'     =>  587,
      // 'smtp_port'     =>  465,
      'mailtype'      => 'html',
      'charset'       => 'utf-8'
    ];

    //verify/inisialisasi smtp port di server localhost
    $CI->email->initialize($config);
    $CI->email->set_newline("\r\n");

    $CI->email->from('promkesrsutangsel@gmail.com', 'Promkes RSU Tangsel');
    $CI->email->to($CI->input->post('email'));
    $pesan_keluar   = $CI->input->post('pesan_keluar');
    $pesan_balasan   = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Layanan Pengaduan RSU Tangsel</title>
      <style>
          body {
              text-align: center;
          }
          .card{
            background-color: #009999;
            color: #fff;
            padding: 20px;
            text-align: center;
          }
      </style>
    </head>
    <body>
      <div class="card">
        <h5>RSU Kota Tangerang Selatan</h5>
          <div class="card-body">
            <h5>Hallo,</h5>
            <p>Ada pengaduan masuk loh, yuk segera cek dengan klik tombol dibawah ini</p>
            <a href="https://instagram.com/rsu_tangsel/"><button style="background-color="#009999"; color="#fff";">Cek Sekarang</button></a>
          </div>
      </div>
    </body>
    </html> 
    ';

    /* Note: Cek type email | Author: wandaazhar@gmail.com */
    if ($type == 'verify') {
      $CI->email->subject('Verifikasi Akun Layanan Pengaduan RSU Kota Tangerang Selatan (NO REPLY)');
      $CI->email->message('<h3 style="color: blue;">Terimakasih Anda telah mendaftar <br> Klik Link ini untuk verifikasi akun Anda : <h3> <br> <h3>Password Anda adalah: </h3> <a href="' . base_url() . 'auth/pageVerifikasiAkun?email=' . $CI->input->post('email') . '&token=' . urlencode($token) . '"><button style="color: #fff; background-color: blue;" >Aktikan</button></a>');
    } else if ($type == 'forgot') {
      $CI->email->subject('Reset Password Layanan Pengaduan RSU Kota Tangerang Selatan (NO REPLY)');
      $CI->email->message('<h3 style="color: blue;">Hallo<br> Klik Link ini untuk mereset password kamu: <h3> <a href="' . base_url() . 'register/resetPassword?email=' . $CI->input->post('email') . '&token=' . urlencode($token) . '"><button style="color: #fff; background-color: blue;" >Reset Password</button></a>');
    } else if ($type == 'compose') {
      $CI->email->subject('Layanan Pengaduan RSU Kota Tangerang Selatan (NO REPLY)');
      $CI->email->message($pesan_keluar);
    } else if ($type == 'balas_inbox') {
      $CI->email->subject('Layanan Pengaduan RSU Kota Tangerang Selatan (NO REPLY)');
      $CI->email->message($pesan_balasan);
    }

    if ($CI->email->send()) {
      return true;
    } else {
      echo $CI->email->print_debugger();
      die;
    }
  }

  /* Note: Function untuk mengirim email ketika forward ke bidang terkait | Author: wandaazhar@gmail.com */
  function _sendEmail2($email, $type)
  {
    $CI = &get_instance();
    //load library send email CodeIgniter
    $CI->load->library('email');
    $config = [
      'protocol'      => 'smtp',
      'smtp_host'     => 'ssl://smtp.googlemail.com',
      'smtp_user'     => 'promkesrsutangsel@gmail.com',
      'smtp_pass'     => 'PkRs2017',
      'smtp_port'     =>  465,
      'mailtype'      => 'html',
      'charset'       => 'utf-8'
    ];

    // $config = [
    //     'protocol'      => 'smtp',
    //     'smtp_crypto'   => 'tls',
    //     'smtp_host'     => 'smtp.googlemail.com',
    //     'smtp_user'     => 'promkesrsutangsel@gmail.com',
    //     'smtp_pass'     => 'PkRs2017',
    //     'smtp_port'     =>  587,
    //     // 'smtp_port'     =>  465,
    //     'mailtype'      => 'html',
    //     'charset'       => 'utf-8'
    // ];

    //verify/inisialisasi smtp port di server localhost
    $CI->email->initialize($config);
    $CI->email->set_newline("\r\n");

    $CI->email->from('promkesrsutangsel@gmail.com', 'Promkes RSU Tangsel');
    // $CI->email->to($CI->input->post('email'));
    $CI->email->to($email);
    // $pesan_keluar   = $CI->input->post('pesan_keluar');
    $pesanForward = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Pesan Pengaduan RSU Tangsel</title>
          <style>
              body {
                  text-align: center;
              }
              .card{
                background-color: #009999;
                color: #fff;
                padding: 20px;
                text-align: center;
                justify-content: center;
              }
              .card p {
                margin-top: -20px;
              }
              
              .card h3 {
                margin-top: -20px;
              }
          </style>
        </head>
        <body>
          <div class="card">
                <h2>RSU Kota Tangerang Selatan</h2>
                <h3>Hallo, ' . $CI->input->post('email') . '</h3>
                <p>Pesan pengaduan anda sudah kami balas,cek balasan kami dengan klik tombol dibawah ini</p>
                <a href="https://instagram.com/rsu_tangsel/"><button style="background-color="#fff"; color="#009999";">Cek Sekarang</button></a>
                <p>(NO REPLY). Jangan balas email ini</p>
          </div>
        </body>
        </html> 
          ';

    /* Note: Cek type email | Author: wandaazhar@gmail.com */
    if ($type == 'forward') {
      $CI->email->subject('Pengaduan Masuk RSU Kota Tangerang Selatan');
      $CI->email->message($pesanForward);
    } else if ($type == 'forgot') {
      $CI->email->subject('Reset Password');
      $CI->email->message('<h3 style="color: blue;">Hallo<br> Klik Link ini untuk mereset password kamu: <h3> <a href="' . base_url() . 'register/resetPassword?email=' . $CI->input->post('email') . '&token=' . urlencode($email) . '"><button style="color: #fff; background-color: blue;" >Reset Password</button></a>');
    }

    if ($CI->email->send()) {
      return true;
    } else {
      echo $CI->email->print_debugger();
      die;
    }
  }


  /* Note: Function untuk generate token PHP.5.1 | Author: wandaazhar@gmail.com */
  function _getToken($length = 6)
  {
    $characters = '0123456789';
    $characters_length = strlen($characters);
    $output = '';
    for ($i = 0; $i < $length; $i++)
      $output .= $characters[rand(0, $characters_length - 1)];

    return $output;
  }

  function countNotif($email)
  {
    $CI = &get_instance();
    $email    = $CI->session->userdata('email');
    $query = $CI->db->get_where('pesan', ['email' => $email]);
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  function getNotif($email)
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT COUNT(`pesan`.`email`) FROM `pesan` WHERE `pesan`.`email` = '$email'")->row_array();
  }

  /* Note: Function untuk membuat Hash | Author: wandaazhar@gmail.com */
  function regHash($par, $length = 6)
  {
    $keyHash = '';
    $chars     = "ABCDEFGHJKLMNPQRSTUVWXYZ";
    for ($i = 0; $i < $length; $i++) {
      $x = mt_rand(0, strlen($chars) - 1);
      $keyHash .= $chars{
        $x};
    }
    $return = '' . $par . '_' . $keyHash . '';
    return $return;
  }

  /* Note: Function untuk mengetahui kapan terkahir kali user admin login | Author: wandaazhar@gmail.com */
  function _lastLoginUserById($email)
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `history_login`.`date_created` FROM `history_login` WHERE `email` = '$email' ORDER BY `history_login`.`id` DESC LIMIT 10")->result_array();
  }

  /* Note: Function untuk menghitung jumlah login user admin | Author: wandaazhar@gmail.com */
  function countLoginUserById($email)
  {
    $CI = &get_instance();
    $query = $CI->db->query("SELECT `history_login`.`id` FROM `history_login` WHERE `email` = '$email'");
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  /* Note: Function untuk menghitung jumlah pesan masuk bidang penunjang | Author: wandaazhar@gmail.com */
  function countAllPesanPenunjang()
  {
    $CI = &get_instance();
    $query = $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`bidang` = 'penunjang' AND `pesan`.`tgl_forward` IS NOT NULL");
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  /* Note: Function untuk menghitung jumlah pesan masuk bidang keperawatan | Author: wandaazhar@gmail.com */
  function countAllPesanKeperawatan()
  {
    $CI = &get_instance();
    $query = $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`bidang` = 'keperawatan' AND `pesan`.`tgl_forward` IS NOT NULL");
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  /* Note: Function untuk menghitung jumlah pesan masuk bidang yanmed | Author: wandaazhar@gmail.com */
  function countAllPesanYanmed()
  {
    $CI = &get_instance();
    $query = $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`tgl_forward` IS NOT NULL AND `pesan`.`bidang` = 'pelayanan medis'");
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  function countAllPesanBelumBalasYanmed()
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`tgl_forward` IS NOT NULL AND `pesan`.`tgl_balas` IS NULL  AND `pesan`.`bidang` = 'pelayanan medis'")->num_rows();
  }

  function countAllPesanSedangProsesYanmed()
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`tgl_balas` IS NOT NULL AND `pesan`.`tgl_selesai` IS NULL AND `pesan`.`bidang` = 'pelayanan medis'")->num_rows();
  }

  function countAllPesanSelesaiYanmed()
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`tgl_selesai` IS NOT NULL AND `pesan`.`bidang` = 'pelayanan medis'")->num_rows();
  }

  /* Note: menhitung pesan penunjang | Author: wandaazhar@gmail.com */
  function countAllPesanBelumBalasPenunjang()
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`tgl_forward` IS NOT NULL AND `pesan`.`tgl_balas` IS NULL  AND `pesan`.`bidang` = 'penunjang'")->num_rows();
  }

  function countAllPesanSedangProsesPenunjang()
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`tgl_balas` IS NOT NULL AND `pesan`.`tgl_selesai` IS NULL AND `pesan`.`bidang` = 'penunjang'")->num_rows();
  }

  function countAllPesanSelesaiPenunjang()
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`tgl_selesai` IS NOT NULL AND `pesan`.`bidang` = 'penunjang'")->num_rows();
  }

  /* Note: menhitung pesan keperawatan | Author: wandaazhar@gmail.com */
  function countAllPesanBelumBalasKeperawatan()
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`tgl_forward` IS NOT NULL AND `pesan`.`tgl_balas` IS NULL  AND `pesan`.`bidang` = 'penunjang'")->num_rows();
  }

  function countAllPesanSedangProsesKeperawatan()
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`tgl_balas` IS NOT NULL AND `pesan`.`tgl_selesai` IS NULL AND `pesan`.`bidang` = 'penunjang'")->num_rows();
  }

  function countAllPesanSelesaiKeperawatan()
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`tgl_selesai` IS NOT NULL AND `pesan`.`bidang` = 'penunjang'")->num_rows();
  }


  /* Note: Function untuk menghitung jumlah pesan masuk bidang umum | Author: wandaazhar@gmail.com */
  function countAllPesanUmum()
  {
    $CI = &get_instance();
    $query = $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`tgl_forward` IS NOT NULL AND `pesan`.`bidang` = 'umum'");
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  function countAllPesanBelumBalasUmum()
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`tgl_forward` IS NOT NULL AND `pesan`.`tgl_balas` IS NULL  AND `pesan`.`bidang` = 'umum'")->num_rows();
  }

  function countAllPesanSedangProsesUmum()
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`tgl_balas` IS NOT NULL AND `pesan`.`tgl_selesai` IS NULL AND `pesan`.`bidang` = 'umum'")->num_rows();
  }

  function countAllPesanSelesaiUmum()
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`tgl_selesai` IS NOT NULL AND `pesan`.`bidang` = 'umum'")->num_rows();
  }


  /* Note: Function untuk menghitung jumlah keseluruhan pesan masuk berdasarkan user_access dari session user admin | Author: wandaazhar@gmail.com */
  function countAllInbox()
  {
    $CI = &get_instance();

    if ($CI->session->userdata('user_access') == 'administrator') {
      $query = $CI->db->query("SELECT `pesan`.`id` FROM `pesan`");
      if ($query->num_rows() > 0) {
        return $query->num_rows();
      } else {
        return 0;
      }
    }
    if ($CI->session->userdata('user_access') == 'yanmed') {
      $query = $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`bidang` = 'yanmed' AND `pesan`.`tgl_forward` IS NOT NULL");
      if ($query->num_rows() > 0) {
        return $query->num_rows();
      } else {
        return 0;
      }
    }
    if ($CI->session->userdata('user_access') == 'penunjang') {
      $query = $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`bidang` = 'penunjang' AND `pesan`.`tgl_forward` IS NOT NULL");
      if ($query->num_rows() > 0) {
        return $query->num_rows();
      } else {
        return 0;
      }
    }
    if ($CI->session->userdata('user_access') == 'umum') {
      $query = $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`bidang` = 'umum' AND `pesan`.`tgl_forward` IS NOT NULL");
      if ($query->num_rows() > 0) {
        return $query->num_rows();
      } else {
        return 0;
      }
    }
    if ($CI->session->userdata('user_access') == 'keperawatan') {
      $query = $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`bidang` = 'keperawatan' AND `pesan`.`tgl_forward` IS NOT NULL");
      if ($query->num_rows() > 0) {
        return $query->num_rows();
      } else {
        return 0;
      }
    }
  }

  function countAllOutbox()
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`pesan_keluar` IS NOT NULL")->num_rows();
  }

  function countAllPesanByEmailUser($email)
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`email` = '$email'")->num_rows();
  }
  function countAllPesanByIdUser($id_user)
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`id_user` = '$id_user'")->num_rows();
  }

  /* Note: Function untuk menghitung lamanya waktu balas pesan masuk berdasarkan hari | Author: wandaazhar@gmail.com */
  function akumulasiByDay($tgl_masuk, $tgl_selesai_int)
  {
    $diff = $tgl_selesai_int - $tgl_masuk;
    return round($diff / (60 * 60 * 24));
  }

  /* Note: Function untuk menghitung lamanya waktu balas pesan masuk berdasarkan jam | Author: wandaazhar@gmail.com */
  function akumulasiByHour($tgl_masuk, $tgl_selesai_int)
  {
    $diff = $tgl_selesai_int - $tgl_masuk;
    $totalHari = $diff / (60 * 60);
    $result = round($totalHari / 60);

    return $result;
  }

  /* Note: Function untuk menghitung lamanya waktu balas pesan masuk berdasarkan menit | Author: wandaazhar@gmail.com */
  function akumulasiByMinute($tgl_masuk, $tgl_selesai_int)
  {
    $diff = $tgl_selesai_int - $tgl_masuk;
    $totalHari = $diff / (60 * 24);
    $result = round($totalHari / 60);

    return $result;
  }

  // function sendAkumulasiByDay($tgl_masuk, $tgl_selesai_int)
  // {
  //  $tglMasuk = $this->akumulasiByDay($tgl_masuk, $tgl_selesai_int);
  //  $day = 7;
  //  if($day >)
  // }

  function countAllPesanBelumDibalas()
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`tgl_balas` IS NULL AND  `pesan`.`pesan_masuk` IS NOT NULL")->num_rows();
  }

  function countAllPesanSedangDiproses()
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`tgl_balas` IS NOT NULL AND  `pesan`.`pesan_masuk` IS NOT NULL")->num_rows();
  }

  function countAllPesanSudahSelesai()
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `pesan`.`id` FROM `pesan` WHERE `pesan`.`tgl_selesai` IS NOT NULL AND  `pesan`.`pesan_masuk` IS NOT NULL")->num_rows();
  }
  function countAllPesan()
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT `pesan`.`id` FROM `pesan`")->num_rows();
  }

  function getAllUserAdmin()
  {
    $CI = &get_instance();
    return $CI->db->query("SELECT * FROM `tb_user_admin` ORDER BY `id` DESC LIMIT 5")->result_array();
  }

  function getFotoProfileAdmin($id)
  {
    return $this->db->query("SELECT * FROM `tb_user_admin` WHERE `tb_user_admin`.`id` = '$id'")->result_array();
  }

  function getHistoryAdmin($id)
  {
    return $this->db->query("SELECT * FROM `tb_user_admin` WHERE `tb_user_admin`.`id` = '$id'")->result_array();
  }

  function getAllPesan()
  {
    return $this->db->query("SELECT `pesan`.`id`, `pesan`.`tgl_masuk`, `pesan`.`status_proses`, `tb_user`.`id` AS 'id_user', `tb_user`.`nama`, `tb_user`.`email` FROM `pesan` INNER JOIN `tb_user` ON `pesan`.`id_user` = `tb_user`.`id`
    WHERE `pesan`.`status_proses` IS NOT NULL
    ORDER BY `pesan`.`id` 
    DESC LIMIT 3")->result_array();
  }

  function getAllPesanYanmed()
  {
    return $this->db->query("SELECT `pesan`.`id`, `pesan`.`tgl_masuk`, `pesan`.`status_proses`, `tb_user`.`id` AS 'id_user', `tb_user`.`nama`, `tb_user`.`email` FROM `pesan` INNER JOIN `tb_user` ON `pesan`.`id_user` = `tb_user`.`id`
    WHERE `pesan`.`status_proses` IS NOT NULL AND `pesan`.`tgl_forward` IS NOT NULL AND `pesan`.`bidang` = 'pelayanan medis'
    ORDER BY `pesan`.`id` 
    DESC LIMIT 3")->result_array();
  }

  function getAllPesanPenunjang()
  {
    return $this->db->query("SELECT `pesan`.`id`, `pesan`.`tgl_masuk`, `pesan`.`status_proses`, `tb_user`.`id` AS 'id_user', `tb_user`.`nama`, `tb_user`.`email` FROM `pesan` INNER JOIN `tb_user` ON `pesan`.`id_user` = `tb_user`.`id`
    WHERE `pesan`.`status_proses` IS NOT NULL AND `pesan`.`tgl_forward` IS NOT NULL AND `pesan`.`bidang` = 'penunjang'
    ORDER BY `pesan`.`id` 
    DESC LIMIT 3")->result_array();
  }

  function getAllPesanKeperawatan()
  {
    return $this->db->query("SELECT `pesan`.`id`, `pesan`.`tgl_masuk`, `pesan`.`status_proses`, `tb_user`.`id` AS 'id_user', `tb_user`.`nama`, `tb_user`.`email` FROM `pesan` INNER JOIN `tb_user` ON `pesan`.`id_user` = `tb_user`.`id`
    WHERE `pesan`.`status_proses` IS NOT NULL AND `pesan`.`tgl_forward` IS NOT NULL AND `pesan`.`bidang` = 'keperawatan'
    ORDER BY `pesan`.`id` 
    DESC LIMIT 3")->result_array();
  }

  function getAllPesanUmum()
  {
    return $this->db->query("SELECT `pesan`.`id`, `pesan`.`tgl_masuk`, `pesan`.`status_proses`, `tb_user`.`id` AS 'id_user', `tb_user`.`nama`, `tb_user`.`email` FROM `pesan` INNER JOIN `tb_user` ON `pesan`.`id_user` = `tb_user`.`id`
    WHERE `pesan`.`status_proses` IS NOT NULL AND `pesan`.`tgl_forward` IS NOT NULL AND `pesan`.`bidang` = 'umum'
    ORDER BY `pesan`.`id` 
    DESC LIMIT 3")->result_array();
  }


  function getAllPesanSudahSelesai()
  {
    return $this->db->query("SELECT `pesan`.`id`, `pesan`.`tgl_masuk`, `pesan`.`status_proses`, `tb_user`.`id` AS 'id_user', `tb_user`.`nama`, `tb_user`.`email` FROM `pesan` INNER JOIN `tb_user` ON `pesan`.`id_user` = `tb_user`.`id`
    WHERE `pesan`.`status_proses` = 'sudah selesai'
    ORDER BY `pesan`.`id` 
    DESC LIMIT 3")->result_array();
  }

  function getAllPesanBelumDibalas()
  {
    return $this->db->query("SELECT `pesan`.`id`, `pesan`.`tgl_masuk`, `pesan`.`status_proses`, `tb_user`.`id` AS 'id_user', `tb_user`.`nama`, `tb_user`.`email` FROM `pesan` INNER JOIN `tb_user` ON `pesan`.`id_user` = `tb_user`.`id`
    WHERE `pesan`.`status_proses` = 'sudah diterima'
    ORDER BY `pesan`.`id` 
    DESC LIMIT 3")->result_array();
  }

  function getAllPesanSedangDiproses()
  {
    return $this->db->query("SELECT `pesan`.`id`, `pesan`.`tgl_masuk`, `pesan`.`status_proses`, `tb_user`.`id` AS 'id_user', `tb_user`.`nama`, `tb_user`.`email` FROM `pesan` INNER JOIN `tb_user` ON `pesan`.`id_user` = `tb_user`.`id`
    WHERE `pesan`.`status_proses` = 'sedang diproses'
    ORDER BY `pesan`.`id` 
    DESC LIMIT 3")->result_array();
  }

  function getPesanBelumBalasUmumById($id)
  {
  }


  function getPesanBelumDibalasYanmed()
  {
    return $this->db->query("SELECT `pesan`.`id`, `pesan`.`tgl_masuk`, `pesan`.`status_proses`, `tb_user`.`id` AS 'id_user', `tb_user`.`nama`, `tb_user`.`email` FROM `pesan` INNER JOIN `tb_user` ON `pesan`.`id_user` = `tb_user`.`id`
    WHERE `pesan`.`status_proses` = 'belum dibalas'
    ORDER BY `pesan`.`id` 
    DESC LIMIT 3")->result_array();
  }

  function echoBidang($bidang)
  {
    if ($bidang == 'pelayanan medis') {
      echo '<div class="badge badge-danger">Yanmed</div>';
    } elseif ($bidang == 'penunjang') {
      echo '<div class="badge badge-primary">Penunjang</div>';
    } elseif ($bidang == 'keperawatan') {
      echo '<div class="badge badge-success">Keperawatan</div>';
    } elseif ($bidang == 'umum') {
      echo '<div class="badge badge-warning">Umum</div>';
    }
  }

  function belumDibalas($tgl_balas)
  {
    if ($tgl_balas == NULL) {
      echo '<div class="badge badge-danger">Belum Dibalas</div>';
    } else {
      echo '<div class="badge badge-success">Sudah Dibalas</div>';
    }
  }
}
