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

	/**
	 * creates a ics file with the schedule, loaded from events.json in /web
	 */
	public function schema()
	{
		function event($data, $start, $end) {
			$rows = array(
				"BEGIN:VEVENT",
				"UID:" . md5(uniqid(mt_rand(), true)) . "@legionen.nu",
				"DTSTAMP:" . gmdate('Ymd\THis\Z', strtotime($start)),
				"DTSTART:" . gmdate('Ymd\THis\Z', strtotime($start)),
				"DTEND:" . gmdate('Ymd\THis\Z', strtotime($end)),
				"SUMMARY:" . $data->name
			);
			if (!empty($data->location)) {
				$rows[] = "LOCATION:" . $location;
			}
			if (!empty($data->description)) {
				$rows[] = "DESCRIPTION:" . $description;
			}
			$rows[] = "END:VEVENT";
			return join("\n", $rows);
		}

		function printEvents($events) {
			header('Content-type: text/calendar; charset=utf-8');
			header('Content-Disposition: inline; filename="legionen.ics"');
			echo join("\n", array(
				"BEGIN:VCALENDAR",
				"VERSION:2.0",
				"PRODID:-//hacksw/handcal//NONSGML v1.0//EN",
				join("\n", $events),
				"END:VCALENDAR"
			));
		}

		$eventFile = "./web/events.json";
		$eventData = file_get_contents($eventFile);
		$schedule = json_decode($eventData);
		if (!empty($schedule->events)) {
			$eventStrings = array();
			foreach ($schedule->events as $day => $events) {
				foreach ($events as $time => $data) {
					$endDate = empty($data->endDate) ? $day : $data->endDate;
					$endTime = empty($data->endTime) ? date("H:i", strtotime($time . " + 1 hours")) : $data->endTime;

					$start = $day . " " . $time;
					$end = $endDate . " " . $endTime;
					$eventStrings[] = event($data, $start, $end);
				}
			}
			printEvents($eventStrings);
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
