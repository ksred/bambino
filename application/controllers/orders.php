<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller {

	function __construct () {
		parent::__construct();
		$this->load->model("Model_orders");
	}

	public function index()
	{
		$data['title'] = "Orders";
		$this->load->view('orders/index');
	}

	public function add () {
		$user_id = $this->session->userdata("id");
		$data['title'] = "Bambino : Orders : Add";
		$status = $this->Model_orders->get_all_status($user_id);
		$data['status'] = $status->result();
		$this->load->view("orders/add", $data);
	}

	public function add_process () {
		$user_id = $this->session->userdata("id");
		$customer_name = $this->input->post("customer_name");
		$customer_details = $this->input->post("customer_details");
		$note = $this->input->post("note");
		$status = $this->input->post("status");
		$no_of_items = $this->input->post("item_total");
		//Add data to orders table
		$data = array(
				"user_id" => $user_id,
				"status" => $this->input->post("status")
				);
		$order_id = $this->Model_orders->add($data);
		if (!$order_id) die("Died on the order insert bro");
		//Add data to orders_items table
		for ($i=1; $i <= $no_of_items; $i++) :
			$item = $this->input->post("item".$i);
			$code = $item['code'];
			$description = $item['desc'];
			$quantity = (int) $item['quantity'];
			$cost = (float) $item['cost'];
			$retail = (float) $item['retail'];
			$data = array(
					"user_id" => $user_id,
					"order_id" => $order_id,
					"item_id" => $code,
					"description" => $description,
					"quantity" => $quantity,
					"cost_price" => $cost,
					"retail_price" => $retail
				);
			$result_item = $this->Model_orders->add_order_items($data);
			var_dump($result_item);
			if (!$result_item) die("Died on an item insert bro");
		endfor;
		//Add data to orders_notes table
		$data = array(
				"user_id" => $user_id,
				"order_id" => $order_id,
				"note" => $this->input->post("note")
				);
		$result_notes = $this->Model_orders->add_order_notes($data);
		if (!$result_notes) die("Died on a result insert bro");
		die('END');
	}
}

