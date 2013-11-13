<h2><?php echo $review_item['RTITLE'] ?></h2>
<div id="main">
	<p>From <a href="<?php echo site_url('users/view/'.$review_item['USER_ID']) ?>"><?php echo $review_item['UNAME'] ?></a></p>
		<p>
		Review For: <a href="<?php echo site_url('books/view/'.$review_item['ISBN']) ?>"><?php echo $review_item['BNAME'] ?></a>&nbsp;&nbsp; <?php echo $review_item['STARS'] ?> stars
		</p>
        <p><?php echo $review_item['RCONTENT'] ?></p>
		<p><?php echo $review_item['RDATE'] ?></p>
		<?php if($logged_in && $is_self): ?>
		<p><a href="<?php echo site_url('reviews/edit/'.$review_item['RID']) ?>">Edit</a>&nbsp;&nbsp; <a href="<?php echo site_url('reviews/delete/'.$review_item['RID']) ?>">Delete</a></p>
		<?php endif ?>
		<?php if ($admin){
			echo '<p><a href = "
				'.site_url('reviews/shield/'.$review_item['RID']).'">Shield this review
			</a></p>';
		}
		?>
</div>