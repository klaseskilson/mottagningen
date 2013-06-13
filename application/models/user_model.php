<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class User_model extends CI_model
{
	function __construct()
	{
		// call model constructor
		parent::__construct();
	}


	/**
	 * check if login credentials are correct
	 */
	function validate($lid, $pwd)
	{
		$this->db->select("uid, password, liuid");
		$this->db->where('liuid', $lid);
		// password query
		$pwq = $this->db->get("users");
		$pwr = $pwq->result(); // password result

		if($this->passwordhash->CheckPassword($pwd, $pwr[0]->password))
		{
			return $pwr[0];
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

		if($query->num_rows() > 0)
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
		$result = $query->result();

		if($query)
		{
			return $result[0]->privil;
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

		$result = $query->result();

		if($query->num_rows() == 1)
		{
			return $result[0]->$what;
		}

		return false;
	}

	/**
	 * create a new user
	 */
	function create_user($liuid, $fname, $sname, $password, $privil = 2)
	{
		if(strlen($liuid) == 8 && !empty($fname) && !empty($fname) && strlen($password) > 6
			&& !$this->liuid_exists($liuid))
		{
			$data = array(
						'fname'		=> $fname,
						'sname'		=> $sname,
						'password'	=> $this->passwordhash->HashPassword($password),
						'liuid'		=> $liuid
					);

			return $this->db->insert('users', $data) && $this->change_privil($this->get_id($liuid), $privil);
		}
		return false;
	}

	/**
	 * set user privil
	 */
	function change_privil($uid, $privil)
	{
		$privil = $privil > 4 ? 4 : $privil;

		$this->db->select("uid");
		$this->db->where("uid", $uid);
		$query = $this->db->get("admin");

		// create privil entry in db
		if($query->num_rows() == 0)
		{
			return $this->db->insert("admin", array("uid" => $uid, "privil" => $privil));
		}
		else // update existing
		{
			return $this->db->update("admin", array("privil" => $privil), array("uid" => $uid));
		}

		return false;
	}

	/**
	 * check if a liuid exist in the database
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
			$password = array('password' => $this->passwordhash->HashPassword($password));

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

	/**
	 * get id from liuid
	 */
	function get_id($liuid)
	{
		$this->db->select("uid");
		$this->db->where("liuid", $liuid);
		$query = $this->db->get("users");
		$result = $query->result();

		return $result[0]->uid;
	}

}
