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
		$this->db->where("name like '%$name'");
		$result = $this->db->get();
		return $result;
	}


	function search_details ($user_id, $details) {
		$this->db->select('delivery_address');
		$this->db->from('customers');
		$this->db->where('user_id', $user_id);
		$this->db->where("delivery_address like '%$details'");
		$result = $this->db->get();
		return $result;
	}
}
?>
