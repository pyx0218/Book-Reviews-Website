<?php
date_default_timezone_set('America/New_York');
class Reviews_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }
  
  public function add_review(){
  echo $now;
	$this->load->helper('date');
	$now=time();
	echo $now;
	$data = array(
		'ISBN' => $this->input->post('isbn'),
		'USER_ID' => $this->session->userdata('user_id')
	);
	$query=$this->db->get_where('READ',$data);
	$temp=$query->result_array();
	if(empty($temp)){
		$this->db->insert('READ',$data);
	}
	$data = array(
		'USER_ID' => $this->session->userdata('user_id'),
		'ISBN' => $this->input->post('isbn'),
		'RTITLE' => $this->input->post('title'),
		'STARS' => $this->input->post('rating'),
		'RCONTENT' => $this->input->post('content'),
		'VISIBILITY' => 1
		'RDATE' => unix_to_human($now)
	);
	$this->db->insert('REVIEW_GENERATEDFROM',$data);

	return $this->db->insert_id('rid');
  }
  
  public function get_review($rid){
	$this->db->select('RID,RTITLE,RDATE,STARS,RCONTENT,Review_GeneratedFrom.ISBN as ISBN,BNAME,Review_GeneratedFrom.USER_ID as USER_ID,UNAME');
	$this->db->from('Review_GeneratedFrom');
	$this->db->join('Books','Books.ISBN=Review_GeneratedFrom.ISBN');
	$this->db->join('Users','Users.USER_ID=Review_GeneratedFrom.USER_ID');
	$this->db->where('RID',$rid);
	$this->db->where('VISIBILITY',1);
	$query = $this->db->get();
	return $query->row_array();
  }
  
  public function set_read(){
	$data = array(
		'USER_ID' => $this->session->userdata('user_id'),
		'ISBN' => strip_quotes($this->input->post('isbn')),
	);
	$this->db->insert('Read',$data);
  }
  
}