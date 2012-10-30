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

	public function add_post () {
		$user_id = $this->session->userdata("id");
		$name = $this->input->post("name");
		$number = $this->input->post("number");
		$email = $this->input->post("email");
		$address = $this->input->post("address");
		$data = array (
			"user_id" => $user_id,
			"name" => $name,
			"contact_number" => $number,
			"contact_email" => $email,
			"delivery_address" => $address
		);
		$customer_exists = $this->Model_customers->search_name_exact($user_id, $name);
		$num = $customer_exists->num_rows();
		if ($num < 1 ) :
			$customer_id = $this->Model_customers->add_customer($data);
			$customer = $this->Model_customers->search_customer_by_id($user_id, $customer_id);
			foreach ($customer->result() as $c) {
				$customer_array[] = array("name" => $c->name, "address" => $c->delivery_address);
			}
			echo json_encode($customer_array);
		else :
			echo "Customer already exists";
			return;
		endif;
	}
}
