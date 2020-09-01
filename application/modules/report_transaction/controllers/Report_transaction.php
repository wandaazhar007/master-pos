<?php defined('BASEPATH') or exit('No direct script access allowed');

class Report_transaction extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('m_report_transaction', 'model');
  }

  function index()
  {
    $data['title']      = 'Laporan Master POS';
    $data['contents']   = 'report_transaction';
    $this->load->view('templates/core', $data);
  }

  function getAllDataTransaction()
  {
    $start_date = htmlspecialchars($this->input->post('start_date', true));
    $end_date   = htmlspecialchars($this->input->post('end_date', true));
    // var_dump($end_date);
    // die;

    $this->model->getAllDataTransaction($start_date, $end_date);
  }
}
