<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Model_items");
		$user_id = $this->session->userdata("id");
		if (!$user_id) redirect(BASE_URL."login");
	}

	public function index()
	{
		$data['title'] = "Bambino : Items";
		$data['nav'] = "items";
		$this->load->view('items/index', $data);
	}

	public function search_code() {
		$user_id = $this->session->userdata("id");
		$item_code = $this->input->post("item[code]");
		$item = $this->Model_items->search_code($user_id, $item_code);
		foreach ($item->result() as $i) {
			$items_array[] = $i->stock_id;
		}
		echo json_encode($items_array);
	}

	public function add () {
		$user_id = $this->session->userdata("id");
		$data['title'] = "Bambino : Items : Add";
		$data['nav'] = "items";
		$suppliers = $this->Model_items->get_all_suppliers($user_id);
		$data['suppliers'] = $suppliers->result();
		$this->load->view("items/add", $data);
	}

	public function add_process () {
		$stock_id = $this->input->post('stock_id');
		$stock_desc = $this->input->post('stock_desc');
		$stock_cost = $this->input->post('stock_cost');
		$stock_retail = $this->input->post('stock_retail');
		$stock_supplier = $this->input->post('stock_supplier');
		$user_id = $this->session->userdata("id");
		$data = array(
			"user_id" => $user_id,
			"stock_id" => $stock_id,
			"description" => $stock_desc,
			"supplier_id" => $stock_supplier
		);
		$item_exists = $this->Model_items->search_stockid_exact($user_id, $stock_id);
		$num = $item_exists->num_rows();
		
		if ($num < 1) {
			$item_id = $this->Model_items->add($data);
			if ($item_id) {
				$this->session->set_flashdata("success", "1");
				$this->session->set_flashdata("msg", "Item added successfully!");
				redirect(BASE_URL."items/");
			} else {
				$this->session->set_flashdata("success", "0");
				$this->session->set_flashdata("msg", "Item NOT added successfully!");
				redirect(BASE_URL."items/");
			}
		} else {
			$this->session->set_flashdata("success", "0");
			$this->session->set_flashdata("msg", "Item with item code $stock_id already exists!");
			redirect(BASE_URL."items/");
		}
	}
	
	public function view () {
		$user_id = $this->session->userdata("id");
		$data['title'] = "Bambino : Items : View";
		$data['nav'] = "items";
		$items = $this->Model_items->get_all($user_id);
		$data['items'] = $items->result();
		$this->load->view("items/view", $data);
	}

	public function update ($id) {
		$data['nav'] = "items";
		$user_id = $this->session->userdata("id");
		$item = $this->Model_items->view($user_id, $id);
		$data['item'] = $item->result();
		$suppliers = $this->Model_items->get_all_suppliers($user_id);
		$data['suppliers'] = $suppliers->result();

		$data['title'] = 'Bambino : Item : Update';
		$this->load->view('items/update', $data);
	}

	public function update_process () {
		$stock_id = $this->input->post('stock_id');
		$item_id = $this->input->post('item_id');
		$stock_desc = $this->input->post('stock_desc');
		$stock_supplier = $this->input->post('stock_supplier');
		$user_id = $this->session->userdata("id");
		$data = array(
			"user_id" => $user_id,
			"stock_id" => $stock_id,
			"description" => $stock_desc,
			"supplier_id" => $stock_supplier
		);
		$item_exists_w_id = $this->Model_items->search_stockid_itemid_exact($stock_id, $item_id);
		$item_exists = $this->Model_items->search_stockid_exact($user_id, $stock_id);
		$num = $item_exists->num_rows();
		//If id exists with same code then its fine, otherwise throw error
		//if there is an exisiting item with that code
		if ($item_exists_w_id->num_rows() > 0) $num = 0;
		
		if ($num < 1) {
			$result = $this->Model_items->update($data, $item_id);
			if ($result) {
				$this->session->set_flashdata("success", "1");
				$this->session->set_flashdata("msg", "Item updated successfully!");
				redirect(BASE_URL."items/");
			} else {
				$this->session->set_flashdata("success", "0");
				$this->session->set_flashdata("msg", "Item NOT updated successfully!");
				redirect(BASE_URL."items/");
			}
		} else {
			$this->session->set_flashdata("success", "0");
			$this->session->set_flashdata("msg", "Item with item code $stock_id already exists!");
			redirect(BASE_URL."items/");
		}
	}
	
	public function delete ($id) {
		$user_id = $this->session->userdata("id");
		$data = array ("user_id" => $user_id, "id" => $id);
		$result = $this->Model_items->delete($data);

		if ($result) {
			$this->session->set_flashdata("success", "1");
			$this->session->set_flashdata("msg", "Item deleted successfully!");
			redirect(BASE_URL."items/");
		} else {
			$this->session->set_flashdata("success", "0");
			$this->session->set_flashdata("msg", "Item NOT deleted successfully!");
			redirect(BASE_URL."items/");
		}
	}

}

