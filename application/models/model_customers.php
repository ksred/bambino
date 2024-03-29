<?php
class Model_customers extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database("default", TRUE);
    }
    
	function search_name ($user_id, $name) {
		$this->db->select('name');
		$this->db->from('customers');
		$this->db->where('user_id', $user_id);
		$this->db->where("name like '%$name%'");
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
	
	function search_customer_by_name ($user_id, $name) {
		$this->db->select('*');
		$this->db->from('customers');
		$this->db->where('user_id', $user_id);
		$this->db->where('name', $name);
		$result = $this->db->get();
		return $result;
	}
	
	function view ($user_id, $id) {
		$this->db->select('*');
		$this->db->from('customers');
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $id);
		$result = $this->db->get();
		return $result;
	}

	function get_all($user_id) {
		$this->db->select('*');
		$this->db->from('customers');
		$this->db->where('user_id', $user_id);
		$this->db->order_by('name');
		$result = $this->db->get();
		return $result;
	}

    function update ($data, $id) {
    	$this->db->where("id", $id);
        $result = $this->db->update("customers", $data);
        return $result;
    }

    function delete ($data) {
        $result = $this->db->delete("customers", $data);
        return $result;
    }


}
?>
