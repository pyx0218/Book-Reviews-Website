<h2><?php echo $BNAME ?></h2>

<?php echo validation_errors(); ?>
<?php echo form_open('reviews/update','',array('rid'=>$RID)); ?>

  <label for="title">Title</label> 
  <input type="text" name="title"  class="span4" value="<?php echo $RTITLE ?>"/><br>
  
  <label for="rating">Rating</label>
  <input type="radio" name="rating" value="1" <?php if($STARS==1) echo 'checked'?>/>1 &nbsp;&nbsp;
  <input type="radio" name="rating" value="2" <?php if($STARS==2) echo 'checked'?>/>2 &nbsp;&nbsp;
  <input type="radio" name="rating" value="3" <?php if($STARS==3) echo 'checked'?>/>3 &nbsp;&nbsp;
  <input type="radio" name="rating" value="4" <?php if($STARS==4) echo 'checked'?>/>4 &nbsp;&nbsp;
  <input type="radio" name="rating" value="5" <?php if($STARS==5) echo 'checked'?>/>5<br><br>
  
  <label for="content">Content</label>
  <textarea name="content"  class="span6" rows="10"><?php echo $RCONTENT ?></textarea><br>
  
  <input type="submit" name="submit" class="btn" value="Save" />&nbsp;&nbsp;
  <input type="submit" name="cancel" class="btn" value="Cancel" />  

</form>