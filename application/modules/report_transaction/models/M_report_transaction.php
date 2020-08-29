<?php
class M_report_transaction extends CI_Model
{
  function getAllDataTransaction($start_date, $end_date)
  {
    return $this->db->query("SELECT `transaction`.`idtransaction`, `transaction`.`code_product`, `transaction`.`qty`, `transaction`.`discount`, `transaction`.`selling_price`, `transaction`.`final_price`, `transaction`.`status`, `transaction`.`name_customer` WHERE `product`.`date_created` BETWEEN $start_date AND $end_date")->result_array();
  }
}
