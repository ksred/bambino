<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Suppliers extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Model_suppliers");
		$user_id = $this->session->userdata("id");
		if (!isset($user_id)) redirect(BASE_URL."login");
	}

	public function index()
	{
		$data['title'] = "Bambino : Suppliers";
		$data['nav'] = "suppliers";
		$this->load->view('suppliers/index', $data);
	}
	
	public function add ($success = 0) {
		$data['title'] = "Bambino : Add : Supplier";
		$data['nav'] = "suppliers";
		$this->load->view("suppliers/add", $data);
	}

	public function view () {
		$user_id = $this->session->userdata("id");
		$supplier = $this->Model_suppliers->view_all($user_id);
		$data['suppliers'] = $supplier;
		$data['nav'] = "suppliers";

		$data['title'] = 'Bambino : Suppliers : All';
		$this->load->view('suppliers/view', $data);
	}

	public function update ($id) {
		$user_id = $this->session->userdata("id");
		$supplier = $this->Model_suppliers->view($user_id, $id)->result();
		$data['supplier'] = $supplier;
		$data['nav'] = "suppliers";

		$data['title'] = 'Bambino : Suppliers : All';
		$this->load->view('suppliers/update', $data);
	}

	public function delete ($id) {
		$user_id = $this->session->userdata("id");
		$data = array ("id" => $user_id);
		$result = $this->Model_suppliers->delete($data);

		if ($result) {
			$this->session->set_flashdata("success", "1");
			$this->session->set_flashdata("msg", "Supplier deleted successfully!");
			redirect(BASE_URL."suppliers/");
		} else {
			$this->session->set_flashdata("success", "0");
			$this->session->set_flashdata("msg", "Supplier NOT deleted successfully!");
			redirect(BASE_URL."suppliers/");
		}
	}

	public function update_process () {
		$user_id = $this->session->userdata("id");
		$supplier = $this->input->post("supplier");
		$contact_name = $this->input->post("contact_name");
		$contact_email = $this->input->post("contact_email");
		$data = array (
			"user_id" => $user_id,
			"name" => $supplier,
			"contact_name" => $contact_name,
			"contact_email" => $contact_email
		);
		$result = $this->Model_suppliers->update($data);

		if ($result) {
			$this->session->set_flashdata("success", "1");
			$this->session->set_flashdata("msg", "Supplier updated successfully!");
			redirect(BASE_URL."suppliers/");
		} else {
			$this->session->set_flashdata("success", "0");
			$this->session->set_flashdata("msg", "Supplier NOT updated successfully!");
			redirect(BASE_URL."suppliers/");
		}
	}

	public function add_process () {
		$user_id = $this->session->userdata("id");
		$supplier = $this->input->post("supplier");
		$contact_name = $this->input->post("contact_name");
		$contact_email = $this->input->post("contact_email");
		$data = array (
			"user_id" => $user_id,
			"name" => $supplier,
			"contact_name" => $contact_name,
			"contact_email" => $contact_email
		);
		$supplier_exists = $this->Model_suppliers->search_name_exact($user_id, $supplier);
		$num = $supplier_exists->num_rows();
		if ($num < 1 ) :
			$supplier_id = $this->Model_suppliers->add_supplier($data);
			$supplier_details = $this->Model_suppliers->search_supplier_by_id($user_id, $supplier_id);
			$this->session->set_flashdata("success", "1");
			$this->session->set_flashdata("msg", "Supplier added successfully!");
			redirect(BASE_URL."suppliers/");
		else :
			$this->session->set_flashdata("success", "0");
			$this->session->set_flashdata("msg", "Supplier not added successfully!");
			redirect(BASE_URL."suppliers/");
		endif;
	}
	
	public function add_post () {
		$user_id = $this->session->userdata("id");
		$supplier = $this->input->post("supplier");
		$contact_name = $this->input->post("contact_name");
		$contact_email = $this->input->post("contact_email");
		$data = array (
			"user_id" => $user_id,
			"name" => $supplier,
			"contact_name" => $contact_name,
			"contact_email" => $contact_email
		);
		$supplier_exists = $this->Model_suppliers->search_name_exact($user_id, $supplier);
		$num = $supplier_exists->num_rows();
		if ($num < 1 ) :
			$supplier_id = $this->Model_suppliers->add_supplier($data);
			$supplier_details = $this->Model_suppliers->search_supplier_by_id($user_id, $supplier_id);
			foreach ($supplier_details->result() as $s) {
				$supplier_array = array("name" => $s->name, "contact_name" => $s->contact_name, "contact_email" => $s->contact_email);
			}
			echo json_encode($supplier_array);
		else :
			echo "Supplier already exists";
			return;
		endif;
	}
}

