<?php
date_default_timezone_set('America/New_York');
class Users_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
  //////////////////////////////////////////////////////////////////////////////////////
	function login($username,$password){
		$this->db->where('UNAME', $username);
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
				
				if($this->db->query('SELECT * from administrator A where '.$rows->USER_ID.'=A.aid')->num_rows() != 0){
					$newdata['admin'] = TRUE;
				}
				else{
					$newdata['admin'] = FALSE;
				}
			}
			$this->session->set_userdata($newdata);
			return true;
		}
		return false;
	}
	
	////////////////////////////////////////////////////////////////////////////////////////
	public function add_user(){
		$data=array(
		'UNAME'=>$this->input->post('user_name'),
		'PWD'=>($this->input->post('password'))
		);
		$this->db->insert('USERS',$data);
	}
	
	////////////////////////////////////////////////////////////////////////////////////
	public function user_info($user_id){
		if($user_id ==0){
			$user_id = $this->session->userdata('user_id');
		}
		
		$query = $this->db->query('
			select * 
			from administrator A
			where A.aid = '.$user_id.'
		');
		
		if ($query->num_rows() != 0){
			$user = array(
				'user_id' => $user_id,
				'admin' => TRUE,
			);
		}
		else{
			$user = array(
				'user_id' => $user_id,
				'admin' => FALSE,
			);
		}
		$query = $this->db->query('
			select uname
			from users U
			where U.user_id = '.$user_id.'
		');
		
		$row = $query->row();
		
		$user['name'] = $row->UNAME;
		if($this->session->userdata('user_id') == $user['user_id']){
			$user['is_self'] = TRUE;
		}
		else{
			$user['is_self'] = FALSE;
		}
		$idx = 0;
		$friends = array();
		$user['isfriend'] = FALSE;
		$query = $this->db->query('select distinct U.UNAME, U.USER_ID
			from USERS U, FRIENDOF F
			WHERE F.USER_ID1 = '.$user_id.' AND F.USER_ID2 = U.USER_ID
			UNION
			select distinct U.UNAME, U.USER_ID
			from USERS U, FRIENDOF F
			WHERE F.USER_ID2 = '.$user_id.' AND F.USER_ID1 = U.USER_ID');
		foreach ($query->result() as $row){
			$friends[$idx++] = array(
				'name' => $row->UNAME,
				'user_id' => $row->USER_ID,
			);
			
			if($row->USER_ID == $this->session->userdata('user_id')){
				$user['isfriend'] = TRUE;
			}
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
		//////
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
		////////
		$idx = 0;
		$reviews = array();
		$query = $this->db->query('
			select *
			from review_generatedfrom R
			where R.user_id = '.$user_id.'
		');
		foreach ($query->result() as $row){
			$reviews[$idx++] = array(
				'rid' => $row->RID,
				'rtitle' => $row->RTITLE,
				'isbn' => $row->ISBN,
			);
		}
		
		////////
		$idx = 0;
		$notes = array();
		$query = $this->db->query('
			select *
			from note_records N
			where N.user_id = '.$user_id.'
		');
		foreach ($query->result() as $row){
			$notes[$idx++] = array(
				'nid' => $row->NID,
				'page' => $row->PAGE,
				'isbn' => $row->ISBN,
			);
		}
		
		////////
		$data = array(
			'user' => $user,
			'friends' => $friends,
			'reading' => $reading,
			'read' => $read,
			'wantstoread' => $wantstoread,
			'notes' => $notes,
			'reviews' => $reviews,);
		
		if($this->session->userdata('admin') && $user['user_id'] == $this->session->userdata['user_id']){
			$idx = 0;
			$monitors = array();
			$query = $this->db->query('
				select R.rtitle, M.mdate, M.operation, M.reason
				from monitors M, Review_generatedfrom R
				where M.aid = '.$user_id.' and M.rid = R.rid
			');
			foreach ($query->result() as $row){
				$monitors[$idx++] = array(
					'date' => $row->MDATE,
					'title' => $row->RTITLE,
					'reason' => $row->REASON,
					'operation' => $row->OPERATION,
				);
			}
			$data['monitors'] = $monitors;
		}
		
		return $data;
	}
	
	////////////////////////////////////////////////////////////////////////////////////////////
	public function setting(){
		$user_id = $this->session->userdata('user_id');
		$this->db->query('
			update USERS
			set PWD = \''.$this->input->post('password').'\'
			where USER_ID = '.$user_id.'
		');
	}
	
	///////////////////////////////////////////////////////////////////////////////////////////////
	public function add_friend($friend_id){
		$user_id = $this->session->userdata('user_id');
		$this->db->query('
			insert into friendof (user_id1, user_id2)
			values ('.$user_id.','.$friend_id.')
		');
	}
	
	///////////////////////////////////////////////////////////////////////////////////////////////
	public function unfriend($friend_id){
		$user_id = $this->session->userdata('user_id');
		$this->db->query('
			delete from friendof
			where user_id1 = '.$user_id.' and user_id2 = '.$friend_id.' or user_id1 = '.$friend_id.' and user_id2 = '.$user_id.'
		');
	}
}