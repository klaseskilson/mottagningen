<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Fadder_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_all()
	{
		$this->db->select("*");
		$this->db->join("fadder_info", "fadder.fadderid = fadder_info.fadderid", "left");
		$this->db->group_by("fadder.fadderid");
		$query = $this->db->get("fadder");

		return ($query ? $query->result_array() : false);
	}

	function get_fadder($id)
	{
		$this->db->select("*");
		if(is_numeric($id))
			$this->db->where('13_fadder.fadderid', $id);
		else
			$this->db->where('liuid', $id);

		$this->db->join("fadder_info", "fadder.fadderid = fadder_info.fadderid", "left");
		$this->db->group_by("fadder.fadderid");

		$query = $this->db->get("fadder");
		return ($query ? $query->result_array()[0] : false);
	}
}
