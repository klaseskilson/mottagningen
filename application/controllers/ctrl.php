<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ctrl extends CI_Controller
{
	/**
	 * Controller for easy-access controll
	 */

	public function index()
	{
		show_404();
	}

	public function weather($action = '')
	{
		$this->config->load("leg_weather");
		$this->load->model("Weather_model");

		if($action == 'magic')
		{
			var_dump($this->Weather_model->magic());
		}
		elseif($action == 'force')
		{
			$collect = $this->Weather_model->collect();
			$run = $this->Weather_model->update($collect['weather'], $collect['temp']);
			echo ($run ? 'game' : 'no game' );
		}
		elseif($action == 'get')
		{
			var_dump($this->Weather_model->collectcache());
		}
		elseif($action == 'pull')
		{
			var_dump($this->Weather_model->collect());
		}
		else{
			show_404();
		}

		$this->load->view("loadtime");
	}
}
