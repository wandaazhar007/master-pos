<?php

class M_profile extends CI_Model
{
  function getUser($iduser_admin)
  {
    return $this->db->query("SELECT * FROM `user_admin` WHERE `iduser_admin` = '$iduser_admin'")->result_array();
  }
}
