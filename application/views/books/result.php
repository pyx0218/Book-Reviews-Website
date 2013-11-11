<?php if(empty($books)): ?>
	<p>No result.</p>
<?php else: ?>
<?php foreach ($books as $books_item): ?>

    <h2><a href="<?php echo site_url('books/view/'.$books_item['ISBN']) ?>"><?php echo $books_item['BNAME'] ?></a></h2>
    <div id="main">
		<p>
		<?php foreach ($books_item['AUTHORS'] as $author):?>
			<?php echo $author['ANAME'] ?>&nbsp;&nbsp;
		<?php endforeach ?>
		</p>
        <p><?php echo $books_item['PUBLISHER'] ?></p>
		<p><?php echo $books_item['STARS']?> stars (<?php echo $books_item['COUNT']?>)</p>
		<p>Want to read (<?php echo $books_item['WANTSTOREAD']?>)&nbsp;&nbsp; Reading (<?php echo $books_item['READING']?>)&nbsp;&nbsp; Read (<?php echo $books_item['READ']?>)</p>
		<img src="<?php echo $books_item['COVER_URL'] ?>">
    </div>

<?php endforeach ?>
<?php endif ?>