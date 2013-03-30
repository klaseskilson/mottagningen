<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class User_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * check if login credentials are correct
	 */
	function validate($lid, $pwd)
	{
		$this->db->where('liuid', $lid);
		$this->db->where('password', encrypt_password($pwd));
		$query = $this->db->get('users');
		if($query->num_rows == 1)
		{
			return $query;
		}
		return false;
	}

	/**
	 * check if user has given privil
	 */
	function has_privilege($id, $what)
	{
		$this->db->where('id', $id);
		$this->db->where('privil >= "$what"');
		$query = $this->db->get('admin');
		if($query->num_rows == 1)
		{
			return $query;
		}

		return false;
	}

	/**
	 * collect privil for user
	 */
	function get_privil($id)
	{
		$this->db->select("privil");
		$this->db->where('uid', $id);
		$query = $this->db->get('admin');
		if($query->num_rows == 1)
		{
			return $query;
		}

		return false;
	}
}
