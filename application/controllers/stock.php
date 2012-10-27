<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock extends CI_Controller {

	function __construct () {
		parent::__construct();
		$this->load->model("Model_stock");
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}
	

}

