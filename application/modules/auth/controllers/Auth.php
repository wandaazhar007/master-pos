<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('name')) {
      redirect('dashboard');
    }
  }

  function index()
  {
    $data['title']      = 'Selamat Datang';
    $this->load->view('login', $data);
  }

  function login()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('email', 'email', 'required|valid_email', [
      'required'    => 'Email tidak boleh kosong',
      'valid_email' => 'Format email tidak sesuai'
    ]);
    $this->form_validation->set_rules('password', 'Password', 'required', [
      'required'    => 'Password tidak boleh kosong'
    ]);

    if ($this->form_validation->run() == false) {
      $data['title']      = 'Selamat Datang';
      $this->load->view('login', $data);
    } else {
      $this->wandalibs->_loginProcess();
    }
  }

  function logout()
  {
    $this->wandalibs->_doLogout();
  }
}
