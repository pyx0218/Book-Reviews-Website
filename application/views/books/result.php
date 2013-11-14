<?php if(empty($books)): ?>
	<p>No result.</p>
<?php else: ?>
<?php foreach ($books as $books_item): ?>
<hr>
<div class="row">
  <div class="span4">
    <img src="<?php echo $books_item['COVER_URL'] ?>">
	</a>
  </div>
  <div class="span8">
    <h3><a href="<?php echo site_url('books/view/'.$books_item['ISBN']) ?>"><?php echo $books_item['BNAME'] ?></a></h3>
    <div>
		<p>
		<?php foreach ($books_item['AUTHORS'] as $author):?>
			<?php echo $author['ANAME'] ?>&nbsp;&nbsp;
		<?php endforeach ?>
		</p>
        <p><?php echo $books_item['PUBLISHER'] ?></p>
		<p><?php echo $books_item['STARS']?> stars (<?php echo $books_item['COUNT']?>)</p>
		<p>Want to read (<?php echo $books_item['WANTSTOREAD_NUM']?>)&nbsp;&nbsp; Reading (<?php echo $books_item['READING_NUM']?>)&nbsp;&nbsp; Read (<?php echo $books_item['READ_NUM']?>)</p>
    </div>
  </div>
</div>
<?php endforeach ?>
<?php endif ?>