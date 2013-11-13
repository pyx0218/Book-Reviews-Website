<?php
date_default_timezone_set('America/New_York');
class Reviews_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }
  
  public function add_review(){
	$this->load->helper('date');
	$now=time();

	$data = array(
		'ISBN' => $this->input->post('isbn'),
		'USER_ID' => $this->session->userdata('user_id')
	);
	$query=$this->db->get_where('READ',$data);
	$temp=$query->result_array();
	if(empty($temp)){
		$this->db->insert('READ',$data);
	}
	$sql = "insert into REVIEW_GENERATEDFROM (USER_ID, ISBN, RTITLE, STARS, RCONTENT, VISIBILITY, RDATE) values ('".$this->session->userdata('user_id')."','".$this->input->post('isbn')."','".$this->input->post('title')."','".$this->input->post('rating')."','".$this->input->post('content')."','1',to_date('".unix_to_human($now)."','YYYY-MM-DD HH:MI AM'))";
	
	/*$data = array(
		'USER_ID' => $this->session->userdata('user_id'),
		'ISBN' => $this->input->post('isbn'),
		'RTITLE' => $this->input->post('title'),
		'STARS' => $this->input->post('rating'),
		'RCONTENT' => $this->input->post('content'),
		'VISIBILITY' => 1,
		'RDATE' => $date
	);*/
	$this->db->query($sql);

	return $this->db->insert_id('rid');
  }
  
  public function update_review(){
	$data = array(
		'RTITLE' => $this->input->post('title'),
		'STARS' => $this->input->post('rating'),
		'RCONTENT' => $this->input->post('content')
	);
	$this->db->where('RID',$this->input->post('rid'));
	$this->db->update('REVIEW_GENERATEDFROM',$data);
	
  }
  
  public function get_review($rid){
	$query = $this->db->query('
		select R.*, U.uname, B.bname
		from review_generatedfrom R, users U, books B
		where R.user_id = U.user_id and R.isbn = B.isbn and R.rid = '.$rid.' and R.visibility = 1
	');
	return $query->row_array();
  }
  
  public function delete_review($rid){
	$this->db->delete('Review_GeneratedFrom',array('RID'=>$rid));
  }
  
  public function shield_review($data){
	$query = $this->db->query('
		update review_generatedfrom
		set visibility = 0
		where rid = '.$data['review_item']['RID'].'
	');
	$this->load->helper('date');
	$now=time();
	$query = $this->db->query('
		insert into monitors (aid, mdate, rid, operation, reason)
		values ('.$data['user_id'].',to_date(\''.unix_to_human($now).'\',\'YYYY-MM-DD HH:MI AM\'),
			'.$data['review_item']['RID'].', 0, \''.$this->input->post('content').'\')
	');
  }
  
  
}