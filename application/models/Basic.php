<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Basic extends CI_Model { 

public function savelist(){
	if($this->input->post('pname')){
		$data = array(
			 'email' => $this->session->userdata('auth'), 
			'name' => $this->input->post('pname'), 
			'descr' => $this->input->post('desc'), 
			'privacy' => $this->input->post('privacy')

		); 
		$this->db->insert('list', $data);
		redirect(base_url());

	}

}

public function getByListid($id){
	if($this->input->get('listid')){
		$data = $this->db->get_where('saved', array('listid' => $id))->result();
		return $data; 

	}
	 
}


}
?>