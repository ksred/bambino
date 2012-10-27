<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dash extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = "Bambino";
		$this->load->view('dash/index', $data);
	}
}

