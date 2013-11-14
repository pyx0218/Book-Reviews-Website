<h2><?php 
	echo $user['name'];
	if($user['admin']){
		echo' (Administrator)';
	}
?></h2>
<?php if($user['is_self'] == false && $user['isfriend'] == false){
	echo '<a class="btn" href = "/index.php/users/add_friend/'.$user['user_id'].'">Become Friend!</a>';
	}?>

<br>
<?php
	if($user['admin'] && $user['is_self']){
		echo '<div>
			<h3>My monitor operations:</h3>
			<p><table class="table">
			<tr>
			<th>Date</th>
			<th>Review Title</th>
			<th>Operation</th>
			<th>Reason</th>
			</tr>';
		foreach ($monitors as $monitor){
			echo '<tr>
				<td>'.$monitor['date'].'</td>
				<td><a href = "/index.php/reviews/view/'.$monitor['rid'].'">'.$monitor['title'].'</a></td>';
			if($monitor['operation'] == 0){
				echo'<td>Shield</td>';
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

<hr>
<div class="row">
	<h3><?php if($user['is_self']) echo'My '; else echo'His/her ' ?>friends:</h3>
	<p>
	<?php foreach ($friends as $fname){
		echo '<a href="/index.php/users/view/'.$fname['user_id'].'">'.$fname['name'].'</a>&nbsp;&nbsp;';
		if($user['is_self']){
			echo '<a class="btn" href="/index.php/users/unfriend/'.$fname['user_id'].'">unfriend</a>';
		}
		echo '<br>';
		
	}  ?>
	</p>
</div>

<hr>
<div class="row">
	<h3>Books <?php if($user['is_self']) echo'I\'m '; else echo'he/she is ' ?>reading now:</h3>
	<div class="row">
	<?php
		foreach ($reading as $book){
		echo '<div class="span3">';
		 echo '<img src="'.$book['cover_url'].'">';
		 echo '<p class="text-center"><a href="/index.php/books/view/'.$book['isbn'].'">'.$book['bname'].'</a></p>';
		 echo '<p class="text-center">';
		if($user['is_self'] || $user['isfriend']){
			foreach ($notes as $note){
				if($book['isbn'] == $note['isbn']){
					if($user['is_self'] || $user['isfriend'] || $note['visibility'] == 2)
					echo '<a href="/index.php/notes/view/'.$note['nid'].'">Note: page '.$note['page'].'</a><br>';
				}
			}
		}
		echo '</p>';
		echo '</div>';
	}
	?>
	</div>
</div>

<hr>
<div class="row">
	<h3>Books <?php if($user['is_self']) echo'I have '; else echo'he/she has ' ?>already read:</h3>
	<div class="row">
	<p>
	<?php foreach ($read as $book){
		echo '<div class="span3">';
		echo '<img src="'.$book['cover_url'].'">';
		echo '<p class="text-center"><a href="/index.php/books/view/'.$book['isbn'].'">'.$book['bname'].'</a></p>';
		echo '<p class="text-center">';
		foreach ($reviews as $review){
			if($book['isbn'] == $review['isbn']){
				if($review['visibility'] == 1 || $user['admin'])
				echo '<a href="/index.php/reviews/view/'.$review['rid'].'">Review: '.$review['rtitle'].'</a><br>';
			}
		}
		echo '</p>';
		echo '</div>';
	}
	?>
	</p>
	</div>
</div>

<hr>
<div class="row">
	<h3>Books <?php if($user['is_self']) echo'I want '; else echo'he/she wants ' ?>to read:</h3>
	<div class="row">
	<p>
	<?php foreach ($wantstoread as $book){
		echo '<div class="span3">';
		echo '<img src="'.$book['cover_url'].'">';
		echo '<p class="text-center"><a href="/index.php/books/view/'.$book['isbn'].'">'.$book['bname'].'</a></p>';
		echo '</p>';
		echo '</div>';
	}
	?>
	</p>
	</div>
</div>


