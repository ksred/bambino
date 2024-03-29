<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller {

	function __construct () {
		parent::__construct();
		$this->load->model("Model_orders");
		$this->load->model("Model_items");
		$user_id = $this->session->userdata("id");
		if (!$user_id) redirect(BASE_URL."login");
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
			if ($code != '') {
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
			} //endif code is not empty
		endfor;
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

	function check_order_fields () {
		$result = "";
		$user_id = $this->session->userdata("id");
		//Check if customer exists
		$customer_name = $this->input->post("customer_name");
		$this->load->Model('Model_customers');
		$customer_id = $this->Model_customers->search_name($user_id, $customer_name);
		if ($customer_id->num_rows() == 0) $result .= "Customer does not exist. Please choose an exisiting customer, or create a new customer.<br />";
		//Check if Site Order Id exists (must be unique)
		$site_order_id = $this->input->post("site_order_id");
		$site_order_exists = $this->Model_orders->search_id($user_id, $site_order_id);
		if ($site_order_exists->num_rows() > 0) $result .= "Site order id already exists. Please use a unique order number.<br />";
		//Check item exists
		$no_of_items = $this->input->post("item_total");
		for ($i=1; $i <= $no_of_items; $i++) :
			$item = $this->input->post("item".$i);
			if ($item != '') {
				$item_id = $this->Model_items->search_code($user_id, $item)->result();
				if (!$item_id) $result .= "<strong>$item</strong> Item does not exist, please choose an existing item or add a new one.";
			} //endif code is not empty
		endfor;
		if ($result == "") {
			echo 0;
		} else {
			echo json_encode($result);
		}
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
		$item_status = $this->input->post('item_status');
		$order_item_id = $this->input->post('order_item_id');
		$user_id = $this->session->userdata("id");
		$data = array (
				"cost" => $cost,
				"retail" => $retail,
				"details" => $details,
				"item_status" => $item_status,
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

	function delete_process () {
		$order_id = $this->input->post('orderid');
		$user_id = $this->session->userdata('id');
		$result = $this->Model_orders->delete_order($user_id, $order_id);
		echo $result;
	}

	function delete_item_process () {
		$order_id = $this->input->post('orderid');
		$item_id = $this->input->post('itemid');
		$order_item_id = $this->input->post('orderitemid');
		$user_id = $this->session->userdata('id');
		$result = $this->Model_orders->delete_order_item($user_id, $order_id, $item_id, $order_item_id);
		echo $result;
	}

	function add_item_order_process () {
		$user_id = $this->session->userdata('id');
		$order_id = $this->input->post('orderid');
		$item_code = $this->input->post("itemcode");
		$item_quantity = $this->input->post("itemquantity");
		if ($item_code != '') {
			$quantity = (int) $item_quantity;
			$item_id = $this->Model_items->search_code($user_id, $item_code)->result();
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
			$item_details = $this->Model_items->view($user_id, $item_id[0]->id)->result();
			$data['item_desc'] = $item_details[0]->description;
			$data['order_item_id'] = $result_item_meta;
			$data['quantity'] = $item_quantity;
			$result = json_encode($data);
			echo $result;
		}
	}

}

