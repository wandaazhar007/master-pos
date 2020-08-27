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
    $nama  = $this->session->userdata('name');
    $query  = $this->db->get_where('user_admin', ['email' => $email])->row_array();
    $dataSession = [
      'iduser_admin'        => $query['iduser_admin'],
      'email'     => $query['email'],
      'name'      => $query['name'],
      'phone'      => $query['phone'],
      'phone'      => $query['phone']
    ];
    $this->session->unset_userdata('iduser_admin');
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('name');
    $this->session->unset_userdata('phone');
    $this->session->unset_userdata('phonoe');
    $this->session->unset_userdata('date_created');
    $this->session->unset_userdata('created_by');
    // $this->session->sess_destroy($dataSession);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <i class="icon fa fa-check"></i>Terimakasih!&nbsp;
    <b>' . $nama . '</b> Kamu berhasil logout
    </div>');
    redirect('auth/login');
  }
}
