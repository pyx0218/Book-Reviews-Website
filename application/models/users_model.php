<?php
class Users_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
  
	function login($username,$password){
		$this->db->where("uname",$username);
		$this->db->where("pwd",$password);

		$query=$this->db->get("users");
		if($query->num_rows()>0){
			foreach($query->result() as $rows){
				//add all data to session
				$newdata = array(
				'user_id'  => $rows->user_id,
				'user_name'  => $rows->uname,
				'logged_in'  => TRUE
				);
			}
			$this->session->set_userdata($newdata);
			return true;
		}
		return false;
	}
	public function add_user(){
		$data=array(
		'uname'=>$this->input->post('user_name'),
		'pwd'=>md5($this->input->post('password'))
		);
		$this->db->insert('users',$data);
	}
}