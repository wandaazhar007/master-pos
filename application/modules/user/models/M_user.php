<?php
class M_user extends CI_Model
{

  // DataTables list table
  function datatables_getAllTable()
  {
    $column_order   = ['iduser_admin', 'name', 'phone'];
    $column_search  = ['iduser_admin', 'name', 'phone'];
    $def_order      = ['iduser_admin' => 'desc'];

    $this->_sql();
    $this->query_datatables($column_order, $column_search, $def_order);
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result_array();
  }

  function _sql()
  {
    $this->db->select("`user_admin`.`iduser_admin`, `user_admin`.`name`, `user_admin`.`username`, `user_admin`.`email`, `user_admin`.`phone`, `user_admin`.`date_created`, `user_admin`.`created_by`, `user_admin`.`updated`, `user_admin`.`updated_by`, `user_access`.`name_access`, `user_access`.`description`", false);
    $this->db->from("user_admin");
    $this->db->join('user_access', 'user_access.iduser_access = user_admin.iduser_access', 'left');
    $this->db->order_by("iduser_admin", "desc");
    // $this->db->select("iduser,name,address,phone,description,created", false);
    // $this->db->from("user");
    // $this->db->order_by("iduser", "desc");
    // $this->db->query("SELECT * FROM `tb_user` ORDER BY `id` DESC");

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
      // $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
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
    $column_order       = ['iduser_admin', 'name', 'phone'];
    $column_search      = [
      'iduser_admin',
      'name',
      'phone'
    ];
    $def_order          = ['iduser_admin' => 'desc'];

    $this->_sql();
    $this->query_datatables($column_order, $column_search, $def_order);
    $query = $this->db->get();
    return $query->num_rows();
  }

  function getDetailById($iduser_admin)
  {
    return $this->db->query("SELECT `user_admin`.`iduser_admin`, `user_admin`.`name`, `user_admin`.`username`, `user_admin`.`phone`, `user_admin`.`email`, `user_access`.`name_access`, `user_access`.`iduser_access` FROM `user_admin` LEFT JOIN `user_access` ON `user_admin`.`iduser_access` = `user_access`.`iduser_access` WHERE `user_admin`.`iduser_admin` = '$iduser_admin'")->result_array();
  }

  function getAll()
  {
    return $this->db->query("SELECT `user_admin`.`iduser_admin`, `user_admin`.`name`, `user_admin`.`username`, `user_admin`.`phone`, `user_admin`.`email`, `user_admin`.`created_by`, `user_admin`.`date_created`, `user_access`.`name_access`, `user_access`.`description` FROM `user_admin` LEFT JOIN `user_access` ON `user_admin`.`iduser_access` = `user_access`.`iduser_access`")->result_array();
  }
}
