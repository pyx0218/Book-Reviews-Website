<h2><?php echo $BNAME ?></h2>

<?php echo validation_errors(); ?>
<?php echo form_open('reviews/create','',array('isbn'=>$ISBN)); ?>

  <label for="title">Title</label> 
  <input type="text" name="title" value="<?php echo set_value('title'); ?>"/></br>
  
  <label for="rating">Rating</label>
  <input type="radio" name="rating" value="1"/>1 
  <input type="radio" name="rating" value="2"/>2 
  <input type="radio" name="rating" value="3"/>3 
  <input type="radio" name="rating" value="4"/>4 
  <input type="radio" name="rating" value="5"/>5</br>
  
  <label for="content">Content</label>
  <textarea name="content" value="<?php echo set_value('content'); ?>"></textarea></br>
  
  <input type="submit" name="submit" value="Submit" /> 

</form>