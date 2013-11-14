<h2><?php echo $BNAME; ?></h2>

<?php echo validation_errors();?>
<?php echo form_open('notes/create','',array('isbn'=>$ISBN)); ?>

  <label for="title">Page</label> 
  <input type="text" name="page"  class="span4" value="<?php echo set_value('page'); ?>"/><br>
  
  <label for="content">Content</label>
  <textarea name="content" class="span6" rows="10"><?php echo set_value('content'); ?></textarea><br>
  
  <label for="visibility">Visibility</label>
  <input type="radio" name="visibility" value="1" <?php if(set_value('visibility')==1) echo 'checked'?>/>Only my friends can see it &nbsp;&nbsp;
  <input type="radio" name="visibility" value="2" <?php if(set_value('visibility')==2) echo 'checked'?>/>Everybody can see it <br><br>
  
  <input type="submit" name="submit"  class="btn" value="Submit" /> &nbsp;&nbsp;
  <input type="submit" name="cancel"  class="btn" value="Return" /> 

</form>