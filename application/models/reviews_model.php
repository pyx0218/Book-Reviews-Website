<?php
date_default_timezone_set('America/New_York');
class Reviews_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }
  
  public function add_review(){
	$this->load->helper('date');
	$this->load->helper('string');
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
	$title = quotes_to_entities($this->input->post('title'));
	$content = quotes_to_entities($this->input->post('content'));
	$sql = "insert into REVIEW_GENERATEDFROM (USER_ID, ISBN, RTITLE, STARS, RCONTENT, VISIBILITY, RDATE) values ('".$this->session->userdata('user_id')."','".$this->input->post('isbn')."','".$title."','".$this->input->post('rating')."','".$content."','1',to_date('".unix_to_human($now,TRUE)."','YYYY-MM-DD HH:MI:SS AM'))";
	
	$this->db->query($sql);

	return $this->db->insert_id('rid');
  }
  
  public function update_review(){
  	$this->load->helper('string');
	$title=quotes_to_entities($this->input->post('title'));
	$content=quotes_to_entities($this->input->post('content'));
	$data = array(
		'RTITLE' => $title,
		'STARS' => $this->input->post('rating'),
		'RCONTENT' => $content
	);
	$this->db->where('RID',$this->input->post('rid'));
	$this->db->update('REVIEW_GENERATEDFROM',$data);
	
  }
  
  public function get_review($rid){
	$query = $this->db->query('
		select R.*, U.uname, B.bname
		from review_generatedfrom R, users U, books B
		where R.user_id = U.user_id and R.isbn = B.isbn and R.rid = '.$rid.'
	');
	return $query->row_array();
  }
  
  public function delete_review($rid){
	$this->db->delete('Review_GeneratedFrom',array('RID'=>$rid));
  }
  
  public function shield_review($data){
	$this->load->helper('date');
	$this->load->helper('string');
	$now=time();
	
	$query = $this->db->query('
		update review_generatedfrom
		set visibility = 0
		where rid = '.$data['review_item']['RID'].'
	');
	$content=quotes_to_entities($this->input->post('content'));
	$query = $this->db->query('
		insert into monitors (aid, mdate, rid, operation, reason)
		values ('.$data['user_id'].',to_date(\''.unix_to_human($now,TRUE).'\',\'YYYY-MM-DD HH:MI:SS AM\'),
			'.$data['review_item']['RID'].', 0, \''.$content.'\')
	');
  }
  
  public function restore_review($data){
    $this->load->helper('string');
	$query = $this->db->query('
		update review_generatedfrom
		set visibility = 1
		where rid = '.$data['review_item']['RID'].'
	');
	$this->load->helper('date');
	$now=time();
	$content=quotes_to_entities($this->input->post('content'));
	$query = $this->db->query('
		insert into monitors (aid, mdate, rid, operation, reason)
		values ('.$data['user_id'].',to_date(\''.unix_to_human($now,TRUE).'\',\'YYYY-MM-DD HH:MI:SS AM\'),
			'.$data['review_item']['RID'].', 1, \''.$content.'\')
	');
  }
  
  
}