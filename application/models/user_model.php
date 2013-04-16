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
		$this->db->where('uid', $id);
		$this->db->where('privil <=', $what);
		$query = $this->db->get('admin');

		if($query->num_rows > 0)
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

	/**
	 * get certain user info, such as name or other
	 */
	function get_info($uid, $what)
	{
		$this->db->select($what);
		$this->db->where('uid', $uid);
		$query = $this->db->get('users');

		if($query->num_rows == 1)
		{
			return $query->result()[0]->$what;
		}

		return false;
	}

	/**
	 * create a new user
	 */
	function create_user($liuid, $fname, $sname, $password)
	{
		if(strlen($liuid) == 8 && !empty($fname) && !empty($fname) && strlen($password) > 6
			&& !$this->liuid_exists($liuid))
		{
			$data = array(
						'fname'		=> $fname,
						'sname'		=> $sname,
						'password'	=> encrypt_password($password),
						'liuid'		=> $liuid
					);

			return $this->db->insert('users', $data);
		}
		return false;
	}

	/**
	 * ¨check if a liuid exist in the database
	 */
	function liuid_exists($liuid)
	{
		$this->db->where('liuid', $liuid);
		$this->db->limit('1');
		$query = $this->db->get('users');

		return $query->num_rows();
	}

	/**
	 * update password, given uid and new password
	 */
	function update_password($uid, $password, $confirm)
	{
		if(($password == $confirm) && strlen($password) > 6)
		{
			$password = array('password' => encrypt_password($password));

			return $this->db->update('users', $password, array('uid' => $uid));
		}
		return false;
	}

	function get_all()
	{
		$this->db->select("users.*, admin.privil");
		$this->db->from("users");
		$this->db->join("admin", "users.uid = admin.uid", "left");
		$this->db->group_by("users.uid");
		$this->db->order_by("users.uid");

		$result = $this->db->get();

		if($result->num_rows() > 0)
			return $result->result_array();

		return false;
	}
}
