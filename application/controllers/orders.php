<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller {

	function __construct () {
		parent::__construct();
		$this->load->model("Model_orders");
		$this->load->model("Model_items");
		$user_id = $this->session->userdata("id");
		if (!isset($user_id)) redirect(BASE_URL."login");
	}

	public function index()
	{
		$data['title'] = "Orders";
		$data['nav'] = "orders";
		$this->load->view('orders/index');
	}

	public function add () {
		$user_id = $this->session->userdata("id");
		$data['title'] = "Bambino : Orders : Add";
		$data['nav'] = "orders";
		$status = $this->Model_orders->get_all_status($user_id);
		$data['status'] = $status->result();
		$this->load->view("orders/add", $data);
	}

	public function add_process () {
		$user_id = $this->session->userdata("id");
		$customer_name = $this->input->post("customer_name");
		$note = $this->input->post("note");
		$status = $this->input->post("status");
		$site_order_id = $this->input->post("site_order_id");
		$no_of_items = $this->input->post("item_total");
		//Add data to orders table
		$data = array(
				"user_id" => $user_id,
				"status" => $status,
				"site_order_id" => $site_order_id 
				);
		$order_id = $this->Model_orders->add($data);
		if (!$order_id) die("Died on the order insert bro");
		//Add data to orders_items table
		for ($i=1; $i <= $no_of_items; $i++) :
			$item = $this->input->post("item".$i);
			$code = $item['code'];
			$quantity = (int) $item['quantity'];
			$item_id = $this->Model_items->search_code($user_id, $code)->result();
			$data = array(
					"user_id" => $user_id,
					"order_id" => $order_id,
					"item_id" => $item_id[0]->id
				);
			$result_item = $this->Model_orders->add_order_items($data);
			if (!$result_item) die("Died on an item insert bro");
			$orders_items_id = $result_item;
			//Insert item meta 
			//Get latest values from db for items
			$item_details_cr = $this->Model_orders->get_latest_prices($user_id, $item_id[0]->id)->result();
			if (!isset($item_details_cr[0]->cost)) $item_details_cr[0]->cost = 0;
			if (!isset($item_details_cr[0]->retail)) $item_details_cr[0]->retail = 0;
			$data = array (
					"user_id" => $user_id,
					"item_id" => $item_id[0]->id,
					"stock_id" => $item_id[0]->stock_id,
					"order_id" => $order_id,
					"orders_items_id" => $orders_items_id,
					"details" => '(none)',
					"cost" => $item_details_cr[0]->cost,
					"retail" => $item_details_cr[0]->retail,
					"quantity" => $quantity,
					);
			$result_item_meta = $this->Model_items->add_item_meta($data);
			if (!$result_item_meta) die("Died on item meta insert bro");
		endfor;
		//Add data to orders_notes table
		$data = array(
				"user_id" => $user_id,
				"order_id" => $order_id,
				"note" => $this->input->post("note")
				);
		$result_notes = $this->Model_orders->add_order_notes($data);
		//Insert customer order
		$this->load->model("Model_customers");
		$customer = $this->Model_customers->search_customer_by_name($user_id, $customer_name)->result();
		if (!$customer) die("Couldn't find the customer. Weird right");
		$data = array (
				"user_id" => $user_id,
				"customer_id" => $customer[0]->id,
				"order_id" => $order_id
				);
		$result_customer_order = $this->Model_orders->add_order_customer($data);
		if (!$result_customer_order) die("Died on a customer result insert bro");
		redirect(BASE_URL."orders/view");
	}

	function view () {
		$user_id = $this->session->userdata("id");
		$orders = $this->Model_orders->orders_per_user($user_id);
		$data['orders'] = $orders;
		$data['nav'] = "orders";
		$status_all = $this->Model_orders->get_all_status($user_id);
		$data['status_all'] = $status_all->result();

		$data['title'] = 'Bambino : Orders : All';
		$this->load->view('orders/view', $data);
	}
	
	function update_process () {
		$status = $this->input->post('status');
		$order_id = $this->input->post('order_id');
		$user_id = $this->session->userdata("id");
		$result = $this->Model_orders->update_status($user_id, $order_id, $status);
		echo $result;
	}

	function update_item_process () {
		$cost = $this->input->post('cost');
		$retail = $this->input->post('retail');
		$quantity = $this->input->post('quantity');
		$details = $this->input->post('details');
		$order_item_id = $this->input->post('order_item_id');
		$user_id = $this->session->userdata("id");
		$data = array (
				"cost" => $cost,
				"retail" => $retail,
				"details" => $details,
				"quantity" => $quantity
		);
		$result = $this->Model_orders->update_item_meta($user_id, $order_item_id, $data);
		echo $result;
	}

	function search_id () {
		$user_id = $this->session->userdata("id");
		$order_id = $this->input->post("query");
		$order_ids = $this->Model_orders->search_id($user_id, $order_id);
		foreach ($order_ids->result() as $o) {
			$orders_array[] = $o->site_order_id;
		}
		echo json_encode($orders_array);

	}

	function customer ($id) {
		$user_id = $this->session->userdata("id");
		$orders = $this->Model_orders->get_orders_by_customer($user_id, $id);
		$this->load->model("Model_customers");
		$customer = $this->Model_customers->view($user_id, $id);
		$status_all = $this->Model_orders->get_all_status($user_id);
		$data['status_all'] = $status_all->result();
		$data['customer'] = $customer->result();
		$data['orders'] = $orders->result();
		$data['nav'] = "orders";
		$data['title'] = "Bambino : Orders : Per Customer";

		$this->load->view("orders/customer", $data);
	}

	function update ($id) {
		$user_id = $this->session->userdata("id");
		$orders = $this->Model_orders->get_order($user_id, $id);
		$status_all = $this->Model_orders->get_all_status($user_id);
		$data['status_all'] = $status_all->result();
		$data['orders'] = $orders->result();
		$data['nav'] = "orders";
		$data['title'] = "Bambino : Orders : Update";

		$this->load->view("orders/update", $data);
	}

}

