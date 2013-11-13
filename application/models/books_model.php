<?php
date_default_timezone_set('America/New_York');
class Books_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }
  
  public function get_book($isbn = FALSE){
	  if ($isbn === FALSE) return FALSE;
	  
	  $query = $this->db->get_where('Books', array('ISBN' => $isbn));
	  return $query->row_array();
  }

	public function search_books($keyword = FALSE){
	if ($keyword === FALSE)
	  {
		$query = $this->db->get('Books');
	  }
	else{
	  $this->db->distinct();
	  $this->db->select('Books.ISBN');
	  $this->db->from('Books');
	  $this->db->join('WroteBy','Books.ISBN=WroteBy.ISBN');
	  $this->db->join('Authors','Authors.AID=WroteBy.AID');
	  $this->db->join('BelongsTo','BelongsTo.ISBN=Books.ISBN');
	  $this->db->like('lower(BNAME)', strtolower($keyword));
	  $this->db->or_like('lower(Books.ISBN)', strtolower($keyword));
	  $this->db->or_like('lower(ANAME)', strtolower($keyword));
	  $this->db->or_like('lower(TNAME)',strtolower($keyword));
	  $query = $this->db->get();
	}
	  $x=0;
	  $info=array();
	  foreach($query->result_array() as $row){
		$info[$x]=$this->books_model->get_book($row['ISBN']);
		$info[$x]['AUTHORS']=$this->books_model->get_book_authors_name($row['ISBN']);
		$info[$x]=array_merge($info[$x],$this->books_model->get_book_avgstar($row['ISBN']));
		$info[$x]=array_merge($info[$x],$this->books_model->get_book_reader_num($row['ISBN']));
		$x++;
	  }
	  return $info;
	}
	
	public function get_book_authors_name($isbn){ //find all the authors' names of the book
		if(!$isbn) return FALSE;
		
		$this->db->select('AID');
		$this->db->from('WroteBy');
		$this->db->where('ISBN',$isbn);
		$query = $this->db->get();
		$x=0;
		foreach($query->result_array() as $row)
			$AID[$x++] = $row['AID'];
		$this->db->select('ANAME');
		$this->db->from('Authors');
		$this->db->where_in('AID',$AID);
		$query = $this->db->get();
		$authors = $query->result_array();
		return $authors;
	}
	
	public function get_book_authors($isbn){ //find all the authors of the book
		if(!$isbn) return FALSE;
		
		$this->db->select('AID');
		$this->db->from('WroteBy');
		$this->db->where('ISBN',$isbn);
		$query = $this->db->get();
		$x=0;
		foreach($query->result_array() as $row)
			$AID[$x++] = $row['AID'];
		$this->db->from('Authors');
		$this->db->where_in('AID',$AID);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_book_avgstar($isbn){  //get the average star and the number of reviews
		$this->db->select_avg('STARS');
		$this->db->from('Review_GeneratedFrom');
		$this->db->where('ISBN',$isbn);
		$this->db->where('VISIBILITY',1);
		$query=$this->db->get();
		$review = $query->row_array();
		$this->db->select('RID');
		$this->db->where('VISIBILITY',1);
		$query = $this->db->get_where('Review_GeneratedFrom', array('ISBN'=>$isbn));
		$review['COUNT'] = $query->num_rows();
		return $review;
	}
	
	//get the number of users who want to/is reading/read the book
	public function get_book_reader_num($isbn){
		$query = $this->db->get_where('WantsToRead', array('ISBN' => $isbn));
		$reader['WANTSTOREAD_NUM'] = $query->num_rows();
		$query = $this->db->get_where('Reading', array('ISBN' => $isbn));
		$reader['READING_NUM'] = $query->num_rows();
		$query = $this->db->get_where('Read', array('ISBN' => $isbn));
		$reader['READ_NUM'] = $query->num_rows();
		return $reader;
	}
	
	//Find whether the current user wants to/is reading/read the book
	public function get_book_reader_flag($isbn){
		$flag['WANTSTOREAD_FLAG']=FALSE;
		$flag['READING_FLAG']=FALSE;
		$flag['READ_FLAG']=FALSE;
		if($this->session->userdata('logged_in')){
			$user_id=$this->session->userdata('user_id');
			$query = $this->db->get_where('WantsToRead', array('ISBN' => $isbn, 'USER_ID'=>$user_id));
			$result = $query->result_array();
			if(!empty($result))
				$flag['WANTSTOREAD_FLAG']=TRUE;
			$query = $this->db->get_where('Reading', array('ISBN' => $isbn, 'USER_ID'=>$user_id));
			$result = $query->result_array();
			if(!empty($result))
				$flag['READING_FLAG']=TRUE;
			$query = $this->db->get_where('Read', array('ISBN' => $isbn, 'USER_ID'=>$user_id));
			$result = $query->result_array();
			if(!empty($result))
				$flag['READ_FLAG']=TRUE;
		}
		return $flag;
	}
	
	public function get_book_reviews($isbn){
		if(!$isbn) return FALSE;
		$this->db->from('Review_GeneratedFrom');
		$this->db->join('Users','Review_GeneratedFrom.USER_ID=Users.USER_ID');
		$this->db->where('ISBN',$isbn);
		$this->db->where('VISIBILITY',1);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	public function get_book_friend_notes($isbn){
		if(!$this->session->userdata('logged_in')){
			return FALSE;
		}
		$user_id=$this->session->userdata('user_id');
		$friends_id='select USER_ID1 as USER_ID 
			from FRIENDOF where USER_ID2 = '.$user_id.'
			UNION
			select USER_ID2 as USER_ID 
			from FRIENDOF where USER_ID1 = '.$user_id;
		$query = $this->db->query("select * from Note_Records, Users where Note_Records.USER_ID = Users.USER_ID and VISIBILITY=1 and ISBN='".$isbn."' and Note_Records.USER_ID in (".$friends_id.")");
		return $query->result_array();
	}
	
	public function get_book_like_also_like($isbn){
		$user_ids = "select USER_ID from WantsToRead where ISBN='".$isbn."' union select USER_ID from Reading where ISBN='".$isbn."' union select USER_ID from Read where ISBN='".$isbn."'";
		$isbns = 'select ISBN from WantsToRead where USER_ID in ('.$user_ids.') union select ISBN from Reading where USER_ID in ('.$user_ids.') union select ISBN from Read where USER_ID in ('.$user_ids.')';
		$query = $this->db->query("select distinct ISBN from (".$isbns.") where ISBN <> '".$isbn."'");
		$x=0;
	    foreach($query->result_array() as $row){
			$books[$x]=$this->books_model->get_book($row['ISBN']);
			$books[$x]['AUTHORS']=$this->books_model->get_book_authors_name($row['ISBN']);
			$x++;
		}
		return $books;
	}
	
	public function get_book_tags($isbn){
		$this->db->select('TNAME');
		$query = $this->db->get_where('BelongsTo',array('ISBN'=>$isbn));
		return $query->result_array();
	}
	
	public function get_book_information($isbn){
		$info = $this->books_model->get_book($isbn);
		$info['AUTHORS'] = $this->books_model->get_book_authors($isbn);
		$info = array_merge($info,$this->books_model->get_book_avgstar($isbn));
		$info = array_merge($info,$this->books_model->get_book_reader_num($isbn));
		$info['TAGS'] = $this->books_model->get_book_tags($isbn);
		$info['REVIEWS'] = $this->books_model->get_book_reviews($isbn);
		$info['NOTES'] = $this->books_model->get_book_friend_notes($isbn);
		$info['RECOMBOOKS'] = $this->books_model->get_book_like_also_like($isbn);
		$info = array_merge($info, $this->books_model->get_book_reader_flag($isbn));
		return $info;
	}
	
	public function set_wanttoread(){
		$data = array(
			'USER_ID' => $this->session->userdata('user_id'),
			'ISBN' => $this->input->post('isbn'),
		);
		$query=$this->db->get_where('WANTSTOREAD',$data);
		$temp=$query->result_array();
		if(empty($temp)){
			$this->db->insert('WantsToRead',$data);
		}
	}
	
	public function set_reading(){
		$data = array(
			'USER_ID' => $this->session->userdata('user_id'),
			'ISBN' => $this->input->post('isbn'),
		);
		$query=$this->db->get_where('READING',$data);
		$temp=$query->result_array();
		if(empty($temp)){
			$this->db->insert('Reading',$data);
		}
	}
	
	public function set_read(){
		$data = array(
			'USER_ID' => $this->session->userdata('user_id'),
			'ISBN' => $this->input->post('isbn'),
		);
		$query=$this->db->get_where('READ',$data);
		$temp=$query->result_array();
		if(empty($temp)){
			$this->db->insert('Read',$data);
		}
	}
}