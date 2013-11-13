<!-- navigation -->
<?php if($this->session->userdata('logged_in')){
		echo '<a href = "/index.php/users/view/'.$this->session->userdata('user_id').'">'.$this->session->userdata('user_name').'</a>
		&nbsp;&nbsp;
		<a href = "/index.php/users/setting">setting</a>
		&nbsp;&nbsp;
		<a href = "/index.php/users/logout">logout</a>';
	}
	else{
		echo '<a href = "/index.php/users/login">Please login!</a>';
	}
 ?>