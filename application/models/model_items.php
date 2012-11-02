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
		$this->db->where("stock_id like '%$code%'");
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

	function get_all_suppliers ($user_id) {
		$this->db->select('*');
		$this->db->from('suppliers');
		$this->db->where('user_id', $user_id);
		$result = $this->db->get();
		return $result;
	}

    function add_customer ($data) {
        $this->db->insert("customers", $data);
        return $this->db->insert_id();
    }

    function add ($data) {
        $this->db->insert("items", $data);
        return $this->db->insert_id();
    }

    function add_item_meta ($data) {
        $this->db->insert("items_meta", $data);
        return $this->db->insert_id();
    }

    function search_stockid_exact ($user_id, $stock_id) {
		$this->db->select('*');
		$this->db->from('items');
		$this->db->where('user_id', $user_id);
		$this->db->where('stock_id', $stock_id);
		$result = $this->db->get();
		return $result;
	}

    function search_stockid_itemid_exact ($stock_id, $id) {
		$this->db->select('*');
		$this->db->from('items');
		$this->db->where('stock_id', $stock_id);
		$this->db->where('id = '.$id);
		$result = $this->db->get();
		return $result;
	}

	function get_all ($user_id) {
		$this->db->select("items.id as id, items.stock_id as stock_id, items.description as description, suppliers.name as supplier, suppliers.id as supplier_id, items.date as date");
		$this->db->from("items");
		$this->db->join("suppliers", "suppliers.id = items.supplier_id");
		$this->db->where("items.user_id", $user_id);
		$result = $this->db->get();
		return $result;
	}

	function view ($user_id, $id) {
		$this->db->select("*");
		$this->db->from("items");
		$this->db->where("user_id", $user_id);
		$this->db->where("id", $id);
		$result = $this->db->get();
		return $result;
	}

    function update ($data, $id) {
        $this->db->where("id", $id);
        $result = $this->db->update("items", $data);
        return $result;
    }

    function delete ($data) {
        $result = $this->db->delete("items", $data);
        return $result;
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
