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
				'content' => $content,
				'uid'	  => $this->login->get_id()
			);

		return $this->db->insert('post_cont', $data);
	}

	/**
	 * create a new post
	 * @return 	id 	the created page id
	 */
	function create($title, $slug, $content, $status, $type = 0)
	{
		// prepare slug for insertion
		$slug = strtolower(empty($slug) ? $title : $slug);
		$slug = substr(preg_replace("/[^a-zA-Z0-9-]/", "", str_replace(" ", "-", $slug)), 0, 20);
		// make sure slug isn't already used using function slug_exists, if it is taken, add an int
		$i = '';
		while($this->slug_exists($slug.$i))
			$i = ($i == '' ? 1 : $i+1);

		$slug = $slug.$i;

		// generate hash
		$hash = random(10, 20);

		// if slug length is less than 4, make it into a hash string instead
		if(strlen($slug) < 4) $slug = random(5, 10);

		$data = array(
				'hash' 	=> $hash,
				'title' => trim($title),
				'slug' 	=> $slug,
				'type' => $type,
				'status' => $status
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
	function update($id, $title, $slug, $content, $status, $type = 0)
	{
		// prepare slug for insertion
		$slug = strtolower(empty($slug) ? $title : $slug);
		$slug = substr(preg_replace("/[^a-zA-Z0-9-]/", "", str_replace(" ", "-", $slug)), 0, 20);
		// make sure slug isn't already used using function slug_exists, if it is taken, add an int
		$i = '';
		while($this->slug_exists($slug.$i))
			$i = ($i == '' ? 1 : $i+1);
		// if slug length is less than 4, make it into a hash string instead
		if(strlen($slug) < 4) $slug = random(5, 10);

		$data = array(
				'title' => trim($title),
				'slug' 	=> $slug,
				'type' => $type,
				'status' => $status
			);

		return ($this->db->update('posts', $data, array('post_id' => $id)) && $this->insert_ver($id, $content));
	}

	/**
	 * deletes a post
	 * @param  int $id the post id
	 * @return bool    success or not?
	 */
	function delete($id)
	{
		if(!$this->login->has_privilege(2) || $this->get_status($id))
			return false;

		// start with deleting post_cont, since it is depending on posts
		return $this->db->delete('post_cont', array('post_id' => $id))
			&& $this->db->delete('posts', array('post_id' => $id));
	}

	/**
	 * get a post with a specific id
	 * @return 	array/bool(false) 	array with the post content or false
	 */
	function get_post($id)
	{
		if(!is_numeric($id))
			$id = $this->get_id($id);

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

		$result = $query->result_array();

		if($query) return $result[0];

		return false;
	}

	/**
	 * get all posts
	 * @return 	array 	the posts
	 */
	function get_all_posts($type = 0, $status = '')
	{
		$this->db->select('*');
		$this->db->from("posts post");
		// here we have a problem! In order for this to work, the year prefix needs to be
		// hard-coded into the query. UUUUGLYYYYY!
		$this->db->join("(SELECT * FROM 13_post_cont ORDER BY cont_id DESC) cont", "post.post_id = cont.post_id", "left");
		$this->db->where('type', $type);
		if($status !== '')
			$this->db->where('status', $status);
		if($type == 1)
			$this->db->order_by('post.post_id', 'desc');
		$this->db->group_by("post.post_id");
		$query = $this->db->get();

		if($query) return $query->result_array();

		return false;
	}

	/**
	 * get all avtive pages, eg for menu and such
	 * @param  string $what what columns to return
	 * @return array       the posts
	 */
	function get_active_pages($what = '*')
	{
		// what to collect?
		$this->db->select($what);
		// limit results
		$this->db->from('posts');
		$this->db->where(array('type' => 0, 'status' => 1));

		// get it all
		$query = $this->db->get();

		// if query goes well, return results as array
		if($query) return $query->result_array();

		return false;
	}

	/**
	 * check if a post exists
	 * @return 	bool
	 */
	function post_exists($id)
	{
		$this->db->select('post_id');
		$this->db->where('post_id', $id);
		$query = $this->db->get('posts');

		return $query->num_rows();
	}

	/**
	 * see if a slug is taken or not
	 * @param  string $slug the slug
	 * @return bool
	 */
	function slug_exists($slug)
	{
		$this->db->where('slug', $slug);
		$query = $this->db->get('posts');

		return $query->num_rows();
	}

	/**
	 * get post status, draft or not
	 * @return 	bool
	 */
	function get_status($id)
	{
		$this->db->select('status');
		$this->db->where('post_id', $id);
		$query = $this->db->get('posts');

		$result = $query->result_array();

		return $result[0]['status'];
	}

	/**
	 * change draft/public-status of a post
	 * @return 	bool 	success or not
	 */
	function togglestatus($id)
	{
		if($this->get_status($id))
			return $this->db->update('posts', array('status' => 0), array('post_id' => $id));
		else
			return $this->db->update('posts', array('status' => 1), array('post_id' => $id));
	}

	/**
	 * slug -> id
	 * @param  string $slug the slug
	 * @return int       the id
	 */
	function get_id($slug)
	{
		$this->db->select("post_id");
		$this->db->where("slug", $slug);
		$query = $this->db->get("posts");
		$result = $query->result_array();

		if($query) return $result[0]['post_id'];

		return false;
	}
}
