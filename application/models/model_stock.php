<?php
class Model_stock extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database("default", TRUE);
    }
    
    function add ($data) {
        $this->db->insert("items", $data);
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
		$this->db->select('orders.id as id, orders.site_order_id as site_order_id, orders_items.code as item_code, item.description as description, orders_items.cost as cost, orders_items.retail as retail, orders.date as date');
		$this->db->from('orders');
		$this->db->join('orders_items', 'orders.id = orders_items.order_id');
		$this->db->where('user_id', $user_id);
		$this->db->order_by('date desc');
		$result = $this->db->get();
		die($this->db->last_query());
		return $result;
	}
}
?>
