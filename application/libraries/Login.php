<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * THIS SYSTEM USES THE LOGIN LIBRARY FROM medieteknik.nu, though somewhat modified
 * found here:
 * https://github.com/medieteknik/Medieteknik.nu/blob/master/application/libraries/Login.php
 */


class Login
{
	protected $CI;

	public function __construct() {
		$this->CI =& get_instance();
	}

	function is_logged_in() {
		return $this->CI->session->userdata('is_logged_in');
	}

	function is_admin() {
		if($this->is_logged_in() && $this->CI->session->userdata('privil') < 4) {
			return true;
		}
		return false;
	}

	public function has_privilege($privileges) {
		if(!isset($privileges)) {
			return false;
		}

		if($this->is_logged_in()) {
			$id = $this->CI->session->userdata('id');
			$this->CI->load->model('User_model');

			return $this->CI->User_model->has_privilege($id, $privileges);
		}
		return false;
	}

	public function validate($name = '', $pwd = '') {
		$this->CI->load->model('User_model');
		$result = $this->CI->User_model->validate($name, $pwd);

		if($result) // if the user's credentials validated...
		{
			$data = array(
				'id' => $result->uid,
				'liuid' => $result->liuid,
				'is_logged_in' => true,
				'privil' => $this->CI->User_model->get_privil($result->uid),
			);
			$this->CI->session->set_userdata($data);
			return true;
		}

		// incorrect username or password
		return false;
	}

	public function get_id() {
		return $this->CI->session->userdata('id');
	}

	public function get_liuid() {
		return $this->CI->session->userdata('liuid');
	}

	public function get_info($what)
	{
		// inloggad?
		if(!$this->is_logged_in())
			return false;

		// ladda usermodel
		$this->CI->load->model('User_model');

		return $this->CI->User_model->get_info($this->get_id(), $what);
	}

	public function logout() {
		$data = array(
			'id' => 0,
			'liuid' => "",
			'is_logged_in' => false,
			'privil' => false,
		);
		$this->CI->session->set_userdata($data);
		$this->CI->session->sess_destroy();
	}
}
