

<h2><?php 
	echo $user['name'];
	if($user['admin']){
		echo' (Administrator)';
	}
?></h2>
<?php if($this->session->userdata('user_id') != $user['user_id'] && $user['isfriend'] == false){
	echo '<a href = "/index.php/users/add_friend/'.$user['user_id'].'">Become Friend!</a>';
	}?>

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
	<h3><?php if($user['is_self']) echo'My '; else echo'His/her ' ?>friends:</h3>
	<p>
	<?php foreach ($friends as $fname){
		echo '<a href="/index.php/users/view/'.$fname['user_id'].'">'.$fname['name'].'</a>&nbsp;&nbsp;';
		if($user['is_self']){
			echo '<a href="/index.php/users/unfriend/'.$fname['user_id'].'">unfriend</a>';
		}
		echo '<br>';
		
	}  ?>
	</p>
</div>
<div>
	<h3>Books <?php if($user['is_self']) echo'I\'m '; else echo'he/she is ' ?>reading now:</h3>
	<p>
	<?php
		foreach ($reading as $book){
		echo '<a href="/index.php/books/view/'.$book['isbn'].'">'.$book['bname'].'</a>&nbsp;&nbsp;';
		if($user['is_self'] || $user['isfriend']){
			foreach ($notes as $note){
				if($book['isbn'] == $note['isbn']){
					echo '<a href="/index.php/notes/view/'.$note['nid'].'">note: page '.$note['page'].'</a>&nbsp;&nbsp;';
				}
			}
		}
		
		echo '<br>';
	}
	?>
	</p>
</div>
<div>
	<h3>Books <?php if($user['is_self']) echo'I have '; else echo'he/she has ' ?>already read:</h3>
	<p>
	<?php foreach ($read as $book){
		echo '<a href="/index.php/books/view/'.$book['isbn'].'">'.$book['bname'].'</a>&nbsp;&nbsp;';
		foreach ($reviews as $review){
			if($book['isbn'] == $review['isbn']){
				echo '<a href="/index.php/reviews/view/'.$review['rid'].'">review: '.$review['rtitle'].'</a>&nbsp;&nbsp;';
			}
		}
		echo '<br>';
	}
	?>
	</p>
</div>
<div>
	<h3>Books <?php if($user['is_self']) echo'I want '; else echo'he/she wants ' ?>to read:</h3>
	<p>
	<?php foreach ($wantstoread as $book){
		echo '<a href="/index.php/books/view/'.$book['isbn'].'">'.$book['bname'].'</a><br>';
	}
	?>
	</p>
</div>


