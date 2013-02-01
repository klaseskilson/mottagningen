<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sida extends CI_Controller {

	/**
	 * Controller handeling pages
	 */

	public function index()
	{
		$this->visa();
	}

	public function visa($view = 'home')
	{
		$this->load->view('welcome_message');
	}

}


/* End of file sida.php */
/* Location: ./application/controllers/sida.php */
