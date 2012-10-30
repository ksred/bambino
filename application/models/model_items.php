<?php
class Model_items extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database("default", TRUE);
    }
    
	function search_code ($user_id, $code) {
		$this->db->select('*');
		$this->db->from('items');
		$this->db->where('user_id', $user_id);
		$this->db->where("code like '%$code%'");
		$result = $this->db->get();
		return $result;
	}

	function search_name_exact ($user_id, $name) {
		$this->db->select('name');
		$this->db->from('customers');
		$this->db->where('user_id', $user_id);
		$this->db->where('name', $name);
		$result = $this->db->get();
		return $result;
	}

	function search_details ($user_id, $details) {
		$this->db->select('delivery_address');
		$this->db->from('customers');
		$this->db->where('user_id', $user_id);
		$this->db->where("delivery_address like '%$details%'");
		$result = $this->db->get();
		return $result;
	}

    function add_customer ($data) {
        $this->db->insert("customers", $data);
        return $this->db->insert_id();
    }

	function search_customer_by_id ($user_id, $id) {
		$this->db->select('*');
		$this->db->from('customers');
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $id);
		$result = $this->db->get();
		return $result;
	}
}
?>
