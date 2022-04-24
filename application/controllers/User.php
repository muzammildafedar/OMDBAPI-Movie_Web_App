<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		// if($this->session->userdata('auth') == ''){
		// 	redirect('auth'); 

		// }
		$result = json_decode( $this->MoviesApi->main()); 
		$this->Basic->savelist(); 
		$this->load->view('public/header');
		$this->load->view('public/home', ['data' => $result]);
		$this->load->view('public/footer');


	}
	public function login(){
		$this->Auth->register(); 
		$this->Auth->login(); 
		$this->load->view('public/header');
		$this->load->view('public/login');
		$this->load->view('public/footer');

	}
	public function logout(){
		$this->Auth->logout(); 
		redirect('auth');


	}
	public function savemovie(){
		if($this->input->get('imdbid')){
			if($this->session->userdata('auth') == ''){
			redirect('auth'); 

			}
			$data = array(
				'imdbid' => $this->input->get('imdbid'), 
				'listid' => $this->input->get('listid'),
			);
			$this->db->insert('saved', $data);
			redirect(base_url());  

		}
	}
	public function info(){
		$this->load->view('public/header');
		$this->load->view('public/info');
		$this->load->view('public/footer');

	}
}
