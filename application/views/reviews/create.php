<h2><?php echo $BNAME ?></h2>

<?php echo validation_errors(); ?>
<?php echo form_open('reviews/create','',array('isbn'=>$ISBN)); ?>

  <label for="title">Title</label> 
  <input type="text" class="span4" name="title" value="<?php echo set_value('title'); ?>"/><br>
  
  <label>Rating</label>
  <input type="radio" name="rating" value="1" <?php if(set_value('rating')==1) echo 'checked'?>/>1 &nbsp;&nbsp;
  <input type="radio" name="rating" value="2" <?php if(set_value('rating')==2) echo 'checked'?>/>2 &nbsp;&nbsp;
  <input type="radio" name="rating" value="3" <?php if(set_value('rating')==3) echo 'checked'?>/>3 &nbsp;&nbsp;
  <input type="radio" name="rating" value="4" <?php if(set_value('rating')==4) echo 'checked'?>/>4 &nbsp;&nbsp;
  <input type="radio" name="rating" value="5" <?php if(set_value('rating')==5) echo 'checked'?>/>5
  <br><br>
  <label for="content">Content</label>
  <textarea name="content" class="span6" rows="10"><?php echo set_value('content'); ?></textarea><br>
  
  <input type="submit" name="submit" class="btn" value="Submit" />&nbsp;&nbsp;
  <input type="submit" name="cancel" class="btn" value="Return" /> 

</form>