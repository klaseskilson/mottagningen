<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_controller
{

	function __construct()
	{
		// Call the controller constructor
		parent::__construct();

		// logged in?
		if(!$this->login->is_admin() && $this->uri->segment(2) != "login")
		{
			redirect('/admin/login/ad', 'refresh');
		}
	}

	function index()
	{
		$this->overview();
	}

	function overview()
	{
		$data['name'] = $this->login->get_info("fname");

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/menu');
		$this->load->view('admin/overview', $data);
		$this->load->view('admin/templates/footer', $data);
	}

	function fadder($action = 'all', $id = '')
	{
		$data = array();
		$this->load->model("Fadder_model");
		$view = '';

		if($action == "open")
		{
			if(!empty($id))
				$data['fadder'] = $this->Fadder_model->get_fadder($id);
			else
				show_404();

			$view = "fadder_single";
		}
		elseif($action == "all")
		{
			$data['faddrar'] = $this->Fadder_model->get_all();
			$view = "fadder_all";
		}

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/menu');
		$this->load->view('admin/'.$view, $data);
		$this->load->view('admin/templates/footer', $data);
	}

	function login($dowhat = '')
	{
		$data = array();

		// perform logout
		if($dowhat == 'logout')
			$this->login->logout();

		// perform login
		if($dowhat == 'do')
		{
			$liuid = $this->input->post('liuid');
			$password = $this->input->post('password');

			echo '<!--'.encrypt_password($password).'-->';

			if($this->login->validate($liuid, $password))
			{
				redirect('/admin');
			}
		}

		// save message for login page
		$data['msg'] = $dowhat;

		// load views
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/login', $data);
		$this->load->view('admin/templates/footer', $data);
	}

	function user($action = '')
	{
		$data = array();
		$this->load->model("User_model");

		switch($action)
		{
			case 'new':
				$view = 'user_new';
			break;

			case 'new_run':

				$view = 'user_new';
			break;

			case 'all':
				$view = 'user_all';
			break;

			case 'me':
				$view = 'user_account';
			break;

			case 'pwd':
				$pwd = trim($this->input->post('passw'));
				$confirm = trim($this->input->post('confirm'));

				$data['message'] = $this->User_model->update_password($this->login->get_id(), $pwd, $confirm);

				$view = 'user_account';
			break;

			default:
				$view = 'user_account';
			break;
		}

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/menu');
		$this->load->view('admin/'.$view, $data);
		$this->load->view('admin/templates/footer', $data);
	}

	function news($action = '', $id = '')
	{
		$data = array();

		switch($action)
		{
			case 'new':
				$view = 'news_post';
			break;
			case 'all':
				$view = 'news_all';
			break;
			default:
				$view = 'news_all';
			break;
		}

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/menu');
		$this->load->view('admin/'.$view, $data);
		$this->load->view('admin/templates/footer', $data);
	}
}