<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct () {
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = "Login Bambino";
		$this->load->view('users/login', $data);
	}

	public function process () {
		$data = array (
					"email" => $this->input->post("email"),
					"password" => md5($this->input->post("password"))
					);
		$login = $this->Model_users->login($data);
		if ($login->num_rows() > 0) {
			//set session
			$user = $login->result();
			var_dump($user);
            $data = array("id" => $user[0]->id,
                "name" => $user[0]->name
                );
            $this->session->set_userdata($data);
            header("Location: /");
		} else {
			$data['title'] = "Login Bambino";
			$this->load->view("users/login_unsuccessful", $data);
		}
	}

    public function logout() {
        $this->session->sess_destroy();
        $this->session->unset_userdata("id");
        header("Location: /");
    }
}

