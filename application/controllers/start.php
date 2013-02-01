<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Start extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/start
	 *	- or -
	 * 		http://example.com/index.php/start/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to  <method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data = array();

		$this->load->view('templates/header', $data);
		$this->load->view('start');
		$this->load->view('templates/footer', $data);
	}
}

/* End of file start.php */
/* Location: ./application/controllers/start.php */
