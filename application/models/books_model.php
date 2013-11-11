<?php
date_default_timezone_set('America/New_York');
class Books_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }
  
  public function get_books($isbn = FALSE){
  if ($isbn === FALSE)
  {
    //$query = $this->db->query('select * from Books');
	$query = $this->db->get('Books');
    return $query->result_array();
  }
  
  //$query = $this->db->query('select * from Books where ISBN='.$isbn);
  $query = $this->db->get_where('Books', array('ISBN' => $isbn));
  return $query->row_array();
}

	public function search_books($keyword = FALSE){
	if ($keyword === FALSE)
	  {
		$query = $this->db->get('Books');
		return $query->result_array();
	  }
	  
	  $this->db->from('Books');
	  $this->db->where('BNAME', $keyword);
	  $this->db->or_where('ISBN', $keyword);
	  $query = $this->db->get();
	  return $query->result_array();
	}
	
	public function get_book_information($isbn){
		if(!$isbn) return FALSE;
		$query = $this->db->get_where('Books', array('ISBN' => $isbn));
		$info = $query->row_array();
		//author
		$query = $this->db->query('select ANAME from Authors where AID in (select AID from WroteBy where ISBN='.$isbn.')');
		$info['AUTHOR'] = $query->result_array();
		$info['AVGSTAR'] = 
	}
}