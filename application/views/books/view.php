<h2><?php echo $books_item['BNAME']?></h2>
<div class="row">
	<div class="span4">
		<img src="<?php echo $books_item['COVER_URL'] ?>">
	</div>
	<div class="span8">
		<p>
		Author: 
		<?php foreach ($books_item['AUTHORS'] as $author):?>
			<?php echo $author['ANAME'] ?>&nbsp;&nbsp;
		<?php endforeach ?>
		</p>
        <p>Publisher: <?php echo $books_item['PUBLISHER'] ?></p>
		<p>ISBN: <?php echo $books_item['ISBN'] ?></p>
		<p><?php echo $books_item['STARS']?> stars (<?php echo $books_item['COUNT']?>)</p>

		<?php echo form_open('books/change_status',array('class'=>'form-inline'),array('isbn'=>$books_item['ISBN'])); ?>
		<label>I want to read it (<?php echo $books_item['WANTSTOREAD_NUM']?>)</label>
		<?php if($books_item['WANTSTOREAD_FLAG']): ?>
			<input type="submit" name="unwanttoread" class="btn" value="-1" /> 
		<?php else: ?>
		<input type="submit" name="wanttoread" class="btn"  value="+1" /> 
		<?php endif ?><br><br>
		<label class="control-label">I am reading it (<?php echo $books_item['READING_NUM']?>)</label>
		<?php if($books_item['READING_FLAG']): ?>
		<input type="submit" name="unreading" class="btn" value="-1" />
		<?php else: ?>
		<input type="submit" name="reading" class="btn" value="+1" />
		<?php endif ?><br><br>
		<label class="control-label">I have read it (<?php echo $books_item['READ_NUM']?>)</label>
		<?php if($books_item['READ_FLAG']): ?>
		<input type="submit" name="unread" class="btn" value="-1" />
		<?php else: ?>
		<input type="submit" name="read" class="btn" value="+1" />
		<?php endif ?>
		
		</form>	
		<p>
		<a href="<?php echo site_url('reviews/new_review/'.$books_item['ISBN']) ?>">Write a Review</a>&nbsp;&nbsp;
		<a href="<?php echo site_url('notes/new_note/'.$books_item['ISBN']) ?>">Take a Note</a>
		</p>
	</div>
</div>

<hr>
<div class="row">
<h3>Description</h3>
<p><?php echo $books_item['ABSTRACT']?></p>
</div>

<hr>
<div class="row">
<h3>About the Authors</h3>
<?php foreach ($books_item['AUTHORS'] as $author):?>
<h4><?php echo $author['ANAME'] ?></h4>
<p><?php echo $author['INTRODUCTION'] ?></p>
<?php endforeach ?>
</div>

<hr>
<div class="row">
<h3>Tags</h3>
<p>
<?php foreach ($books_item['TAGS'] as $tag):?>
<?php echo $tag['TNAME'] ?>&nbsp;&nbsp;
<?php endforeach ?>
</p>
</div>

<hr>
<div class="row">
<h3>Reviews</h3>
<?php foreach ($books_item['REVIEWS'] as $review):?>
<h4><a href="<?php echo site_url('reviews/view/'.$review['RID']) ?>"><?php echo $review['RTITLE'] ?></a></h4>
<p><a href="<?php echo site_url('users/view/'.$review['USER_ID']) ?>"><?php echo $review['UNAME'] ?></a>&nbsp;&nbsp;<?php echo $review['STARS'] ?> stars</p>
<div>
<p><?php echo $review['RCONTENT'] ?></p>
</div>
<p><?php echo $review['RDATE'] ?></p>
<?php endforeach ?>
</div>

<hr>
<?php if (!empty($books_item['NOTES'])): ?>
<div class="row">
<h3>Notes</h3>
<?php foreach ($books_item['NOTES'] as $note):?>
<h4><a href="<?php echo site_url('notes/view/'.$note['NID']) ?>">page<?php echo $note['PAGE'] ?></a></h4>
<a href="<?php echo site_url('users/view/'.$note['USER_ID']) ?>"><?php echo $note['UNAME'] ?></a><br>
<p><?php echo $note['NCONTENT'] ?></p>
<p><?php echo $note['NDATE'] ?></p>
<?php endforeach ?>
</div>
<?php endif ?>

<hr>
<div class="row">
	<h3>Readers Who Like This Book Also Like</h3>
	<div class="row">
		<?php $x=0; ?>
		<?php foreach ($books_item['RECOMBOOKS'] as $book):?>
		<?php if($x>4) break; ?> 
		<div class="span2">
			<img src="<?php echo $book['COVER_URL'] ?>">
			<h4 class="text-center"><a href="<?php echo site_url('books/view/'.$book['ISBN']) ?>"><?php echo $book['BNAME'] ?></a></h4>
			<p class="text-center">
			<?php foreach ($book['AUTHORS'] as $author):?>
				<?php echo $author['ANAME'] ?>&nbsp;&nbsp;
			<?php endforeach ?>
			</p>
		</div>
		<?php $x++; ?>
		<?php endforeach ?>
	</div>
</div>
