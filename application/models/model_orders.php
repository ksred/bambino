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
}
?>
