<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {

	function __construct () {
		parent::__construct();
		$this->load->model("Model_emails");
		$user_id = $this->session->userdata("id");
		if (!$user_id) redirect(BASE_URL."login");
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}
}

