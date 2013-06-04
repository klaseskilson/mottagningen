<?php
class Ad_model extends CI_model
{
	function __construct()
	{
		// call parent constructor
		parent::__construct();
	}

	function collect($ads = 3)
	{
		$this->db->select("ads.*, COUNT(ad_id) AS ads_count ");
		$this->db->from("ads");
		$this->db->join("ad_views", "ads.id = ad_views.ad_id", "left");
		$this->db->group_by("ads.id");
		$this->db->order_by("ads_count");
		$this->db->limit($ads);

		$result = $this->db->get();

		return $result->result_array();
	}

	function increase($id, $collector)
	{
		if(empty($collector))
			return false;

		$data = array(
					'ad_id' 	=> $id,
					'phadderi'	=> substr(trim($collector), 0, 3)
				);

		return $this->db->insert('ad_views', $data);
	}
}
