<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * model for handeling images!
 */
class Image_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
	}

	function add($filename)
	{
		$insert_data = array(
						'filename' 	=> $filename,
						'uid' 		=> $this->login->get_id()
					);
		return $this->db->insert("images", $insert_data);
	}

	function get_all($select = '*', $limit = 0)
	{
		$this->db->select($select);
		if($limit !== 0)
			$this->db->limit($limit);
		$query = $this->db->get('images');

		if($query) return $query->result_array();

		return false;
	}

	function get_all_public($select = '*', $limit = 0)
	{
		$this->db->select($select);
		$this->db->where('status', 1);
		if($limit !== 0)
			$this->db->limit($limit);
		$query = $this->db->get('images');

		if($query) return $query->result_array();

		return false;
	}
}
/*
END OF image_model.php
 */
