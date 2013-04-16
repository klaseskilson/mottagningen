<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class User_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
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
	function create($title, $slug, $content, $parentid = 0)
	{
		$slug = substr(ereg_replace("[^A-Za-z0-9\-]", "", $slug ), 0, 20);
		$hash = random(7, 10);

		$data = array(
				'hash' 	=> $hash,
				'title' => trim($title),
				'slug' 	=> $slug,
				'parentid' => $parentid
			);

		if($this->db->insert('post', $data))
		{
			return true;
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
