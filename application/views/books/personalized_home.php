<h3>Popular Books</h3>
<?php $x=0; ?>
<?php foreach ($popular_books as $book_item): ?>
	<?php if($x>4) break; ?> 
	<img src="<?php echo $book_item['COVER_URL'] ?>">
    <p><a href="<?php echo site_url('books/view/'.$book_item['ISBN']) ?>"><?php echo $book_item['BNAME'] ?></a></p>
	<p><?php echo $book_item['STARS']?> stars (<?php echo $book_item['COUNT']?>)</p>
	<p>Want to read (<?php echo $book_item['WANTSTOREAD_NUM']?>)&nbsp;&nbsp; Reading (<?php echo $book_item['READING_NUM']?>)&nbsp;&nbsp; Read (<?php echo $book_item['READ_NUM']?>)</p>
	<?php $x++; ?>
<?php endforeach ?>
<?php if(!empty($may_like_books)): ?>
<h3>Books You May Interested In</h3>
<?php $x=0; ?>
<?php foreach ($may_like_books as $book_item): ?>
	<?php if($x>4) break; ?> 
	<img src="<?php echo $book_item['COVER_URL'] ?>">
    <p><a href="<?php echo site_url('books/view/'.$book_item['ISBN']) ?>"><?php echo $book_item['BNAME'] ?></a></p>
	<p><?php echo $book_item['STARS']?> stars (<?php echo $book_item['COUNT']?>)</p>
	<p>Want to read (<?php echo $book_item['WANTSTOREAD_NUM']?>)&nbsp;&nbsp; Reading (<?php echo $book_item['READING_NUM']?>)&nbsp;&nbsp; Read (<?php echo $book_item['READ_NUM']?>)</p>
	<?php $x++; ?>
<?php endforeach ?>
<?php endif ?>
<?php if(!empty($friend_books)): ?>
<h3>Books Your Friends Are Reading</h3>
<?php $x=0; ?>
<?php foreach ($friend_books as $book_item): ?>
	<?php if($x>4) break; ?> 
	<img src="<?php echo $book_item['COVER_URL'] ?>">
    <p><a href="<?php echo site_url('books/view/'.$book_item['ISBN']) ?>"><?php echo $book_item['BNAME'] ?></a></p>
	<p><?php echo $book_item['STARS']?> stars (<?php echo $book_item['COUNT']?>)</p>
	<p>Want to read (<?php echo $book_item['WANTSTOREAD_NUM']?>)&nbsp;&nbsp; Reading (<?php echo $book_item['READING_NUM']?>)&nbsp;&nbsp; Read (<?php echo $book_item['READ_NUM']?>)</p>
	<?php $x++; ?>
<?php endforeach ?>
<?php endif ?>