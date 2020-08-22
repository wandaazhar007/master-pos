<?php
class M_transaksi extends CI_Model
{
  function getProduct()
  {
    return $this->db->query("SELECT `product`.`idproduct`, `product`.`name` FROM `product`")->result_array();
  }

  function getIdTransactionGroup()
  {
    return $this->db->query("SELECT MAX(`idtransaction_group`) AS `id_trans` FROM `transaction`")->row_array();
  }

  function getAddProduct()
  {
    return $this->db->query("SELECT `temp_transaction`.`idtransaction`, `temp_transaction`.`qty`, `temp_transaction`.`discount`, `temp_transaction`.`sell_price`, `temp_transaction`.`final_price`, `product`.`name` FROM `temp_transaction` INNER JOIN `product` ON `product`.`idproduct` = `temp_transaction`.`idproduct`")->result_array();
  }
}
