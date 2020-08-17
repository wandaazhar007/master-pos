<?php
class M_user extends CI_Model
{

  // DataTables list table
  function datatables_getAllTable()
  {
    $column_order   = ['iduser', 'name', 'phone', 'akses'];
    $column_search  = ['iduser', 'name', 'phone', 'akses'];
    $def_order      = ['iduser' => 'desc'];

    $this->_sql();
    $this->query_datatables($column_order, $column_search, $def_order);
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result_array();
  }

  function _sql()
  {
    $this->db->select("`user`.`iduser`, `user`.`name`, `user`.`username`, `user`.`phone`, `user`.`created`, `user_group`.`idgroup`, `group`.`group_name`, `group`.`description`", false);
    $this->db->from("user");
    $this->db->join('user_group', 'user_group.iduser = user.iduser', 'inner');
    $this->db->join('group', 'group.idgroup = user_group.idgroup', 'inner');
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
    $column_order       = ['iduser', 'name', 'phone'];
    $column_search      = [
      'iduser',
      'name',
      'phone'
    ];
    $def_order          = ['iduser' => 'desc'];

    $this->_sql();
    $this->query_datatables($column_order, $column_search, $def_order);
    $query = $this->db->get();
    return $query->num_rows();
  }

  function getDetailById($iduser)
  {
    return $this->db->query("SELECT `user`.`iduser`, `user`.`name`, `user`.`username`, `user`.`phone`, `user_group`.`iduser`, `group`.`group_name` FROM `user` INNER JOIN `user_group` ON `user`.`iduser` = `user_group`.`iduser` INNER JOIN `group` ON `group`.`idgroup` = `user_group`.`idgroup` WHERE `user`.`iduser` = '$iduser'")->result_array();
  }

  function getAll()
  {
    return $this->db->query("SELECT `user`.`iduser`, `user`.`name`, `user`.`username`, `user`.`phone`, `user`.`created`, `user`.`email`, `user_group`.`iduser`, `group`.`group_name` FROM `user` INNER JOIN `user_group` ON `user`.`iduser` = `user_group`.`iduser` INNER JOIN `group` ON `group`.`idgroup` = `user_group`.`idgroup`")->result_array();
  }
}
