<?php
class M_data_product extends CI_Model
{

  // DataTables list table
  function datatables_getAllTableDataProduct()
  {
    $column_order   = ['product.idproduct', 'product.name'];
    $column_search  = ['product.idproduct', 'product.name'];
    $def_order      = ['product.idproduct' => 'desc'];

    $this->_sql();
    $this->query_datatables($column_order, $column_search, $def_order);
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result_array();
  }

  function _sql()
  {
    $this->db->select("`product`.`idproduct`, `product`.`name`, `product`.`code_product`, `category`.`name_category`, `unit`.`name_unit`, `stock`.`total`, `price`.`buying_price`, `price`.`persentase`, `price`.`selling_price`", false);
    $this->db->from("product");
    $this->db->join("category", "category.idcategory = product.idcategory");
    $this->db->join("unit", "unit.idunit = product.idunit");
    $this->db->join("price", "price.idprice = product.idprice");
    $this->db->join("stock", "stock.idstock = product.idstock");
    // $this->db->join("product_stock", "product.idproduct_stock = product_stock.idproduct_stock", "left");
    $this->db->order_by("product.idproduct", "desc");
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
    $column_order = [
      'product.idproduct',
      'product.name',
      'product.price',
      'product.kode_product',
    ];

    $column_search = [
      'product.idproduct',
      'product.name',
    ];
    $def_order          = ['idproduct' => 'desc'];

    $this->_sql();
    $this->query_datatables($column_order, $column_search, $def_order);
    $query = $this->db->get();
    return $query->num_rows();
  }

  function getDetailById($idproduct)
  {
    return $this->db->query("SELECT * FROM `product` WHERE `product`.`idproduct` = '$idproduct'")->result_array();
  }

  // function getBarcode()
  // {
  //   return $this->db->query("SELECT MAX(`idproduct`) FROM `product`")->result_array();
  // }
}
