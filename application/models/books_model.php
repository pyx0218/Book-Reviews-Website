<?php
class Books_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }
  
  public function get_books($isbn = FALSE){
  if ($isbn === FALSE)
  {
    $query = $this->db->query('select * from Books');
	//$query = $this->db->get('Books');
    return $query->result_array();
  }
  
  $query = $this->db->get_where('Books', array('ISBN' => $isbn));
  return $query->row_array();
}
}