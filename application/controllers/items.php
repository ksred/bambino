<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Model_items");
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function search_code() {
		$user_id = $this->session->userdata("id");
		die(var_dump($_POST));
		$name = $this->input->post("customer_name");
		$customers = $this->Model_customers->search_name($user_id, $name);
		foreach ($customers->result() as $c) {
			$customers_array[] = $c->name;
		}
		echo json_encode($customers_array);
	}
}

