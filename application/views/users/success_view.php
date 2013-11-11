<h2><?php echo $this->session->userdata('user_name');?></h2>

<?php
	if($this->session->userdata('admin')){
		echo '<div>
			<h3>My monitor operations:</h3>
			<p><table border="1">
			<tr>
			<th>Date</th>
			<th>Review Title</th>
			<th>Operation</th>
			<th>Reason</th>
			</tr>';
		foreach ($monitors as $monitor){
			echo '<tr>
				<td>'.$monitor['date'].'</td>
				<td>'.$monitor['title'].'</td>';
			if($monitor['operation'] == 0){
				echo'<td>Delete</td>';
			}
			else{
				echo'<td>Restore</td>';
			}
			echo'<td>'.$monitor['reason'].'</td></tr>';
		}
		
		echo'</table></p>
		</div>';
	}
 ?>

<div id="main">
	<h3>My friends:</h3>
	<p>
	<?php foreach ($friends as $fname):?>
		<?php echo $fname.'<br>' ?>
	<?php endforeach ?>
	</p>
</div>
<div>
	<h3>Books I'm reading now:</h3>
	<p>
	<?php foreach ($reading as $book){
		echo '<a href="../books/view/'.$book['isbn'].'">'.$book['bname'].'</a><br>';
	}
	?>
	</p>
</div>
<div>
	<h3>Books I have already read:</h3>
	<p>
	<?php foreach ($read as $book){
		echo '<a href="../books/view/'.$book['isbn'].'">'.$book['bname'].'</a><br>';
	}
	?>
	</p>
</div>
<div>
	<h3>Books I want to read:</h3>
	<p>
	<?php foreach ($wantstoread as $book){
		echo '<a href="../books/view/'.$book['isbn'].'">'.$book['bname'].'</a><br>';
	}
	?>
	</p>
</div>


