<?php
class M_product_unit extends CI_Model
{

  // DataTables list table
  function datatables_getAllTable()
  {
    $column_order   = ['idproduct_unit', 'name'];
    $column_search  = ['idproduct_unit', 'name'];
    $def_order      = ['idproduct_unit' => 'desc'];

    $this->_sql();
    $this->query_datatables($column_order, $column_search, $def_order);
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result_array();
  }

  function _sql()
  {
    $this->db->select("idproduct_unit,name", false);
    $this->db->from("product_unit");
    $this->db->order_by("idproduct_unit", "desc");
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
    $column_order       = ['idproduct_unit', 'name'];
    $column_search      = ['idproduct_unit', 'name'];
    $def_order          = ['idproduct_unit' => 'desc'];

    $this->_sql();
    $this->query_datatables($column_order, $column_search, $def_order);
    $query = $this->db->get();
    return $query->num_rows();
  }

  function getDetailById($idproduct_unit)
  {
    return $this->db->query("SELECT * FROM `product_unit` WHERE `product_unit`.`idproduct_unit` = '$idproduct_unit'")->result_array();
  }
}
