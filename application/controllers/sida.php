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

		$this->load->view('templates/new_header', $data);
		$this->load->view($new, $data);
		$this->load->view('templates/new_footer', $data);
	}

	public function weather($action = '')
	{
		$this->load->model('weather_model');
	}
}


/* End of file sida.php */
/* Location: ./application/controllers/sida.php */
