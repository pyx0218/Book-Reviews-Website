<?php foreach ($books as $books_item): ?>

    <h2><?php echo $books_item['bname'] ?></h2>
    <div id="main">
        <?php echo $books_item['abstract'] ?>
    </div>
    <p><a href="http://localhost/index.php/books/<?php echo $books_item['isbn'] ?>">View book</a></p>

<?php endforeach ?>