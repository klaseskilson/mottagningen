<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sida extends CI_Controller {

	/**
	 * Controller handeling pages
	 */

	public function index($view = 'hem')
	{
		$this->visa($view);
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

}


/* End of file sida.php */
/* Location: ./application/controllers/sida.php */
