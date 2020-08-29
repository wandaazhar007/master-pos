<?php
class M_product_stock extends CI_Model
{

  // DataTables list table
  function datatables_getAllTable()
  {
    $column_order   = ['stock.idstock', 'name', 'stock.date_created', 'code_product', 'type'];
    $column_search  = ['stock.idstock', 'name', 'stock.date_created', 'code_product', 'type'];
    $def_order      = ['stock.idstock' => 'desc'];

    $this->_sql();
    $this->query_datatables($column_order, $column_search, $def_order);
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result_array();
  }

  function _sql()
  {
    $this->db->select("`stock`.`idstock`, `stock`.`type`, `stock`.`total`, `stock`.`created_by`, `stock`.`date_created`, `stock`.`updated`, `stock`.`updated_by`, `stock`.`description`, `product`.`idproduct`, `product`.`name`, `product`.`code_product`, `supplier`.`name_supplier`, `unit`.`name_unit`", false);
    $this->db->from("stock");
    $this->db->join('product', 'product.idproduct = stock.idproduct', 'left');
    $this->db->join('supplier', 'supplier.idsupplier = product.idsupplier', 'left');
    $this->db->join('unit', 'unit.idunit = product.idunit', 'left');
    $this->db->order_by("idstock", "desc");

    // $this->db->query("SELECT `product_stock`.`idproduct_stock`, `product_stock`.`stock_date`, `product_stock`.`type`, `product_stock`.`detail`, `product_stock`.`total`, `product_stock`.`createdby`, `product`.`name`, `product`.`barcode`, `unit`.`name` AS `name_supplier` FROM `product_stock` INNER JOIN `product` ON `product_stock`.`idproduct` = `product`.`idproduct` INNER JOIN `supplier` ON `product_stock`.`idsupplier` = `supplier`.`idsupplier`");
  }

  function query_datatables($column_order, $column_search, $def_order)
  {
    $i = 0;
    foreach ($column_search as $item) {
      if ($_POST['search']['value']) {
        if ($i === 0) {
          $this->db->group_start();
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        if (count($column_search) - 1 == $i)
          $this->db->group_end();
      }
      $i++;
    }

    if (isset($_POST['order'])) {
      $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($order)) {
      $order = $def_order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function countAll()
  {
    $this->_sql();
    return $this->db->count_all_results();
  }

  function countFiltered()
  {
    $column_order       = ['stock.idstock', 'name', 'stock.date_created', 'code_product', 'type'];
    $column_search      = ['stock.idstock', 'name', 'stock.date_created', 'code_product', 'type'];
    $def_order          = ['stock.idstock' => 'desc'];

    $this->_sql();
    $this->query_datatables($column_order, $column_search, $def_order);
    $query = $this->db->get();
    return $query->num_rows();
  }

  function getDetailById($idstock)
  {
    return $this->db->query("SELECT `stock`.`idstock`, `stock`.`date_created`, `stock`.`type`, `stock`.`total`, `stock`.`created_by`, `product`.`name`, `product`.`code_product`, `supplier`.`name_supplier` FROM `stock` LEFT JOIN `product` ON `stock`.`idproduct` = `product`.`idproduct` LEFT JOIN `supplier` ON `product`.`idsupplier` = `supplier`.`idsupplier` WHERE `stock`.`idstock` = '$idstock'")->result_array();
  }

  function getProduct()
  {
    return $this->db->query("SELECT `product`.`idproduct`, `product`.`name` FROM `product`")->result_array();
  }

  function getSupplier()
  {
    return $this->db->query("SELECT `supplier`.`idsupplier`, `supplier`.`name` FROM `supplier`")->result_array();
  }
}
