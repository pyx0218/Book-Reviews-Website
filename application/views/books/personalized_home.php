<div class="row">
<h3>Popular Books</h3>
<div class="row">
<?php $x=0; ?>
<?php foreach ($popular_books as $book_item): ?>
	<?php if($x>4) break; ?> 
	<div class="span2">
		<img src="<?php echo $book_item['COVER_URL'] ?>">
		<p class="text-center"><a href="<?php echo site_url('books/view/'.$book_item['ISBN']) ?>"><?php echo $book_item['BNAME'] ?></a></p>
		<p class="text-center"><?php echo number_format($book_item['STARS'],1)?> stars (<?php echo $book_item['COUNT']?>)</p>
		<p class="text-center">Want to read (<?php echo $book_item['WANTSTOREAD_NUM']?>)<br>
		Reading (<?php echo $book_item['READING_NUM']?>)<br> 
		Read (<?php echo $book_item['READ_NUM']?>)</p>
		<?php $x++; ?>
	</div>
<?php endforeach ?>
</div>
</div>

<hr>
<div class="row">
<?php if(!empty($may_like_books)): ?>
<h3>Books You May Interested In</h3>
<?php $x=0; ?>
<?php foreach ($may_like_books as $book_item): ?>
	<?php if($x>4) break; ?> 
	<div class="span2">
		<img src="<?php echo $book_item['COVER_URL'] ?>">
		<p class="text-center"><a href="<?php echo site_url('books/view/'.$book_item['ISBN']) ?>"><?php echo $book_item['BNAME'] ?></a></p>
		<p class="text-center"><?php echo number_format($book_item['STARS'],1)?> stars (<?php echo $book_item['COUNT']?>)</p>
		<p class="text-center">Want to read (<?php echo $book_item['WANTSTOREAD_NUM']?>)<br> 
		Reading (<?php echo $book_item['READING_NUM']?>)<br> 
		Read (<?php echo $book_item['READ_NUM']?>)</p>
		<?php $x++; ?>
	</div>
<?php endforeach ?>
<?php endif ?>
</div>

<hr>
<div class="row">
<?php if(!empty($friend_books)): ?>
<h3>Books Your Friends Are Reading</h3>
<?php $x=0; ?>
<?php foreach ($friend_books as $book_item): ?>
	<?php if($x>4) break; ?> 
	<div class="span2">
		<img src="<?php echo $book_item['COVER_URL'] ?>">
		<p class="text-center"><a href="<?php echo site_url('books/view/'.$book_item['ISBN']) ?>"><?php echo $book_item['BNAME'] ?></a></p>
		<p class="text-center"><?php echo number_format($book_item['STARS'],1)?> stars (<?php echo $book_item['COUNT']?>)</p>
		<p class="text-center">Want to read (<?php echo $book_item['WANTSTOREAD_NUM']?>)<br>
		Reading (<?php echo $book_item['READING_NUM']?>)<br> 
		Read (<?php echo $book_item['READ_NUM']?>)</p>
		<?php $x++; ?>
	</div>
<?php endforeach ?>
<?php endif ?>
</div>