<h2><?php echo $this->session->userdata('user_name');?></h2>
<div id="main">
	<h3>My Friends:</h3>
	<p>
	<?php foreach ($friends as $fname):?>
		<?php echo $fname ?>&nbsp;&nbsp;
	<?php endforeach ?>
	</p>
</div>
<div>
	<h3>Books I'm reading now:</h3>
	<p>
	<?php foreach ($reading as $book):?>
		<?php echo $book['bname'].'qwe'.$book['isbn'] ?>&nbsp;&nbsp;
	<?php endforeach ?>
	</p>
</div>
<div>
	<h3>Books I have already read:</h3>
	<p>
	<?php foreach ($read as $book):?>
		<?php echo $book['bname'].'qwe'.$book['isbn'] ?>&nbsp;&nbsp;
	<?php endforeach ?>
	</p>
</div>
<div>
	<h3>Books I want to read:</h3>
	<p>
	<?php foreach ($wantstoread as $book):?>
		<?php echo $book['bname'].'qwe'.$book['isbn'] ?>&nbsp;&nbsp;
	<?php endforeach ?>
	</p>
</div>
