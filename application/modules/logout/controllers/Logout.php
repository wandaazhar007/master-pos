<?php defined('BASEPATH') or exit('No direct script access allowed');
class Logout extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
  }

  function logoutUser()
  {
    $email  = $this->session->userdata('email');
    $nama  = $this->session->userdata('nama');
    $query  = $this->db->get_where('tb_user_admin', ['email' => $email])->row_array();
    $dataSession = [
      'id'        => $query['id'],
      'email'     => $query['email'],
      'nama'      => $query['nama'],
      'no_hp'      => $query['no_hp'],
      'foto'      => $query['foto']
    ];
    $this->session->unset_userdata('id');
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('nama');
    $this->session->unset_userdata('no_hp');
    $this->session->unset_userdata('foto');
    $this->session->unset_userdata('date_created');
    // $this->session->sess_destroy($dataSession);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <i class="icon fa fa-check"></i>Terimakasih!&nbsp;
    <b>' . $nama . '</b> Kamu berhasil logout
    </div>');
    redirect('auth/login');
  }
}
