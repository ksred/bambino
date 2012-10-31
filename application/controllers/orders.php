<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller {

	function __construct () {
		parent::__construct();
		$this->load->model("Model_orders");
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
		$customer_details = $this->input->post("customer_details");
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
			$description = $item['desc'];
			$quantity = (int) $item['quantity'];
			$cost = (float) $item['cost'];
			$retail = (float) $item['retail'];
			$data = array(
					"user_id" => $user_id,
					"order_id" => $order_id,
					"item_code" => $code,
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
		//Insert customer order
		if (!$result_notes) die("Died on a result insert bro");
		redirect(BASE_URL."orders/view");
	}

	function view () {
		$user_id = $this->session->userdata("id");
		$orders = $this->Model_orders->view_all($user_id);
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

}
