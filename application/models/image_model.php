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

	function get_all($select = '*', $limit = 0, $page = 0)
	{
		$this->db->select($select);
		$this->db->order_by('date','desc');
		if($limit !== 0)
			$this->db->limit($limit, $limit*$page);
		$query = $this->db->get('images');

		if($query) return $query->result_array();

		return false;
	}

	function get_all_public($select = '*', $limit = 0, $page)
	{
		$this->db->select($select);
		$this->db->where('status', 1);
		$this->db->order_by('date','desc');
		if($limit !== 0)
			$this->db->limit($limit, $limit*$page);
		$query = $this->db->get('images');

		if($query) return $query->result_array();

		return false;
	}

	function count_all($public = '')
	{
		$this->db->select('imageid');
		if($public !== '')
			$this->db->where('status', $public);
		$query = $this->db->get('images');

		if($query) return $query->num_rows();

		return false;
	}

	/**
	 * used on the front page
	 * @return [type] [description]
	 */
	function get_random($limit = 4)
	{
		$this->db->select('filename');
		$this->db->where('status', 1);
		$this->db->order_by('filename', 'random');
		$this->db->limit($limit);
		$query = $this->db->get('images');

		if($query) return $query->result_array();

		return false;
	}

	function toggle($id, $status)
	{
		return $this->db->update('images', array('status' => $status), array('imageid' => $id));
	}

	function remove($id)
	{
		$this->db->select("filename");
		$this->db->where("imageid", $id);
		$query = $this->db->get("images");
		$result = $query->result_array();

		$filename = $result[0]['filename'];

		return unlink('web/uploads/'.$filename)
			&& $this->db->delete('images', array('imageid' => $id));
	}
}
/*
END OF image_model.php
 */
