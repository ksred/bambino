<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("Model_customers");
		$user_id = $this->session->userdata("id");
		if (!isset($user_id)) redirect(BASE_URL."login");
	}

	public function index()
	{
		$data['title'] = "Bambindo : Customers";
		$data['nav'] = "customers";
		$this->load->view("customers/index", $data);
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
	
	public function add ($success = 0) {
		$data['title'] = "Bambino : Add : Customer";
		$data['nav'] = "customers";
		$this->load->view("customers/add", $data);
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
				$customer_array = array("name" => $c->name, "address" => $c->delivery_address);
			}
			echo json_encode($customer_array);
		else :
			echo "Customer already exists";
			return;
		endif;
	}

	public function add_process () {
		$user_id = $this->session->userdata("id");
		$name = $this->input->post("customer_name_add");
		$number = $this->input->post("customer_number");
		$email = $this->input->post("customer_email");
		$address = $this->input->post("customer_address");
		$data = array (
			"user_id" => $user_id,
			"name" => $name,
			"contact_number" => $number,
			"contact_email" => $email,
			"delivery_address" => $address
		);
		$customer_exists = $this->Model_customers->search_name_exact($user_id, $name);
		$num = $customer_exists->num_rows();

		if ($num < 1) {
			$result = $customer_id = $this->Model_customers->add_customer($data);
			if ($result) {
				$this->session->set_flashdata("success", "1");
				$this->session->set_flashdata("msg", "Customer added successfully!");
				redirect(BASE_URL."customers/");
			} else {
				$this->session->set_flashdata("success", "0");
				$this->session->set_flashdata("msg", "Customer NOT added successfully!");
				redirect(BASE_URL."customers/");
			}
		} else {
			$this->session->set_flashdata("success", "0");
			$this->session->set_flashdata("msg", "Customer already exists!");
			redirect(BASE_URL."customers/");
		}
	}
	
	public function update ($id) {
		$data['nav'] = "customers";
		$user_id = $this->session->userdata("id");
		$customer = $this->Model_customers->view($user_id, $id)->result();
		$data['customer'] = $customer;

		$data['title'] = 'Bambino : Customers : Update';
		$this->load->view('customers/update', $data);
	}

	public function update_process () {
		$user_id = $this->session->userdata("id");
		$name = $this->input->post("customer_name_add");
		$number = $this->input->post("customer_number");
		$email = $this->input->post("customer_email");
		$address = $this->input->post("customer_address");
		$data = array (
			"user_id" => $user_id,
			"name" => $name,
			"contact_number" => $number,
			"contact_email" => $email,
			"delivery_address" => $address
		);
		$result = $this->Model_customers->update($date);

		if ($result) {
			$this->session->set_flashdata("success", "1");
			$this->session->set_flashdata("msg", "Customer updated successfully!");
			redirect(BASE_URL."customers/");
		} else {
			$this->session->set_flashdata("success", "0");
			$this->session->set_flashdata("msg", "Customer NOT updated successfully!");
			redirect(BASE_URL."customers/");
		}
	}
	
	public function delete ($id) {
		$user_id = $this->session->userdata("id");
		$data = array ("user_id" => $user_id, "id" => $id);
		$result = $this->Model_customers->delete($data);

		if ($result) {
			$this->session->set_flashdata("success", "1");
			$this->session->set_flashdata("msg", "Customer deleted successfully!");
			redirect(BASE_URL."customers/");
		} else {
			$this->session->set_flashdata("success", "0");
			$this->session->set_flashdata("msg", "Customer NOT deleted successfully!");
			redirect(BASE_URL."customers/");
		}
	}

}
