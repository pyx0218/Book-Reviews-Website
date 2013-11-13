<?php
date_default_timezone_set('America/New_York');
class Notes_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }
  
  public function add_note(){
	$this->load->helper('date');
	$now=time();

	$data = array(
		'ISBN' => $this->input->post('isbn'),
		'USER_ID' => $this->session->userdata('user_id')
	);
	$query=$this->db->get_where('READING',$data);
	$temp=$query->result_array();
	if(empty($temp)){
		$this->db->insert('READING',$data);
	}
	
	$query = $this->db->query('
		insert into note_records (user_id, isbn, ncontent, page, ndate, visibility)
		values ('.$this->session->userdata('user_id').', \''.$this->input->post('isbn').'\', 
			\''.$this->input->post('content').'\', '.$this->input->post('page').',
			to_date(\''.unix_to_human($now).'\',YYYY-MM-DD HH:MI AM), 1)
	');

	return $this->db->insert_id('nid');
  }
  
  public function get_note($rid){
	$query = $this->db->query('
		select N.*, B.bname, U.uname
		from note_records N, books B, users U
		where N.nid = '.$rid.' and N.isbn = B.isbn and N.user_id = U.user_id
	');
	return $query->row_array();
  }
  
  public function set_read(){
	$data = array(
		'USER_ID' => $this->session->userdata('user_id'),
		'ISBN' => $this->input->post('isbn'),
	);
	$this->db->insert('Read',$data);
  }
  
}