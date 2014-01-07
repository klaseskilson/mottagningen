<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sok extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		header("Location: https://docs.google.com/a/student.liu.se/forms/d/1kWeIA3gP_ZRHCOF6NpBF-VB5znMbPmKZW43ejc3LYMw/viewform");
	}
}
