<!-- navigation -->
<a href = "/index.php/users/view/<?php echo $this->session->userdata('user_id'); ?>">
	<?php echo $this->session->userdata('user_name'); ?></a>
&nbsp;&nbsp;
<a href = "/index.php/users/setting">setting</a>
&nbsp;&nbsp;
<a href = "/index.php/users/logout">logout</a>