<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth extends CI_Model {
	public function register(){
		if($this->input->post('name')){

			$check = $this->db->get_where('user', array('email' => $this->input->post('email')))->row();
			// print_r($check);

			if(!empty($check)){
				$this->session->set_flashdata('error', 'This '.$this->input->post('email').' email address already exists');

			} else {
				$data = array(
					'name' => $this->input->post('name'),  
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password'),

				); 
				$this->db->insert('user', $data); 
				$this->session->set_flashdata('success', 'Hurray ! You have been successfully registered your account !!');

			}


		}
	}
	public function login(){
		if($this->input->post('uemail')){
			$check = $this->db->get_where('user', array('email' => $this->input->post('uemail'), 'password' => $this->input->post('upassword')))->row();
			print_r($check);
			if(empty($check)){
					$this->session->set_flashdata('error', 'Invalid password or email or account doesn\'t exists');


			} else {
				$this->session->set_userdata('auth', $check->email);
				redirect(base_url()); 
			}

		}
	}
	public function logout(){
		$this->session->unset_userdata('auth');

	}


}

?>