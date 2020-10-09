<?php

class Login_model extends CI_Model{

	function cek_login($table,$where){
		return $this->db->get_where($table,$where);
	}

  function get_by_id($id)
  {
      $this->db->where('username', $id);
      return $this->db->get('user')->row();
  }
}

?>
