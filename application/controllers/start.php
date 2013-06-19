<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Start extends CI_Controller {
	// prepare data array for view
	private $data = array();

	/**
	 * this is done every time the constructor is called
	 */
	public function __construct()
	{
		// thing that _has_ to be done according to CI
		parent::__construct();

		// this is what we do every time the site loads
		// it collects weather and pages and prepare the
		// view

		if(defined('ENVIRONMENT') && ENVIRONMENT == 'development' && !$this->login->is_admin())
		{
			$this->load->view('sand');
			die;
		}

		// load models
		$this->load->model("Weather_model");
		$this->load->model("Post_model");

		// save weather using the magic function
		$this->data['weather'] = $this->Weather_model->magic();
		// save pages for menu
		$this->data['menu_pages'] = $this->Post_model->get_active_parents("title, slug");

		// sunrise and sunset in unix timestamp
		$this->data['sunset'] = strtotime($this->data['weather']['sunset']);
		$this->data['sunrise'] = strtotime($this->data['weather']['sunrise']);

		// is it dawn? i.e. less than 30 mins to or from sunset or sunrise?
		if(abs(time() - $this->data['sunset']) < 30*60 || abs(time() - $this->data['sunrise']) < 30*60)
			$this->data['daytime'] = 'dawn';
		// is it day?
		elseif(time() > $this->data['sunrise'] && time() < $this->data['sunset'])
			$this->data['daytime'] = 'day';
		// it's night
		else
			$this->data['daytime'] = 'night';
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data = $this->data;

		$this->load->view('templates/new_header', $data);
		$this->load->view('new', $data);
		$this->load->view('templates/new_footer', $data);

	}
}

/* End of file start.php */
/* Location: ./application/controllers/start.php */
