<h2>Page <?php echo $PAGE ?></h2>
<div>
	<p>From <a href="<?php echo site_url('users/view/'.$USER_ID) ?>"><?php echo $UNAME ?></a></p>
	<p>Note For: <a href="<?php echo site_url('books/view/'.$ISBN) ?>"><?php echo $BNAME ?></a>&nbsp;&nbsp;
	<?php if($VISIBILITY==1): ?>
		Only friends can see it
	<?php else: ?>
		EveryBody can see it
	<?php endif ?>
	</p>
        <p><?php echo $NCONTENT ?></p>
		<p><?php echo $NDATE ?></p>
		<?php if($this->session->userdata('logged_in') && $this->session->userdata('user_id')==$USER_ID): ?>
		<p><a href="<?php echo site_url('notes/edit/'.$NID) ?>">Edit</a>&nbsp;&nbsp; <a href="<?php echo site_url('notes/delete/'.$NID) ?>">Delete</a></p>
		<?php endif ?>
</div>