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

	function update($weather, $temp)
	{
		$data = array(
					'weather' 	=> trim($weather),
					'temp' 		=> trim($temp)
				);
		if(!empty($data['weather']))
		{
			return $this->db->insert('weather', $data);
		}
		else
			return 'NO';
	}

	function collect($area = 'Sweden/Östergötland/Norrköping')
	{
		$weatherobj = simplexml_load_file('http://www.yr.no/place/'.$area.'/varsel_time_for_time.xml');
		//return $weatherobj;
		if($weatherobj)
		{
			$current_weather = array(
								   'weather' 	=> strtolower($weatherobj->forecast->tabular->time[0]->symbol['name']),
								   'temp' 		=> intval($weatherobj->forecast->tabular->time[0]->temperature['value'])
							   );
			return $current_weather;
		}
		else
			return false;
	}
}
