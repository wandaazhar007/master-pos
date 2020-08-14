<?php
class M_product_category extends CI_Model
{

  // DataTables list table
  function datatables_getAllTable()
  {
    $column_order   = ['idproduct_category', 'name'];
    $column_search  = ['idproduct_category', 'name'];
    $def_order      = ['idproduct_category' => 'desc'];

    $this->_sql();
    $this->query_datatables($column_order, $column_search, $def_order);
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result_array();
  }

  function _sql()
  {
    $this->db->select("idproduct_category,name", false);
    $this->db->from("product_category");
    $this->db->order_by("idproduct_category", "desc");
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
    $column_order       = ['idproduct_category', 'name'];
    $column_search      = ['idproduct_category', 'name'];
    $def_order          = ['idproduct_category' => 'desc'];

    $this->_sql();
    $this->query_datatables($column_order, $column_search, $def_order);
    $query = $this->db->get();
    return $query->num_rows();
  }

  function getDetailById($idproduct_category)
  {
    return $this->db->query("SELECT * FROM `product_category` WHERE `product_category`.`idproduct_category` = '$idproduct_category'")->result_array();
  }
}
