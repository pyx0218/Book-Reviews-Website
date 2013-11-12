<h2><?php 
	echo $user['name'];
	if($user['admin']){
		echo' (Administrator)';
	}
?></h2>

<?php
	if($this->session->userdata('admin') && $user['user_id'] == $this->session->userdata['user_id']){
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
	<?php foreach ($friends as $fname){
		echo '<a href="/index.php/users/view/'.$fname['user_id'].'">'.$fname['name'].'</a><br>';
	}  ?>
	</p>
</div>
<div>
	<h3>Books I'm reading now:</h3>
	<p>
	<?php foreach ($reading as $book){
		echo '<a href="/index.php/books/view/'.$book['isbn'].'">'.$book['bname'].'</a><br>';
	}
	?>
	</p>
</div>
<div>
	<h3>Books I have already read:</h3>
	<p>
	<?php foreach ($read as $book){
		echo '<a href="/index.php/books/view/'.$book['isbn'].'">'.$book['bname'].'</a><br>';
	}
	?>
	</p>
</div>
<div>
	<h3>Books I want to read:</h3>
	<p>
	<?php foreach ($wantstoread as $book){
		echo '<a href="/index.php/books/view/'.$book['isbn'].'">'.$book['bname'].'</a><br>';
	}
	?>
	</p>
</div>


