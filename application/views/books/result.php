<?php if(empty($books)): ?>
	<p>No result.</p>
<?php else: ?>
<?php foreach ($books as $books_item): ?>

    <h2><a href="<?php echo site_url('books/view/'.$books_item['ISBN']) ?>"><?php echo $books_item['BNAME'] ?></a></h2>
    <div id="main">
		<img src="<?php echo $books_item['COVER_URL'] ?>">
        <p><?php echo $books_item['PUBLISHER'] ?></p>
    </div>

<?php endforeach ?>
<?php endif ?>