<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("Model_customers");
	}

	public function index()
	{
	}

	public function search_name () {
		$user_id = $this->session->userdata("id");
		$name = $this->input->post("customer_name");
		$customers = $this->Model_customers->search_name($user_id, $name);
		foreach ($customers->result() as $c) {
			$customers_array[] = $c->name;
		}
		echo json_encode($customers_array);
	}


	public function search_details () {
		$user_id = $this->session->userdata("id");
		$details = $this->input->post("customer_details");
		$customers = $this->Model_customers->search_details($user_id, $details);
		foreach ($customers->result() as $c) {
			$customers_array[] = $c->delivery_address;
		}
		echo json_encode($customers_array);
	}
}
