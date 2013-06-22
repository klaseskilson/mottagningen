<?php
class Weather_model extends CI_Model
{
	function __construct()
	{
		// call parent constructor
		parent::__construct();
	}

	/**
	 * check weather cache
	 * @return 	int 	number of hits
	 */
	function check()
	{
		// load update freq settings
		$this->config->load("leg_weather");
		$update_freq = $this->config->item("update_freq");
		// set time when to look for caches
		$time = date("Y-m-d H:i:s", (time()-$update_freq));
		$now = date('Y-m-d H:i:s');

		// see if there are any recent caches
		$this->db->select("*");
		$this->db->from("weather");
		$this->db->where("cachedate > '$time'");
		$this->db->limit(1);

		return $this->db->count_all_results();
	}

	/**
	 * insert weather data to cache
	 */
	function update($weather, $temp, $windspeed, $sunrise, $sunset)
	{
		$data = array(
					'weather' 	=> str_replace(" ", "", trim($weather)),
					'temp' 		=> trim($temp),
					'windspeed' => $windspeed,
					'sunrise' => $sunrise,
					'sunset' => $sunset
				);
		if(!empty($data['weather']))
		{
			return $this->db->insert('weather', $data);
		}
		else
			return false;
	}

	/**
	 * collect weather data from yr
	 * @return 	array(string) 	weatherdata
	 */
	function collect($area = 'Sweden/Östergötland/Norrköping')
	{
		// save weatherobj adress as variable
		$weatherfile = 'http://www.yr.no/place/'.$area.'/varsel_time_for_time.xml';
		// load weather from yr.no
		$weatherobj = simplexml_load_file($weatherfile);
		//return $weatherobj;
		if($weatherobj)
		{

			// take only what we want
			$current_weather = array(
									'weather' 	=> strtolower($weatherobj->forecast->tabular->time[0]->symbol['name']),
									'temp' 		=> intval($weatherobj->forecast->tabular->time[0]->temperature['value']),
									'windspeed' => floatval($weatherobj->forecast->tabular->time[0]->windSpeed['mps']),
									'sunrise'	=> str_replace('T', ' ', $weatherobj->sun['rise']),
									'sunset'	=> str_replace('T', ' ', $weatherobj->sun['set'])
								);
			return $current_weather;
		}

		return false;
	}

	/**
	 * collect cache from data
	 * @return 	array(string) 	weatherdata
	 */
	function collectcache()
	{
		$this->db->select("temp, weather, windspeed, sunrise, sunset, cachedate");
		$this->db->order_by("weatherid", "desc");
		$this->db->limit(1);

		$query = $this->db->get("weather");
		$result = $query->result_array();

		return $result[0];
	}

	/**
	 * function to fetch weather data online if needed, otherwise fetches from cache
	 * @return 	array(string) 	weatherdata
	 */
	function magic()
	{
		if(!$this->check())
		{
			if($magic = $this->collect())
			{
				$this->update($magic['weather'], $magic['temp'], $magic['windspeed'], $magic['sunrise'], $magic['sunset']);
				return $magic;
			}
		}
		return $this->collectcache();
	}
}
