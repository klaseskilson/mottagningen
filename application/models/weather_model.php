<?php
class Weather_model extends CI_Model
{
	function __construct()
	{
		// call parent constructor
		parent::__construct();
	}

	function check()
	{
		$update_freq = $this->config->item("update_freq");
		$time = date("Y-m-d H:i:s", (time()-$update_freq));
		$now = date('Y-m-d H:i:s');

		$this->db->select("*");
		$this->db->from("weather");
		$this->db->where("cachedate > '$time'");
		$this->db->limit(1);

		return $this->db->count_all_results();
	}
}
