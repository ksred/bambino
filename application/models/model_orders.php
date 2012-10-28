<?php
class Model_orders extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database("default", TRUE);
    }
    
    function add ($data) {
        $this->db->insert("orders", $data);
        return $this->db->insert_id();
    }
    
    function add_order_items ($data) {
        $result = $this->db->insert("orders_items", $data);
        return $result;
    }

    function add_order_notes ($data) {
        $result = $this->db->insert("orders_notes", $data);
        return $result;
    }

	function get_all_status ($user_id) {
		$this->db->select('*');
		$this->db->from('orders_status');
		$this->db->where('user_id', $user_id);
		$result = $this->db->get();
		return $result;
	}

	function view_all ($user_id) {
		$this->db->select('orders.id as id, orders.site_order_id as site_order_id, orders_items.item_code as item, orders_items.description as description, orders_items.cost_price as cost, orders_items.retail_price as retail, customers.name as customer, orders.date as date, orders_items.quantity as quantity, orders.status as status');
		$this->db->from('orders');
		$this->db->join('orders_items', 'orders.id = orders_items.order_id');
		$this->db->join('customers_orders', 'orders.id = customers_orders.order_id');
		$this->db->join('customers', 'customers_orders.customer_id = customers.id');
		$this->db->where('orders.user_id', $user_id);
		$this->db->order_by('date desc');
		$result = $this->db->get();
		return $result;
	}

	function update_status ($user_id, $order_id, $status) {
		$data = array ("id" => $order_id, "user_id" => $user_id);
		$this->db->where($data);
		$data = array("status" => $status);
		$result = $this->db->update("orders", $data);
		return $result;
	}

	function search_id ($user_id, $order_id) {
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('user_id', $user_id);
		$this->db->where("site_order_id like '%$order_id%'");
		$result = $this->db->get();
		return $result;
	}
}
?>
