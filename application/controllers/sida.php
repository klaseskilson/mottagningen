<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sida extends CI_Controller {

	/**
	 * Controller handeling pages
	 */

	public function index()
	{
		$this->visa('hem');
	}

	public function visa($view = 'hmm')
	{
		$data = array();

		$this->load->view('templates/header', $data);

		if($view == 'fika')
		{
			$this->load->view('fika');
		}
		else
		{
			$this->load->view('start');
		}

		$this->load->view('templates/footer', $data);
	}

	public function cool($new = 'new')
	{
		$data = array();

		// load config for weather and weather model
		$this->config->load("leg_weather");
		$this->load->model("Weather_model");

		// skicka
		$data['weather'] = $this->Weather_model->magic();

		$this->load->view('templates/new_header', $data);
		$this->load->view($new, $data);
		$this->load->view('templates/new_footer', $data);
	}

	public function weather($action = '')
	{
		$this->config->load('leg_weather');
		$this->load->model('Weather_model');

		if(!$this->Weather_model->check())
		{
			$collect = $this->Weather_model->collect();
			var_dump($collect);
			echo date('Y-m-d H:i:s');
			$run = $this->Weather_model->update($collect['weather'], $collect['temp']);
			echo $run;
			echo ($run ? 'game' : 'no game' );

		}
		else
		{
			$kalas = $this->Weather_model->magic();
			var_dump($kalas);
		}
		$this->load->view('loadtime');
	}
}


/* End of file sida.php */
/* Location: ./application/controllers/sida.php */
