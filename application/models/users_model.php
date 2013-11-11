<?php
date_default_timezone_set('America/New_York');
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
	
	public function user_info(){
		$user_id = $this->session->userdata('user_id');
		$idx = 0;
		$friends = array();
		$query = $this->db->query('select distinct U.UNAME
			from USERS U, FRIENDOF F
			WHERE F.USER_ID1 = '.$user_id.' AND F.USER_ID2 = U.USER_ID
			UNION
			select distinct U.UNAME
			from USERS U, FRIENDOF F
			WHERE F.USER_ID2 = '.$user_id.' AND F.USER_ID1 = U.USER_ID');
		foreach ($query->result() as $row){
			$friends[$idx++] = $row->UNAME;
		}
		$idx = 0;
		$reading = array();
		$query = $this->db->query('select distinct B.bname, B.isbn
			from Reading R, books B
			WHERE R.USER_ID = '.$user_id.' and B.isbn = R.isbn');
		foreach ($query->result() as $row){
			$reading[$idx++] = array(
				'bname' => $row->BNAME,
				'isbn' => $row->ISBN,
				);
		}
		$idx = 0;
		$read = array();
		$query = $this->db->query('select distinct B.bname, B.isbn
			from read R, books B
			WHERE R.USER_ID = '.$user_id.' and B.isbn = R.isbn');
		foreach ($query->result() as $row){
			$read[$idx++] = array(
				'bname' => $row->BNAME,
				'isbn' => $row->ISBN,
			);
		}
		$idx = 0;
		$wantstoread = array();
		$query = $this->db->query('select distinct B.bname, B.isbn
			from wantstoread R, books B
			WHERE R.USER_ID = '.$user_id.' and B.isbn = R.isbn');
		foreach ($query->result() as $row){
			$wantstoread[$idx++] = array(
				'bname' => $row->BNAME,
				'isbn' => $row->ISBN,
			);
		}
		$data = array('friends' => $friends,
			'reading' => $reading,
			'read' => $read,
			'wantstoread' => $wantstoread,);
		echo $data['friends'][0];
		return $data;
	}
	
	
	
	
	
	
	
	
	
	
}