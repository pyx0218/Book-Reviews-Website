<?php
class Users_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
  
	function login($username,$password){
		$this->db->where("UNAME",$username);
		$this->db->where("PWD",$password);

		$query=$this->db->get("users");
		if($query->num_rows()>0){	
			foreach($query->result() as $rows){
				//add all data to session
				$newdata = array(
				'user_id'  => $rows->USER_ID,
				'user_name'  => $rows->UNAME,
				'logged_in'  => TRUE,
				);
			}
			$this->session->set_userdata($newdata);
			return true;
		}
		return false;
	}
	public function add_user(){
		$data=array(
		'UNAME'=>$this->input->post('user_name'),
		'PWD'=>($this->input->post('password'))
		);
		$this->db->insert('USERS',$data);
	}
}