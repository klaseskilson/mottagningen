<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_controller
{

	function __construct()
	{
		// Call the controller constructor
		parent::__construct();

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
		echo 'hej';
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
}
