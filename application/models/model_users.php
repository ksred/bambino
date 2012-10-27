<?php
class Model_users extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database("default", TRUE);
    }
    
    function login ($data) {
        $this->db->select('*');
        $this->db->from("users");
        $this->db->where("email", $data["email"]);
        $this->db->where("password", $data["password"]);
        $result = $this->db->get();
        return $result;
    }
    
}
?>
