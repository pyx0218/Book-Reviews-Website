<h2><?php echo $RTITLE ?></h2>
<div id="main">
	<p>From <a href="<?php echo site_url('users/view/'.$USER_ID) ?>"><?php echo $UNAME ?></a></p>
		<p>
		Review For: <a href="<?php echo site_url('books/view/'.$ISBN) ?>"><?php echo $BNAME ?></a>&nbsp;&nbsp; <?php echo $STARS ?> stars
		</p>
        <p><?php echo $RCONTENT ?></p>
		<p><?php echo $RDATE ?></p>
		<?php if($this->session->userdata('logged_in') && $this->session->userdata('user_id')==$USER_ID): ?>
		<p><a href="<?php echo site_url('reviews/edit/'.$RID) ?>">Edit</a>&nbsp;&nbsp; <a href="<?php echo site_url('reviews/delete/'.$RID) ?>">Delete</a></p>
		<?php endif ?>
</div>