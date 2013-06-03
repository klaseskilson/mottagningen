<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Post_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * insert new version of post
	 */
	function insert_ver($id, $content)
	{
		$data = array(
				'post_id' => $id,
				'content' => $content
			);

		return $this->db->insert('post_cont', $data);
	}

	/**
	 * create a new post
	 * @return 	id 	the created page id
	 */
	function create($title, $slug, $content, $parentid = 0)
	{
		// prepare slug for insertion
		$slug = strtolower(empty($slug) ? $title : $slug);
		$slug = substr(str_replace(" ", "-", preg_replace("/[^a-zA-Z0-9-]/", "", $slug)), 0, 20);
		$hash = random(10, 20);

		// if slug length is less than 4, make it into a hash string instead
		if(strlen($slug) < 4) $slug = random(5, 10);

		$data = array(
				'hash' 	=> $hash,
				'title' => trim($title),
				'slug' 	=> $slug,
				'parentid' => $parentid
			);

		if($this->db->insert('posts', $data))
		{
			$this->db->select('post_id');
			$this->db->where('hash', $hash);
			$query = $this->db->get('posts');

			if($query->num_rows() > 0)
			{
				$id = $query->result_array();
				$id = $id[0]['post_id'];

				return ($this->insert_ver($id, $content) ? $id : false);
			}
		}
		return false;
	}

	/**
	 * edit an existing post
	 * @return 	bool 	success or not!
	 */
	function update($id, $title, $slug, $content, $parentid)
	{
		// prepare slug for insertion
		$slug = strtolower(empty($slug) ? $title : $slug);
		$slug = substr(preg_replace("/[^a-zA-Z0-9-]/", "", str_replace(" ", "-", $slug)), 0, 20);
		// if slug length is less than 4, make it into a hash string instead
		if(strlen($slug) < 4) $slug = random(5, 10);

		$data = array(
				'title' => trim($title),
				'slug' 	=> $slug,
				'parentid' => $parentid
			);

		return ($this->db->update('posts', $data, array('post_id' => $id)) && $this->insert_ver($id, $content));
	}

	/**
	 * get a post with a specific id
	 * @return 	array/bool(false) 	array with the post content or false
	 */
	function get_post($id)
	{
		// does the post exist?
		if(!$this->post_exists($id))
			return false;

		$this->db->select('*');
		$this->db->from("posts post");
		// here we have a problem! In order for this to work, the year prefix needs to be
		// hard-coded into the query
		$this->db->join("(SELECT * FROM 13_post_cont ORDER BY cont_id DESC) cont", "post.post_id = cont.post_id", "left");
		$this->db->group_by("post.post_id");
		$this->db->where('post.post_id', $id);
		$query = $this->db->get();

		if($query) return $query->result_array()[0];

		return false;
	}

	function post_exists($id)
	{
		$this->db->select('post_id');
		$this->db->where('post_id', $id);
		$query = $this->db->get('posts');

		return $query->num_rows();
	}
}
