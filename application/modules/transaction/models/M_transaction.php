<?php
class M_transaction extends CI_Model
{
  function getProduct()
  {
    return $this->db->query("SELECT `product`.`idproduct`, `product`.`name`, `product`.`selling_price` FROM `product`")->result_array();
  }

  // function getIdTransactionGroup()
  // {
  //   return $this->db->query("SELECT MAX(`idtransaction_group`) AS `id_trans` FROM `transaction`")->row_array();
  // }

  function getAddProduct()
  {
    return $this->db->query("SELECT `temp_transaction`.`idtemp_transaction`,  `temp_transaction`.`qty`, `temp_transaction`.`discount`, `temp_transaction`.`selling_price`, `temp_transaction`.`final_price`, `product`.`name` FROM `temp_transaction` INNER JOIN `product` ON `product`.`idproduct` = `temp_transaction`.`idproduct`")->result_array();
  }

  function getDetailById($idtemp_transaction)
  {
    return $this->db->query("SELECT `temp_transaction`.`idtemp_transaction`, `temp_transaction`.`qty`, `product`.`name` FROM `temp_transaction` LEFT JOIN `product` ON `temp_transaction`.`idproduct` = `product`.`idproduct` WHERE `temp_transaction`.`idtemp_transaction` = '$idtemp_transaction'")->result_array();
  }
}
