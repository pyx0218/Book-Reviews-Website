<div id="main">
	<p>A note from <a href="<?php echo site_url('users/view/'.$USER_ID) ?>"><?php echo $UNAME ?></a>
		for <a href="<?php echo site_url('books/view/'.$ISBN) ?>"><?php echo $BNAME ?></a>
		on page <?php echo $PAGE ?>:</p>
        <p><?php echo $NCONTENT ?></p>
		<p><?php echo $NDATE ?></p>
		<?php if($this->session->userdata('logged_in') && $this->session->userdata('user_id')==$USER_ID): ?>
		<p><a href="<?php echo site_url('notes/edit/'.$NID) ?>">Edit</a>&nbsp;&nbsp; <a href="<?php echo site_url('notes/delete/'.$NID) ?>">Delete</a></p>
		<?php endif ?>
</div>