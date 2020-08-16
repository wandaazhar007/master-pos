<?php defined('BASEPATH') or exit('No direct script access allowed');
class User extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->wandalibs->_checkLoginSession();
  }

  function index()
  {
    $this->load->view('list_user');
  }
}
