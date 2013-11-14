<?php
date_default_timezone_set('America/New_York');
class Notes_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }
  
  public function add_note(){
	$this->load->helper('date');
	$this->load->helper('string');
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
	$content = quotes_to_entities($this->input->post('content'));
	$query = $this->db->query('
		insert into note_records (user_id, isbn, ncontent, page, ndate, visibility)
		values ('.$this->session->userdata('user_id').', \''.$this->input->post('isbn').'\', 
			'.$content.', '.$this->input->post('page').',
			to_date(\''.unix_to_human($now).'\',\'YYYY-MM-DD HH:MI AM\'), '.$this->input->post('visibility').')
	');

	return $this->db->insert_id('nid');
  }
  
  public function get_note($nid){
  
	$query = $this->db->query('
		select N.*, B.bname, U.uname
		from note_records N, books B, users U
		where N.nid = '.$nid.' and N.isbn = B.isbn and N.user_id = U.user_id
	');
	return $query->row_array();
  }
  
  public function update_note(){
	$this->load->helper('string');
	$content=quotes_to_entities($this->input->post('content'));
	$data = array(
		'PAGE' => $this->input->post('page'),
		'NCONTENT' => $content,
		'VISIBILITY' => $this->input->post('visibility')
	);
	$this->db->where('nid',$this->input->post('nid'));
	$this->db->update('note_records',$data);
	
  }
  
  public function delete_review($nid){
	$this->db->delete('note_records',array('NID'=>$nid));
  }
 
  
}