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
        return $this->db->insert_id();
    }

    function add_order_notes ($data) {
        $result = $this->db->insert("orders_notes", $data);
        return $result;
    }

    function add_order_customer ($data) {
        $result = $this->db->insert("customers_orders", $data);
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
		$this->db->select('orders.id as id, orders.site_order_id as site_order_id, items.stock_id as item, orders_items.description as description, orders_items.cost_price as cost, orders_items.retail_price as retail, customers.name as customer, orders.date as date, orders_items.quantity as quantity, orders.status as status');
		$this->db->from('orders');
		$this->db->join('orders_items', 'orders.id = orders_items.order_id');
		$this->db->join('items', 'orders_items.item_id = items.id');
		$this->db->join('customers_orders', 'orders.id = customers_orders.order_id');
		$this->db->join('customers', 'customers_orders.customer_id = customers.id');
		$this->db->where('orders.user_id', $user_id);
		$this->db->order_by('date desc');
		$result = $this->db->get();
		return $result;
	}

	function orders_per_user ($user_id) {
		$this->db->select('orders.id as id, orders.user_id as user_id, customers_orders.customer_id as customer_id, orders.site_order_id as site_order_id, customers.name as customer, orders.date as date, orders.status as status');
		$this->db->from('orders');
		$this->db->join('customers_orders', 'orders.id = customers_orders.order_id');
		$this->db->join('customers', 'customers_orders.customer_id = customers.id');
		$this->db->where('orders.user_id', $user_id);
		$this->db->order_by('date desc');
		$result = $this->db->get();
		return $result;
	}

	function items_per_order ($user_id, $order_id) {
		$this->db->select('orders_items.id as oi_id, items_meta.quantity as quantity, items.description as description, items.stock_id as stock_id, orders_items.item_id as item_id');
		$this->db->from('orders_items');
		$this->db->join('items', 'items.id = orders_items.item_id');
		$this->db->join('items_meta', 'orders_items.id = items_meta.orders_items_id');
		$this->db->where('orders_items.user_id', $user_id);
		$this->db->where('orders_items.order_id', $order_id);
		$result = $this->db->get();
		return $result;
	}

	function item_meta ($user_id, $item_id) {
		$this->db->select('*');
		$this->db->from('items_meta');
		$this->db->where('user_id', $user_id);
		$this->db->where('item_id', $item_id);
		$result = $this->db->get();
		return $result;
	}

	function get_latest_prices($user_id, $item_id) {
		$this->db->select('*');
		$this->db->from('items_meta');
		$this->db->where('user_id', $user_id);
		$this->db->where('item_id', $item_id);
		$this->db->limit(1);
		$this->db->order_by('id desc');
		$result = $this->db->get();
		return $result;
	}

	function item_meta_orders_items ($user_id, $orders_items_id) {
		$this->db->select('*');
		$this->db->from('items_meta');
		$this->db->where('user_id', $user_id);
		$this->db->where('orders_items_id', $orders_items_id);
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

	function update_item_meta ($user_id, $item_meta_id, $data) {
		$data_where = array ("id" => $item_meta_id, "user_id" => $user_id);
		$this->db->where($data_where);
		$result = $this->db->update("items_meta", $data);
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

	function get_order ($user_id, $id) {
		$this->db->select('orders.id as id, orders.site_order_id as site_order_id, orders.user_id as user_id, orders.date as date, orders.status as status');
		$this->db->from('orders');
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $id);
		$this->db->order_by('date desc');
		$result = $this->db->get();
		return $result;
	}
    
	function get_orders_by_customer ($user_id, $id) {
		$this->db->select('orders.id as id, orders.site_order_id as site_order_id, orders.user_id as user_id, customers.name as customer, orders.date as date, orders.status as status');
		$this->db->from('orders');
		$this->db->join('customers_orders', 'orders.id = customers_orders.order_id');
		$this->db->join('customers', 'customers_orders.customer_id = customers.id');
		$this->db->where('orders.user_id', $user_id);
		$this->db->where('customers_orders.customer_id', $id);
		$this->db->order_by('date desc');
		$result = $this->db->get();
		return $result;
	}
    
    function update_order_item_meta($user_id, $order_id, $item_meta_id) {
        $this->db->where("user_id", $user_id);
        $this->db->where("id", $order_id);
        $data = array("item_meta_id", $item_meta_id);
        $result = $this->db->update("orders_items", $data);
        return $result;
    }

    function delete_order($user_id, $order_id) {
        $data = array("user_id" => $user_id, "id" => $order_id);
        $result_o = $this->db->delete("orders", $data);
        $data = array("user_id" => $user_id, "order_id" => $order_id);
        $result_oi = $this->db->delete("orders_items", $data);
        $result_on = $this->db->delete("orders_notes", $data);
        //Make sure all were successful
        if (($result_o == 1) && ($result_oi == 1) && ($result_on == 1)) {
        	return 1;
        } else {
        	return 0;
        }
    }

    function delete_order_item($user_id, $order_id, $item_id, $order_item_id) {
        $data = array("user_id" => $user_id, "order_id" => $order_id, "item_id" => $item_id, "id" => $order_item_id);
        $result = $this->db->delete("orders_items", $data);
		return $result;
    }
}
?>
