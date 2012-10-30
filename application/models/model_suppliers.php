<?php
class Model_suppliers extends CI_Model
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
		$this->db->select('*');
		$this->db->from('suppliers');
		$this->db->where('user_id', $user_id);
		$this->db->where('name', $name);
		$result = $this->db->get();
		return $result;
	}

	function view_all ($user_id) {
		$this->db->select('*');
		$this->db->from('suppliers');
		$this->db->where('user_id', $user_id);
		$result = $this->db->get();
		return $result;
	}

	function update ($data) {
		$result = $this->db->update("suppliers", $data);
		return $result;
	}

	function delete ($data) {
		$result = $this->db->delete("suppliers", $data);
		return $result;
	}

	function view ($user_id, $id) {
		$this->db->select('*');
		$this->db->from('suppliers');
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $id);
		$result = $this->db->get();
		return $result;
	}
    
    function add_supplier ($data) {
        $this->db->insert("suppliers", $data);
        return $this->db->insert_id();
    }

	function search_supplier_by_id ($user_id, $id) {
		$this->db->select('*');
		$this->db->from('suppliers');
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $id);
		$result = $this->db->get();
		return $result;
	}
}
?>
