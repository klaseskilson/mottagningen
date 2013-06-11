<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Start extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data = array();

		$this->load->model("Weather_model");
		$data['weather'] = $this->Weather_model->magic();

		// sunrise and sunset in unix timestamp
		$data['sunset'] = strtotime($data['weather']['sunset']);
		$data['sunrise'] = strtotime($data['weather']['sunrise']);

		// is it dawn? i.e. less than 30 mins to or from sunset or sunrise?
		if(abs(time() - $data['sunset']) < 30*60 || abs(time() - $data['sunrise']) < 30*60)
			$data['daytime'] = 'dawn';
		// is it day?
		elseif(time() > $data['sunrise'] && time() < $data['sunset'])
			$data['daytime'] = 'day';
		// it's night
		else
			$data['daytime'] = 'night';

		$this->load->view('templates/new_header', $data);
		$this->load->view('new', $data);
		$this->load->view('templates/new_footer', $data);
	}
}

/* End of file start.php */
/* Location: ./application/controllers/start.php */
