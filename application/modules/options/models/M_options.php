<?php
class M_options extends CI_Model
{
  function getAllDataOption()
  {
    return $this->db->query("SELECT * FROM `config`")->result_array();
  }
}
