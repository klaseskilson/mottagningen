<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Script extends CI_controller
{
	public function index()
	{
		show_404();
	}

	/**
	 * adsadsads!
	 * @param 	$collector	string 	the phadder
	 * @param 	$method 	string 	e.g. 'script.js'
	 */
	public function ads($collector, $method)
	{
		// make sure everything is properly called
		if(strlen($collector) !== 3 || $method == '')
		{
			show_404();
			die();
		}

		// load ad model and prepare views
		$this->load->model("Ad_model");
		$data = array();

		// save ads in a nice array
		$ads = $this->Ad_model->collect();

		// loop through and increase views count for each ad
		foreach ($ads as $ad) {
			$this->Ad_model->increase($ad["id"], $collector);
		}

		$data['ads'] = $ads;
		$data['collector'] = $collector;

		// check call method, currently only script.js
		if($method == 'script.js')
		{
			// set it to appear as a javascript file
			header("Content-type: application/javascript");
			$this->load->view("ads/js", $data);
		}
	}


	public function weather()
	{
		$this->load->model('Weather_model');

		$weather = $this->Weather_model->magic();

		header("Content-type: application/javascript");
		// ugly, but I'm lazy
		?>
var weathertemp, weathersymbol, weatherwind;
function getweather()
{
	weathertemp = <?php echo $weather['temp']; ?>;
	weathersymbol = <?php echo $weather['weather']; ?>;
	weatherwind = <?php echo $weather['windspeed']; ?>;
}
		<?php
	}
}
